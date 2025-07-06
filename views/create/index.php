<?php

use humhub\helpers\Html;
use humhub\modules\drawio\assets\Assets;
use humhub\widgets\modal\Modal;

Assets::register($this);
?>

<?php $form = Modal::beginFormDialog([
    'title' => Yii::t('DrawioModule.base', '<strong>Create</strong> draw.io diagram'),
    'footer' => Html::submitButton('Save', ['data-action-click' => 'drawio.createSubmit', 'data-ui-loader' => '', 'class' => 'btn btn-primary']),
]) ?>

    <?= $form->field($model, 'fileName', ['template' => '{label}<div class="input-group">{input}<div class="input-group-text">' . $ext . '</div></div>{hint}{error}']); ?>
    <?= $form->field($model, 'openFlag')->checkbox(); ?>

<?php Modal::endFormDialog()?>
