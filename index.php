<?php

require __DIR__ . '/autoload.php';

use \App\Models\Article;

/* Пукнт 1 ДЗ
$config = \App\Config::getInstance();
echo $config->data['db']['host']; */

$article  = new Article();
$cols = $article->getColumns();
include __DIR__ . '/templates/index.php';