<?php

use yii\helpers\Html;
use yii\data\ArrayDataProvider;
use yii\bootstrap\Modal;

$this->title = 'Manajemen Ruangan';
$this->params['breadcrumbs'][] = ['label' => 'Manajemen', 'url' => ['#']];
$this->params['breadcrumbs'][] = $this->title;

// Dummy data ruangan
$data = [
    [
        'id' => '289200001',
        'nama' => 'Ruangan Mawar',
        'kuota' => '10 Bed',
        'status' => 'Tersedia',
    ],
    [
        'id' => '289200002',
        'nama' => 'Ruangan Melati',
        'kuota' => '8 Bed',
        'status' => 'Penuh',
    ],
    [
        'id' => '289200003',
        'nama' => 'Ruangan Anggrek',
        'kuota' => '5 Bed',
        'status' => 'Tersedia',
    ],
    [
        'id' => '289200004',
        'nama' => 'Ruangan Dahlia',
        'kuota' => '7 Bed',
        'status' => 'Diperiksa',
    ],
    [
        'id' => '289200005',
        'nama' => 'Ruangan Sakura',
        'kuota' => '6 Bed',
        'status' => 'Antri',
    ],
    [
        'id' => '289200006',
        'nama' => 'Ruangan Teratai',
        'kuota' => '9 Bed',
        'status' => 'Tersedia',
    ],
    [
        'id' => '289200007',
        'nama' => 'Ruangan Kamboja',
        'kuota' => '4 Bed',
        'status' => 'Penuh',
    ],
    [
        'id' => '289200008',
        'nama' => 'Ruangan Kenanga',
        'kuota' => '10 Bed',
        'status' => 'Diperiksa',
    ],
    [
        'id' => '289200009',
        'nama' => 'Ruangan Tulip',
        'kuota' => '6 Bed',
        'status' => 'Antri',
    ],
    [
        'id' => '289200010',
        'nama' => 'Ruangan Lavender',
        'kuota' => '8 Bed',
        'status' => 'Tersedia',
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

// Modal untuk tambah ruangan
Modal::begin([
    'id' => 'modal-tambah-ruangan',
    'header' => '<h4 class="modal-title-custom">TAMBAH RUANGAN RAWAT INAP</h4>',
    'headerOptions' => ['class' => 'modal-header-custom'],
    'size' => Modal::SIZE_DEFAULT,
    'options' => [
        'tabindex' => false // penting untuk select2
    ],
]);
?>
<div class="modal-body">
    <form id="form-tambah-ruangan">
        <div class="form-group">
            <label for="nama-ruangan">Nama Ruangan</label>
            <input type="text" class="form-control" id="nama-ruangan" placeholder="Masukkan nama ruangan">
        </div>
        <div class="form-group">
            <label for="kuota-bed">Kuota Bed</label>
            <input type="text" class="form-control" id="kuota-bed" placeholder="Masukkan nama bed">
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary btn-rounded" data-dismiss="modal">Batal</button>
    <button type="button" class="btn btn-primary btn-rounded" id="simpan-ruangan">Simpan</button>
</div>
<?php
Modal::end();

// JavaScript untuk menangani modal
$js = <<<JS
// Buka modal saat tombol tambah ruangan diklik
$('#btn-tambah-ruangan').on('click', function() {
    $('#modal-tambah-ruangan').modal('show');
});

// Simpan data ruangan
$('#simpan-ruangan').on('click', function() {
    var namaRuangan = $('#nama-ruangan').val();
    var kuotaBed = $('#kuota-bed').val();
    
    // Validasi sederhana
    if (!namaRuangan || !kuotaBed) {
        Swal.fire({
            title: 'Penambahan Data Ruangan Rawat Inap Gagal!',
            text: 'Harap lengkapi semua field!',
            icon: 'error',
            confirmButtonText: 'OK',
            confirmButtonColor: 'red'
        });
        return;
    }
    
    // Di sini Anda bisa menambahkan kode untuk menyimpan data ke server
    var isSuccess = true; // Simulasi hasil penyimpanan data
    if (isSuccess) {
        Swal.fire({
            title: 'Penambahan Data Ruangan Rawat Inap Berhasil!',
            icon: 'success',
            confirmButtonText: 'OK',
            confirmButtonColor: 'green'
        });
        
        // Reset form dan tutup modal
        $('#form-tambah-ruangan')[0].reset();
        $('#modal-tambah-ruangan').modal('hide');
    } else {
        Swal.fire({
            title: 'Penambahan Data Ruangan Rawat Inap Gagal!',
            text: 'Terjadi kesalahan saat menyimpan data.',
            icon: 'error',
            confirmButtonText: 'OK',
            confirmButtonColor: 'red'
        });
    }
});
JS;

$this->registerJs($js);

// Modal untuk edit ruangan
Modal::begin([
    'id' => 'modal-edit-ruangan',
    'header' => '<h4 class="modal-title-custom">EDIT RUANGAN RAWAT INAP</h4>',
    'headerOptions' => ['class' => 'modal-header-custom'],
    'size' => Modal::SIZE_DEFAULT,
    'options' => [
        'tabindex' => false // penting untuk select2
    ],
]);
?>
<div class="modal-body">
    <form id="form-edit-ruangan">
        <div class="form-group">
            <label for="edit-nama-ruangan">Nama Ruangan</label>
            <input type="text" class="form-control" id="edit-nama-ruangan" placeholder="Masukkan nama ruangan">
        </div>
        <div class="form-group">
            <label for="edit-kuota-bed">Kuota Bed</label>
            <input type="text" class="form-control" id="edit-kuota-bed" placeholder="Masukkan kuota bed">
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary btn-rounded" data-dismiss="modal">Batal</button>
    <button type="button" class="btn btn-primary btn-rounded" id="simpan-edit-kamar">Simpan</button>
</div>
<?php
Modal::end();

// JavaScript untuk menangani modal edit
$jsEdit = <<<JS
// Buka modal edit saat tombol edit diklik
$('.btn-edit-ruangan').on('click', function() {
    var id = $(this).data('id');
    var nama = $(this).data('nama');
    var kuota = $(this).data('kuota');

    // Isi form dengan data yang ada
    $('#edit-nama-ruangan').val(nama);
    $('#edit-kuota-bed').val(kuota);

    // Simpan ID ruangan di atribut data
    $('#simpan-edit-kamar').data('id', id);

    // Tampilkan modal
    $('#modal-edit-ruangan').modal('show');
});

// Simpan perubahan data ruangan
$('#simpan-edit-kamar').on('click', function() {
    var id = $(this).data('id');
    var namaRuangan = $('#edit-nama-ruangan').val();
    var kuotaBed = $('#edit-kuota-bed').val();

    // Validasi sederhana
    if (!namaRuangan || !kuotaBed) {
        Swal.fire({
            title: 'Perubahan Data Ruangan Rawat Inap Gagal!',
            text: 'Harap lengkapi semua field!',
            icon: 'error',
            confirmButtonText: 'OK',
            confirmButtonColor: 'red'
        });
        return;
    }

    // Di sini Anda bisa menambahkan kode untuk menyimpan data ke server
    var isSuccess = true; // Simulasi hasil penyimpanan data
    if (isSuccess) {
        Swal.fire({
            title: 'Perubahan Data Ruangan Rawat Inap Berhasil!',
            icon: 'success',
            confirmButtonText: 'OK',
            confirmButtonColor: 'green'
        });

        // Reset form dan tutup modal
        $('#form-edit-ruangan')[0].reset();
        $('#modal-edit-ruangan').modal('hide');
    } else {
        Swal.fire({
            title: 'Perubahan Data Ruangan Rawat Inap Gagal!',
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

<div class="ruangan-index">
    <div class="text-right mb-3">
        <?= Html::button('+ Tambah Ruangan', [
            'class' => 'btn btn-primary btn-rounded',
            'style' => 'margin-bottom: 10px;',
            'id' => 'btn-tambah-ruangan'
        ]) ?>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Id Ruangan</th>
                    <th>Nama Ruangan</th>
                    <th>Kuota Bed</th>
                    <th>Status Ruangan</th>
                    <th>Aksi</th>
                </tr>
                <!-- Row filter -->
                <tr>
                    <td></td>
                    <td><input type="text" class="form-control" placeholder=""></td>
                    <td><input type="text" class="form-control" placeholder=""></td>
                    <td><input type="text" class="form-control" placeholder=""></td>
                    <td><input type="text" class="form-control" placeholder=""></td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dataProvider->getModels() as $index => $model): ?>
                    <tr>
                        <td><?= $dataProvider->pagination->offset + $index + 1 ?></td>
                        <td><?= $model['id'] ?></td>
                        <td><?= $model['nama'] ?></td>
                        <td><?= $model['kuota'] ?></td>
                        <td><?= $model['status'] ?></td>
                        <td>
                            <?= Html::a('<i class="fa fa-pencil"></i>', '#', [
                                'class' => 'btn btn-sm btn-default btn-edit-ruangan btn-rounded',
                                'title' => 'Edit',
                                'data-id' => $model['id'],
                                'data-nama' => $model['nama'],
                                'data-kuota' => $model['kuota'],
                            ]) ?>
                            <?= Html::a('<i class="fa fa-trash"></i>', ['ruangan/delete', 'id' => $model['id']], [
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
// Hapus data ruangan
$('.btn-danger').on('click', function(e) {
    e.preventDefault(); // Mencegah aksi default tombol

    var url = $(this).attr('href'); // URL untuk menghapus data
    var row = $(this).closest('tr'); // Baris tabel yang akan dihapus

    // Tampilkan konfirmasi penghapusan
    Swal.fire({
        title: 'HAPUS RUANGAN RAWAT INAP',
        text: 'Apakah Anda ingin menghapus data ruangan rawat inap?',
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
                    title: 'Penghapusan Data Ruangan Rawat Inap Berhasil!',
                    icon: 'success',
                    confirmButtonText: 'OK',
                    confirmButtonColor: 'green'
                }).then(() => {
                    // Hapus baris dari tabel
                    row.remove();
                });
            } else {
                Swal.fire({
                    title: 'Penghapusan Data Ruangan Rawat Inap Gagal!',
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