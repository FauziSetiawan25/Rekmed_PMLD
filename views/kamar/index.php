<?php

use yii\helpers\Html;
use yii\data\ArrayDataProvider;
use yii\bootstrap\Modal;

$this->title = 'Manajemen Kamar';
$this->params['breadcrumbs'][] = ['label' => 'Manajemen', 'url' => ['#']];
$this->params['breadcrumbs'][] = $this->title;

// Dummy data kamar
$data = [
    [
        'no_kamar' => 'K001',
        'nama_ruangan' => 'Ruangan Mawar',
        'harga' => '500000',
        'status_ruangan' => 'Tersedia',
    ],
    [
        'no_kamar' => 'K002',
        'nama_ruangan' => 'Ruangan Melati',
        'harga' => '450000',
        'status_ruangan' => 'Penuh',
    ],
    [
        'no_kamar' => 'K003',
        'nama_ruangan' => 'Ruangan Anggrek',
        'harga' => '400000',
        'status_ruangan' => 'Tersedia',
    ],
    [
        'no_kamar' => 'K004',
        'nama_ruangan' => 'Ruangan Dahlia',
        'harga' => '550000',
        'status_ruangan' => 'Diperiksa',
    ],
    [
        'no_kamar' => 'K005',
        'nama_ruangan' => 'Ruangan Sakura',
        'harga' => '600000',
        'status_ruangan' => 'Antri',
    ],
];

$dataProvider = new ArrayDataProvider([
    'allModels' => $data,
    'pagination' => [
        'pageSize' => 10, // Menampilkan maksimal 10 data per halaman
    ],
]);

// CSS untuk styling header modal
$css = <<<CSS
.swal2-confirm, .swal2-cancel {
    border-radius: 10px !important; /* Membuat tombol rounded */
    padding: 10px 20px; /* Menyesuaikan ukuran tombol */
    font-size: 14px; /* Ukuran font */
}

.btn-rounded {
    border-radius: 10px !important;
}

.modal-header-custom {
    background-color: #f8f9fa;
    border-bottom: 2px solid #dee2e6;
    text-align: center;
    padding: 15px;
}

.modal-title-custom {
    font-weight: bold;
    font-size: 18px;
    margin: 0;
    color: #333;
    text-align: center;
    width: 100%;
}
CSS;

$this->registerCss($css);

// Modal untuk tambah kamar
Modal::begin([
    'id' => 'modal-tambah-kamar',
    'header' => '<h4 class="modal-title-custom">TAMBAH KAMAR RAWAT INAP</h4>',
    'headerOptions' => ['class' => 'modal-header-custom'],
    'size' => Modal::SIZE_DEFAULT,
    'options' => [
        'tabindex' => false // penting untuk select2
    ],
]);
?>
<div class="modal-body">
    <form id="form-tambah-kamar">
        <div class="form-group">
            <label for="no-kamar">No Kamar</label>
            <input type="text" class="form-control" id="no-kamar" placeholder="Masukkan nomor kamar">
        </div>
        <div class="form-group">
            <label for="nama-ruangan">Nama Ruangan</label>
            <input type="text" class="form-control" id="nama-ruangan" placeholder="Masukkan nama ruangan">
        </div>
        <div class="form-group">
            <label for="harga">Harga</label>
            <input type="text" class="form-control" id="harga" placeholder="Masukkan harga kamar">
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary btn-rounded" data-dismiss="modal">Batal</button>
    <button type="button" class="btn btn-primary btn-rounded" id="simpan-kamar">Simpan</button>
</div>
<?php
Modal::end();

// JavaScript untuk menangani modal tambah kamar
$js = <<<JS
// Buka modal saat tombol tambah kamar diklik
$('#btn-tambah-kamar').on('click', function() {
    $('#modal-tambah-kamar').modal('show');
});

