<?php

use humhub\modules\drawio\assets\Assets;
use humhub\modules\drawio\models\CreateDocument;
use humhub\widgets\modal\Modal;
use humhub\widgets\modal\ModalButton;

/* @var CreateDocument $model */
/* @var string $ext */

Assets::register($this);
?>

<?php $form = Modal::beginFormDialog([
    'title' => Yii::t('DrawioModule.base', '<strong>Create</strong> draw.io diagram'),
    'footer' => ModalButton::save()->action('drawio.createSubmit'),
]) ?>

    <?= $form->field($model, 'fileName', ['template' => '{label}<div class="input-group">{input}<div class="input-group-text">' . $ext . '</div></div>{hint}{error}']); ?>
    <?= $form->field($model, 'openFlag')->checkbox(); ?>

<?php Modal::endFormDialog()?>
