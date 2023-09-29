<?php

$isAjaxRequest = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
if ($isAjaxRequest) {

    require __DIR__ . '/functions.php';
    $arrayCek = ["id_pengajuan", "id_pengajuan_detail", "persetujuan"];
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

    function editPengajuanDetail($request)
    {
        global $pdo, $persetujuan, $id_pengajuan_detail;
        $query = $pdo->prepare($request);
        $query->execute([$persetujuan, $id_pengajuan_detail]);

        return $query;
    }

    function editPengajuan($request)
    {
        global $pdo, $persetujuan, $id_pengajuan;
        $query = $pdo->prepare($request);
        $query->execute([$persetujuan, $id_pengajuan]);

        return $query;
    }

    function hapusData($request)
    {
        global $pdo, $id_pengajuan;
        $query = $pdo->prepare($request);
        $query->execute([$id_pengajuan]);

        return $query;
    }

    $count = count($_POST['id_pengajuan_detail']);
    $idPengajuanDetail = $_POST['id_pengajuan_detail'];
    $persetujuanPost = $_POST['persetujuan'];

    $nilaiCocok = [];
    foreach ($idPengajuanDetail as $id) {
        if (in_array($id, $persetujuanPost)) {
            $nilaiCocok[$id]['persetujuan'] = true;
        }
    }

    for ($i = 0; $i < $count; $i++) {
        $id_pengajuan_detail = $_POST['id_pengajuan_detail'][$i];
        $persetujuan = isset($nilaiCocok[$id_pengajuan_detail]['persetujuan']) ? $nilaiCocok[$id_pengajuan_detail]['persetujuan'] : false;

        $query = editPengajuanDetail("UPDATE tb_pengajuan_detail SET persetujuan = ? WHERE id_pengajuan_detail = ?");
    }

    $id_pengajuan = decrypt($_POST['id_pengajuan']);
    $queryCek = tampilData("SELECT * FROM tb_pengajuan_detail WHERE pengajuan_id = '$id_pengajuan'");

    if ($queryCek) {

        $pengajuanPersetujuan = [];
        foreach ($queryCek as $item) {
            $pengajuanPersetujuan[] = (bool) $item->persetujuan;
        }

        if (array_reduce($pengajuanPersetujuan, function ($carry, $status) {
            return $carry && $status === true;
        }, true)) {
            $persetujuanPengajuan = true;
            $queryUpdate = editPengajuan("UPDATE tb_pengajuan SET
                                          persetujuan = ?
                                          WHERE id_pengajuan = ?
            ");
        } else {
            $persetujuan = false;
            $queryUpdate = editPengajuan("UPDATE tb_pengajuan SET
                                          persetujuan = ?
                                          WHERE id_pengajuan = ?
            ");
        }

        if ($queryUpdate) {
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
