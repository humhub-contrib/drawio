<?php

namespace humhub\modules\drawio\models;

use Yii;

/**
 * ConfigureForm defines the configurable fields.

 */
class ConfigureForm extends \yii\base\Model
{

    public $serverUrl;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['serverUrl', 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'serverUrl' => Yii::t('DrawioModule.base', 'Hostname'),
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return [
            'serverUrl' => Yii::t('DrawioModule.base', 'e.g. https://draw.io'),
        ];
    }

    public function loadSettings()
    {
        $this->serverUrl = Yii::$app->getModule('drawio')->settings->get('serverUrl');

        return true;
    }

    public function save()
    {
        Yii::$app->getModule('drawio')->settings->set('serverUrl', $this->serverUrl);

        return true;
    }

}
