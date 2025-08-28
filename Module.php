<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2017 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\drawio;

use yii\helpers\Url;

/**
 * File Module
 *
 * @since 0.5
 */
class Module extends \humhub\components\Module
{
    /**
     * @inheritdoc
     */
    public function getConfigUrl()
    {
        return Url::to([
            '/drawio/admin',
        ]);
    }

    public function getServerUrl()
    {
        $url = $this->settings->get('serverUrl');
        if (empty($url)) {
            return 'https://embed.diagrams.net';
        }

        return $url;
    }

    public function getExtensions()
    {
        return ['xml', 'drawio'];
    }

}
