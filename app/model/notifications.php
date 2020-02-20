<?php
require_once $config['LIB_PATH'] . 'db_connection.php';
$current_view = $config['VIEW_PATH'] . 'notifications' . DS;

switch (get('action')) {
    case 'viewActiveNotifications':
    {
        $view = $current_view . 'activeNotifications.phtml';
        $sql = "SELECT * FROM notifications WHERE notification_status = 'active' ";
        $statements = get_db_clients($db_conn, $sql);
        break;
    }
    case 'viewArchivedNotifications':
    {
        $view = $current_view . 'archivedNotifications.phtml';
        $sql = "SELECT * FROM notifications WHERE notification_status = 'archived' ";
        $statements = get_db_clients($db_conn, $sql);
        break;
    }
    case 'archive':
    {
        $id = get('id');
        $sql = "UPDATE notifications
                SET notification_status = 'archived'
                WHERE notifications.notification_id = $id";
        if(mysqli_query($db_conn, $sql)){
            $msg = 'Success: notification id '. $id .' archived. ';
        }
        else{
            $msg = 'Error: notification not archived. ';
        }
        $sql = "SELECT * FROM notifications WHERE notification_status = 'active' ";
        $statements = get_db_clients($db_conn, $sql);
        $view = $current_view . 'activeNotifications.phtml';
        break;
    }
    case 'activate':
    {
        $id = get('id');
        $sql = "UPDATE notifications
                SET notification_status = 'active'
                WHERE notifications.notification_id = $id";
        if(mysqli_query($db_conn, $sql)){
            $msg = 'Success: notification id '. $id .' activated. ';
        }
        else{
            $msg = 'Error: notification not activated. ';
        }
        $sql = "SELECT * FROM notifications WHERE notification_status = 'archived' ";
        $statements = get_db_clients($db_conn, $sql);
        $view = $current_view . 'archivedNotifications.phtml';
        break;
    }
    case 'update':
    {
        $view = $current_view . 'updateNotifications.phtml';
        $id = get('id');
        $sql = "SELECT * FROM notifications WHERE notification_id = $id";
        $statements = get_db_notifications($db_conn, $sql);
        $fields = array();
        $i = 0;
        foreach ($statements as $row){
            foreach ($row as $data){
                $fields[$i] = $data;
                $i++;
            }
        }
        break;
    }
    case 'doUpdate':
    {
        $currentId = get('id');
        $notification_name = get('notification_name');
        $notification_type = get('notification_type');
        $notification_status = get('notification_status');    
        
        $fields = [
            'notification_name',
            'notification_type',
            'notification_status'
        ];
        $data = [];
        foreach ($fields as $field) {
            $data[$field] = get($field);
        }
        $passed_validation = '';
        foreach ($data as $content){
            if(empty($content)){
                $passed_validation = false;
                break;
            }
            else{
                $passed_validation = true;
            }
        }
        if($passed_validation){
            $sql = "UPDATE notifications 
                    SET notification_name = '$notification_name', 
                        notification_type = '$notification_type', 
                        notification_status = '$notification_status'
                    WHERE notifications.notification_id = $currentId";
            if(mysqli_query($db_conn, $sql)){
                $msg = 'Success: notification id '. $currentId .' updated.';
            }
            else{
                $msg = 'Error: notification not updated.';
            }
            if ($data['notification_status'] == 'active') {
                $sql = "SELECT * FROM notifications WHERE notification_status = 'active' ";
                $statements = get_db_clients($db_conn, $sql);
                $msg;
                $view = $current_view . 'activeNotifications.phtml';
            } elseif ($data['notification_status'] == 'archived') {
                $sql = "SELECT * FROM notifications WHERE notification_status = 'archived' ";
                $statements = get_db_clients($db_conn, $sql);
                $msg;
                $view = $current_view . 'archivedNotifications.phtml';
            }
        }else{
            $view = $current_view . 'updateNotifications.phtml';
            $id = get('id');
            $sql = "SELECT * FROM notifications WHERE notification_id = $id";
            $statements = get_db_notifications($db_conn, $sql);
            $fields = array();
            $i = 0;
            foreach ($statements as $row){
                foreach ($row as $data){
                    $fields[$i] = $data;
                    $i++;
                }
            }
        }
        break;
    }
    case 'save':
    {
        $notification_name = get('notification_name');
        $notification_type = get('notification_type');
        $notification_status = get('notification_status');    
        
        $fields = [
            'notification_name',
            'notification_type',
            'notification_status'
        ];
        $data = [];
        foreach ($fields as $field) {
            $data[$field] = get($field);
        }
        $passed_validation = '';
        foreach ($data as $content){
            if(empty($content)){
                $passed_validation = false;
                break;
            }
            else{
                $passed_validation = true;
            }
        }
        if($passed_validation){
            $sql = "INSERT INTO notifications (notification_id, notification_name, notification_type, notification_status) 
            VALUES (NULL, '$notification_name', '$notification_type', '$notification_status')";
            if(mysqli_query($db_conn, $sql)){
                $msg = 'success';
            }
            else{
                $msg = 'error';
            }
            if ($data['notification_status'] == 'active') {
                $sql = "SELECT * FROM notifications WHERE notification_status = 'active' ";
                $statements = get_db_clients($db_conn, $sql);
                $msg;
                $view = $current_view . 'activeNotifications.phtml';
            } elseif ($data['notification_status'] == 'archived') {
                $sql = "SELECT * FROM notifications WHERE notification_status = 'archived' ";
                $statements = get_db_clients($db_conn, $sql);
                $msg;
                $view = $current_view . 'archivedNotifications.phtml';
            }
        } else {
            $view = $current_view . 'addClient.phtml';
        }
        break;
    }
    case 'add':
    {
        $view = $current_view . 'addNotification.phtml';
        break;
    }
    case 'search':
    {
        $current_list = get('current_view');
        $searched_content = trim(get('search'));
        $searched_content = mysqli_real_escape_string($db_conn, $searched_content);
        if($searched_content == ''){
            $sql = "SELECT * FROM notifications WHERE notification_status = '$current_list' ";
        }
        elseif($searched_content !== ''){
            $sql = search_notifications($searched_content, $current_list);
        }

        $statements = get_db_clients($db_conn, $sql);
        if (is_array($statements) && $current_list == 'active') {
            $view = $current_view . 'activeNotifications.phtml';
        }
        elseif (is_array($statements) && $current_list == 'archived') {
            $view = $current_view . 'archivedNotifications.phtml';
        }
        elseif (!is_array($statements) && $current_list == 'active'){
            $msg = "No results were found. ";
            $view = $current_view . 'activeNotifications.phtml';
            break;
        }
        elseif (!is_array($statements) && $current_list == 'archived'){
            $msg = "No results were found. ";
            $view = $current_view . 'archivedNotifications.phtml';
            break;
        }
    }
}
echo "<a href='/folder_view/vs.php?s=" . __FILE__ . "' target='_blank'>View Source: notifications.php</a> | ";