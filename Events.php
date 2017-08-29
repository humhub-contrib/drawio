<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2017 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\drawio;

use Yii;
use humhub\modules\file\handler\FileHandlerCollection;
use humhub\modules\file\libs\FileHelper;

/**
 * @author luke
 */
class Events extends \yii\base\Object
{

    public static function onFileHandlerCollection($event)
    {
        /* @var $collection FileHandlerCollection */
        $collection = $event->sender;

        if ($collection->type === FileHandlerCollection::TYPE_CREATE) {
            $collection->register(new filehandler\CreateFileHandler());
            return;
        }

        /* @var $module \humhub\modules\drawio\Module */
        $module = Yii::$app->getModule('drawio');

        if ($collection->file === null)  {
            return;
        }

        $extension = FileHelper::getExtension($collection->file->file_name);
        if (!in_array($extension, $module->getExtensions())) {
            return;
        }

        if ($collection->type == FileHandlerCollection::TYPE_EDIT) {
            $collection->register(new filehandler\EditFileHandler());
        }
    }

}
