<?php
$this->title = $exception->getMessage();
?>

<h3><?=$exception->getMessage()?></h3>
<span><?=$exception->statusCode?></span>

<p>Opps. An error<br> You can visit <a href="/">main page</a></p>
