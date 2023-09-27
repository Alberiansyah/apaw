<?php

$isAjaxRequest = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
if ($isAjaxRequest) {

    require __DIR__ . '/../connections/connections.php';

    $nama_kegiatan = htmlspecialchars($_POST['nama_kegiatan']);
    $nilai_anggaran = htmlspecialchars($_POST['nilai_anggaran']);
    $nama_pptk = htmlspecialchars($_POST['nama_pptk']);
    $nip_pptk = htmlspecialchars($_POST['nip_pptk']);
    $tahun_anggaran = htmlspecialchars($_POST['tahun_anggaran']);
    $kode_rekening = htmlspecialchars($_POST['kode_rekening']);
    $nama_ppk = htmlspecialchars($_POST['nama_ppk']);
    $nip_ppk = htmlspecialchars($_POST['nip_ppk']);

    $query = $pdo->prepare("INSERT INTO tb_kegiatan (nama_kegiatan, nilai_anggaran, nama_pptk, nip_pptk, tahun_anggaran, kode_rekening, nama_ppk, nip_ppk) VALUE(?, ?, ?, ?, ?, ?, ?, ?)");
    $query->execute([$nama_kegiatan, $nilai_anggaran, $nama_pptk, $nip_pptk, $tahun_anggaran, $kode_rekening, $nama_ppk, $nip_ppk]);
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
