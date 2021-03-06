<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class ODataController extends Controller
{

    public function actionIndex()
    {
        // Delegate handling of request to ODataController of Yii2PODataAdapter
        return yii::$app->runAction('o-data-adapter', [
            'metaProviderClassName' => 'app\\models\\OData\\MetadataProvider',
            'queryProviderMap' => '@vendor/qeti/yii2-podata-adapter/implementation/QueryProvider.php',
        ]);
    }

}
