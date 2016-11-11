<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<div class="row">
    <div class="col-lg-5">
        <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($conference, 'title')->textInput(['autofocus' => true]) ?>
            <?= $form->field($conference, 'location') ?>
            <?= $form->field($conference, 'enabled')->checkbox() ?>
            <?= $form->field($conference, 'start_date')->widget(\yii\jui\DatePicker::classname(), [
                'language' => 'ru',
                'dateFormat' => 'yyyy-MM-dd',
            ]) ?>
            <?= $form->field($conference, 'start_time')->textInput(['type' => 'time']) ?>
            <?= $form->field($conference, 'description')->textarea() ?>
            <div class="form-group">
                <?= Html::submitButton(
                    'Сохранить',
                    ['class' => 'btn btn-primary']
                ) ?>
                <?php if ($conference->id && $conference->getMembers()->count() == 0) {
                    echo Html::submitInput(
                        'Удалить',
                        ['class' => 'btn btn-primary', 'name' => 'delete']
                    );
                } ?>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
