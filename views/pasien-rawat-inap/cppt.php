<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ArrayDataProvider;
use yii\bootstrap\Modal;
use yii\widgets\ActiveForm;

$this->title = 'CATATAN PERKEMBANGAN PASIEN TERINTEGRASI (CPPT) RAWAT INAP';
$this->params['breadcrumbs'][] = ['label' => 'Manajemen', 'url' => ['#']];
$this->params['breadcrumbs'][] = ['label' => 'Pasien Rawat Inap', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'CPPT';

// Dummy data pasien
$pasien = [
    'no_rm' => 'RM001234',
    'tanggal_lahir' => '1990-02-14',
    'nama' => 'Budi Santoso',
    'jenis_kelamin' => 'L',
];

// Dummy data CPPT
$cpptData = [
    [
        'tanggal' => '2025-09-24 08:15',
        'profesi' => 'Dokter',
        'subjektif' => 'Keluhan pusing sejak kemarin',
        'planning' => 'Observasi + cairan infus',
        'obat' => 'Paracetamol 500mg',
        'verifikator' => 'dr. Sinta',
    ],
    [
        'tanggal' => '2025-09-24 13:45',
        'profesi' => 'Perawat',
        'subjektif' => 'Pasien tampak lemas',
        'planning' => 'Monitoring tekanan darah',
        'obat' => '-',
        'verifikator' => 'Ns. Andi',
    ],
];

$dataProvider = new ArrayDataProvider([
    'allModels' => $cpptData,
    'pagination' => [
        'pageSize' => 20,
    ],
]);

// CSS untuk button rounded dan modal custom
$this->registerCss("
    .btn-rounded {
        border-radius: 10px !important;
    }
    .modal-confirm {
        text-align: center;
    }
    .modal-confirm .modal-header {
        border-bottom: none;
        padding-bottom: 0;
    }
    .modal-confirm .modal-body {
        padding-top: 0;
    }
    .modal-confirm .btn-container {
        margin-top: 20px;
    }
    .modal-confirm .btn-modal {
        margin: 0 5px;
        min-width: 80px;
    }
");

// JavaScript untuk modal cetak
$this->registerJs("
    function showPrintConfirmation() {
        $('#printConfirmationModal').modal('show');
    }
    
    function processPrint() {
        // Simulasi proses cetak
        $('#printConfirmationModal').modal('hide');
        
        // Tampilkan modal hasil (berhasil/gagal)
        setTimeout(function() {
            // Untuk simulasi, kita asumsikan berhasil
            // Ganti dengan $('#printFailedModal').modal('show'); untuk simulasi gagal
            $('#printSuccessModal').modal('show');
        }, 500);
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

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'tanggal',
                'label' => 'Tanggal dan Jam',
            ],
            'profesi',
            [
                'attribute' => 'subjektif',
                'label' => 'Subjektif, Objektif, Asesmen',
            ],
            'planning',
            'obat',
            [
                'attribute' => 'verifikator',
                'label' => 'Verifikator Tanda Tangan',
            ],
        ],
    ]); ?>
</div>

<?php
// Modal Tambah CPPT
Modal::begin([
    'id' => 'cpptModal',
    'header' => '<h4><b>Tambah Perkembangan CPPT (Dummy)</b></h4>',
]);
?>

<form id="form-cppt-dummy">
    <div class="form-group">
        <label>Profesi</label>
        <input type="text" class="form-control" placeholder="Contoh: Dokter / Perawat">
    </div>
    <div class="form-group">
        <label>Subjektif / Objektif / Asesmen</label>
        <textarea class="form-control" rows="3"></textarea>
    </div>
    <div class="form-group">
        <label>Planning</label>
        <textarea class="form-control" rows="2"></textarea>
    </div>
    <div class="form-group">
        <label>Obat</label>
        <textarea class="form-control" rows="2"></textarea>
    </div>
    <div class="form-group">
        <label>Verifikator</label>
        <input type="text" class="form-control" placeholder="Nama verifikator">
    </div>

    <div class="form-group text-right">
        <button type="button" class="btn btn-default btn-rounded" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-danger btn-rounded" data-dismiss="modal">Simpan (Dummy)</button>
    </div>
</form>

<?php Modal::end(); ?>

<?php
// Modal Konfirmasi Cetak
Modal::begin([
    'id' => 'printConfirmationModal',
    'header' => false,
    'options' => ['class' => 'modal-confirm']
]);
?>

<div style="padding: 20px;">
    <h4><b>Konfirmasi Cetak ...</b></h4>
    <div class="modal-body">
        <p style="margin-bottom: 10px;"><b>Apakah Anda Ingin Mencetak</b></p>
        <p style="margin-bottom: 20px;">Catatan Perkembangan Pasien Terintegrasi ?</p>
        
        <div class="btn-container">
            <?= Html::button('Batal', [
                'class' => 'btn btn-default btn-rounded btn-modal',
                'data-dismiss' => 'modal'
            ]) ?>
            <?= Html::button('Cetak', [
                'class' => 'btn btn-info btn-rounded btn-modal',
                'onclick' => 'processPrint()'
            ]) ?>
        </div>
    </div>
</div>

<?php Modal::end(); ?>

<?php
// Modal Cetak Berhasil
Modal::begin([
    'id' => 'printSuccessModal',
    'header' => false,
    'options' => ['class' => 'modal-confirm']
]);
?>

<div style="padding: 20px;">
    <h4><b>Konfirmasi Cetak ...</b></h4>
    <div class="modal-body">
        <p style="color: green; font-weight: bold; margin: 20px 0;">Cetak CPPT Berhasil !</p>
        
        <div class="btn-container">
            <?= Html::button('OK', [
                'class' => 'btn btn-info btn-rounded btn-modal',
                'data-dismiss' => 'modal'
            ]) ?>
        </div>
    </div>
</div>

<?php Modal::end(); ?>

<?php
// Modal Cetak Gagal
Modal::begin([
    'id' => 'printFailedModal',
    'header' => false,
    'options' => ['class' => 'modal-confirm']
]);
?>

<div style="padding: 20px;">
    <h4><b>Konfirmasi Cetak ...</b></h4>
    <div class="modal-body">
        <p style="color: red; font-weight: bold; margin: 20px 0;">Cetak CPPT Gagal !</p>
        
        <div class="btn-container">
            <?= Html::button('OK', [
                'class' => 'btn btn-info btn-rounded btn-modal',
                'data-dismiss' => 'modal'
            ]) ?>
        </div>
    </div>
</div>

<?php Modal::end(); ?>