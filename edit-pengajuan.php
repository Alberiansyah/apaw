<?php

require __DIR__ . '/functions/functions.php';
require __DIR__ . '/functions/session-check.php';

$idPengajuan = decrypt($_GET['id_pengajuan']);
$dataKegiatan = tampilDataFirst("SELECT tb_kegiatan.*, tb_pengajuan.*, tb_bagian.nama_bagian, tb_teknisi.nama_teknisi FROM tb_pengajuan LEFT JOIN tb_kegiatan ON tb_kegiatan.id_kegiatan = tb_pengajuan.kegiatan_id INNER JOIN tb_bagian ON tb_bagian.id_bagian = tb_pengajuan.bagian_id INNER JOIN tb_teknisi ON tb_teknisi.id_teknisi = tb_pengajuan.teknisi_id WHERE tb_pengajuan.id_pengajuan = '$idPengajuan'");
$dataPengajuanDetail = tampilData("SELECT tb_pengajuan.*, tb_pengajuan_detail.*, tb_ruangan.*, tb_barang.* FROM tb_pengajuan INNER JOIN tb_pengajuan_detail ON tb_pengajuan_detail.pengajuan_id = tb_pengajuan.id_pengajuan INNER JOIN tb_ruangan ON tb_ruangan.id_ruangan = tb_pengajuan_detail.ruangan_id INNER JOIN tb_barang ON tb_barang.id_barang = tb_pengajuan_detail.barang_id WHERE tb_pengajuan.id_pengajuan = '$idPengajuan'");
$dataUser = tampilData("SELECT * FROM tb_user");
$dataTeknisi = tampilData("SELECT * FROM tb_teknisi");
$dataRuangan = tampilData("SELECT * FROM tb_ruangan");
$dataBagian = tampilData("SELECT * FROM tb_bagian");
$dataBarang = tampilData("SELECT * FROM tb_barang");
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
                <li class="breadcrumb-item active">Edit Data</li>
            </ol>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Pengajuan</h4>
                    </div>
                    <form method="POST" id="postPengajuan" action="">
                        <div class="modal-body">
                            <div class="row">
                                <input type="hidden" class="form-control date" name="id_pengajuan" value="<?= encrypt($idPengajuan) ?>">
                                <div class="col-xl-1 col-lg-1 col-md-12 col-sm-12">
                                </div>
                                <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="nama_kegiatan" class="">Nama Kegiatan</label>
                                        <textarea style="cursor: not-allowed;" id="nama_kegiatan" class="form-control" rows="1" disabled><?= $dataKegiatan->nama_kegiatan ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama_pengaju" class="">Nama Pengaju</label>
                                        <select id="nama_pengaju" class="single-select" name="nama_pengaju">
                                            <?php foreach ($dataUser as $data) : ?>
                                                <?php if (($data->role_id == 1 || $data->role_id == 3) && $data->nama_lengkap == $dataKegiatan->nama_pengaju) : ?>
                                                    <option value="<?= $data->nama_lengkap ?>" selected><?= $data->nama_lengkap ?></option>
                                                <?php elseif ($data->role_id == 1 || $data->role_id == 3) : ?>
                                                    <option value="<?= $data->nama_lengkap ?>"><?= $data->nama_lengkap ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="nip_pengaju" class="">NIP Pengaju</label>
                                        <input type="text" class="form-control" name="nip_pengaju" value="<?= $dataKegiatan->nip_pengaju ?>">
                                    </div>
                                </div>
                                <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="bagian_id" class="">Nama Bagian</label>
                                        <select id="bagian_id" class="single-select" name="bagian_id">
                                            <?php foreach ($dataBagian as $data) : ?>
                                                <?php if ($data->id_bagian == $dataKegiatan->bagian_id) : ?>
                                                    <option value="<?= encrypt($data->id_bagian) ?>" selected><?= $data->nama_bagian ?></option>
                                                <?php else : ?>
                                                    <option value="<?= encrypt($data->id_bagian) ?>"><?= $data->nama_bagian ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="teknisi_id" class="">Nama Teknisi</label>
                                        <select id="single-select" class="form-control" name="teknisi_id">
                                            <?php foreach ($dataTeknisi as $data) : ?>
                                                <?php if ($data->id_teknisi == $dataKegiatan->teknisi_id) : ?>
                                                    <option value="<?= encrypt($data->id_teknisi) ?>" selected><?= $data->nama_teknisi ?></option>
                                                <?php else : ?>
                                                    <option value="<?= encrypt($data->id_teknisi) ?>"><?= $data->nama_teknisi ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="tanggal" class="">Tanggal</label>
                                        <input type="text" class="form-control date" name="tanggal" value="<?= $dataKegiatan->tanggal ?>">
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
                                                    <input type="hidden" class="form-control" name="ruangan_id[]" value="<?= encrypt($data->ruangan_id) ?>">
                                                    <input type="text" class="form-control" value="<?= $data->nama_ruangan ?>" readonly>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input type="hidden" class="form-control" name="barang_id[]" value="<?= encrypt($data->barang_id) ?>">
                                                    <input type="text" class="form-control" value="<?= $data->nama_barang ?>" readonly>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input type="number" min="1" class="form-control" name="jumlah[]" value="<?= $data->jumlah ?>">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <textarea class="form-control" name="keterangan[]"><?= $data->keterangan ?></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <div class="modal-footer">
                                <a href="pengajuan"><button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button></a>
                                <button type="button" class="btn btn-info" id="editPengajuan">Ubah</button>
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

<script>
    $(document).on("click", "#editPengajuan", function() {
        let form = $('#postPengajuan').serialize();
        $.ajax({
            url: "functions/edit-pengajuan",
            data: form,
            type: 'POST',
            success: function(response) {
                if (response.status) {
                    toastr.info(response.message);

                    setTimeout(function() {
                        window.location.href =
                            "pengajuan";
                    }, 1500);
                } else {
                    toastr.error(response.message);
                }
            },
            error: function(response) {
                toastr.error(response.message);
            }
        });
    });
</script>

</body>

</html>