<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

if ($exception->statusCode == 404) {
	$this->title = 'Страница не найдена';
	//$message
} else {
	$this->title = $name;
}
?>
<div class="site-error">
	
	<?php if ($exception->statusCode == 404) : ?>
	<h3>
        К сожалению такой страницы нет на нашем сайте
    </h3>
    <?php else : ?>
	
    <h1><?= Html::encode($this->title) ?></h1>
	
    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        The above error occurred while the Web server was processing your request.
    </p>
    <p>
        Please contact us if you think this is a server error. Thank you.
    </p>
	<?php endIf; ?>

</div>
