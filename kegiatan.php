<?php

require __DIR__ . '/functions/functions.php';
require __DIR__ . '/functions/session-check.php';

$dataKegiatan = tampilData("SELECT * FROM tb_kegiatan");
$dataUser = tampilData("SELECT * FROM tb_user");
$countBarang = count($dataKegiatan);
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
                <li class="breadcrumb-item active"><a href="<?= getSegment() ?>">Data Kegiatan</a></li>
            </ol>
        </div>
        <!-- row -->
        <div class="row mx-0 mb-3">
            <button class="btn btn-primary" id="tambah" data-toggle="modal" data-target=".tambahKegiatan">Tambah Kegiatan</button>
        </div>
        <div id="reset">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Data Kegiatan</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="table" class="table" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Kegiatan</th>
                                            <th>Tahun Anggaran</th>
                                            <th>Nilai Anggaran</th>
                                            <th>Kode Rekening</th>
                                            <th>Nama PPTK</th>
                                            <th>NIP PPTK</th>
                                            <th>Nama PPK</th>
                                            <th>NIP PPK</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($countBarang < 1) : ?>
                                            <tr>
                                                <td colspan=10" style="text-align: center;">Belum terdapat data, silahkan tambah terlebih dahulu</td>
                                            </tr>
                                        <?php else : ?>
                                            <?php foreach ($dataKegiatan as $data) : ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td><?= $data->nama_kegiatan ?></td>
                                                    <td><?= date('D, d M Y', strtotime($data->tahun_anggaran)) ?></td>
                                                    <td>Rp. <?= number_format($data->nilai_anggaran, 0, ',', '.') ?></td>
                                                    <td><?= $data->kode_rekening ?></td>
                                                    <td><?= $data->nama_pptk ?></td>
                                                    <td><?= $data->nip_pptk ?></td>
                                                    <td><?= $data->nama_ppk ?></td>
                                                    <td><?= $data->nip_ppk ?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-info" id="btnEditKegiatan" data-id="<?= $data->id_kegiatan  ?>">Edit</button></a>
                                                        <button type="button" class="btn btn-danger" id="btnhapusKegiatan" data-id="<?= $data->id_kegiatan  ?>">Hapus</button>
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


<div class="modal fade tambahKegiatan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>

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
<?php require __DIR__ . '/wp-layouts/footer.php'; ?>
<script type="text/javascript">
    $(document).ready(function() {
        $('#nilai_anggaran_manipulasi').on('input', function() {
            var inputValue = $(this).val();
            var formattedValue = formatBayar(inputValue, 'Rp. ');
            $(this).val(formattedValue);
            var unformattedValue = unformatBayar(formattedValue);
            $('#nilai_anggaran').val(unformattedValue);
        });

        $('#edit_nilai_anggaran_manipulasi').on('input', function() {
            var inputValue = $(this).val();
            var formattedValue = formatBayar(inputValue, 'Rp. ');
            $(this).val(formattedValue);
            var unformattedValue = unformatBayar(formattedValue);
            $('#edit_nilai_anggaran').val(unformattedValue);
        });
    });

    function formatBayar(bayarJs, prefix) {
        var number_string = bayarJs.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            bayarJs = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            bayarJs += separator + ribuan.join('.');
        }

        bayarJs = split[1] !== undefined ? bayarJs + ',' + split[1] : bayarJs;
        return prefix === undefined ? bayarJs : (bayarJs ? 'Rp. ' + bayarJs : '');
    }

    function unformatBayar(formattedValue) {
        var unformattedValue = formattedValue.replace(/[^\d]/g, '');
        return unformattedValue;
    }
</script>
<script>
    // Kegiatan

    $(document).on("click", "#tambahKegiatan", function() {
        let form = $('#postBarang').serialize();
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
                    $(".tambahKegiatan").modal("hide");
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

    // End Kegiatan
</script>

</body>

</html>