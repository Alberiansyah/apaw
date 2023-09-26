<?php
$isAjaxRequest = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
if ($isAjaxRequest) {
    require __DIR__ . '/../connections/connections.php';
    function requestId($request)
    {
        global $pdo;
        $id = $_GET['idRuangan'];
        $_SESSION['idRuangan'] = $id;
        $query = $pdo->prepare($request);
        $query->execute([$id]);
        $row = $query->fetchAll(PDO::FETCH_OBJ);

        return $row;
    }

    $dataRuangan = requestId("SELECT * FROM tb_ruangan WHERE id_ruangan = ?");

    if ($dataRuangan) {
        $response = [
            'status' => true,
            'data' => $dataRuangan
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
