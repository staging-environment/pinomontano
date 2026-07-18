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
    protected $signature = 'app:publish-daily-business {--business-id= : Publish a specific business by ID for testing} {--name-origin : Publish the history of the name "Pino Montano" instead of a business}';

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

        if ($this->option('name-origin')) {
            $this->info('Publishing name origin story to configured platforms...');
            $message = "¿Sabías de dónde viene el nombre de \"Pino Montano\"? 🌲 A finales del s. XIX, el hacendado Sr. Montano plantó pinos en su finca para dar sombra a sus jornaleros. Con el tiempo se conoció como \"los pinos de Montano\", dando origen al Cortijo y al posterior barrio obrero. ¡Conoce toda la historia! 👉 " . route('barrio.name-origin');
            $link = route('barrio.name-origin');
            $publishedCount = 0;

            foreach ($configuredPlatforms as $platform) {
                $this->info("Publishing to {$platform}...");
                $result = null;
                if ($platform === 'x') {
                    $result = $this->socialMediaService->postRawToX($message);
                } elseif ($platform === 'facebook') {
                    $result = $this->socialMediaService->postRawToFacebook($message, $link);
                } elseif ($platform === 'instagram') {
                    $imageUrl = 'https://images.unsplash.com/photo-1513151233558-d860c5398176?auto=format&fit=crop&w=1000&q=80';
                    $result = $this->socialMediaService->postRawToInstagram($message, $imageUrl);
                } elseif ($platform === 'telegram') {
                    $result = $this->socialMediaService->postRawToTelegram($message);
                }

                if ($result) {
                    SocialPost::create([
                        'business_id' => null,
                        'platform' => $platform,
                        'status' => $result['status'],
                        'error_message' => $result['status'] === 'failed' ? ($result['error'] ?? 'Unknown error') : null,
                    ]);

                    if ($result['status'] === 'success') {
                        $this->info("Successfully published to {$platform}!");
                        $publishedCount++;
                    } else {
                        $this->error("Failed to publish to {$platform}: " . ($result['error'] ?? 'Unknown error'));
                    }
                }
            }

            return $publishedCount > 0 ? Command::SUCCESS : Command::FAILURE;
        }

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
                [
                    'message' => "¿Sabías de dónde viene el nombre de nuestro barrio \"Pino Montano\"? 🌲 El hacendado Sr. Montano plantó pinos en su finca para dar sombra a sus jornaleros, dando origen al nombre del cortijo y del posterior barrio obrero. ¡Descubre la historia completa! 👉",
                    'link' => route('barrio.name-origin')
                ],
                [
                    'message' => "¿Sabías que el Cortijo de Pino Montano fue cuna de la Generación del 27? 🎭 Fincas emblemáticas de nuestro barrio acogieron tertulias e inspiraron a poetas como Federico García Lorca y Rafael Alberti gracias al torero Ignacio Sánchez Mejías. ¡Descubre la historia completa de nuestras raíces! 👉",
                    'link' => route('barrio.history')
                ],
                [
                    'message' => "¿Sabías que el Parque de Miraflores fue salvado por los propios vecinos? 🌳 En los años 80, este espacio corría el riesgo de convertirse en un enorme vertedero de escombros. Gracias a la unión del barrio y el Comité Pro-Parque Educativo, hoy es el pulmón verde del norte de Sevilla. Conoce más curiosidades aquí 👉",
                    'link' => route('barrio.history')
                ],
                [
                    'message' => "El alma de Pino Montano se forjó en las intensas luchas vecinales de los años 70 y 80. 🏗️ Al recibir viviendas en un barrio sin asfaltar, sin autobuses ni colegios, los vecinos se unieron para conquistar cada derecho básico. ¡Hacer barrio es recordar de dónde venimos! Lee la historia aquí 👉",
                    'link' => route('barrio.history')
                ],
                [
                    'message' => "¿Sabías que las tierras de Pino Montano eran el granero de la Hispalis romana? 🌾 Las excavaciones arqueológicas demuestran la existencia de villas rústicas y prensas de aceite de oliva en nuestra vega desde el siglo I a.C. ¡Un legado milenario de trabajo agrícola! Descubre más 👉",
                    'link' => route('barrio.origins')
                ],
                [
                    'message' => "Durante el periodo andalusí y almohade (siglos XII-XIII), la zona norte de Sevilla albergaba una rica red de huertas protegidas por torres de vigilancia, como la del Cortijo de Miraflores. 🗼 ¡El agua y la agricultura revolucionaron nuestra tierra! Conoce la historia de nuestros orígenes 👉",
                    'link' => route('barrio.origins')
                ],
                [
                    'message' => "¡Apoya al comercio local de Pino Montano! 🛍️ Descubre todos los negocios del barrio en nuestro Marketplace. ¿Tienes un comercio? ¡Regístrate gratis y llega a más vecinos! 👉",
                    'link' => config('app.url')
                ],
                [
                    'message' => "Hacer barrio es comprar en el barrio. ❤️ Descubre las mejores tiendas, bares y servicios de Pino Montano en un solo lugar. ¿Aún no estás apuntado? Únete hoy gratis 👉",
                    'link' => config('app.url')
                ],
                [
                    'message' => "Encuentra lo que necesitas sin salir de Pino Montano. 📍 Desde talleres hasta fruterías y peluquerías. Si tienes un negocio en el barrio, regístrate gratis aquí 👉",
                    'link' => config('app.url')
                ]
            ];
            $selectedPrompt = $prompts[array_rand($prompts)];
            $promoMessage = $selectedPrompt['message'] . ' ' . $selectedPrompt['link'];
            $promoLink = $selectedPrompt['link'];
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
                    $result = $this->socialMediaService->postRawToFacebook($promoMessage, $promoLink);
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
