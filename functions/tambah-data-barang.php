<?php

$isAjaxRequest = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
if ($isAjaxRequest) {

    require __DIR__ . '/../connections/connections.php';

    $arrayCek = ["bagian_id", "nama_barang", "satuan", "merk", "type"];
    foreach ($arrayCek as $field) {
        if (empty($_POST[$field])) {
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

    $bagian_id = htmlspecialchars($_POST['bagian_id']);
    $nama_barang = htmlspecialchars($_POST['nama_barang']);
    $satuan = htmlspecialchars($_POST['satuan']);
    $merk = htmlspecialchars($_POST['merk']);
    $type = htmlspecialchars($_POST['type']);


    $query = $pdo->prepare("INSERT INTO tb_barang (bagian_id, nama_barang, satuan, merk, type) VALUE(?, ?, ?, ?, ?)");
    $query->execute([$bagian_id, $nama_barang, $satuan, $merk, $type]);
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
