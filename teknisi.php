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
                                                    <td><?= $data->no_telp ?></td>
                                                    <td><?= $data->no_nik ?></td>
                                                    <td><?= $data->alamat ?></td>
                                                    <td><?= $data->email ?></td>
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