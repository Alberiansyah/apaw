<?php

require __DIR__ . '/functions/functions.php';
require __DIR__ . '/functions/session-check.php';

$dataTeknisi = tampilData("SELECT tb_bagian.*, tb_teknisi.* FROM tb_bagian INNER JOIN tb_teknisi ON tb_teknisi.bagian_id = tb_bagian.id_bagian");
$dataBagian = tampilData("SELECT * FROM tb_bagian");
$countTeknisi = count($dataTeknisi);
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
                <li class="breadcrumb-item active"><a href="<?= getSegment() ?>">Data Teknisi</a></li>
            </ol>
        </div>
        <!-- row -->
        <div class="row mx-0 mb-3">
            <button class="btn btn-primary" id="tambah" data-toggle="modal" data-target=".tambahTeknisi">Tambah Data</button>
        </div>
        <div id="reset">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Data Bagian</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="table" class="table" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Teknisi</th>
                                            <th>Nama Bagian</th>
                                            <th>No Telp</th>
                                            <th>No NIK</th>
                                            <th>Alamat</th>
                                            <th>Email</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($countTeknisi < 1) : ?>
                                            <tr>
                                                <td colspan="8" style="text-align: center;">Belum terdapat data, silahkan tambah terlebih dahulu</td>
                                            </tr>
                                        <?php else : ?>
                                            <?php foreach ($dataTeknisi as $data) : ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td><?= $data->nama_bagian ?></td>
                                                    <td><?= $data->nama_teknisi ?></td>
                                                    <td><?= empty($data->no_telp) ? '-' : $data->no_telp ?></td>
                                                    <td><?= empty($data->no_nik) ? '-' : $data->no_nik ?></td>
                                                    <td><?= empty($data->alamat) ? '-' : $data->alamat ?></td>
                                                    <td><?= empty($data->email) ? '-' : $data->email ?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-info" id="btnEditTeknisi" data-id="<?= $data->id_teknisi ?>">Edit</button></a>
                                                        <button type="button" class="btn btn-danger" id="btnHapusTeknisi" data-id="<?= $data->id_teknisi ?>">Hapus</button>
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
<div class="modal fade tambahTeknisi" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form method="POST" id="postTeknisi">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="nama_teknisi" class="">Nama Teknisi</label>
                                <input type="text" class="form-control" name="nama_teknisi" id="nama_teknisi" required>
                            </div>
                            <div class="form-group">
                                <label for="email" class="">Email</label>
                                <input type="text" class="form-control" name="email" id="email" required>
                            </div>
                            <div class="form-group">
                                <label for="no_telp" class="">No Telp</label>
                                <input type="text" class="form-control" name="no_telp" id="no_telp" required>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="bagian_id" class="">Nama Bagian</label>
                                <select id="bagian_id" class="single-select" name="bagian_id">
                                    <?php foreach ($dataBagian as $key) : ?>
                                        <option value="<?= $key->id_bagian ?>"><?= $key->nama_bagian ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="no_nik" class="">No NIK</label>
                                <input type="text" class="form-control" name="no_nik" id="no_nik" required>
                            </div>
                            <div class="form-group">
                                <label for="alamat" class="">Alamat</label>
                                <textarea name="alamat" id="alamat" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="button" class="btn btn-primary" id="tambahTeknisi">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade editTeknisi" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title">Edit Data</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <form method="POST" id="postEditTeknisi">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="edit_nama_teknisi" class="">Nama Teknisi</label>
                                <input type="text" class="form-control" name="edit_nama_teknisi" id="edit_nama_teknisi" required>
                            </div>
                            <div class="form-group">
                                <label for="edit_email" class="">Email</label>
                                <input type="text" class="form-control" name="edit_email" id="edit_email" required>
                            </div>
                            <div class="form-group">
                                <label for="edit_no_telp" class="">No Telp</label>
                                <input type="text" class="form-control" name="edit_no_telp" id="edit_no_telp" required>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="edit_bagian_id" class="">Nama Bagian</label>
                                <select id="edit_bagian_id" class="single-select" name="edit_bagian_id">
                                    <?php foreach ($dataBagian as $key) : ?>
                                        <option value="<?= $key->id_bagian ?>"><?= $key->nama_bagian ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="edit_no_nik" class="">No NIK</label>
                                <input type="text" class="form-control" name="edit_no_nik" id="edit_no_nik" required>
                            </div>
                            <div class="form-group">
                                <label for="edit_alamat" class="">Alamat</label>
                                <textarea name="edit_alamat" id="edit_alamat" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-info" id="editTeknisi">Ubah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade hapusTeknisi" tabindex="-1" role="dialog" aria-hidden="true">
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
                <button type="button" class="btn btn-danger" id="hapusTeknisi">Hapus</button>
            </div>
        </div>
    </div>
