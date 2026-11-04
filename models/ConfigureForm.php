<?php

namespace humhub\modules\drawio\models;

use Yii;
use yii\base\Model;

/**
 * ConfigureForm defines the configurable fields.

 */
class ConfigureForm extends Model
{
    public $serverUrl;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['serverUrl', 'trim'],
            ['serverUrl', 'filter', 'filter' => static fn($value) => rtrim((string) $value, '/')],
            ['serverUrl', 'url', 'validSchemes' => ['http', 'https']],
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
            'serverUrl' => Yii::t('DrawioModule.base', 'Diagram content is processed by this server. Use your own draw.io server to keep the data in-house.')
                . ' ' . Yii::t('DrawioModule.base', 'e.g. :drawioDefaultServerUrl', [':drawioDefaultServerUrl' => 'https://embed.diagrams.net']),
        ];
    }

    public function loadSettings()
    {
        $this->serverUrl = Yii::$app->getModule('drawio')->settings->get('serverUrl');

        return true;
    }

    public function save(): bool
    {
        if (!$this->validate()) {
            return false;
        }

        Yii::$app->getModule('drawio')->settings->set('serverUrl', $this->serverUrl);

        return true;
    }

}
