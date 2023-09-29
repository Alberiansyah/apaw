<?php

$isAjaxRequest = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
if ($isAjaxRequest) {

    require __DIR__ . '/functions.php';

    $arrayCek = ["nama_pengaju", "tanggal", "bagian_id", "teknisi_id", "nip_pengaju", "ruangan_id", "barang_id", "jumlah", "keterangan"];
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

    function editPengajuan($request)
    {
        global $pdo, $nama_pengaju, $nip_pengaju, $bagian_id, $teknisi_id, $tanggal, $id_pengajuan;
        $query = $pdo->prepare($request);
        $query->execute([$nama_pengaju, $nip_pengaju, $bagian_id, $teknisi_id, $tanggal, $id_pengajuan]);

        return $query;
    }

    function hapusData($request)
    {
        global $pdo, $id_pengajuan;
        $query = $pdo->prepare($request);
        $query->execute([$id_pengajuan]);

        return $query;
    }

    $id_pengajuan = decrypt($_POST['id_pengajuan']);
    $nama_pengaju = htmlspecialchars($_POST['nama_pengaju']);
    $nip_pengaju = htmlspecialchars($_POST['nip_pengaju']);
    $bagian_id = decrypt($_POST['bagian_id']);
    $teknisi_id = decrypt($_POST['teknisi_id']);
    $tanggal = htmlspecialchars($_POST['tanggal']);

    $queryUpdate = editPengajuan("UPDATE tb_pengajuan SET
                                      nama_pengaju = ?,
                                      nip_pengaju = ?,
                                      bagian_id = ?,
                                      teknisi_id = ?,
                                      tanggal = ?
                                      WHERE id_pengajuan = ?
        ");

    if ($queryUpdate) {

        $count = count($_POST['ruangan_id']);

        $queryDelete = hapusData("DELETE FROM tb_pengajuan_detail WHERE pengajuan_id = ?");

        for ($i = 0; $i < $count; $i++) {

            $ruanganDecrypt = $_POST['ruangan_id'][$i];
            $ruangan_id = decrypt($ruanganDecrypt);
            $barangDecrypt = $_POST['barang_id'][$i];
            $barang_id = decrypt($barangDecrypt);
            $jumlah = $_POST['jumlah'][$i];
            $keterangan = $_POST['keterangan'][$i];


            $query = $pdo->prepare("INSERT INTO tb_pengajuan_detail (pengajuan_id, ruangan_id, barang_id, jumlah, keterangan) VALUE(?, ?, ?, ?, ?)");
            $query->execute([$id_pengajuan, $ruangan_id, $barang_id, $jumlah, $keterangan]);
        }

        if ($query) {
            $response = [
                'status' => true,
                'message' => "Data berhasil disimpan."
            ];

            $jsonData = json_encode($response);
            header('Content-Type: application/json');
            echo $jsonData;
        } else {
            $response = [
                'status' => false,
                'message' => "Data gagal disimpan."
            ];

            $jsonData = json_encode($response);
            header('Content-Type: application/json');
            echo $jsonData;
        }
    } else {

        $response = [
            'status' => false,
            'message' => "Data gagal disimpan."
        ];

        $jsonData = json_encode($response);
        header('Content-Type: application/json');
        echo $jsonData;
    }
} else {
    header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found", true, 404);
    require __DIR__ . "/../wp-layouts/404-page.php";
    die;
}
