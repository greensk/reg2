<?php Use \yii\helpers\Html; ?>
<div>
    Вы точно хотите удалить участника <?= htmlspecialchars($member->last_name) ?> <?= htmlspecialchars($member->first_name) ?>
    из списка конференции <?= htmlspecialchars($member->conference->title) ?>
</div>
<div>
    <?= Html::a('Отмена', ['members/index', 'id' => $member->conference_id]) ?>
    <?= Html::a('<span class="glyphicon glyphicon-remove"> Удалить', ['members/delete', 'id' => $member->id, 'confirm' => true], ['class' => 'btn btn-primary']) ?>
</div>
