<?php
$isAjaxRequest = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
if ($isAjaxRequest) {
    require __DIR__ . '/../connections/connections.php';

    function requestId($request)
    {
        global $pdo;
        $id = $_GET['idBarang'];
        $_SESSION['idBarang'] = $id;
        $query = $pdo->prepare($request);
        $query->execute([$id]);
        $row = $query->fetchAll(PDO::FETCH_OBJ);

        return $row;
    }

    $dataBarang = requestId("SELECT tb_bagian.*, tb_barang.* FROM tb_bagian INNER JOIN tb_barang ON tb_barang.bagian_id = tb_bagian.id_bagian WHERE tb_barang.id_barang = ?");

    if ($dataBarang) {
        $response = [
            'status' => true,
            'data' => $dataBarang
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
