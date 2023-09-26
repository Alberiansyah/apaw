<?php
$isAjaxRequest = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
if ($isAjaxRequest) {

    require __DIR__ . '/../connections/connections.php';
    function editTeknisi($request)
    {
        global $pdo, $edit_nama_teknisi, $edit_email, $edit_no_telp, $edit_bagian_id, $edit_no_nik, $edit_alamat, $id;
        $query = $pdo->prepare($request);
        $query->execute([$edit_nama_teknisi, $edit_email, $edit_no_telp, $edit_bagian_id, $edit_no_nik, $edit_alamat, $id]);

        return $query;
    }

    $id = $_SESSION['idTeknis'];
    $edit_nama_teknisi = htmlspecialchars($_POST['edit_nama_teknisi']);
    $edit_email = htmlspecialchars($_POST['edit_email']);
    $edit_no_telp = htmlspecialchars($_POST['edit_no_telp']);
    $edit_bagian_id = htmlspecialchars($_POST['edit_bagian_id']);
    $edit_no_nik = htmlspecialchars($_POST['edit_no_nik']);
    $edit_alamat = htmlspecialchars($_POST['edit_alamat']);

    $query = editTeknisi("UPDATE tb_teknisi SET
                                      nama_teknisi = ?,
                                      email = ?,
                                      no_telp = ?,
                                      bagian_id = ?,
                                      no_nik = ?,
                                      alamat = ?
                                      WHERE id_teknisi = ?
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
