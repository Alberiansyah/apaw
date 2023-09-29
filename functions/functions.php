<?php

require __DIR__ . '/../connections/connections.php';

function getSegment()
{
    $urlSegment = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    $lastSegment = array_pop($urlSegment);

    return $lastSegment;
}

function tampilData($request)
{
    global $pdo;
    $query = $pdo->prepare($request);
    $query->execute();
    $row = $query->fetchAll(PDO::FETCH_OBJ);

    return $row;
}

function tampilDataFirst($request)
{
    global $pdo;
    $query = $pdo->prepare($request);
    $query->execute();
    $row = $query->fetch(PDO::FETCH_OBJ);

    return $row;
}

function encrypt($value)
{
    $key = "encryptId1092";
    $cipher = 'AES-256-CBC';
    $iv = random_bytes(16);

    $encrypted = openssl_encrypt($value, $cipher, $key, 0, $iv);

    if ($encrypted === false) {
        return false;
    }

    $mac = hash_hmac('sha256', $encrypted, $key, true);

    return base64_encode($iv . $mac . $encrypted);
}

function decrypt($payload)
{
    global $key;
    $key = "encryptId1092";
    $cipher = 'AES-256-CBC';
    $payload = base64_decode(str_replace(' ', '+', $payload));

    $iv = substr($payload, 0, 16);
    $mac = substr($payload, 16, 32);
    $payload = substr($payload, 48);

    $decrypted = openssl_decrypt($payload, $cipher, $key, 0, $iv);

    if ($decrypted === false) {
        return false;
    }

    $calculatedMac = hash_hmac('sha256', $payload, $key, true);

    if (!hash_equals($mac, $calculatedMac)) {
        return false;
    }

    return $decrypted;
}
