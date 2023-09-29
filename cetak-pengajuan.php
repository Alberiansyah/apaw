<?php
require_once __DIR__ . '/vendor/autoload.php'; // Sesuaikan dengan path library mPDF
require __DIR__ . '/functions/functions.php';

$idPengajuan = decrypt($_GET['id_pengajuan']);
$dataKegiatan = tampilDataFirst("SELECT tb_kegiatan.*, tb_pengajuan.*, tb_bagian.*, tb_teknisi.* FROM tb_pengajuan LEFT JOIN tb_kegiatan ON tb_kegiatan.id_kegiatan = tb_pengajuan.kegiatan_id LEFT JOIN tb_bagian ON tb_bagian.id_bagian = tb_pengajuan.bagian_id LEFT JOIN tb_teknisi ON tb_teknisi.id_teknisi = tb_pengajuan.teknisi_id WHERE tb_pengajuan.id_pengajuan = '$idPengajuan'");
$dataPengajuanDetail = tampilData("SELECT tb_pengajuan.*, tb_pengajuan_detail.*, tb_ruangan.*, tb_barang.* FROM tb_pengajuan INNER JOIN tb_pengajuan_detail ON tb_pengajuan_detail.pengajuan_id = tb_pengajuan.id_pengajuan INNER JOIN tb_ruangan ON tb_ruangan.id_ruangan = tb_pengajuan_detail.ruangan_id INNER JOIN tb_barang ON tb_barang.id_barang = tb_pengajuan_detail.barang_id WHERE tb_pengajuan.id_pengajuan = '$idPengajuan'");
$no = 1;

$mpdf = new \Mpdf\Mpdf();
$html = '<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Cetak Pengajuan</title>
   <style>
         .container {
            position: absolute;
            right: 55px;
            margin-right: 500px;
            margin-top:100px;
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
         table {
            width: 100%;
            border-collapse: collapse;
         }
      
         table, th, td {
            border: 1px solid black;
         }
      
         th, td {
            padding: 8px;
         }
      
         th {
            background-color: #f2f2f2;
         }
    </style>
</head>
<body>
      
   <div class="">
      <h1 align="center">Cetak Pengajuan</h1>
   </div>

   <table>
         <tr>
            <td>Nama Kegiatan</td>
            <td>:</td>
            <td>' . $dataKegiatan->nama_kegiatan . '</td>
         </tr>
         <tr>
            <td>Nama Pengaju</td>
            <td>:</td>
            <td>' . $dataKegiatan->nama_pengaju . '</td>
         </tr>
         <tr>
            <td>NIP Pengaju</td>
            <td>:</td>
            <td>' . $dataKegiatan->nip_pengaju . '</td>
         </tr>
         <tr>
            <td>Nama Bagian</td>
            <td>:</td>
            <td>' . $dataKegiatan->nama_bagian . '</td>
         </tr>
         <tr>
            <td>Nama Teknisi</td>
            <td>:</td>
            <td>' . $dataKegiatan->nama_teknisi . '</td>
         </tr>
         <tr>
            <td>Tanggal</td>
            <td>:</td>
            <td>' . $dataKegiatan->tanggal . '</td>
         </tr>
   </table> 

   <div class="">
      <h3 align="center">Detail Pengajuan</h3>
   </div>

   <table border="1" align="center">
         <tr>
            <thead>
               <th>No</th>
               <th>Ruangan</th>
               <th>Nama Barang</th>
               <th>Jumlah</th>
               <th>Keterangan</th>
            </thead>
         </tr>';
foreach ($dataPengajuanDetail as $data) {
   $html .= '
               <tr>
                  <td>' . $no++ . '</td>
                  <td>' . $data->nama_ruangan . '</td>
                  <td>' . $data->nama_barang . '</td>
                  <td>' . $data->jumlah . '</td>
                  <td>' . $data->keterangan . '</td>
               </tr>';
}

$html .= '
            </tbody>
         </table>
         <br>
      <span>Jumlah Item ' . count($dataPengajuanDetail) . '</span>
      <div class="container">
         <div class="col-3" style="text-align: right;">
            <div class="text-right mt-5 mb-2">
               <span class="text-dark" style="word-wrap: break-word;">Bandung, ' . date('D, d M Y') . '</span>
            </div>
            <div class="text-right">
               <span class="text-dark" style="word-wrap: break-word;">Pejabat Pelaksana Teknis Kegiatan</span>
            </div>
            <div class="text-right">
               <span class="text-dark m-1"><b>' . $dataKegiatan->nama_kegiatan . '</b></span>
            </div>
            <div class="text-right mt-100">
               <span class="text-dark m-1"><u><b>' . $dataKegiatan->nama_pengaju . '</b></u></span>
            </div>
            <div class="text-right mb-5">
               <span class="text-dark m-1"><b>' . $dataKegiatan->nip_pengaju . '</b></span>
            </div>
         </div>
      </div>

</body>
</html>
';

$mpdf->WriteHTML($html);
$mpdf->Output('Cetak Pengajuan', 'I');
