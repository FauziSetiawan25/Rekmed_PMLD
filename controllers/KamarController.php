<?php
namespace app\controllers;

use yii\web\Controller;

class KamarController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
