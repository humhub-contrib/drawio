<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2017 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\drawio\models;

use humhub\modules\file\models\File;
use Yii;
use yii\base\Model;

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
            ['fileName', 'trim'],
            ['fileName', 'string', 'max' => 240],
            ['fileName', 'match', 'pattern' => '#^[^/\\\\]+$#'],
            ['openFlag', 'boolean'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'openFlag' => Yii::t('DrawioModule.base', 'Open the new document in the next step'),
        ];
    }

    /**
     * Creates a new empty draw.io file.
     *
     * @return File|null the created file or null on validation/save error
     */
    public function createFile(): ?File
    {
        if (!$this->validate()) {
            return null;
        }

        $file = new File();
        $file->file_name = $this->fileName . '.drawio';
        $file->size = 0;
        $file->mime_type = 'application/xml';

        if (!$file->save()) {
            $this->addError('fileName', Yii::t('DrawioModule.base', 'Could not create the file!'));

            return null;
        }

        $file->store->setContent('');

        return $file;
    }

}
