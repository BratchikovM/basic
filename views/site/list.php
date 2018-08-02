<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\helpers\Url;

?>

<h1>Ваши заметки</h1>
<p>
    <?= Html::a('Создать заметку', Url::toRoute('site/create'), ['class' => 'btn btn-lg btn-success']) ?>
</p>

<div class="row">
    <?php if (!empty($notes)) :
        foreach ($notes as $note) : ?>
            <div class="col-lg-4">
                <h2><a href="<?= yii\helpers\Url::to(['site/note', 'title'=>$note->title])?>"><?=$note->title?></a></h2>
            </div>
        <?php endforeach;?>

    <?php endif;?>


</div>
<?= yii\widgets\LinkPager::widget(['pagination'=> $pages]); ?>