<?php

use humhub\helpers\Html;
use humhub\modules\drawio\assets\Assets;

Assets::register($this);
?>

<?= Html::beginTag('div', $options) ?>
<iframe src="<?= $drawioUrl; ?>" id="drawIOFrame" width="100%" height="100%" frameborder="0" name="iframeContainer"></iframe>
<?= Html::endTag('div'); ?>
