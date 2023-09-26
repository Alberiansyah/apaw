<?php

$isAjaxRequest = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
if ($isAjaxRequest) {

    require __DIR__ . '/../connections/connections.php';

    $nama_ruangan = htmlspecialchars($_POST['nama_ruangan']);
    $lantai = htmlspecialchars($_POST['lantai']);
    $zona = htmlspecialchars($_POST['zona']);

    $query = $pdo->prepare("INSERT INTO tb_ruangan (nama_ruangan, lantai, zona) VALUE(?, ?, ?)");
    $query->execute([$nama_ruangan, $lantai, $zona]);

    if ($query) {
        $response = [
            'status' => true,
            'message' => "Data berhasil disimpan."
        ];
    } else {
        $response = [
            'status' => false,
            'message' => "Data gagal disimpan."
        ];
    }

    $jsonData = json_encode($response);
    header('Content-Type: application/json');
    echo $jsonData;
} else {
    header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found", true, 404);
    require __DIR__ . "/../wp-layouts/404-page.php";
    die;
}
