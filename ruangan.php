<?php

require __DIR__ . '/functions/functions.php';
require __DIR__ . '/functions/session-check.php';

$dataRuangan = tampilData("SELECT * FROM tb_ruangan");
$countTeknisi = count($dataRuangan);
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
                <li class="breadcrumb-item active"><a href="<?= getSegment() ?>">Data Ruangan</a></li>
            </ol>
        </div>
        <!-- row -->
        <div class="row mx-0 mb-3">
            <button class="btn btn-primary" id="tambah" data-toggle="modal" data-target=".tambahRuangan">Tambah Data</button>
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
                                            <th>Nama Ruangan</th>
                                            <th>Lantai</th>
                                            <th>Zona</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($countTeknisi < 1) : ?>
                                            <tr>
                                                <td colspan="5" style="text-align: center;">Belum terdapat data, silahkan tambah terlebih dahulu</td>
                                            </tr>
                                        <?php else : ?>
                                            <?php foreach ($dataRuangan as $data) : ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td><?= $data->nama_ruangan ?></td>
                                                    <td><?= $data->lantai ?></td>
                                                    <td><?= $data->zona ?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-info" id="btnEditRuangan" data-id="<?= $data->id_ruangan ?>">Edit</button></a>
                                                        <button type="button" class="btn btn-danger" id="btnHapusRuangan" data-id="<?= $data->id_ruangan ?>">Hapus</button>
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

<div class="modal fade tambahRuangan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form method="POST" id="postRuangan">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_ruangan" class="">Nama Ruangan</label>
                        <input type="text" class="form-control" name="nama_ruangan" id="nama_ruangan" required>
                    </div>
                    <div class="form-group">
                        <label for="lantai" class="">Lantai</label>
                        <select id="lantai" class="single-select" name="lantai" required>
                            <option value="G">G</option>
                            <option value="H">H</option>
                            <option value="B">B</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="R">R</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="zona" class="">Zona</label>
                        <select id="zona" class="single-select" name="zona" required>
                            <option value="STAFF">STAFF</option>
                            <option value="DEWAN">DEWAN</option>
                            <option value="TAMAN">TAMAN</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="button" class="btn btn-primary" id="tambahRuangan">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade editRuangan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title">Edit Data</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <form method="POST" id="postEditRuangan">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_nama_ruangan" class="">Nama Ruangan</label>
                        <input type="text" class="form-control" name="edit_nama_ruangan" id="edit_nama_ruangan">
                    </div>
                    <div class="form-group">
                        <label for="edit_lantai" class="">Lantai</label>
                        <select id="edit_lantai" class="single-select" name="edit_lantai">
                            <option value="G">G</option>
                            <option value="H">H</option>
                            <option value="B">B</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="R">R</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_zona" class="">Zona</label>
                        <select id="edit_zona" class="single-select" name="edit_zona">
                            <option value="STAFF">STAFF</option>
                            <option value="DEWAN">DEWAN</option>
                            <option value="TAMAN">TAMAN</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-info" id="editRuangan">Ubah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade hapusRuangan" tabindex="-1" role="dialog" aria-hidden="true">
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
                <button type="button" class="btn btn-danger" id="hapusRuangan">Hapus</button>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/wp-layouts/footer.php'; ?>
<script>
    // Ruangan

    $(document).on("click", "#tambahRuangan", function() {
        let form = $('#postRuangan').serialize();
        $.ajax({
            url: "functions/tambah-data-ruangan",
            data: form,
            type: 'POST',
            beforeSend: function() {
                $('#nama_ruangan').val('');
                $('#lantai').val('').trigger('change');;
                $('#zona').val('').trigger('change');;
            },
            success: function(response) {
                if (response.status) {
                    $(".tambahRuangan").modal("hide");
                    $("#reset").load(location.href + " #reset>*", function() {
                        $('#table').DataTable();
                    });
                    toastr.success(response.message);
                } else {
                    $(".tambahRuangan").modal("hide");
                    toastr.error(response.message);
                }
            },
            error: function(response) {
                $(".tambahRuangan").modal("hide");
                toastr.error(response.message);
            }
        });
    });

    $(document).on("click", "#btnEditRuangan", function() {
        let id = $(this).data("id");
        $.ajax({
            url: "functions/get-id-ruangan?idRuangan=" + id,
            dataType: 'json',
            type: 'POST',
            success: function(response) {
                if (response.status) {
                    let data = response.data;
                    for (let i = 0; i < data.length; i++) {
                        $("#edit_nama_ruangan").val(data[i].nama_ruangan)
                        $("#edit_lantai").val(data[i].lantai).trigger('change');
                        $("#edit_zona").val(data[i].zona).trigger('change');
                        $(".editRuangan").modal("show");
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

    $(document).on("click", "#editRuangan", function(e) {
        let form = $('#postEditRuangan').serialize();
        $.ajax({
            url: "functions/edit-ruangan",
            data: form,
            type: 'POST',
            success: function(response) {
                if (response.status) {
                    $(".editRuangan").modal("hide");
                    $("#reset").load(location.href + " #reset>*", function() {
                        $('#table').DataTable();
                    });
                    toastr.info(response.message);
                } else {
                    $(".editRuangan").modal("hide");
                    toastr.error(response.message);
                }
            },
            error: function(response) {
                $(".editRuangan").modal("hide");
                toastr.error(response.message);
            }
        });
    });

    $(document).on("click", "#btnHapusRuangan", function() {
        let id = $(this).data("id");
        $.ajax({
            url: "functions/get-id-ruangan?idRuangan=" + id,
            dataType: 'json',
            type: 'POST',
            success: function(response) {
                let data = response.data;
                for (let i = 0; i < data.length; i++) {
                    $(".hapusRuangan").modal("show");
                }
            },
            error: function(response) {
                toastr.error(response.message);
            }
        });
    });

    $(document).on("click", "#hapusRuangan", function(e) {
        $.ajax({
            url: "functions/delete-ruangan",
            type: 'POST',
            success: function(response) {
                if (response.status) {
                    $(".hapusRuangan").modal("hide");
                    $("#reset").load(location.href + " #reset>*", function() {
                        $('#table').DataTable();
                    });
                    toastr.error(response.message);
                } else {
                    $(".hapusRuangan").modal("hide");
                    toastr.error(response.message);
                }
            },
            error: function(response) {
                $(".hapusRuangan").modal("hide");
                toastr.error(response.message);
            }
        });
    });

    // End Ruangan
</script>

</body>

</html>