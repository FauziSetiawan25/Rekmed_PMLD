<?php
namespace app\controllers;

use yii\web\Controller;

class RuanganController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
