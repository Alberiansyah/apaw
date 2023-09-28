<?php
$isAjaxRequest = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
if ($isAjaxRequest) {

    require __DIR__ . '/../connections/connections.php';

    $arrayCek = ["bagian_id", "nama_barang", "satuan", "merk", "type"];
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

    function editBarang($request)
    {
        global $pdo, $nama_barang, $bagian_id, $satuan, $merk, $type, $id;
        $query = $pdo->prepare($request);
        $query->execute([$nama_barang, $bagian_id, $satuan, $merk, $type, $id]);

        return $query;
    }

    $id = $_SESSION['idBarang'];
    $nama_barang = htmlspecialchars($_POST['nama_barang']);
    $bagian_id = htmlspecialchars($_POST['bagian_id']);
    $satuan = htmlspecialchars($_POST['satuan']);
    $merk = htmlspecialchars($_POST['merk']);
    $type = htmlspecialchars($_POST['type']);

    $query = editBarang("UPDATE tb_barang SET
                                      nama_barang = ?,
                                      bagian_id = ?,
                                      satuan = ?,
                                      merk = ?,
                                      type = ?
                                      WHERE id_barang = ?
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
