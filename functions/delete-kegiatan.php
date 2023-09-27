<?php

$isAjaxRequest = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
if ($isAjaxRequest) {

    require __DIR__ . '/../connections/connections.php';

    function hapusData($request)
    {
        global $pdo, $id;
        $query = $pdo->prepare($request);
        $query->execute([$id]);

        return $query;
    }

    $id = $_SESSION['idKegiatan'];

    $query = hapusData("DELETE FROM tb_kegiatan WHERE id_kegiatan = ?");

    if ($query) {
        $response = [
            'status' => true,
            'message' => "Data berhasil dihapus."
        ];
        unset($_SESSION['idKegiatan']);
    } else {
        $response = [
            'status' => false,
            'message' => "Data gagal dihapus."
        ];
        unset($_SESSION['idKegiatan']);
    }

    $jsonData = json_encode($response);
    header('Content-Type: application/json');
    echo $jsonData;
} else {
    header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found", true, 404);
    require __DIR__ . "/../layouts/404-page.php";
    die;
}
