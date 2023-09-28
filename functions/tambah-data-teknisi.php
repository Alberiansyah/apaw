<?php

$isAjaxRequest = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
if ($isAjaxRequest) {

    require __DIR__ . '/../connections/connections.php';

    $arrayCek = ["bagian_id", "nama_teknisi", "no_telp", "no_nik", "alamat", "email"];
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

    $bagian_id = htmlspecialchars($_POST['bagian_id']);
    $nama_teknisi = htmlspecialchars($_POST['nama_teknisi']);
    $no_telp = htmlspecialchars($_POST['no_telp']);
    $no_nik = htmlspecialchars($_POST['no_nik']);
    $alamat = htmlspecialchars($_POST['alamat']);
    $email = htmlspecialchars($_POST['email']);

    $query = $pdo->prepare("INSERT INTO tb_teknisi (bagian_id, nama_teknisi, no_telp, no_nik, alamat, email) VALUE(?, ?, ?, ?, ?, ?)");
    $query->execute([$bagian_id, $nama_teknisi, $no_telp, $no_nik, $alamat, $email]);

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
