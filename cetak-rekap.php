<?php
require_once __DIR__ . '/vendor/autoload.php'; // Sesuaikan dengan path library mPDF
require __DIR__ . '/functions/functions.php';

$dataRekap = tampilData("SELECT tb_barang.*, tb_pengajuan_detail.* FROM tb_barang INNER JOIN tb_pengajuan_detail ON tb_pengajuan_detail.barang_id = tb_barang.id_barang GROUP BY tb_barang.id_barang;");
$no = 1;

$mpdf = new \Mpdf\Mpdf();
$html = '<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Cetak Rekap</title>
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
      <h1 align="center">Laporan Rekap Pengajuan Barang</h1>
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
foreach ($dataRekap as $data) {
    $html .= '
               <tr>
                  <td>' . $no++ . '</td>
                  <td>' . $data->nama_barang . '</td>
                  <td>' . $data->merk . '</td>
                  <td>' . $data->jumlah . '</td>
                  <td>' . $data->satuan . '</td>
               </tr>';
}

$html .= '
            </tbody>
         </table>
         <br>
      <span>Dicetak tanggal ' . date('d/m/Y') . '</span>

</body>
</html>
';

$mpdf->WriteHTML($html);
$mpdf->Output('Cetak Rekap', 'I');
