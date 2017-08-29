<?php

use humhub\modules\file\handler\FileHandlerCollection;

return [
    'id' => 'drawio',
    'class' => 'humhub\modules\drawio\Module',
    'namespace' => 'humhub\modules\drawio',
    'events' => [
        [FileHandlerCollection::className(), FileHandlerCollection::EVENT_INIT, ['humhub\modules\drawio\Events', 'onFileHandlerCollection']],
    ]
];
?>