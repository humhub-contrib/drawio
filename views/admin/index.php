<?php

use humhub\widgets\form\ActiveForm;
use yii\helpers\Html;

?>

<div class="panel panel-default">

    <div class="panel-heading"><?= Yii::t('DrawioModule.base', '<strong>Draw.io </strong> module configuration'); ?></div>

    <div class="panel-body">

        <?php $form = ActiveForm::begin(['id' => 'configure-form']); ?>
        <div class="mb-3">
            <?= $form->field($model, 'serverUrl'); ?>
        </div>

        <div class="mb-3">
            <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'data-ui-loader' => '']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
