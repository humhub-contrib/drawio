<?php

use humhub\components\View;
use humhub\helpers\Html;
use humhub\modules\drawio\assets\Assets;

/* @var $this View */
/* @var $options array */
/* @var $drawioUrl string */

Assets::register($this);
?>
<?= Html::beginTag('div', $options) ?>
<iframe src="<?= Html::encode($drawioUrl) ?>" id="drawIOFrame" width="100%" height="100%" frameborder="0" name="iframeContainer"></iframe>
<?= Html::endTag('div'); ?>
