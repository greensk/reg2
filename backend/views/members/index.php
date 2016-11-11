<?php
/* @file backend/views/conference/index.php */
/* @var $this yii\web\View */
Use \yii\helpers\Html;
$this->title = 'Список участников';
?>
<?php if (!$list) { ?>
    <div class="alert alert-warning" role="alert">Пока нет ни одного участника.</div>
<?php } else { ?>
    <h1><?= htmlspecialchars($conference->title) ?> — список участников</h1>
    <table class="table">
        <tr>
            <th>№</th>
            <th>Фамилия</th>
            <th>Имя</th>
            <th>E-mail</th>
            <th>Телефон</th>
            <th>Дата регистрации</th>
            <th></th>
        </tr>
        <?php foreach ($list as $member) { ?>
            <tr>
                <td><?= $member->id ?></td>
                <th><?= htmlspecialchars($member->last_name) ?></th>
                <th><?= htmlspecialchars($member->first_name) ?></th>
                <th><?= Html::a(htmlspecialchars($member->email), 'mailto:' . htmlspecialchars($member->email)) ?></th>
                <th><?= htmlspecialchars($member->phone) ?></th>
                <th><?= (new \DateTime($member->reg_date))->format('d.m.Y') ?></th>
                <th>
                    <div class="btn-group" role="group">
                        <?= Html::a('<span class="glyphicon glyphicon-edit"></span> Редактировать', ['members/edit', 'id' => $member->id], ['class' => 'btn btn-default']) ?>
                        <?= Html::a('<span class="glyphicon glyphicon-remove"></span> Удалить', ['members/delete', 'id' => $member->id], ['class' => 'btn btn-default']) ?>
                    </div>
                </th>
            </tr>
        <?php } ?>
    </table>
<?php } ?>
