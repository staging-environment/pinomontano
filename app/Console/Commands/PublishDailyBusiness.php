<?php

namespace App\Console\Commands;

use App\Models\Business;
use App\Models\SocialPost;
use App\Services\SocialMediaService;
use Illuminate\Console\Command;

class PublishDailyBusiness extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:publish-daily-business {--business-id= : Publish a specific business by ID for testing}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish one approved new business daily to configured social media platforms';

    /**
     * The SocialMediaService instance.
     */
    protected $socialMediaService;

    /**
     * Create a new command instance.
     */
    public function __construct(SocialMediaService $socialMediaService)
    {
        parent::__construct();
        $this->socialMediaService = $socialMediaService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $configuredPlatforms = $this->getConfiguredPlatforms();

        if (empty($configuredPlatforms)) {
            $this->warn('No social media platforms are configured. Please check your .env credentials.');
            return Command::FAILURE;
        }

        $this->info('Configured platforms: ' . implode(', ', $configuredPlatforms));

        $businessId = $this->option('business-id');
        $business = null;

        if ($businessId) {
            $business = Business::where('is_approved', true)->find($businessId);
            if (!$business) {
                $this->error("Approved business with ID {$businessId} not found.");
                return Command::FAILURE;
            }
        } else {
            // Find the oldest approved business that is missing successful posts for at least one configured platform,
            // but has not exceeded the max retry limit of 3 failed attempts for that platform.
            $business = Business::where('is_approved', true)
                ->where(function ($query) use ($configuredPlatforms) {
                    foreach ($configuredPlatforms as $platform) {
                        $query->orWhere(function ($subQuery) use ($platform) {
                            // No successful post for this platform
                            $subQuery->whereNotExists(function ($q) use ($platform) {
                                $q->selectRaw(1)
                                    ->from('social_posts')
                                    ->whereColumn('social_posts.business_id', 'businesses.id')
                                    ->where('platform', $platform)
                                    ->where('status', 'success');
                            })
                            // AND fewer than 3 failed attempts for this platform
                            ->where(function ($q) use ($platform) {
                                $q->selectRaw('count(*)')
                                    ->from('social_posts')
                                    ->whereColumn('social_posts.business_id', 'businesses.id')
                                    ->where('platform', $platform)
                                    ->where('status', 'failed');
                            }, '<', 3);
                        });
                    }
                })
                ->orderBy('created_at', 'asc')
                ->first();
        }

        if (!$business) {
            $this->info('No new approved businesses to publish. Checking for promotional fallback...');

            $prompts = [
                "¡Apoya al comercio local de Pino Montano! 🛍️ Descubre todos los negocios del barrio en nuestro Marketplace. ¿Tienes un comercio? ¡Regístrate gratis y llega a más vecinos! 👉 " . config('app.url'),
                "Hacer barrio es comprar en el barrio. ❤️ Descubre las mejores tiendas, bares y servicios de Pino Montano en un solo lugar. ¿Aún no estás apuntado? Únete hoy gratis: " . config('app.url'),
                "Encuentra lo que necesitas sin salir de Pino Montano. 📍 Desde talleres hasta fruterías y peluquerías. Si tienes un negocio en el barrio, regístrate gratis aquí: " . config('app.url')
            ];
            $promoMessage = $prompts[array_rand($prompts)];
            $promoPublishedCount = 0;

            foreach ($configuredPlatforms as $platform) {
                // Check if already published successfully today
                $alreadyPublishedToday = SocialPost::whereNull('business_id')
                    ->where('platform', $platform)
                    ->where('status', 'success')
                    ->whereDate('created_at', today())
                    ->exists();

                if ($alreadyPublishedToday) {
                    $this->info("Promotional post already successfully published to {$platform} today. Skipping.");
                    continue;
                }

                $this->info("Publishing promotional post to {$platform}...");

                $result = null;
                if ($platform === 'x') {
                    $result = $this->socialMediaService->postRawToX($promoMessage);
                } elseif ($platform === 'facebook') {
                    $result = $this->socialMediaService->postRawToFacebook($promoMessage, config('app.url'));
                } elseif ($platform === 'instagram') {
                    $imageUrl = 'https://images.unsplash.com/photo-1513151233558-d860c5398176?auto=format&fit=crop&w=1000&q=80';
                    $result = $this->socialMediaService->postRawToInstagram($promoMessage, $imageUrl);
                } elseif ($platform === 'telegram') {
                    $result = $this->socialMediaService->postRawToTelegram($promoMessage);
                }

                if ($result) {
                    SocialPost::create([
                        'business_id' => null,
                        'platform' => $platform,
                        'status' => $result['status'],
                        'error_message' => $result['status'] === 'failed' ? ($result['error'] ?? 'Unknown error') : null,
                    ]);

                    if ($result['status'] === 'success') {
                        $this->info("Successfully published promotional post to {$platform}!");
                        $promoPublishedCount++;
                    } else {
                        $this->error("Failed to publish promotional post to {$platform}: " . ($result['error'] ?? 'Unknown error'));
                    }
                }
            }

            if ($promoPublishedCount > 0) {
                $this->info("Promotional fallback completed successfully. Posted to {$promoPublishedCount} platforms.");
            } else {
                $this->info("No promotional posts were published (either already published or all failed).");
            }

            return Command::SUCCESS;
        }

        $this->info("Selected business: {$business->name} (ID: {$business->id})");

        foreach ($configuredPlatforms as $platform) {
            // Check if already published successfully
            $alreadyPublished = SocialPost::where('business_id', $business->id)
                ->where('platform', $platform)
                ->where('status', 'success')
                ->exists();

            if ($alreadyPublished && !$businessId) {
                $this->info("Already successfully published to {$platform}. Skipping.");
                continue;
            }

            $this->info("Publishing to {$platform}...");

            $result = null;
            if ($platform === 'x') {
                $result = $this->socialMediaService->postToX($business);
            } elseif ($platform === 'facebook') {
                $result = $this->socialMediaService->postToFacebook($business);
            } elseif ($platform === 'instagram') {
                $result = $this->socialMediaService->postToInstagram($business);
            } elseif ($platform === 'telegram') {
                $result = $this->socialMediaService->postToTelegram($business);
            }

            if ($result) {
                SocialPost::create([
                    'business_id' => $business->id,
                    'platform' => $platform,
                    'status' => $result['status'],
                    'error_message' => $result['status'] === 'failed' ? ($result['error'] ?? 'Unknown error') : null,
                ]);

                if ($result['status'] === 'success') {
                    $this->info("Successfully published to {$platform}!");
                } else {
                    $this->error("Failed to publish to {$platform}: " . ($result['error'] ?? 'Unknown error'));
                }
            }
        }

        return Command::SUCCESS;
    }

    /**
     * Get list of platforms with configured env keys.
     */
    protected function getConfiguredPlatforms(): array
    {
        $platforms = [];

        if (config('services.x.consumer_key') &&
            config('services.x.consumer_secret') &&
            config('services.x.access_token') &&
            config('services.x.access_token_secret')) {
            $platforms[] = 'x';
        }

        if (config('services.meta.page_id') &&
            config('services.meta.page_access_token')) {
            $platforms[] = 'facebook';
        }

        if (config('services.meta.instagram_business_id') &&
            config('services.meta.page_access_token')) {
            $platforms[] = 'instagram';
        }

        if (config('services.telegram.bot_token') &&
            config('services.telegram.chat_id')) {
            $platforms[] = 'telegram';
        }

        return $platforms;
    }
}