// Simpan data kamar
$('#simpan-kamar').on('click', function() {
    var noKamar = $('#no-kamar').val();
    var namaRuangan = $('#nama-ruangan').val();
    var harga = $('#harga').val();
    
    // Validasi sederhana
    if (!noKamar || !namaRuangan || !harga) {
        Swal.fire({
            title: 'Penambahan Data Kamar Rawat Inap Gagal!',
            text: 'Harap lengkapi semua field!',
            icon: 'error',
            confirmButtonText: 'OK',
            confirmButtonColor: 'red'
        });
        return;
    }
    
    // Simulasi hasil penyimpanan data
    var isSuccess = true; // Ganti dengan hasil dari server
    if (isSuccess) {
        Swal.fire({
            title: 'Penambahan Data Kamar Rawat Inap Berhasil!',
            icon: 'success',
            confirmButtonText: 'OK',
            confirmButtonColor: 'green'
        });
        
        // Reset form dan tutup modal
        $('#form-tambah-kamar')[0].reset();
        $('#modal-tambah-kamar').modal('hide');
    } else {
        Swal.fire({
            title: 'Penambahan Data Kamar Rawat Inap Gagal!',
            text: 'Terjadi kesalahan saat menyimpan data.',
            icon: 'error',
            confirmButtonText: 'OK',
            confirmButtonColor: 'red'
        });
    }
});
JS;

$this->registerJs($js);

// Modal untuk edit kamar
Modal::begin([
    'id' => 'modal-edit-kamar',
    'header' => '<h4 class="modal-title-custom">EDIT KAMAR RAWAT INAP</h4>',
    'headerOptions' => ['class' => 'modal-header-custom'],
    'size' => Modal::SIZE_DEFAULT,
    'options' => [
        'tabindex' => false // penting untuk select2
    ],
]);
?>
<div class="modal-body">
    <form id="form-edit-kamar">
        <div class="form-group">
            <label for="edit-no-kamar">No Kamar</label>
            <input type="text" class="form-control" id="edit-no-kamar" placeholder="Masukkan nomor kamar">
        </div>
        <div class="form-group">
            <label for="edit-nama-ruangan">Nama Ruangan</label>
            <input type="text" class="form-control" id="edit-nama-ruangan" placeholder="Masukkan nama ruangan">
        </div>
        <div class="form-group">
            <label for="edit-harga">Harga</label>
            <input type="text" class="form-control" id="edit-harga" placeholder="Masukkan harga kamar">
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary btn-rounded" data-dismiss="modal">Batal</button>
    <button type="button" class="btn btn-primary btn-rounded" id="simpan-edit-kamar">Simpan</button>
</div>
<?php
Modal::end();
?>

