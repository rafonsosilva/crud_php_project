<?php
require_once $config['LIB_PATH'] . 'db_connection.php';
$current_view = $config['VIEW_PATH'] . 'authentication' . DS;

switch (get('action')) {
    case 'login':
    {
        $view = $current_view . 'login.phtml';
    break;
    }
    case 'logout':
    {
        $view = $current_view . 'logout.phtml';
    break;
    }
}
echo "<a href='/folder_view/vs.php?s=" . __FILE__ . "' target='_blank'>View Source: authentication.php</a> | ";