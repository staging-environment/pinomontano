<?php

// get_meta_tokens.php
// A temporary script to exchange User Access Token for a Long-Lived Page Access Token
// and print the corresponding Page IDs and Instagram Business Account IDs.

$appId = '982262321065812';
$appSecret = '4d423d0e9b28b00d4a9d532230ead960';
$userToken = '';

echo "Step 0: Debugging User Token...\n";
$debugUrl = "https://graph.facebook.com/v20.0/debug_token?" . http_build_query([
    'input_token' => $userToken,
    'access_token' => "{$appId}|{$appSecret}"
]);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $debugUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

$debugData = json_decode($response, true);
echo "Token debug response:\n" . print_r($debugData, true) . "\n\n";

echo "Step 1: Exchanging short-lived user token for long-lived user token...\n";
$exchangeUrl = "https://graph.facebook.com/v20.0/oauth/access_token?" . http_build_query([
    'grant_type' => 'fb_exchange_token',
    'client_id' => $appId,
    'client_secret' => $appSecret,
    'fb_exchange_token' => $userToken
]);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $exchangeUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

$data = json_decode($response, true);
if (isset($data['error'])) {
    echo "Error exchanging token: " . print_r($data['error'], true) . "\n";
    exit(1);
}

$longLivedUserToken = $data['access_token'];
echo "Long-lived User Token obtained successfully!\n\n";

echo "Step 2: Retrieving user pages and page tokens...\n";
$pagesUrl = "https://graph.facebook.com/v20.0/me/accounts?" . http_build_query([
    'access_token' => $longLivedUserToken
]);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $pagesUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

$pagesData = json_decode($response, true);
if (isset($pagesData['error'])) {
    echo "Error retrieving pages: " . print_r($pagesData['error'], true) . "\n";
    exit(1);
}

if (empty($pagesData['data'])) {
    echo "No pages found under this user account. Make sure you granted permissions to at least one Facebook page.\n";
    exit(1);
}

foreach ($pagesData['data'] as $page) {
    $pageId = $page['id'];
    $pageName = $page['name'];
    $pageAccessToken = $page['access_token'];
    
    echo "----------------------------------------\n";
    echo "PAGE NAME: {$pageName}\n";
    echo "PAGE ID: {$pageId}\n";
    echo "PAGE ACCESS TOKEN: {$pageAccessToken}\n";
    
    echo "Step 3: Checking linked Instagram Business Account...\n";
    $igUrl = "https://graph.facebook.com/v20.0/{$pageId}?" . http_build_query([
        'fields' => 'instagram_business_account',
        'access_token' => $pageAccessToken
    ]);
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $igUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $igResponse = curl_exec($ch);
    curl_close($ch);
    
    $igData = json_decode($igResponse, true);
    if (isset($igData['instagram_business_account']['id'])) {
        $igId = $igData['instagram_business_account']['id'];
        echo "INSTAGRAM BUSINESS ID: {$igId}\n";
    } else {
        echo "INSTAGRAM BUSINESS ID: Not found (Is there an Instagram business account linked to this Facebook Page?)\n";
    }
}
echo "----------------------------------------\n";
echo "Done!\n";
