<?php

namespace Tests\Feature;

use App\Models\Business;
use App\Models\SocialPost;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class PublishDailyBusinessTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Configure dummy credentials for testing
        config([
            'services.x.consumer_key' => 'test_consumer_key',
            'services.x.consumer_secret' => 'test_consumer_secret',
            'services.x.access_token' => 'test_access_token',
            'services.x.access_token_secret' => 'test_access_token_secret',
            'services.meta.page_id' => 'test_page_id',
            'services.meta.instagram_business_id' => 'test_instagram_business_id',
            'services.meta.page_access_token' => 'test_page_access_token',
            'services.telegram.bot_token' => 'test_bot_token',
            'services.telegram.chat_id' => '@test_chat_id',
        ]);
    }

    /**
     * Test daily publishing picks the oldest approved, unpublished business.
     */
    public function test_publish_daily_business_command_picks_oldest_approved_unpublished()
    {
        Http::fake([
            'api.twitter.com/2/tweets' => Http::response(['id' => 'x_123'], 201),
            'graph.facebook.com/v20.0/test_page_id/feed' => Http::response(['id' => 'fb_123'], 200),
            'graph.facebook.com/v20.0/test_instagram_business_id/media' => Http::response(['id' => 'ig_container_123'], 200),
            'graph.facebook.com/v20.0/test_instagram_business_id/media_publish' => Http::response(['id' => 'ig_123'], 200),
            'api.telegram.org/bottest_bot_token/sendMessage' => Http::response(['ok' => true], 200),
        ]);

        // Business 1: Oldest, approved
        $business1 = Business::create([
            'name' => 'Bar Pepe',
            'slug' => 'bar-pepe',
            'category' => 'Restauración',
            'description' => 'Tapas ricas en Pino Montano',
            'address' => 'Calle Estrella Altair, 5',
            'is_approved' => true,
            'created_at' => now()->subDays(2),
        ]);

        // Business 2: Newer, approved
        $business2 = Business::create([
            'name' => 'Peluquería Estilo',
            'slug' => 'peluqueria-estilo',
            'category' => 'Peluquerías',
            'description' => 'Cortes de pelo modernos',
            'address' => 'Calle Camino de los Toros, 12',
            'is_approved' => true,
            'created_at' => now()->subDay(),
        ]);

        // Business 3: Not approved
        $business3 = Business::create([
            'name' => 'Comercio Pendiente',
            'slug' => 'comercio-pendiente',
            'category' => 'Otros',
            'description' => 'Pendiente de aprobación',
            'is_approved' => false,
            'created_at' => now(),
        ]);

        // Run the command
        $this->artisan('app:publish-daily-business')
            ->expectsOutput('Configured platforms: x, facebook, instagram, telegram')
            ->expectsOutput('Selected business: Bar Pepe (ID: ' . $business1->id . ')')
            ->expectsOutput('Publishing to x...')
            ->expectsOutput('Successfully published to x!')
            ->expectsOutput('Publishing to facebook...')
            ->expectsOutput('Successfully published to facebook!')
            ->expectsOutput('Publishing to instagram...')
            ->expectsOutput('Successfully published to instagram!')
            ->expectsOutput('Publishing to telegram...')
            ->expectsOutput('Successfully published to telegram!')
            ->assertExitCode(0);

        // Verify database records are created
        $this->assertDatabaseHas('social_posts', [
            'business_id' => $business1->id,
            'platform' => 'x',
            'status' => 'success',
        ]);
        $this->assertDatabaseHas('social_posts', [
            'business_id' => $business1->id,
            'platform' => 'facebook',
            'status' => 'success',
        ]);
        $this->assertDatabaseHas('social_posts', [
            'business_id' => $business1->id,
            'platform' => 'instagram',
            'status' => 'success',
        ]);
        $this->assertDatabaseHas('social_posts', [
            'business_id' => $business1->id,
            'platform' => 'telegram',
            'status' => 'success',
        ]);

        // Verify Http requests were made
        Http::assertSentCount(5); // 1 X + 1 FB + 2 IG (container + publish) + 1 Telegram

        // Run the command again. It should pick Business 2 because Business 1 is already published.
        Http::fake([
            'api.twitter.com/2/tweets' => Http::response(['id' => 'x_456'], 201),
            'graph.facebook.com/v20.0/test_page_id/feed' => Http::response(['id' => 'fb_456'], 200),
            'graph.facebook.com/v20.0/test_instagram_business_id/media' => Http::response(['id' => 'ig_container_456'], 200),
            'graph.facebook.com/v20.0/test_instagram_business_id/media_publish' => Http::response(['id' => 'ig_456'], 200),
            'api.telegram.org/bottest_bot_token/sendMessage' => Http::response(['ok' => true], 200),
        ]);

        $this->artisan('app:publish-daily-business')
            ->expectsOutput('Configured platforms: x, facebook, instagram, telegram')
            ->expectsOutput('Selected business: Peluquería Estilo (ID: ' . $business2->id . ')')
            ->assertExitCode(0);

        // Verify Business 2 was published
        $this->assertDatabaseHas('social_posts', [
            'business_id' => $business2->id,
            'platform' => 'x',
            'status' => 'success',
        ]);

        // Run the command a third time. Only unapproved business left. Should trigger promotional fallback.
        $this->artisan('app:publish-daily-business')
            ->expectsOutput('Configured platforms: x, facebook, instagram, telegram')
            ->expectsOutput('No new approved businesses to publish. Checking for promotional fallback...')
            ->expectsOutput('Publishing promotional post to x...')
            ->expectsOutput('Successfully published promotional post to x!')
            ->expectsOutput('Publishing promotional post to facebook...')
            ->expectsOutput('Successfully published promotional post to facebook!')
            ->expectsOutput('Publishing promotional post to instagram...')
            ->expectsOutput('Successfully published promotional post to instagram!')
            ->expectsOutput('Publishing promotional post to telegram...')
            ->expectsOutput('Successfully published promotional post to telegram!')
            ->expectsOutput('Promotional fallback completed successfully. Posted to 4 platforms.')
            ->assertExitCode(0);
    }

    /**
     * Test command handles API failures correctly.
     */
    public function test_publish_daily_business_command_handles_failures()
    {
        // Mock X to fail first and then succeed on retry, and Facebook/Instagram to succeed
        Http::fake([
            'api.twitter.com/2/tweets' => Http::sequence()
                ->push('Unauthorized', 401)
                ->push(['id' => 'x_retry_success'], 201),
            'graph.facebook.com/v20.0/test_page_id/feed' => Http::response(['id' => 'fb_123'], 200),
            'graph.facebook.com/v20.0/test_instagram_business_id/media' => Http::response(['id' => 'ig_container_123'], 200),
            'graph.facebook.com/v20.0/test_instagram_business_id/media_publish' => Http::response(['id' => 'ig_123'], 200),
            'api.telegram.org/bottest_bot_token/sendMessage' => Http::response(['ok' => true], 200),
        ]);

        $business = Business::create([
            'name' => 'Bar Pepe',
            'slug' => 'bar-pepe',
            'category' => 'Restauración',
            'is_approved' => true,
        ]);

        $this->artisan('app:publish-daily-business')
            ->expectsOutput('Configured platforms: x, facebook, instagram, telegram')
            ->expectsOutput('Selected business: Bar Pepe (ID: ' . $business->id . ')')
            ->expectsOutput('Publishing to x...')
            ->expectsOutput('Failed to publish to x: Unauthorized')
            ->expectsOutput('Publishing to facebook...')
            ->expectsOutput('Successfully published to facebook!')
            ->expectsOutput('Publishing to instagram...')
            ->expectsOutput('Successfully published to instagram!')
            ->expectsOutput('Publishing to telegram...')
            ->expectsOutput('Successfully published to telegram!')
            ->assertExitCode(0);

        // Verify in DB that X failed and FB succeeded
        $this->assertDatabaseHas('social_posts', [
            'business_id' => $business->id,
            'platform' => 'x',
            'status' => 'failed',
            'error_message' => 'Unauthorized',
        ]);

        $this->assertDatabaseHas('social_posts', [
            'business_id' => $business->id,
            'platform' => 'facebook',
            'status' => 'success',
        ]);

        // Since it failed on X, running the command again should select the same business,
        // skip Facebook and Instagram (already success), and retry X.
        $this->artisan('app:publish-daily-business')
            ->expectsOutput('Configured platforms: x, facebook, instagram, telegram')
            ->expectsOutput('Selected business: Bar Pepe (ID: ' . $business->id . ')')
            ->expectsOutput('Publishing to x...')
            ->expectsOutput('Successfully published to x!')
            ->expectsOutput('Already successfully published to facebook. Skipping.')
            ->expectsOutput('Already successfully published to instagram. Skipping.')
            ->expectsOutput('Already successfully published to telegram. Skipping.')
            ->assertExitCode(0);

        // Now we should have success for X too
        $this->assertDatabaseHas('social_posts', [
            'business_id' => $business->id,
            'platform' => 'x',
            'status' => 'success',
        ]);
    }

    /**
     * Test command publishes promotional fallback post when there are no approved businesses.
     */
    public function test_publish_daily_business_command_publishes_promotional_fallback_when_no_approved_business()
    {
        Http::fake([
            'api.twitter.com/2/tweets' => Http::response(['id' => 'x_promo_123'], 201),
            'graph.facebook.com/v20.0/test_page_id/feed' => Http::response(['id' => 'fb_promo_123'], 200),
            'graph.facebook.com/v20.0/test_instagram_business_id/media' => Http::response(['id' => 'ig_container_promo_123'], 200),
            'graph.facebook.com/v20.0/test_instagram_business_id/media_publish' => Http::response(['id' => 'ig_promo_123'], 200),
            'api.telegram.org/bottest_bot_token/sendMessage' => Http::response(['ok' => true], 200),
        ]);

        // Run command
        $this->artisan('app:publish-daily-business')
            ->expectsOutput('Configured platforms: x, facebook, instagram, telegram')
            ->expectsOutput('No new approved businesses to publish. Checking for promotional fallback...')
            ->expectsOutput('Publishing promotional post to x...')
            ->expectsOutput('Successfully published promotional post to x!')
            ->expectsOutput('Publishing promotional post to facebook...')
            ->expectsOutput('Successfully published promotional post to facebook!')
            ->expectsOutput('Publishing promotional post to instagram...')
            ->expectsOutput('Successfully published promotional post to instagram!')
            ->expectsOutput('Publishing promotional post to telegram...')
            ->expectsOutput('Successfully published promotional post to telegram!')
            ->expectsOutput('Promotional fallback completed successfully. Posted to 4 platforms.')
            ->assertExitCode(0);

        // Verify in database that business_id is null for these promo posts
        $this->assertDatabaseHas('social_posts', [
            'business_id' => null,
            'platform' => 'x',
            'status' => 'success',
        ]);
        $this->assertDatabaseHas('social_posts', [
            'business_id' => null,
            'platform' => 'facebook',
            'status' => 'success',
        ]);
        $this->assertDatabaseHas('social_posts', [
            'business_id' => null,
            'platform' => 'instagram',
            'status' => 'success',
        ]);
        $this->assertDatabaseHas('social_posts', [
            'business_id' => null,
            'platform' => 'telegram',
            'status' => 'success',
        ]);
    }

    /**
     * Test command skips promotional fallback if already published today.
     */
    public function test_publish_daily_business_command_skips_promotional_fallback_if_already_published_today()
    {
        // Seed a promo post already published today
        SocialPost::create([
            'business_id' => null,
            'platform' => 'x',
            'status' => 'success',
            'created_at' => now(),
        ]);

        // Seed a failed promo post for facebook to verify it retries the failed ones
        SocialPost::create([
            'business_id' => null,
            'platform' => 'facebook',
            'status' => 'failed',
            'error_message' => 'API Error',
            'created_at' => now(),
        ]);

        Http::fake([
            'graph.facebook.com/v20.0/test_page_id/feed' => Http::response(['id' => 'fb_retry_promo_123'], 200),
            'graph.facebook.com/v20.0/test_instagram_business_id/media' => Http::response(['id' => 'ig_container_promo_123'], 200),
            'graph.facebook.com/v20.0/test_instagram_business_id/media_publish' => Http::response(['id' => 'ig_promo_123'], 200),
            'api.telegram.org/bottest_bot_token/sendMessage' => Http::response(['ok' => true], 200),
        ]);

        $this->artisan('app:publish-daily-business')
            ->expectsOutput('Configured platforms: x, facebook, instagram, telegram')
            ->expectsOutput('No new approved businesses to publish. Checking for promotional fallback...')
            ->expectsOutput('Promotional post already successfully published to x today. Skipping.')
            ->expectsOutput('Publishing promotional post to facebook...')
            ->expectsOutput('Successfully published promotional post to facebook!')
            ->expectsOutput('Publishing promotional post to instagram...')
            ->expectsOutput('Successfully published promotional post to instagram!')
            ->expectsOutput('Publishing promotional post to telegram...')
            ->expectsOutput('Successfully published promotional post to telegram!')
            ->assertExitCode(0);

        // Verify X was not posted again (should only have the initial one)
        $this->assertEquals(1, SocialPost::whereNull('business_id')->where('platform', 'x')->count());

        // Verify facebook now has a success record too
        $this->assertDatabaseHas('social_posts', [
            'business_id' => null,
            'platform' => 'facebook',
            'status' => 'success',
        ]);
    }
}
