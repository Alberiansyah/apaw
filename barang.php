<?php

require __DIR__ . '/functions/functions.php';
require __DIR__ . '/functions/session-check.php';

$dataBarang = tampilData("SELECT tb_bagian.*, tb_barang.* FROM tb_bagian INNER JOIN tb_barang ON tb_barang.bagian_id = tb_bagian.id_bagian");
$dataBagian = tampilData("SELECT * FROM tb_bagian");
$countBarang = count($dataBarang);
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
                <li class="breadcrumb-item active"><a href="<?= getSegment() ?>">Data Barang</a></li>
            </ol>
        </div>
        <!-- row -->
        <div class="row mx-0 mb-3">
            <button class="btn btn-primary" id="tambah" data-toggle="modal" data-target=".tambahBarang">Tambah Data</button>
        </div>
        <div id="reset">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Data Barang</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="table" class="table" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Barang</th>
                                            <th>Nama Bagian</th>
                                            <th>Satuan</th>
                                            <th>Merk</th>
                                            <th>Type</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($countBarang < 1) : ?>
                                            <tr>
                                                <td colspan="7" style="text-align: center;">Belum terdapat data, silahkan tambah terlebih dahulu</td>
                                            </tr>
                                        <?php else : ?>
                                            <?php foreach ($dataBarang as $data) : ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td><?= $data->nama_barang ?></td>
                                                    <td><?= $data->nama_bagian ?></td>
                                                    <td><?= $data->satuan ?></td>
                                                    <td><?= $data->merk ?></td>
                                                    <td><?= $data->type ?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-info" id="btnEditBarang" data-id="<?= $data->id_barang ?>">Edit</button></a>
                                                        <button type="button" class="btn btn-danger" id="btnhapusBarang" data-id="<?= $data->id_barang ?>">Hapus</button>
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

<div class="modal fade tambahBarang" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form method="POST" id="postBarang">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="nama_barang" class="">Nama Barang</label>
                                <input type="text" class="form-control" name="nama_barang" id="nama_barang" required>
                            </div>
                            <div class="form-group">
                                <label for="satuan" class="">Satuan</label>
                                <select id="satuan" class="single-select" name="satuan">
                                    <option value="Meter">Meter</option>
                                    <option value="Buah">Buah</option>
                                    <option value="Unit">Unit</option>
                                    <option value="Dus">Dus</option>
                                    <option value="KG">KG</option>
                                    <option value="Kaleng">Kaleng</option>
                                    <option value="Batang">Batang</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="type" class="">Type</label>
                                <input type="text" class="form-control" name="type" id="type" required>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="bagian_id" class="">Nama Bagian</label>
                                <select id="bagian_id" class="single-select" name="bagian_id" required>
                                    <?php foreach ($dataBagian as $key) : ?>
                                        <option value="<?= $key->id_bagian ?>"><?= $key->nama_bagian ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="merk" class="">Merk</label>
                                <input type="text" class="form-control" name="merk" id="merk" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="button" class="btn btn-primary" id="tambahBarang">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade editBarang" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title">Edit Data</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <form method="POST" id="postEditBarang">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="nama_barang" class="">Nama Barang</label>
                                <input type="text" class="form-control" name="nama_barang" id="edit_nama_barang" required>
                            </div>
                            <div class="form-group">
                                <label for="satuan" class="">Satuan</label>
                                <select id="edit_satuan" class="single-select" name="satuan" required>
                                    <option value="Meter">Meter</option>
                                    <option value="Buah">Buah</option>
                                    <option value="Unit">Unit</option>
                                    <option value="Dus">Dus</option>
                                    <option value="KG">KG</option>
                                    <option value="Kaleng">Kaleng</option>
                                    <option value="Batang">Batang</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="type" class="">Type</label>
                                <input type="text" class="form-control" name="type" id="edit_type" required>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="bagian_id" class="">Nama Bagian</label>
                                <select id="edit_bagian_id" class="single-select" name="bagian_id" required>
                                    <?php foreach ($dataBagian as $key) : ?>
                                        <option value="<?= $key->id_bagian ?>"><?= $key->nama_bagian ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="merk" class="">Merk</label>
                                <input type="text" class="form-control" name="merk" id="edit_merk" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-info" id="editBarang">Ubah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade hapusBarang" tabindex="-1" role="dialog" aria-hidden="true">
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
                <button type="button" class="btn btn-danger" id="hapusBarang">Hapus</button>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/wp-layouts/footer.php'; ?>

<script>
    // Barang

    $(document).on("click", "#tambahBarang", function() {
        let form = $('#postBarang').serialize();
        $.ajax({
            url: "functions/tambah-data-barang",
            data: form,
            type: 'POST',
            beforeSend: function() {
                $('#nama_barang').val('');
                $("#satuan").val('').trigger('change');
                $("#bagian_id").val('').trigger('change');
                $('#type').val('');
                $('#merk').val('');
            },
            success: function(response) {
                if (response.status) {
                    $(".tambahBarang").modal("hide");
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

    $(document).on("click", "#btnEditBarang", function() {
        let id = $(this).data("id");
        $.ajax({
            url: "functions/get-id-barang?idBarang=" + id,
            dataType: 'json',
            type: 'POST',
            success: function(response) {
                if (response.status) {
                    let data = response.data;
                    for (let i = 0; i < data.length; i++) {
                        $("#edit_nama_barang").val(data[i].nama_barang)
                        $("#edit_satuan").val(data[i].satuan).trigger('change');
                        $("#edit_bagian_id").val(data[i].bagian_id).trigger('change');
                        $("#edit_type").val(data[i].type)
                        $("#edit_merk").val(data[i].merk)
                        $(".editBarang").modal("show");
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

    $(document).on("click", "#editBarang", function(e) {
        let form = $('#postEditBarang').serialize();
        $.ajax({
            url: "functions/edit-barang",
            data: form,
            type: 'POST',
            success: function(response) {
                if (response.status) {
                    $(".editBarang").modal("hide");
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

    $(document).on("click", "#btnhapusBarang", function() {
        let id = $(this).data("id");
        $.ajax({
            url: "functions/get-id-barang?idBarang=" + id,
            dataType: 'json',
            type: 'POST',
            success: function(response) {
                let data = response.data;
                for (let i = 0; i < data.length; i++) {
                    $(".hapusBarang").modal("show");
                }
            },
            error: function(response) {
                toastr.error(response.message);
            }
        });
    });

    $(document).on("click", "#hapusBarang", function(e) {
        $.ajax({
            url: "functions/delete-barang",
            type: 'POST',
            success: function(response) {
                if (response.status) {
                    $(".hapusBarang").modal("hide");
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

    // End Barang
</script>

</body>

</html>