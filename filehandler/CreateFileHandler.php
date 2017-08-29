<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2017 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\drawio\filehandler;

use Yii;
use humhub\modules\file\handler\BaseFileHandler;
use yii\helpers\Url;

/**
 * Description of ViewHandler
 *
 * @author Luke
 */
class CreateFileHandler extends BaseFileHandler
{

    /**
     * @inheritdoc
     */
    public function getLinkAttributes()
    {
        return [
            'label' => Yii::t('DrawioModule.base', 'Create draw.io document'),
            'data-action-url' => Url::to(['/drawio/create']),
            'data-action-click' => 'ui.modal.load',
            'data-modal-id' => 'drawio-modal',
            'data-modal-close' => ''
        ];
    }

}
