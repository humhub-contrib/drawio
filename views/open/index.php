<?php

use humhub\components\View;
use humhub\modules\drawio\widgets\EditorWidget;
use humhub\modules\file\models\File;
use humhub\widgets\modal\Modal;

/**
 * @var $file File
 * @var $this View
 */

// Force modal full height
$this->registerCss('#drawio-modal .modal-content {height: calc(100vh - 45px);}');
?>

<?php Modal::beginDialog([
    'size' => Modal::SIZE_EXTRA_LARGE,
    'closeButton' => false,
]) ?>
    <?= EditorWidget::widget([
        'file' => $file,
    ]) ?>
<?php Modal::endDialog() ?>
