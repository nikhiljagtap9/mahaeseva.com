<?php

$curl = curl_init();

$data = [
    "appkey" => "90b0d2ff-1153-40ef-93c8-62a79b3b5537",
    "authkey" => "kFHWcagqY5d39qjD8z1vKTH9k8LnofUU8UP8TN741K4fqMQQWK",
    "to" => "919561587683",
    "message" => "nikhil",
    "sandbox" => false
];

curl_setopt_array($curl, [
    CURLOPT_URL => "https://whatsapp.bhagwat.tech/api/create-message",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => json_encode($data), // Ensure correct JSON encoding
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json",  // Ensure correct content type
        "Accept: application/json"
    ],
]);

$response = curl_exec($curl);
$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

if (curl_errno($curl)) {
    echo "cURL Error: " . curl_error($curl);
} else {
    if ($response === false) {
        echo "HTTP Code: " . $httpCode . "\n";
        echo "Response1: API request failed.";
    } else {
        echo "HTTP Code: " . $httpCode . "\n";
        echo "Response2: " . $response;
    }
}

curl_close($curl);
