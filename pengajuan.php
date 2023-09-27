<?php

require __DIR__ . '/functions/functions.php';
require __DIR__ . '/functions/session-check.php';

$dataPengajuan = tampilData("SELECT * FROM tb_pengajuan");
$dataBarang = tampilData("SELECT * FROM tb_barang");
$countBarang = count($dataPengajuan);
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
        <div class="row mx-0 mb-3">
            <button class="btn btn-primary" id="tambah" data-toggle="modal" data-target=".tambahBarang">Tambah Pengajuan</button>
        </div>
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
                                            <th>Nama Teknisi</th>
                                            <th>Nama Bagian</th>
                                            <th>Nama Pengaju</th>
                                            <th>Nama Pengaju</th>
                                            <th>NIP Pengaju</th>
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

<?php require __DIR__ . '/wp-layouts/footer.php'; ?>