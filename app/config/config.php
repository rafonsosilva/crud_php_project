<?php
$config = [
    'MODEL_PATH' => APPLICATION_PATH . DS . 'model' . DS,
    'VIEW_PATH' => APPLICATION_PATH . DS . 'view' . DS,
    'LIB_PATH' => APPLICATION_PATH . DS . 'lib' . DS,
    'DATA_PATH' => APPLICATION_PATH . DS . 'data' . DS,
];

require $config['LIB_PATH'] . 'functions.php';

echo "<a href='/folder_view/vs.php?s=" . __FILE__ . "' target='_blank'>View Source: config.php</a> | ";