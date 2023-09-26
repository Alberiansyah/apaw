<?php
$isAjaxRequest = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
if ($isAjaxRequest) {

    require __DIR__ . '/../connections/connections.php';

    function editRuangan($request)
    {
        global $pdo, $nama_ruangan, $lantai, $zona, $id;
        $query = $pdo->prepare($request);
        $query->execute([$nama_ruangan, $lantai, $zona, $id]);

        return $query;
    }

    $id = $_SESSION['idRuangan'];
    $nama_ruangan = htmlspecialchars($_POST['edit_nama_ruangan']);
    $lantai = htmlspecialchars($_POST['edit_lantai']);
    $zona = htmlspecialchars($_POST['edit_zona']);

    $query = editRuangan("UPDATE tb_ruangan SET
                                      nama_ruangan = ?,
                                      lantai = ?,
                                      zona = ?
                                      WHERE id_ruangan = ?
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
