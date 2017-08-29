<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2017 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\drawio\widgets;

use Yii;
use humhub\modules\file\models\File;
use yii\helpers\Url;
use humhub\libs\Html;
use humhub\modules\file\libs\FileHelper;
use humhub\widgets\JsWidget;

/**
 * Description of EditorWidget
 *
 * @author Luke
 */
class EditorWidget extends JsWidget
{

    /**
     * @var File the file
     */
    public $file;

    /**
     * @inheritdoc
     */
    public $jsWidget = 'drawio.Editor';

    /**
     * @inheritdoc
     */
    public $init = true;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function getData()
    {
        $user = Yii::$app->user->getIdentity();

        return [
            'file-name' => Html::encode($this->file->fileName),
            'file-extension' => Html::encode(strtolower(FileHelper::getExtension($this->file))),
            'file-content' => file_get_contents($this->file->store->get()),
            'file-save-url' => Url::to(['/drawio/open/update', 'guid' => $this->file->guid]),
            'user-guid' => ($user) ? Html::encode($user->guid) : '',
            'user-first-name' => ($user) ? Html::encode($user->profile->firstname) : 'Anonymous',
            'user-last-name' => ($user) ? Html::encode($user->profile->lastname) : 'User',
            'user-language' => ($user) ? $user->language : 'en',
        ];
    }

    /**
     * @inheritdoc
     */
    public function getAttributes()
    {
        return [
            'style' => 'height:100%;border-radius: 8px 8px 0px 0px;background-color:#F4F4F4'
        ];
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        $url = Yii::$app->getModule('drawio')->getServerUrl() . '/?embed=1&spin=1&proto=json&stealth=1&splash=0&ui=atlas';

        return $this->render('editor', [
                    'file' => $this->file,
                    'options' => $this->getOptions(),
                    'drawioUrl' => $url
        ]);
    }

}
