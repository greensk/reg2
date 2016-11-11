<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<h1><?= htmlspecialchars($conference->title) ?></h1>
<div>
        Регистрация участников мероприятия.
</div>
<div class="row">
    <div class="col-lg-5">
        <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($member, 'first_name') ?>
            <?= $form->field($member, 'last_name') ?>
            <?= $form->field($member, 'phone') ?>
            <?= $form->field($member, 'email') ?>
            <div class="form-group">
                <?= Html::submitButton('<span class="glyphicon glyphicon-ok"></span> Регистрация', ['class' => 'btn']) ?>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
