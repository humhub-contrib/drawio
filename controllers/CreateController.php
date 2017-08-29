<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2017 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\drawio\controllers;

use Yii;
use yii\web\HttpException;
use yii\helpers\Url;
use humhub\modules\file\libs\FileHelper;

class CreateController extends \humhub\components\Controller
{

    public function actionIndex()
    {
        $ext = 'drawio';

        $model = new \humhub\modules\drawio\models\CreateDocument();
        if ($model->load(Yii::$app->request->post())) {
            $file = $model->save();
            if ($file !== false) {
                return $this->asJson([
                            'success' => true,
                            'file' => FileHelper::getFileInfos($file),
                            'openUrl' => Url::to(['/drawio/open', 'guid' => $file->guid]),
                            'openFlag' => (boolean) $model->openFlag
                ]);
            } else {
                return $this->asJson([
                            'success' => false,
                            'output' => $this->renderAjax('index', ['model' => $model, 'ext' => $ext])
                ]);
            }
        }

        return $this->renderAjax('index', ['model' => $model, 'ext' => $ext]);
    }

}
