<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2017 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\drawio\controllers;

use Yii;
use humhub\modules\drawio\components\BaseFileController;

class OpenController extends BaseFileController
{
    public function actionIndex()
    {
        return $this->renderAjax('index', [
            'file' => $this->file,
        ]);
    }

    public function actionUpdate()
    {
        Yii::$app->response->format = 'json';
        $this->forcePostRequest();
        $fileContent = Yii::$app->request->post('content');
        $this->file->store->setContent($fileContent);
        $this->file->size = strlen($fileContent);
        $this->file->save();

        return [
            'ok' => true,
        ];
    }

}
