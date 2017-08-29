<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2017 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\drawio\components;

use Yii;
use yii\web\HttpException;
use yii\helpers\Url;
use humhub\modules\file\models\File;
use humhub\components\Controller;

/**
 * Description of BaseFileController
 *
 * @author Luke
 */
class BaseFileController extends Controller
{

    /**
     * @var File
     */
    public $file;

    /**
     * @inheritdoc
     */
    public function init()
    {
        // Load File
        $this->file = File::findOne(['guid' => Yii::$app->request->get('guid')]);
        if ($this->file === null) {
            throw new HttpException(404, Yii::t('DrawioModule.base', 'Could not find requested file!'));
        }

        //TODO: Check extension

        if (!$this->file->canDelete()) {
            throw new HttpException(403, Yii::t('DrawioModule.base', 'File write access denied!'));
        }

        parent::init();
    }

}
