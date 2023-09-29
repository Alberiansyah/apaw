<?php
require __DIR__ . '/functions/functions.php';

$idPengajuan = decrypt($_GET['id_pengajuan']);
$dataKegiatan = tampilDataFirst("SELECT tb_kegiatan.*, tb_pengajuan.*, tb_bagian.*, tb_teknisi.* FROM tb_pengajuan LEFT JOIN tb_kegiatan ON tb_kegiatan.id_kegiatan = tb_pengajuan.kegiatan_id LEFT JOIN tb_bagian ON tb_bagian.id_bagian = tb_pengajuan.bagian_id LEFT JOIN tb_teknisi ON tb_teknisi.id_teknisi = tb_pengajuan.teknisi_id WHERE tb_pengajuan.id_pengajuan = '$idPengajuan'");
$dataPengajuanDetail = tampilData("SELECT tb_pengajuan.*, tb_pengajuan_detail.*, tb_ruangan.*, tb_barang.* FROM tb_pengajuan INNER JOIN tb_pengajuan_detail ON tb_pengajuan_detail.pengajuan_id = tb_pengajuan.id_pengajuan INNER JOIN tb_ruangan ON tb_ruangan.id_ruangan = tb_pengajuan_detail.ruangan_id INNER JOIN tb_barang ON tb_barang.id_barang = tb_pengajuan_detail.barang_id WHERE tb_pengajuan.id_pengajuan = '$idPengajuan'");
$no = 1;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Pengajuan</title>
    <style>
        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }

        .table-bordered {
            border: 1px solid #dee2e6;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #dee2e6;
        }

        .table-bordered thead th,
        .table-bordered thead td {
            border-bottom-width: 2px;
        }

        .container {
            display: flex;
            justify-content: flex-end;
        }

        .col-3 {
            width: 25%;
        }

        .text-right {
            text-align: right;
        }

        .mt-5 {
            margin-top: 5px;
        }

        .mb-2 {
            margin-bottom: 2px;
        }

        .mt-100 {
            margin-top: 100px;
        }

        .m-1 {
            margin: 1px;
        }

        .text-dark {
            color: #000;
        }

        .text-dark b {
            font-weight: bold;
        }

        .text-dark u {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="d-flex justify-content-center mt-5">
            <h2>Cetak Pengajuan</h2>
        </div>
        <div class="row mt-5">
            <div class="col-xl-1 col-lg-1col-md-12 col-sm-12"></div>
            <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12">
                <div class="form-group">
                    <label for="nama_kegiatan">Nama Kegiatan</label>
                    <input type="text" name="nama_kegiatan" id="nama_kegiatan" class="form-control" value="<?= $dataKegiatan->nama_kegiatan ?>">
                </div>
                <div class="form-group">
                    <label for="nama_pengaju">Nama Pengaju</label>
                    <input type="text" name="nama_pengaju" id="nama_pengaju" class="form-control" value="<?= $dataKegiatan->nama_pengaju ?>">
                </div>
                <div class="form-group">
                    <label for="nip_pengaju">NIP Pengaju</label>
                    <input type="text" name="nip_pengaju" id="nip_pengaju" class="form-control" value="<?= $dataKegiatan->nip_pengaju ?>">
                </div>
            </div>
            <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12">
                <div class="form-group">
                    <label for="nama_bagian">Nama Bagian</label>
                    <input type="text" name="nama_bagian" id="nama_bagian" class="form-control" value="<?= $dataKegiatan->nama_bagian ?>">
                </div>
                <div class="form-group">
                    <label for="nama_teknisi">Nama Teknisi</label>
                    <input type="text" name="nama_teknisi" id="nama_teknisi" class="form-control" value="<?= $dataKegiatan->nama_teknisi ?>">
                </div>
                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="text" name="tanggal" id="tanggal" class="form-control" value="<?= $dataKegiatan->tanggal ?>">
                </div>
            </div>
            <div class="col-xl-1 col-lg-1col-md-12 col-sm-12"></div>
        </div>
        <div class="d-flex justify-content-center mt-5">
            <h3>Detail Pengajuan</h3>
        </div>
        <table class="table table=bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Ruangan</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dataPengajuanDetail as $data) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $data->nama_ruangan ?></td>
                        <td><?= $data->nama_barang ?></td>
                        <td><?= $data->jumlah ?></td>
                        <td><?= $data->keterangan ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="container">
            <div class="row d-flex justify-content-end">
                <div class="col-3">
                    <div class="text-right mt-5 mb-2">
                        <span class="text-dark" style="word-wrap: break-word;">Bandung, <?= date('D, d M Y') ?></span>
                    </div>
                    <div class="text-right">
                        <span class="text-dark" style="word-wrap: break-word;">Pejabat Pelaksana Teknis Kegiatan</span>
                    </div>
                    <div class="text-right">
                        <span class="text-dark m-1"><b><?= $dataKegiatan->nama_kegiatan ?></b></span>
                    </div>
                    <div class="text-right" style="margin-top: 100px;">
                        <span class="text-dark m-1"><u><b><?= $dataKegiatan->nama_pengaju ?></b></u></span>
                    </div>
                    <div class="text-right mb-5">
                        <span class="text-dark m-1"><u><b><?= $dataKegiatan->nip_pengaju ?></b></u></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>