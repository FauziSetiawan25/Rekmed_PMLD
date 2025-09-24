<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class PasienRawatInapController extends Controller
{
    // index sudah ada
    public function actionIndex()
    {
        return $this->render('index');
    }

    // detail CPPT pasien
    public function actionCppt($id)
    {
        // Dummy data sementara, nanti bisa ambil dari database berdasarkan $id (No RM)
        $pasien = [
            'no_rm' => $id,
            'nama' => 'Pasien ' . $id,
            'tanggal_lahir' => '04-September-2025',
            'jenis_kelamin' => 'L',
        ];

        $cpptData = [];
        for ($i = 1; $i <= 26; $i++) {
            $cpptData[] = [
                'id' => $i,
                'tanggal' => date('d-M-Y H:i', strtotime("-$i days")),
                'profesi' => 'Dokter',
                'subjektif' => 'Keluhan ' . $i,
                'objektif' => 'Hasil pemeriksaan ' . $i,
                'asesmen' => 'Diagnosa ' . $i,
                'planning' => 'Selesai',
                'obat' => 'Paracetamol',
                'verifikator' => 'Dr. Ahmad',
            ];
        }

        return $this->render('cppt', [
            'pasien' => $pasien,
            'cpptData' => $cpptData,
        ]);
    }
}
