<?php

require __DIR__ . '/functions/functions.php';
require __DIR__ . '/functions/session-check.php';

$idPengajuan = decrypt($_GET['id_pengajuan']);
$dataKegiatan = tampilDataFirst("SELECT tb_kegiatan.*, tb_pengajuan.*, tb_bagian.*, tb_teknisi.* FROM tb_pengajuan LEFT JOIN tb_kegiatan ON tb_kegiatan.id_kegiatan = tb_pengajuan.kegiatan_id LEFT JOIN tb_bagian ON tb_bagian.id_bagian = tb_pengajuan.bagian_id LEFT JOIN tb_teknisi ON tb_teknisi.id_teknisi = tb_pengajuan.teknisi_id WHERE tb_pengajuan.id_pengajuan = '$idPengajuan'");
$dataPengajuanDetail = tampilData("SELECT tb_pengajuan.*, tb_pengajuan_detail.*, tb_ruangan.*, tb_barang.* FROM tb_pengajuan INNER JOIN tb_pengajuan_detail ON tb_pengajuan_detail.pengajuan_id = tb_pengajuan.id_pengajuan INNER JOIN tb_ruangan ON tb_ruangan.id_ruangan = tb_pengajuan_detail.ruangan_id INNER JOIN tb_barang ON tb_barang.id_barang = tb_pengajuan_detail.barang_id WHERE tb_pengajuan.id_pengajuan = '$idPengajuan'");
$no = 1;
?>
<?php require __DIR__ . '/wp-layouts/resources.php'; ?>
<?php require __DIR__ . '/wp-layouts/header.php'; ?>
<?php require __DIR__ . '/wp-layouts/sidebar.php'; ?>

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Data</a></li>
                <li class="breadcrumb-item"><a href="pengajuan">Pengajuan</a></li>
                <li class="breadcrumb-item active">Info Data</li>
            </ol>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Data Kegiatan</h4>
                    </div>
                    <form method="POST" id="postPengajuan" action="">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-xl-1 col-lg-1 col-md-12 col-sm-12">
                                </div>
                                <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="nama_kegiatan" class="">Nama Kegiatan</label>
                                        <textarea style="cursor: not-allowed;" id="nama_kegiatan" class="form-control" rows="1" disabled><?= $dataKegiatan->nama_kegiatan ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama_pengaju" class="">Nama Pengaju</label>
                                        <input type="text" class="form-control" value="<?= $dataKegiatan->nama_pengaju ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="nip_pengaju" class="">NIP Pengaju</label>
                                        <input type="text" class="form-control" value="<?= $dataKegiatan->nip_pengaju ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="bagian_id" class="">Nama Bagian</label>
                                        <input type="text" class="form-control" value="<?= $dataKegiatan->nama_bagian ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="teknisi_id" class="">Nama Teknisi</label>
                                        <input type="text" class="form-control" value="<?= $dataKegiatan->nama_teknisi ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="tanggal" class="">Tanggal</label>
                                        <input type="text" class="form-control" value="<?= $dataKegiatan->tanggal ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-xl-1 col-lg-1 col-md-12 col-sm-12">
                                </div>
                            </div>
                            <div class="d-flex justify-content-center mt-3">
                                <h4>Detail Pengajuan</h4><br>
                            </div>
                            <table class="table tableDetail">
                                <thead>
                                    <tr>
                                        <th>Ruangan</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($dataPengajuanDetail as $data) : ?><tr>
                                            <td>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" value="<?= $data->nama_ruangan ?>" readonly>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" value="<?= $data->nama_barang ?>" readonly>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" value="<?= $data->jumlah ?>" readonly>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <textarea class="form-control" readonly><?= $data->keterangan ?></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>

                                </tbody>
                            </table>
                            <div class="modal-footer">
                                <a href="pengajuan"><button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/wp-layouts/footer.php'; ?>
<script>
    $(document).ready(function() {
        let transaksi = $("#transaksi");
        transaksi.addClass("mm-active")
        transaksi.find("ul").addClass("mm-show")
        transaksi.find("ul li").addClass("mm-active")
        transaksi.find("ul li a:eq(1)").addClass("mm-active")
    });
</script>

</body>

</html>