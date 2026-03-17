<?php

use humhub\modules\drawio\models\ConfigureForm;
use humhub\widgets\bootstrap\Button;
use humhub\widgets\form\ActiveForm;

/* @var ConfigureForm $model */
?>
<div class="panel panel-default">
    <div class="panel-heading"><?= Yii::t('DrawioModule.base', '<strong>Draw.io </strong> module configuration') ?></div>
    <div class="panel-body">
        <?php $form = ActiveForm::begin(['id' => 'configure-form']) ?>
            <?= $form->field($model, 'serverUrl') ?>
            <?= Button::save()->submit() ?>
        <?php ActiveForm::end() ?>
    </div>
</div>
