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
                                                        <?php if (!empty($data->persetujuan)) : ?>
                                                            <a href="tambah-pengajuan?id_kegiatan=<?= $data->id_kegiatan ?>"><button type="button" class="btn btn-xs btn-primary"><i class="fa fa-plus"></i></button></a></a>
                                                        <?php else : ?>
                                                            <a href=""><button type="button" class="btn btn-xs btn-info"><i class="fa fa-eye"></i></button></a>
                                                            <a href=""><button type="button" class="btn btn-xs btn-secondary"><i class="fa fa-edit"></i></button></a>
                                                        <?php endif; ?>
                                                        <!-- <button type="button" class="btn btn-danger" id="btnhapusBarang" data-id="<?= $data->id_barang ?>">Batalkan</button> -->
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

<div class="modal fade tambahPengajuan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Tambah Pengajuan</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form method="POST" id="postPengajuan">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="nama_bagian" class="">Nama Kegiatan</label>
                                <textarea name="nama_bagian" id="nama_bagian" class="form-control" rows="1"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="nama_pengaju" class="">Nama Pengaju</label>
                                <select id="nama_pengaju" class="single-select" name="nama_pengaju">
                                    <?php foreach ($dataUser as $data) : ?>
                                        <?php if ($data->role_id == 1 || $data->role_id == 3) : ?>
                                            <option value="<?= $data->nama_lengkap ?>"><?= $data->nama_lengkap ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="nama_teknisi" class="">Nama Teknisi</label>
                                <textarea name="nama_teknisi" id="nama_teknisi" class="form-control" rows="1"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="nip_ppk" class="">NIP PPK</label>
                                <input type="text" class="form-control" name="nip_ppk" id="nip_ppk">
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mt-3">
                        <h4>Detail Pengajuan</h4><br>
                    </div>
                    <table class="table tableDetail">
                        <tr>
                            <th>Ruangan</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <select id="id_ruangan" class="single-select" name="id_ruangan[]">
                                        <?php foreach ($dataRuangan as $data) : ?>
                                            <option value="<?= $data->id_ruangan ?>"><?= $data->nama_ruangan ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <select id="id_barang" class="single-select" name="id_barang[]">
                                        <?php foreach ($dataBarang as $data) : ?>
                                            <option value="<?= $data->id_barang ?>"><?= $data->nama_barang ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="number" min="1" class="form-control" id="jumlah" name="jumlah[]" value="1">
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <textarea id="keterangan" name="keterangan[]" class="form-control"></textarea>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <button type="button" class="btn btn-xs btn-primary" id="tambahRow"><i class="fa fa-plus"></i></button>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="button" class="btn btn-primary" id="tambahPengajuan">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade editKegiatan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title">Edit Data</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <form method="POST" id="postEditKegiatan">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="edit_nama_kegiatan" class="">Nama Kegiatan</label>
                                <textarea name="edit_nama_kegiatan" id="edit_nama_kegiatan" class="form-control" rows="1"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="nilai_anggaran" class="">Nilai Anggaran</label>
                                <input type="hidden" class="form-control" name="edit_nilai_anggaran" id="edit_nilai_anggaran">
                                <input type="text" class="form-control" id="edit_nilai_anggaran_manipulasi">
                            </div>
                            <div class="form-group">
                                <label for="edit_nama_pptk" class="">Nama PPTK</label>
                                <select id="edit_nama_pptk" class="single-select" name="edit_nama_pptk">
                                    <?php foreach ($dataUser as $data) : ?>
                                        <?php if ($data->role_id == 1 || $data->role_id == 3) : ?>
                                            <option value="<?= $data->nama_lengkap ?>"><?= $data->nama_lengkap ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="edit_nip_pptk" class="">NIP PPTK</label>
                                <input type="text" class="form-control" name="edit_nip_pptk" id="edit_nip_pptk">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="edit_tahun_anggaran" class="">Tahun Anggaran</label>
                                <input type="text" class="form-control date" name="edit_tahun_anggaran" id="edit_tahun_anggaran">
                            </div>
                            <div class="form-group">
                                <label for="edit_kode_rekening" class="">Kode Rekening</label>
                                <input type="text" class="form-control" name="edit_kode_rekening" id="edit_kode_rekening">
                            </div>
                            <div class="form-group">
                                <label for="edit_nama_ppk" class="">Nama PPK</label>
                                <select id="edit_nama_ppk" class="single-select" name="edit_nama_ppk">
                                    <?php foreach ($dataUser as $data) : ?>
                                        <?php if ($data->role_id == 2) : ?>
                                            <option value="<?= $data->nama_lengkap ?>"><?= $data->nama_lengkap ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="edit_nip_ppk" class="">NIP PPK</label>
                                <input type="text" class="form-control" name="edit_nip_ppk" id="edit_nip_ppk">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-info" id="editKegiatan">Ubah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade hapusKegiatan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-white">Hapus Data</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <center>
                    <h1><i class="fa fa-exclamation-triangle text-danger"></i></h1>
                    <span>Apakah anda yakin ingin menghapus data?</span>
                </center>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-danger" id="hapusKegiatan">Hapus</button>
            </div>
        </div>
    </div>
