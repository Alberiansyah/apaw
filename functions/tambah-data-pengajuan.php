<?php

$isAjaxRequest = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
if ($isAjaxRequest) {

    require __DIR__ . '/functions.php';

    $arrayCek = ["kegiatan_id", "nama_pengaju", "tanggal", "bagian_id", "teknisi_id", "nip_pengaju", "ruangan_id", "barang_id", "jumlah", "keterangan"];
    foreach ($arrayCek as $field) {
        if (is_array($_POST[$field])) {
            foreach ($_POST[$field] as $value) {
                if (!isset($value) || $value === '') {
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
        } else {
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
        }
    }

    $kegiatan_id = decrypt($_POST['kegiatan_id']);
    $nama_pengaju = htmlspecialchars($_POST['nama_pengaju']);
    $tanggal = htmlspecialchars($_POST['tanggal']);
    $bagian_id = htmlspecialchars($_POST['bagian_id']);
    $teknisi_id = htmlspecialchars($_POST['teknisi_id']);
    $nip_pengaju = htmlspecialchars($_POST['nip_pengaju']);

    $query = $pdo->prepare("INSERT INTO tb_pengajuan (kegiatan_id, nama_pengaju, tanggal, bagian_id, teknisi_id, nip_pengaju) VALUE(?, ?, ?, ?, ?, ?)");
    $query->execute([$kegiatan_id, $nama_pengaju, $tanggal, $bagian_id, $teknisi_id, $nip_pengaju]);

    $lastInsertId = $pdo->lastInsertId();

    $count = count($_POST['ruangan_id']);

    for ($i = 0; $i < $count; $i++) {

        $ruangan_id = $_POST['ruangan_id'][$i];
        $barang_id = $_POST['barang_id'][$i];
        $jumlah = $_POST['jumlah'][$i];
        $keterangan = $_POST['keterangan'][$i];

        $query = $pdo->prepare("INSERT INTO tb_pengajuan_detail (pengajuan_id, ruangan_id, barang_id, jumlah, keterangan) VALUE(?, ?, ?, ?, ?)");
        $query->execute([$lastInsertId, $ruangan_id, $barang_id, $jumlah, $keterangan]);
    }

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
