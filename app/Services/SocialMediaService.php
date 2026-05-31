<?php

namespace App\Services;

use App\Models\Business;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class SocialMediaService
{
    /**
     * Publish a business on X (Twitter).
     */
    public function postToX(Business $business): array
    {
        $url = 'https://api.twitter.com/2/tweets';
        $method = 'POST';

        $text = "¡Nuevo comercio en el Marketplace de Pino Montano! 🥳\n\n"
              . "🛍️ {$business->name}\n"
              . "📌 Categoría: {$business->category}\n"
              . "📝 " . Str::limit($business->description, 100) . "\n\n"
              . "👉 Descubre más: " . route('business.show', $business->slug);

        $body = ['text' => $text];

        try {
            $authHeader = $this->getXAuthHeader($url, $method, $body);

            $response = Http::withHeaders([
                'Authorization' => $authHeader,
                'Content-Type' => 'application/json',
            ])->post($url, $body);

            if ($response->successful()) {
                return ['status' => 'success', 'data' => $response->json()];
            }

            return ['status' => 'failed', 'error' => $response->body()];
        } catch (\Exception $e) {
            return ['status' => 'failed', 'error' => $e->getMessage()];
        }
    }

    /**
     * Publish a business on Facebook.
     */
    public function postToFacebook(Business $business): array
    {
        $pageId = config('services.meta.page_id');
        $accessToken = config('services.meta.page_access_token');

        if (!$pageId || !$accessToken) {
            return ['status' => 'failed', 'error' => 'Meta Page ID or Access Token is not configured.'];
        }

        $url = "https://graph.facebook.com/v20.0/{$pageId}/feed";

        $message = "¡Nuevo comercio en el Marketplace de Pino Montano! 🥳\n\n"
                 . "🛍️ {$business->name}\n"
                 . "📌 Categoría: {$business->category}\n\n"
                 . "{$business->description}\n\n"
                 . "📍 Dirección: {$business->address}\n"
                 . ($business->phone ? "📞 Teléfono: {$business->phone}\n" : "");

        try {
            $response = Http::post($url, [
                'message' => $message,
                'link' => route('business.show', $business->slug),
                'access_token' => $accessToken,
            ]);

            if ($response->successful()) {
                return ['status' => 'success', 'data' => $response->json()];
            }

            return ['status' => 'failed', 'error' => $response->body()];
        } catch (\Exception $e) {
            return ['status' => 'failed', 'error' => $e->getMessage()];
        }
    }

    /**
     * Publish a business on Instagram.
     */
    public function postToInstagram(Business $business): array
    {
        $instagramId = config('services.meta.instagram_business_id');
        $accessToken = config('services.meta.page_access_token');

        if (!$instagramId || !$accessToken) {
            return ['status' => 'failed', 'error' => 'Meta Instagram Business ID or Access Token is not configured.'];
        }

        // Instagram publishing requires a public image URL.
        // We use a beautiful placeholder image representing community marketplace.
        $imageUrl = 'https://images.unsplash.com/photo-1513151233558-d860c5398176?auto=format&fit=crop&w=1000&q=80';

        $caption = "¡Nuevo comercio en el Marketplace de Pino Montano! 🥳\n\n"
                 . "🛍️ {$business->name}\n"
                 . "📌 Categoría: {$business->category}\n\n"
                 . "{$business->description}\n\n"
                 . "📍 Dirección: {$business->address}\n"
                 . ($business->phone ? "📞 Teléfono: {$business->phone}\n" : "")
                 . "👉 Visita: " . route('business.show', $business->slug);

        try {
            // Step 1: Create media container
            $containerUrl = "https://graph.facebook.com/v20.0/{$instagramId}/media";
            $response = Http::post($containerUrl, [
                'image_url' => $imageUrl,
                'caption' => $caption,
                'access_token' => $accessToken,
            ]);

            if (!$response->successful()) {
                return ['status' => 'failed', 'error' => 'Container creation failed: ' . $response->body()];
            }

            $creationId = $response->json()['id'] ?? null;

            if (!$creationId) {
                return ['status' => 'failed', 'error' => 'No creation ID returned.'];
            }

            // Step 2: Publish media container
            $publishUrl = "https://graph.facebook.com/v20.0/{$instagramId}/media_publish";
            $publishResponse = Http::post($publishUrl, [
                'creation_id' => $creationId,
                'access_token' => $accessToken,
            ]);

            if ($publishResponse->successful()) {
                return ['status' => 'success', 'data' => $publishResponse->json()];
            }

            return ['status' => 'failed', 'error' => 'Publishing failed: ' . $publishResponse->body()];
        } catch (\Exception $e) {
            return ['status' => 'failed', 'error' => $e->getMessage()];
        }
    }

    /**
     * Generate OAuth 1.0a Authorization header for X (Twitter) API.
     */
    private function getXAuthHeader(string $url, string $method, array $params = []): string
    {
        $consumerKey = config('services.x.consumer_key') ?? '';
        $consumerSecret = config('services.x.consumer_secret') ?? '';
        $accessToken = config('services.x.access_token') ?? '';
        $accessTokenSecret = config('services.x.access_token_secret') ?? '';

        $oauth = [
            'oauth_consumer_key' => $consumerKey,
            'oauth_nonce' => md5(uniqid(rand(), true)),
            'oauth_signature_method' => 'HMAC-SHA1',
            'oauth_timestamp' => time(),
            'oauth_token' => $accessToken,
            'oauth_version' => '1.0'
        ];

        $compositeParams = array_merge($oauth, $params);
        ksort($compositeParams);

        $queryStr = [];
        foreach ($compositeParams as $k => $v) {
            $queryStr[] = rawurlencode($k) . '=' . rawurlencode($v);
        }

        $baseStr = strtoupper($method) . '&' . rawurlencode($url) . '&' . rawurlencode(implode('&', $queryStr));
        $key = rawurlencode($consumerSecret) . '&' . rawurlencode($accessTokenSecret);
        $signature = base64_encode(hash_hmac('sha1', $baseStr, $key, true));

        $oauth['oauth_signature'] = $signature;
        ksort($oauth);

        $headerStr = [];
        foreach ($oauth as $k => $v) {
            $headerStr[] = $k . '="' . rawurlencode($v) . '"';
        }

        return 'OAuth ' . implode(', ', $headerStr);
    }
}
