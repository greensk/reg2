<?php Use \yii\helpers\Html; ?>
<?php if ($list) { ?>
    <?php foreach ($list as $conference) { ?>
        <h2>
            <?= Html::a(htmlspecialchars($conference->title), array('index/view', 'id' => $conference->id)) ?>
            <span class="badge"><?= (new \DateTime($conference->start_date))->format('d.m.Y') ?></span>
        </h2>
        <div class="description">
            <?= htmlspecialchars($conference->description) ?>
        </div>
    <?php } ?>
<?php } else { ?>
    <div class="alert alert-warning" role="alert">Пока у нас не запланировано никаких мероприятий. Следите за новостями!</div>
<?php } ?>