</div>
<?php require __DIR__ . '/wp-layouts/footer.php'; ?>

<script>
    // Teknisi

    $(document).on("click", "#tambahTeknisi", function() {
        let form = $('#postTeknisi').serialize();
        $.ajax({
            url: "functions/tambah-data-teknisi",
            data: form,
            type: 'POST',
            beforeSend: function() {
                $('#nama_teknisi').val('');
                $('#email').val('');
                $('#no_telp').val('');
                $('#bagian_id').val('').trigger('change');
                $('#no_nik').val('');
                $('#alamat').val('');
            },
            success: function(response) {
                if (response.status) {
                    $(".tambahTeknisi").modal("hide");
                    $("#reset").load(location.href + " #reset>*", function() {
                        $('#table').DataTable();
                    });
                    toastr.success(response.message);
                } else {
                    $(".tambahTeknisi").modal("hide");
                    toastr.error(response.message);
                }
            },
            error: function(response) {
                $(".tambahTeknisi").modal("hide");
                toastr.error(response.message);
            }
        });
    });

    $(document).on("click", "#btnEditTeknisi", function() {
        let id = $(this).data("id");
        $.ajax({
            url: "functions/get-id-teknisi?idTeknis=" + id,
            dataType: 'json',
            type: 'POST',
            success: function(response) {
                if (response.status) {
                    let data = response.data;
                    for (let i = 0; i < data.length; i++) {
                        $("#edit_nama_teknisi").val(data[i].nama_teknisi)
                        $("#edit_email").val(data[i].email)
                        $("#edit_no_telp").val(data[i].no_telp)
                        $("#edit_bagian_id").val(data[i].bagian_id).trigger('change');
                        $("#edit_no_nik").val(data[i].no_nik)
                        $("#edit_alamat").val(data[i].alamat)
                        $(".editTeknisi").modal("show");
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

    $(document).on("click", "#editTeknisi", function() {
        let form = $('#postEditTeknisi').serialize();
        $.ajax({
            url: "functions/edit-teknisi",
            data: form,
            type: 'POST',
            success: function(response) {
                if (response.status) {
                    $(".editTeknisi").modal("hide");
                    $("#reset").load(location.href + " #reset>*", function() {
                        $('#table').DataTable();
                    });
                    toastr.info(response.message);
                } else {
                    $(".editTeknisi").modal("hide");
                    toastr.error(response.message);
                }
            },
            error: function(response) {
                $(".editTeknisi").modal("hide");
                toastr.error(response.message);
            }
        });
    });

    $(document).on("click", "#btnHapusTeknisi", function() {
        let id = $(this).data("id");
        $.ajax({
            url: "functions/get-id-teknisi?idTeknis=" + id,
            dataType: 'json',
            type: 'POST',
            success: function(response) {
                let data = response.data;
                for (let i = 0; i < data.length; i++) {
                    $(".hapusTeknisi").modal("show");
                }
            },
            error: function(response) {
                toastr.error(response.message);
            }
        });
    });

    $(document).on("click", "#hapusTeknisi", function(e) {
        $.ajax({
            url: "functions/delete-teknisi",
            type: 'POST',
            success: function(response) {
                if (response.status) {
                    $(".hapusTeknisi").modal("hide");
                    $("#reset").load(location.href + " #reset>*", function() {
                        $('#table').DataTable();
                    });
                    toastr.error(response.message);
                } else {
                    $(".hapusTeknisi").modal("hide");
                    toastr.error(response.message);
                }
            },
            error: function(response) {
                $(".hapusTeknisi").modal("hide");
                toastr.error(response.message);
            }
        });
    });

    // End Teknisi
</script>

</body>

</html>