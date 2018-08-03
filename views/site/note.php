<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<?php $form = ActiveForm::begin(); ?>

<?= $form->field($note, 'title') ?>

<?= $form->field($note, 'text')->textarea(['rows' => '20']) ?>

<div class="form-group">
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'submit', 'value' => 'save']) ?>
    <?= Html::submitButton('Удалить', ['class' => 'btn btn-primary', 'name' => 'submit', 'value' => 'delete']) ?>
</div>

<?php ActiveForm::end(); ?>
