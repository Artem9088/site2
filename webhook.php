<?php
$secret = '123qwe'; 

$signature = $_SERVER['HTTP_X_HUB_SIGNATURE_256'] ?? '';
$payload = file_get_contents('php://input');
$hash = 'sha256=' . hash_hmac('sha256', $payload, $secret);
if (hash_equals($hash, $signature)) {
    shell_exec('sh /var/www/site2/deploy.sh > /var/www/site2/deploy.log 2>&1');
    http_response_code(200);
} else {
    http_response_code(403);
}