</div>

<div class="copy d-none">
    <tr>
        <td>
            <div class="form-group">
                <select id="" class="single-select" name="id_ruangan[]">
                    <?php foreach ($dataRuangan as $data) : ?>
                        <option value="<?= $data->id_ruangan ?>"><?= $data->nama_ruangan ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </td>
        <td>
            <div class="form-group">
                <select id="" class="single-select" name="id_barang[]">
                    <?php foreach ($dataBarang as $data) : ?>
                        <option value="<?= $data->id_barang ?>"><?= $data->nama_barang ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </td>
        <td>
            <div class="form-group">
                <input type="number" min="1" class="form-control" id="jumlah" name="jumlah[]" value="1">
            </div>
        </td>
        <td>
            <div class="form-group">
                <textarea id="keterangan" name="keterangan[]" class="form-control"></textarea>
            </div>
        </td>
        <td>
            <div class="form-group">
                <button type="button" class="btn btn-xs btn-danger tambahRow"><i class="fa fa-remove"></i></button>
            </div>
        </td>
    </tr>
</div>

<?php require __DIR__ . '/wp-layouts/footer.php'; ?>
<script>
    // Pengajuan

    $(document).on("click", "#tambahPengajuanModal", function() {
        $(".tambahPengajuan").modal("show");
    });

    $(document).on("click", "#tambahPengajuan", function() {
        let form = $('#postPengajuan').serialize();
        $.ajax({
            url: "functions/tambah-data-kegiatan",
            data: form,
            type: 'POST',
            beforeSend: function() {
                $('#nama_kegiatan').val('');
                $('#nilai_anggaran').val('');
                $('#nilai_anggaran_manipulasi').val('');
                $("#nama_pptk").val('').trigger('change');
                $('#nip_pptk').val('');
                $('#tahun_anggaran').val('');
                $('#kode_rekening').val('');
                $("#nama_ppk").val('').trigger('change');
                $('#nip_ppk').val('');
            },
            success: function(response) {
                if (response.status) {
                    $(".tambahPengajuan").modal("hide");
                    $("#reset").load(location.href + " #reset>*", function() {
                        $('#table').DataTable();
                    });
                    toastr.success(response.message);
                } else {
                    toastr.error(response.message);
                }
            },
            error: function(response) {
                toastr.error(response.message);
            }
        });
    });

    $(document).on("click", "#btnEditKegiatan", function() {
        let id = $(this).data("id");
        $.ajax({
            url: "functions/get-id-kegiatan?idKegiatan=" + id,
            dataType: 'json',
            type: 'POST',
            success: function(response) {
                if (response.status) {
                    let data = response.data;
                    for (let i = 0; i < data.length; i++) {
                        $("#edit_nama_kegiatan").text(data[i].nama_kegiatan)
                        $("#edit_nilai_anggaran").val(data[i].nilai_anggaran);
                        var formattedValue = formatBayar(String(data[i].nilai_anggaran), 'Rp. ');
                        $("#edit_nilai_anggaran_manipulasi").val(formattedValue)
                        $("#edit_nama_pptk").val(data[i].nama_pptk).trigger('change');
                        $("#edit_nip_pptk").val(data[i].nip_pptk)
                        $("#edit_tahun_anggaran").val(data[i].tahun_anggaran)
                        $("#edit_kode_rekening").val(data[i].kode_rekening)
                        $("#edit_nama_ppk").val(data[i].nama_ppk).trigger('change');
                        $("#edit_nip_ppk").val(data[i].nip_ppk)
                        $(".editKegiatan").modal("show");
                    }
                } else {
                    toastr.error(response.message);
                }
            },
            error: function(response) {
                toastr.error(response.message);
            }
        });
    });

    $(document).on("click", "#editKegiatan", function(e) {
        let form = $('#postEditKegiatan').serialize();
        $.ajax({
            url: "functions/edit-kegiatan",
            data: form,
            type: 'POST',
            success: function(response) {
                if (response.status) {
                    $(".editKegiatan").modal("hide");
                    $("#reset").load(location.href + " #reset>*", function() {
                        $('#table').DataTable();
                    });
                    toastr.info(response.message);
                } else {
                    toastr.error(response.message);
                }
            },
            error: function(response) {
                toastr.error(response.message);
            }
        });
    });

    $(document).on("click", "#btnhapusKegiatan", function() {
        let id = $(this).data("id");
        $.ajax({
            url: "functions/get-id-kegiatan?idKegiatan=" + id,
            dataType: 'json',
            type: 'POST',
            success: function(response) {
                let data = response.data;
                for (let i = 0; i < data.length; i++) {
                    $(".hapusKegiatan").modal("show");
                }
            },
            error: function(response) {
                toastr.error(response.message);
            }
        });
    });

    $(document).on("click", "#hapusKegiatan", function(e) {
        $.ajax({
            url: "functions/delete-kegiatan",
            type: 'POST',
            success: function(response) {
                if (response.status) {
                    $(".hapusKegiatan").modal("hide");
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

    // End Pengajuan
</script>

</body>

</html>