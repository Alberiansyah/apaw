<?php

require __DIR__ . '/functions/functions.php';
require __DIR__ . '/functions/session-check.php';

$dataBagian = tampilData("SELECT * FROM tb_bagian");
$countBagian = count($dataBagian);
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
                <li class="breadcrumb-item active"><a href="<?= getSegment() ?>">Data Bagian</a></li>
            </ol>
        </div>
        <!-- row -->
        <div class="row mx-0 mb-3">
            <button class="btn btn-primary" id="tambah" data-toggle="modal" data-target=".tambahBagian">Tambah Data</button>
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
                                            <th>Nama Bagian</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($countBagian < 1) : ?>
                                            <tr>
                                                <td colspan="3" style="text-align: center;">Belum terdapat data, silahkan tambah terlebih dahulu</td>
                                            </tr>
                                        <?php else : ?>
                                            <?php foreach ($dataBagian as $data) : ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td><?= $data->nama_bagian ?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-info" id="edit" data-id="<?= $data->id_bagian ?>">Edit</button></a>
                                                        <button type="button" class="btn btn-danger" id="hapus" data-id="<?= $data->id_bagian ?>">Hapus</button>
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

<div class="modal fade tambahBagian" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form method="POST" id="postBagian">
                <div class="modal-body">
                    <label for="bagian" class="">Nama Bagian</label>
                    <input type="text" class="form-control" name="nama_bagian" id="bagian" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" id="tambahBagian">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade editBagian" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title">Edit Data</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <form method="POST" id="postEditBagian">
                <div class="modal-body">
                    <label for="editNamaBagian" class="">Nama Bagian</label>
                    <input type="text" class="form-control" name="nama_bagian" id="editNamaBagian" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-info" id="editBagian">Ubah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade hapusBagian" tabindex="-1" role="dialog" aria-hidden="true">
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
                <button type="button" class="btn btn-danger" id="hapusBagian">Hapus</button>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/wp-layouts/footer.php'; ?>