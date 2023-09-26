<?php
$isAjaxRequest = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
if ($isAjaxRequest) {

    require __DIR__ . '/../connections/connections.php';

    function editBagian($request)
    {
        global $pdo, $namaBagian, $id;
        $query = $pdo->prepare($request);
        $query->execute([$namaBagian, $id]);

        return $query;
    }

    $id = $_SESSION['idBagian'];
    $namaBagian = htmlspecialchars($_POST['nama_bagian']);

    $query = editBagian("UPDATE tb_bagian SET
                                      nama_bagian = ?
                                      WHERE id_bagian = ?
        ");

    if ($query) {
        $response = [
            'status' => true,
            'message' => "Data berhasil diubah."
        ];
    } else {
        $response = [
            'status' => false,
            'message' => "Data gagal diubah."
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
