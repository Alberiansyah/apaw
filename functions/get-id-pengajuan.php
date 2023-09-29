<?php
$isAjaxRequest = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
if ($isAjaxRequest) {
    require __DIR__ . '/functions.php';

    function requestId($request)
    {
        global $pdo;
        $id = decrypt($_GET['idPengajuan']);
        $_SESSION['idPengajuan'] = $id;
        $query = $pdo->prepare($request);
        $query->execute([$id]);
        $row = $query->fetchAll(PDO::FETCH_OBJ);

        return $row;
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
