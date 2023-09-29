<?php
require __DIR__ . '/functions/functions.php';
require __DIR__ . '/functions/session-check.php';

$dataKegiatan = tampilData("SELECT tb_kegiatan.*, tb_pengajuan.*, tb_teknisi.*, tb_bagian.* FROM tb_kegiatan LEFT JOIN tb_pengajuan ON tb_pengajuan.kegiatan_id = tb_kegiatan.id_kegiatan LEFT JOIN tb_teknisi ON tb_teknisi.id_teknisi = tb_pengajuan.teknisi_id LEFT JOIN tb_bagian ON tb_bagian.id_bagian = tb_pengajuan.bagian_id");
$dataUser = tampilData("SELECT * FROM tb_user");
$dataRuangan = tampilData("SELECT * FROM tb_ruangan");
$dataBarang = tampilData("SELECT * FROM tb_barang");
$countKegiatan = count($dataKegiatan);
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
                <li class="breadcrumb-item active"><a href="<?= getSegment() ?>">Pengajuan</a></li>
            </ol>
        </div>
        <!-- row -->
        <div id="reset">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Data Pengajuan</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="table" class="table" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Kegiatan</th>
                                            <th>Nama Teknisi</th>
                                            <th>Nama Bagian</th>
                                            <th>Nama Pengaju</th>
                                            <th>NIP Pengaju</th>
                                            <th>Persetujuan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($countKegiatan < 1) : ?>
                                            <tr>
                                                <td colspan="8" style="text-align: center;">Belum terdapat data, silahkan tambah terlebih dahulu</td>
                                            </tr>
                                        <?php else : ?>
                                            <?php foreach ($dataKegiatan as $data) : ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td><?= empty($data->nama_kegiatan) ? '-' : $data->nama_kegiatan ?></td>
                                                    <td><?= empty($data->nama_teknisi) ? '-' : $data->nama_teknisi ?></td>
                                                    <td><?= empty($data->nama_bagian) ? '-' : $data->nama_bagian ?></td>
                                                    <td><?= empty($data->nama_pengaju) ? '-' : $data->nama_pengaju ?></td>
                                                    <td><?= empty($data->nip_pengaju) ? '-' : $data->nip_pengaju ?></td>
                                                    <td><?= ($data->persetujuan === 0) ? 'Belum disetujui' : (($data->persetujuan === 1) ? 'Disetujui' : '-') ?></td>
                                                    <td>
                                                        <?php if ($data->persetujuan == "") : ?>
                                                            <a href="tambah-pengajuan?id_kegiatan=<?= encrypt($data->id_kegiatan) ?>"><button type="button" class="btn btn-xs btn-primary"><i class="fa fa-plus"></i></button></a>
                                                        <?php elseif ($data->persetujuan === 0) :  ?>
                                                            <a href="detail-pengajuan?id_pengajuan=<?= encrypt($data->id_pengajuan) ?>"><button type="button" class="btn btn-xs btn-info" style="margin: 3px;"><i class="fa fa-eye"></i></button></a>
                                                            <a href="edit-pengajuan?id_pengajuan=<?= encrypt($data->id_pengajuan) ?>"><button type="button" class="btn btn-xs btn-secondary" style="margin: 3px;"><i class="fa fa-edit"></i></button></a><br>
                                                            <a href="cetak-pengajuan?id_pengajuan=<?= encrypt($data->id_pengajuan) ?>" target="_blank"><button type="button" style="margin: 3px;" class="btn btn-xs btn-warning"><i class="fa fa-print"></i></button></a>
                                                            <button type="button" class="btn btn-xs btn-danger" style="margin: 3px;" id="btnBatalkan" data-id="<?= encrypt($data->id_pengajuan) ?>"><i class="fa fa-close"></i></button>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="modal fade batalPengajuan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-white">Batalkan Pengajuan</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <center>
                    <h1><i class="fa fa-exclamation-triangle text-danger"></i></h1>
                    <span>Apakah anda yakin ingin membatalkan pengajuan?</span>
                </center>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-danger" id="batalPengajuan">Batalkan</button>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/wp-layouts/footer.php'; ?>
<script>
    $(document).on("click", "#btnBatalkan", function() {
        let id = $(this).data("id");
        $.ajax({
            url: "functions/get-id-pengajuan?idPengajuan=" + id,
            dataType: 'json',
            type: 'POST',
            success: function(response) {
                let data = response.data;
                for (let i = 0; i < data.length; i++) {
                    $(".batalPengajuan").modal("show");
                }
            },
            error: function(response) {
                toastr.error(response.message);
            }
        });
    });

    $(document).on("click", "#batalPengajuan", function(e) {
        $.ajax({
            url: "functions/batalkan-pengajuan",
            type: 'POST',
            success: function(response) {
                if (response.status) {
                    $(".batalPengajuan").modal("hide");
                    $("#reset").load(location.href + " #reset>*", function() {
                        $('#table').DataTable();
                    });
                    toastr.error(response.message);
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