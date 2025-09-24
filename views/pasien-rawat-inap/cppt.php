<?php
use yii\helpers\Html;
use yii\data\ArrayDataProvider;
use yii\bootstrap\Modal;

$this->title = 'CATATAN PERKEMBANGAN PASIEN TERINTEGRASI (CPPT) RAWAT INAP';
$this->params['breadcrumbs'][] = ['label' => 'Manajemen', 'url' => ['#']];
$this->params['breadcrumbs'][] = ['label' => 'Pasien Rawat Inap', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'CPPT';

// Dummy data pasien
$pasien = [
    'no_rm' => '289200001',
    'tanggal_lahir' => '04-September-2025',
    'nama' => 'Pasien Dummy',
    'jenis_kelamin' => 'L',
];

// Dummy data perkembangan CPPT
$cpptData = [
    ['tanggal' => '24-09-2025 08:30', 'profesi' => 'Dokter', 'subjektif' => 'Pasien sadar, TD normal', 'planning' => 'Observasi 24 jam', 'obat' => 'Paracetamol', 'verifikator' => 'dr. Andi'],
    ['tanggal' => '24-09-2025 12:00', 'profesi' => 'Perawat', 'subjektif' => 'Obat diberikan sesuai resep', 'planning' => '-', 'obat' => 'Paracetamol', 'verifikator' => 'Suster Budi'],
];

$dataProvider = new ArrayDataProvider([
    'allModels' => $cpptData,
    'pagination' => [
        'pageSize' => 20,
    ],
]);

// CSS untuk button rounded
$this->registerCss("
    .table-header-custom {
        background-color: #f8f9fa;
        font-weight: bold;
        text-align: center;
    }

    .table-filter-custom input {
        border-radius: 5px;
        font-size: 12px;
        padding: 5px;
    }

    .btn-rounded {
        border-radius: 10px !important;
    }
");
?>

<div class="cppt-view">
    <div class="row" style="border:1px solid black; margin-bottom:20px;">
        <!-- Kolom kiri -->
        <div class="col-md-6" 
             style="font-size:18px; font-weight:bold; text-align:center; padding:20px;">
            CATATAN PERKEMBANGAN PASIEN TERINTEGRASI (CPPT)<br>RAWAT INAP
        </div>
        <!-- Kolom kanan -->
        <div class="col-md-6" style="padding:20px; border-left:1px solid black;">
            <p>No RM : <?= Html::encode($pasien['no_rm']) ?></p>
            <p>Tanggal Lahir : <?= Html::encode($pasien['tanggal_lahir']) ?></p>
            <p>Nama : <?= Html::encode($pasien['nama']) ?> (<?= $pasien['jenis_kelamin'] ?>)</p>
        </div>
    </div>

    <div class="text-right" style="margin-bottom:15px;">
        <?= Html::button('+ Tambah Perkembangan Pasien', [
            'class' => 'btn btn-primary btn-rounded',
            'data-toggle' => 'modal',
            'data-target' => '#cpptModal'
        ]) ?>
        <?= Html::button('Cetak CPPT', [
            'class' => 'btn btn-info btn-rounded',
            'onclick' => 'showPrintConfirmation()'
        ]) ?>
        <?= Html::a('Pasien Selesai', ['#'], ['class' => 'btn btn-danger btn-rounded']) ?>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr class="table-header-custom">
                    <th>#</th>
                    <th>Tanggal dan Jam</th>
                    <th>Profesi</th>
                    <th>Subjektif, Objektif, Asesmen</th>
                    <th>Planning</th>
                    <th>Obat</th>
                    <th>Verifikator Tanda Tangan</th>
                </tr>
                <!-- Row untuk filter -->
                <tr class="table-filter-custom">
                    <td></td>
                    <td><input type="text" class="form-control form-control-sm" placeholder="Filter Tanggal"></td>
                    <td><input type="text" class="form-control form-control-sm" placeholder="Filter Profesi"></td>
                    <td><input type="text" class="form-control form-control-sm" placeholder="Filter Subjektif"></td>
                    <td><input type="text" class="form-control form-control-sm" placeholder="Filter Planning"></td>
                    <td><input type="text" class="form-control form-control-sm" placeholder="Filter Obat"></td>
                    <td><input type="text" class="form-control form-control-sm" placeholder="Filter Verifikator"></td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dataProvider->getModels() as $index => $model): ?>
                    <tr>
                        <td><?= $dataProvider->pagination->offset + $index + 1 ?></td>
                        <td><?= Html::encode($model['tanggal']) ?></td>
                        <td><?= Html::encode($model['profesi']) ?></td>
                        <td><?= Html::encode($model['subjektif']) ?></td>
                        <td><?= Html::encode($model['planning']) ?></td>
                        <td><?= Html::encode($model['obat']) ?></td>
                        <td><?= Html::encode($model['verifikator']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="text-center">
            <?= \yii\widgets\LinkPager::widget([
                'pagination' => $dataProvider->pagination,
            ]) ?>
        </div>
    </div>
</div>

<?php
// Modal form input CPPT
Modal::begin([
    'id' => 'cpptModal',
    'header' => '<h4><b>Tambah Perkembangan CPPT</b></h4>',
]);
?>

<form id="form-cppt-dummy">
    <div class="form-group">
        <label>Profesi</label>
        <input type="text" id="profesi" class="form-control">
    </div>
    <div class="form-group">
        <label>Subjektif</label>
        <textarea id="subjektif" class="form-control"></textarea>
    </div>
    <div class="form-group">
        <label>Planning</label>
        <textarea id="planning" class="form-control"></textarea>
    </div>
    <div class="form-group">
        <label>Obat</label>
        <textarea id="obat" class="form-control"></textarea>
    </div>
    <div class="form-group">
        <label>Verifikator</label>
        <input type="text" id="verifikator" class="form-control">
    </div>

    <div class="form-group text-right">
        <?= Html::button('Batal', [
            'class' => 'btn btn-default btn-rounded',
            'data-dismiss' => 'modal'
        ]) ?>
        <?= Html::button('Simpan', [
            'class' => 'btn btn-danger btn-rounded',
            'id' => 'btnSaveCppt'
        ]) ?>
    </div>
</form>

<?php Modal::end(); ?>

<?php
$this->registerJs("
    // Simpan data CPPT
    $('#btnSaveCppt').on('click', function() {
        var profesi = $('#profesi').val();
        var subjektif = $('#subjektif').val();
        var planning = $('#planning').val();
        var obat = $('#obat').val();
        var verifikator = $('#verifikator').val();

        // Validasi sederhana
        if (!profesi || !subjektif || !planning || !obat || !verifikator) {
            Swal.fire({
                title: 'Penambahan Data CPPT Gagal!',
                text: 'Harap lengkapi semua field!',
                icon: 'error',
                confirmButtonText: 'OK',
                confirmButtonColor: 'red'
            });
            return;
        }

        // Simulasi penyimpanan data
        var isSuccess = true; // Ganti dengan hasil dari server

        if (isSuccess) {
            Swal.fire({
                title: 'Penambahan Data CPPT Berhasil!',
                icon: 'success',
                confirmButtonText: 'OK',
                confirmButtonColor: 'green'
            });

            // Reset form dan tutup modal
            $('#form-cppt-dummy')[0].reset();
            $('#cpptModal').modal('hide');
        } else {
            Swal.fire({
                title: 'Penambahan Data CPPT Gagal!',
                text: 'Terjadi kesalahan saat menyimpan data.',
                icon: 'error',
                confirmButtonText: 'OK',
                confirmButtonColor: 'red'
            });
        }
    });

    // Konfirmasi cetak CPPT
    function showPrintConfirmation() {
        Swal.fire({
            title: 'CETAK CPPT',
            text: 'Apakah Anda ingin mencetak Catatan Perkembangan Pasien Terintegrasi?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Cetak',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            customClass: {
                confirmButton: 'btn btn-info btn-rounded',
                cancelButton: 'btn btn-danger btn-rounded'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Simulasi hasil cetak
                var isSuccess = true; // Ganti dengan hasil dari server atau logika cetak

                if (isSuccess) {
                    Swal.fire({
                        title: 'Cetak CPPT Berhasil!',
                        icon: 'success',
                        confirmButtonText: 'OK',
                        confirmButtonColor: 'green',
                        customClass: {
                            confirmButton: 'btn btn-info btn-rounded'
                        }
                    });
                } else {
                    Swal.fire({
                        title: 'Cetak CPPT Gagal!',
                        text: 'Terjadi kesalahan saat mencetak.',
                        icon: 'error',
                        confirmButtonText: 'OK',
                        confirmButtonColor: 'red',
                        customClass: {
                            confirmButton: 'btn btn-danger btn-rounded'
                        }
                    });
                }
            }
        });
    }

    // Konfirmasi pasien selesai
    function showFinishConfirmation() {
        Swal.fire({
            title: 'Konfirmasi Pasien Selesai Rawat Inap',
            text: 'Apakah Anda ingin menyelesaikan masa rawat inap pasien?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            customClass: {
                confirmButton: 'btn btn-danger btn-rounded',
                cancelButton: 'btn btn-info btn-rounded'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Simulasi hasil penyelesaian pasien
                var isSuccess = true; // Ganti dengan hasil dari server atau logika penyelesaian

                if (isSuccess) {
                    Swal.fire({
                        title: 'Pasien Berhasil Selesai Rawat Inap!',
                        icon: 'success',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#3085d6',
                        customClass: {
                            confirmButton: 'btn btn-info btn-rounded'
                        }
                    });
                } else {
                    Swal.fire({
                        title: 'Pasien Gagal Selesai Rawat Inap!',
                        text: 'Terjadi kesalahan saat menyelesaikan masa rawat inap pasien.',
                        icon: 'error',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#d33',
                        customClass: {
                            confirmButton: 'btn btn-danger btn-rounded'
                        }
                    });
                }
            }
        });
    }

    // Bind tombol cetak CPPT
    $('.btn-info').on('click', function() {
        showPrintConfirmation();
    });

    // Bind tombol pasien selesai
    $('.btn-danger').on('click', function(e) {
        e.preventDefault(); // Mencegah aksi default tombol
        showFinishConfirmation();
    });
");
?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
