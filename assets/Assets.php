<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2017 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\drawio\assets;

use yii\web\AssetBundle;
use yii\web\View;

class Assets extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@drawio/resources';

    /**
     * @inheritdoc
     */
    public $js = ['humhub.drawio.js'];

    /**
     * @inheritdoc
     */
    public $jsOptions = ['position' => View::POS_BEGIN];

    /**
     * @inheritdoc
     */
    public $publishOptions = [
        'forceCopy' => false,
    ];
}
