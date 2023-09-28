<?php
$isAjaxRequest = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
if ($isAjaxRequest) {

    require __DIR__ . '/../connections/connections.php';

    $arrayCek = ["edit_nama_kegiatan", "edit_nilai_anggaran", "edit_nama_pptk", "edit_nip_pptk", "edit_tahun_anggaran", "edit_kode_rekening", "edit_nama_ppk", "edit_nip_ppk"];
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

    function editKegiatan($request)
    {
        global $pdo, $nama_kegiatan, $nilai_anggaran, $nama_pptk, $nip_pptk, $tahun_anggaran, $kode_rekening, $nama_ppk, $nip_ppk, $id;
        $query = $pdo->prepare($request);
        $query->execute([$nama_kegiatan, $nilai_anggaran, $nama_pptk, $nip_pptk, $tahun_anggaran, $kode_rekening, $nama_ppk, $nip_ppk, $id]);

        return $query;
    }

    $id = $_SESSION['idKegiatan'];
    $nama_kegiatan = htmlspecialchars($_POST['edit_nama_kegiatan']);
    $nilai_anggaran = htmlspecialchars($_POST['edit_nilai_anggaran']);
    $nama_pptk = htmlspecialchars($_POST['edit_nama_pptk']);
    $nip_pptk = htmlspecialchars($_POST['edit_nip_pptk']);
    $tahun_anggaran = htmlspecialchars($_POST['edit_tahun_anggaran']);
    $kode_rekening = htmlspecialchars($_POST['edit_kode_rekening']);
    $nama_ppk = htmlspecialchars($_POST['edit_nama_ppk']);
    $nip_ppk = htmlspecialchars($_POST['edit_nip_ppk']);

    $query = editKegiatan("UPDATE tb_kegiatan SET
                                      nama_kegiatan = ?,
                                      nilai_anggaran = ?,
                                      nama_pptk = ?,
                                      nip_pptk = ?,
                                      tahun_anggaran = ?,
                                      kode_rekening = ?,
                                      nama_ppk = ?,
                                      nip_ppk = ?
                                      WHERE id_kegiatan = ?
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
