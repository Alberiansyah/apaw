<?php

require __DIR__ . '/functions/functions.php';
require __DIR__ . '/functions/session-check.php';

$idKegiatan = $_GET['id_kegiatan'];
$dataKegiatan = tampilDataFirst("SELECT tb_kegiatan.*, tb_pengajuan.* FROM tb_kegiatan LEFT JOIN tb_pengajuan ON tb_pengajuan.kegiatan_id = tb_kegiatan.id_kegiatan WHERE id_kegiatan = '$idKegiatan'");
$dataUser = tampilData("SELECT * FROM tb_user");
$dataTeknisi = tampilData("SELECT * FROM tb_teknisi");
$dataRuangan = tampilData("SELECT * FROM tb_ruangan");
$dataBagian = tampilData("SELECT * FROM tb_bagian");
$dataBarang = tampilData("SELECT * FROM tb_barang");
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
                <li class="breadcrumb-item active"><a href="pengajuan">Pengajuan</a></li>
            </ol>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Data Kegiatan</h4>
                    </div>
                    <form method="POST" id="postPengajuan" action="">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="nama_kegiatan" class="">Nama Kegiatan</label>
                                        <input type="hidden" class="form-control date" name="kegiatan_id" value="<?= $dataKegiatan->id_kegiatan ?>">
                                        <textarea style="cursor: not-allowed;" id="nama_kegiatan" class="form-control" rows="1" disabled><?= $dataKegiatan->nama_kegiatan ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama_pengaju" class="">Nama Pengaju</label>
                                        <select id="nama_pengaju" class="single-select" name="nama_pengaju">
                                            <?php foreach ($dataUser as $data) : ?>
                                                <?php if ($data->role_id == 1 || $data->role_id == 3) : ?>
                                                    <option value="<?= $data->nama_lengkap ?>"><?= $data->nama_lengkap ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="nip_pengaju" class="">NIP Pengaju</label>
                                        <input type="text" class="form-control" name="nip_pengaju" id="nip_pengaju">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="bagian_id" class="">Nama Bagian</label>
                                        <select id="bagian_id" class="single-select" name="bagian_id">
                                            <?php foreach ($dataBagian as $data) : ?>
                                                <option value="<?= $data->id_bagian ?>"><?= $data->nama_bagian ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="teknisi_id" class="">Nama Teknisi</label>
                                        <select id="single-select" class="form-control" name="teknisi_id">
                                            <?php foreach ($dataTeknisi as $data) : ?>
                                                <option value="<?= $data->id_teknisi ?>"><?= $data->nama_teknisi ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="tanggal" class="">Tanggal</label>
                                        <input type="text" class="form-control date" name="tanggal" id="tanggal">
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center mt-3">
                                <h4>Detail Pengajuan</h4><br>
                            </div>
                            <table class="table tableDetail">
                                <thead>
                                    <tr>
                                        <th>Ruangan</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="form-group">
                                                <select id="" class="form-control" name="ruangan_id[]">
                                                    <?php foreach ($dataRuangan as $data) : ?>
                                                        <option value="<?= $data->id_ruangan ?>"><?= $data->nama_ruangan ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <select id="" class="form-control" name="barang_id[]">
                                                    <?php foreach ($dataBarang as $data) : ?>
                                                        <option value="<?= $data->id_barang ?>"><?= $data->nama_barang ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="number" min="1" class="form-control" id="jumlah" name="jumlah[]" value="1">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <textarea id="keterangan" name="keterangan[]" class="form-control"></textarea>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <button type="button" class="btn btn-xs btn-primary" id="tambahRow"><i class="fa fa-plus"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <button type="button" class="btn btn-primary" id="tambahPengajuan">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/wp-layouts/footer.php'; ?>
<script>
    $(document).ready(function() {
        let transaksi = $("#transaksi");
        transaksi.addClass("mm-active")
        transaksi.find("ul").addClass("mm-show")
        transaksi.find("ul li").addClass("mm-active")
        transaksi.find("ul li a:eq(1)").addClass("mm-active")
    });
</script>

<script>
    $(document).ready(function() {
        $('#tambahRow').click(function() {
            var original = $('table.tableDetail tbody tr').first();
            var clone = $('table.tableDetail tbody tr').first().clone();
            clone.find('input').val(1);
            clone.find('textarea').val();
            clone.find('#tambahRow').attr('id', 'deleteRow').removeClass('btn-primary').addClass('btn-danger').html('<i class="fa fa-trash"></i>');
            $('table.tableDetail tbody').append(clone);

            // Inisialisasi Select2 pada elemen select yang baru diklon
            // original.find('select').select2();
            // clone.find('select').select2();
        });

        $('table.tableDetail').on('click', '#deleteRow', function() {
            $(this).closest('tr').remove();
        });
    });
</script>

<script>
    $(document).on("click", "#tambahPengajuan", function() {
        let form = $('#postPengajuan').serialize();
        $.ajax({
            url: "functions/tambah-data-pengajuan",
            data: form,
            type: 'POST',
            success: function(response) {
                if (response.status) {
                    toastr.success(response.message);

                    setTimeout(function() {
                        window.location.href =
                            "pengajuan";
                    }, 1500);
                } else {
                    toastr.error(response.message);
                }
            },
            error: function(response) {
                toastr.error(response.message);
            }
        });
    });
</script>


</body>

</html>