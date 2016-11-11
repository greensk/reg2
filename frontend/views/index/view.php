<?php /* @file frontend/views/index/view.php */ ?>
<?php Use \yii\helpers\Html; ?>
<div class="jumbotron">
    <div class="container">
        <h1><?php echo htmlspecialchars($conference->title) ?></h1>
        <p>
            <?php echo htmlspecialchars($conference->description) ?>
        </p>
        <?php if ($conference->members) { ?>
            <h2>Уже идут:</h2>
            <p>
            <ul>
                <?php foreach($conference->members as $member) { ?>
                    <li>
                        <?= htmlspecialchars($member->first_name) ?>
                        <?= htmlspecialchars($member->last_name) ?>
                    </li>
                <?php } ?>
            </ul>
            </p>
        <?php } ?>
        <?php if ($conference->isAvailable()) {
            echo Html::a(
                '<span class="glyphicon glyphicon-ok"></span> Записаться',
                ['index/signup', 'id' => $conference->id],
                ['class' => 'btn btn-primary btn-lg']
            );
        } ?>
    </div>
</div>