<div class="kamar-index">
    <div class="text-right mb-3">
        <?= Html::button('+ Tambah Kamar', [
            'class' => 'btn btn-primary btn-rounded',
            'style' => 'margin-bottom: 10px;',
            'id' => 'btn-tambah-kamar'
        ]) ?>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>No Kamar</th>
                    <th>Nama Ruangan</th>
                    <th>Harga</th>
                    <th>Status Ruangan</th>
                    <th>Aksi</th>
                </tr>
                <!-- Row filter -->
                <tr>
                    <td></td>
                    <td><input type="text" class="form-control" placeholder="Filter No Kamar"></td>
                    <td><input type="text" class="form-control" placeholder="Filter Nama Ruangan"></td>
                    <td><input type="text" class="form-control" placeholder="Filter Harga"></td>
                    <td><input type="text" class="form-control" placeholder="Filter Status"></td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dataProvider->getModels() as $index => $model): ?>
                    <tr>
                        <td><?= $dataProvider->pagination->offset + $index + 1 ?></td>
                        <td><?= $model['no_kamar'] ?></td>
                        <td><?= $model['nama_ruangan'] ?></td>
                        <td><?= $model['harga'] ?></td>
                        <td><?= $model['status_ruangan'] ?></td>
                        <td>
                            <?= Html::a('<i class="fa fa-pencil"></i>', '#', [
                                'class' => 'btn btn-sm btn-default btn-edit-kamar btn-rounded',
                                'title' => 'Edit',
                                'data-no-kamar' => $model['no_kamar'],
                                'data-nama-ruangan' => $model['nama_ruangan'],
                                'data-harga' => $model['harga'],
                            ]) ?>
                            <?= Html::a('<i class="fa fa-trash"></i>', ['kamar/delete', 'id' => $model['no_kamar']], [
                                'class' => 'btn btn-sm btn-danger btn-rounded',
                                'title' => 'Delete',
                                'data-confirm' => 'Apakah Anda yakin ingin menghapus data ini?',
                                'data-method' => 'post'
                            ]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="text-center">
            <?= \yii\widgets\LinkPager::widget([
                'pagination' => $dataProvider->pagination,
            ]) ?>
        </div>
    </div>
</div>

<?php
$jsDelete = <<<JS
// Hapus Data Kamar
$('.btn-danger').on('click', function(e) {
    e.preventDefault(); // Mencegah aksi default tombol

    var url = $(this).attr('href'); // URL untuk menghapus data
    var row = $(this).closest('tr'); // Baris tabel yang akan dihapus

    // Tampilkan konfirmasi penghapusan
    Swal.fire({
        title: 'HAPUS KAMAR RAWAT INAP',
        text: 'Apakah Anda ingin menghapus data kamar rawat inap?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Batal',
        confirmButtonColor: 'red',
        cancelButtonColor: 'blue'
    }).then((result) => {
        if (result.isConfirmed) {
            // Simulasi penghapusan data
            var isSuccess = true; // Ganti dengan hasil dari server

            if (isSuccess) {
                Swal.fire({
                    title: 'Penghapusan Data Kamar Rawat Inap Berhasil!',
                    icon: 'success',
                    confirmButtonText: 'OK',
                    confirmButtonColor: 'green'
                }).then(() => {
                    // Hapus baris dari tabel
                    row.remove();
                });
            } else {
                Swal.fire({
                    title: 'Penghapusan Data Kamar Rawat Inap Gagal!',
                    text: 'Terjadi kesalahan saat menghapus data.',
                    icon: 'error',
                    confirmButtonText: 'OK',
                    confirmButtonColor: 'red'
                });
            }
        }
    });
});
JS;

$this->registerJs($jsDelete);

$jsEdit = <<<JS
// Buka modal edit saat tombol edit diklik
$('.btn-edit-kamar').on('click', function() {
    var noKamar = $(this).data('no-kamar');
    var namaRuangan = $(this).data('nama-ruangan');
    var harga = $(this).data('harga');

    // Isi form dengan data yang ada
    $('#edit-no-kamar').val(noKamar);
    $('#edit-nama-ruangan').val(namaRuangan);
    $('#edit-harga').val(harga);

    // Tampilkan modal
    $('#modal-edit-kamar').modal('show');
});

// Simpan perubahan data kamar
$('#simpan-edit-kamar').on('click', function() {
    var noKamar = $('#edit-no-kamar').val();
    var namaRuangan = $('#edit-nama-ruangan').val();
    var harga = $('#edit-harga').val();

    // Validasi sederhana
    if (!noKamar || !namaRuangan || !harga) {
        Swal.fire({
            title: 'Perubahan Data Kamar Rawat Inap Gagal!',
            text: 'Harap lengkapi semua field!',
            icon: 'error',
            confirmButtonText: 'OK',
            confirmButtonColor: 'red'
        });
        return;
    }

    // Simulasi hasil penyimpanan data
    var isSuccess = true; // Ganti dengan hasil dari server
    if (isSuccess) {
        Swal.fire({
            title: 'Perubahan Data Kamar Rawat Inap Berhasil!',
            icon: 'success',
            confirmButtonText: 'OK',
            confirmButtonColor: 'green'
        });

        // Reset form dan tutup modal
        $('#form-edit-kamar')[0].reset();
        $('#modal-edit-kamar').modal('hide');
    } else {
        Swal.fire({
            title: 'Perubahan Data Kamar Rawat Inap Gagal!',
            text: 'Terjadi kesalahan saat menyimpan data.',
            icon: 'error',
            confirmButtonText: 'OK',
            confirmButtonColor: 'red'
        });
    }
});
JS;

$this->registerJs($jsEdit);
?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>