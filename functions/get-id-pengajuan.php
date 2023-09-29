<?php
$isAjaxRequest = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
if ($isAjaxRequest) {
    require __DIR__ . '/functions.php';

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

    $dataPengajuan = requestId("SELECT * FROM tb_pengajuan WHERE tb_pengajuan.id_pengajuan = ?");

    if ($dataPengajuan) {
        $response = [
            'status' => true,
            'data' => $dataPengajuan
        ];
    } else {
        $response = [
            'status' => false,
            'message' => "Data tidak ditemukan."
        ];
    }

    $jsonData = json_encode($response);
    header('Content-Type: application/json');
    echo $jsonData;
} else {
    header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found", true, 404);
    require __DIR__ . "/../layouts/404-page.php";
    die;
}
