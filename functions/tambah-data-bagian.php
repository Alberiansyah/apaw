<?php

$isAjaxRequest = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
if ($isAjaxRequest) {

    require __DIR__ . '/../connections/connections.php';

    $arrayCek = ["nama_bagian"];
    foreach ($arrayCek as $field) {
        if (!isset($_POST[$field]) || $_POST[$field] === '') {
            $response = [
                'status' => false,
                'message' => "Semua Form Wajib diisi!"
            ];
            $jsonData = json_encode($response);
            header('Content-Type: application/json');
            echo $jsonData;
            exit();
        }
    }

    $namaBagian = htmlspecialchars($_POST['nama_bagian']);

    $query = $pdo->prepare("INSERT INTO tb_bagian (nama_bagian) VALUE(?)");
    $query->execute([$namaBagian]);

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
