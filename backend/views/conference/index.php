<?php
/* @file backend/views/conference/index.php */
/* @var $this yii\web\View */
Use \yii\helpers\Html;
$this->title = 'Список конференций';
?>
<?php if (!$list) { ?>
    <div class="alert alert-warning" role="alert">Пока нет ни одной конференции <?= Html::a('Добавить', ['conference/add']) ?>.</div>
<?php } else { ?>
    <table class="table">
        <tr>
            <th>№</th>
            <th>Название конференции</th>
            <th>Место проведения</th>
            <th>Дата</th>
            <th>Кол-во записавшихся</th>
            <th></th>
        </tr>
        <?php foreach ($list as $conference) { ?>
            <tr>
                <td><?= $conference->id ?></td>
                <td><?= htmlspecialchars($conference->title) ?></td>
                <td><?= htmlspecialchars($conference->location) ?></td>
                <td><?= (new \DateTime($conference->start_date))->format('d.m.Y') ?></td>
                <td><?= $conference->getMembers()->count() ?></td>
                <td>
                    <div class="btn-group" role="group">
                        <?php
                            echo Html::a(
                                '<span class="glyphicon glyphicon-edit"></span> Редактировать',
                                ['conference/edit', 'id' => $conference->id],
                                ['class' => 'btn btn-default']
                            );
                            if ($conference->getMembers()->count() > 0) {
                                echo Html::a(
                                    '<span class="glyphicon glyphicon-user"></span> Список участников',
                                    ['members/index', 'id' => $conference->id],
                                    ['class' => 'btn btn-default']
                                );
                            }
                        ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        <tr>
            <td colspan="6">
                <?= Html::a('<span class="glyphicon glyphicon-plus"></span> Добавить', ['conference/add'], ['class' => 'btn btn-default']) ?>
            </td>
        </tr>
    </table>
<?php } ?>
