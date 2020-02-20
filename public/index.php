<?php
//MVC model taken Prof. Maziar Masoudi videos: https://www.youtube.com/watch?v=RqRV5h3tV9c&feature=emb_title
defined('APPLICATION_PATH') || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../app'));
//defined('PUBLIC_PATH') || define('PUBLIC_PATH', realpath(dirname(__FILE__) . '/../public'));
const DS = DIRECTORY_SEPARATOR;

require APPLICATION_PATH . DS . 'config' . DS . 'config.php';

$page = get('page', 'home');
$model = $config['MODEL_PATH'] . $page . '.php';
$view = $config['VIEW_PATH'] . $page . '.phtml';
$_404 = $config['VIEW_PATH'] . '404.phtml';

if (file_exists($model)) {
    require $model;
}
$main_content = $_404;

if (file_exists($view)) {
    $main_content = $view;
} 

include $config['VIEW_PATH'] . 'layout.phtml';

echo "<a href='/folder_view/vs.php?s=" . __FILE__ . "' target='_blank'>View Source: index.php</a> | ";
