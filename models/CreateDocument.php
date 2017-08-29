<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2017 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\drawio\models;

use Yii;
use yii\base\Model;
use humhub\modules\drawio\Module;
use humhub\modules\file\models\File;

/**
 * Description of CreateDocument
 *
 * @author Luke
 */
class CreateDocument extends Model
{

    public $fileName;
    public $openFlag = true;

    public function rules()
    {
        return [
            ['fileName', 'required'],
            ['openFlag', 'boolean'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'openFlag' => Yii::t('DrawioModule.base', 'Open the new document in the next step')
        ];
    }

    public function save()
    {

        if ($this->validate()) {
            $file = new File();
            $file->file_name = $this->fileName . '.drawio';
            $file->size = 0;
            $file->mime_type = 'application/xml';
            $file->save();
            $file->store->setContent('');

            return $file;
        }

        return false;
    }

}
