<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2017 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\drawio\filehandler;

use Yii;
use yii\helpers\Url;
use humhub\modules\file\handler\BaseFileHandler;
use humhub\modules\file\libs\FileHelper;

/**
 * Description of ViewHandler
 *
 * @author Luke
 */
class EditFileHandler extends BaseFileHandler
{

    /**
     * @inheritdoc
     */
    public function getLinkAttributes()
    {
        return [
            'label' => Yii::t('DrawioModule.base', 'Edit using draw.io'),
            'data-action-url' => Url::to(['/drawio/open', 'guid' => $this->file->guid]),
            'data-action-click' => 'ui.modal.load',
            'data-modal-id' => 'drawio-modal',
            'data-modal-close' => ''
        ];
    }

}
