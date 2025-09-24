<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ArrayDataProvider;

$this->title = 'Pasien Rawat Inap';
$this->params['breadcrumbs'][] = ['label' => 'Manajemen', 'url' => ['#']];
$this->params['breadcrumbs'][] = $this->title;

// Daftar nama ruangan/bed
$bedNames = ['Mawar', 'Melati', 'Anggrek', 'Kenanga', 'Tulip'];

// Daftar nama penanggung jawab
$penanggungNames = [
    'Budi Santoso',
    'Siti Aminah',
    'Joko Prasetyo',
    'Andi Wijaya',
    'Dewi Kartika',
    'Rahmat Hidayat',
    'Fitri Handayani',
    'Ahmad Fauzi',
    'Rina Wulandari',
    'Eko Saputra'
];

// Dummy data banyak (30 record biar pagination terlihat)
$data = [];
for ($i = 1; $i <= 30; $i++) {
    $bed = $bedNames[array_rand($bedNames)] . ' ' . str_pad(rand(1, 20), 2, '0', STR_PAD_LEFT);
    $penanggung = $penanggungNames[array_rand($penanggungNames)];
    $status = ($i % 3 == 0) ? 'Selesai' : (($i % 2 == 0) ? 'Diperiksa' : 'Antri');

    $data[] = [
        'mr' => '2892000' . str_pad($i, 2, '0', STR_PAD_LEFT),
        'nama' => 'Pasien ' . $i,
        'ruangan' => '04-September-2025',
        'bed' => $bed,
        'penanggung' => $penanggung,
        'status' => $status,
    ];
}

$dataProvider = new ArrayDataProvider([
    'allModels' => $data,
    'pagination' => [
        'pageSize' => 10, // tampil 10 baris per halaman
    ],
]);

?>

<div class="pasien-rawat-inap-index">
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>No Rekam Medis</th>
                    <th>Nama Pasien</th>
                    <th>Ruangan</th>
                    <th>No Bed</th>
                    <th>Nama Penanggung Jawab</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
                <!-- Row untuk filter (slicing manual) -->
                <tr>
                    <td></td>
                    <td><input type="text" class="form-control" placeholder=""></td>
                    <td><input type="text" class="form-control" placeholder=""></td>
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
                        <td><?= $model['mr'] ?></td>
                        <td><?= $model['nama'] ?></td>
                        <td><?= $model['ruangan'] ?></td>
                        <td><?= $model['bed'] ?></td>
                        <td><?= $model['penanggung'] ?></td>
                        <td><?= $model['status'] ?></td>
                        <td>
                            <td>
                         <?= Html::a('LIHAT CPPT', ['pasien-rawat-inap/cppt', 'id' => $model['mr']], [
                              'class' => 'btn btn-default',
                              'style' => 'width:100px'
                         ]) ?>
                         </td>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Pagination manual -->
        <div class="text-center">
            <?= \yii\widgets\LinkPager::widget([
                'pagination' => $dataProvider->pagination,
            ]) ?>
        </div>
    </div>
</div>
