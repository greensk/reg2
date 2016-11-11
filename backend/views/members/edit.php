<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<div>
    Изменение данных участника.
</div>
<div class="row">
    <div class="col-lg-5">
        <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($member, 'first_name') ?>
            <?= $form->field($member, 'last_name') ?>
            <?= $form->field($member, 'phone') ?>
            <?= $form->field($member, 'email') ?>
            <div class="form-group">
                <?= Html::submitButton('<span class="glyphicon glyphicon-ok"></span> Сохранить', ['class' => 'btn']) ?>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
