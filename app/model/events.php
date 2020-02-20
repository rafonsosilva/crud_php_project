<?php
require_once $config['LIB_PATH'] . 'db_connection.php';
$current_view = $config['VIEW_PATH'] . 'events' . DS;

switch (get('action')) {
    case 'viewActiveEvents': {
            $view = $current_view . 'activeEvents.phtml';
            $event_status = 'active';
            $sql = retrieve_events_view($event_status);
            $statements = get_db_clients($db_conn, $sql);
            break;
        }
    case 'viewArchivedEvents': {
            $view = $current_view . 'archivedEvents.phtml';
            $event_status = 'archived';
            $sql = retrieve_events_view($event_status);
            $statements = get_db_clients($db_conn, $sql);
            break;
        }
    case 'activate': {
            $id = get('id');
            $sql = "UPDATE events
                SET event_status = 'active'
                WHERE events.event_id = $id";
            if (mysqli_query($db_conn, $sql)) {
                $msg = 'Success: event id ' . $id . ' activated. ';
            } else {
                $msg = 'Error: event not activated. ';
            }
            $event_status = 'archived';
            $sql = retrieve_events_view($event_status);
            $statements = get_db_clients($db_conn, $sql);
            $view = $current_view . 'archivedEvents.phtml';
            break;
        }
    case 'archive': {
            $id = get('id');
            $sql = "UPDATE events
                SET event_status = 'archived'
                WHERE events.event_id = $id";
            if (mysqli_query($db_conn, $sql)) {
                $msg = 'Success: event id ' . $id . ' archived. ';
            } else {
                $msg = 'Error: event not archived. ';
            }
            $event_status = 'active';
            $sql = retrieve_events_view($event_status);
            $statements = get_db_clients($db_conn, $sql);
            $view = $current_view . 'activeEvents.phtml';
            break;
        }
    case 'update': {
            $view = $current_view . 'updateEvent.phtml';
            $id = get('id');
            $sql_current_event = "SELECT 
                    event_id, 
                    client_id, 
                    c.company_name, 
                    notification_id, 
                    n.notification_name,
                    n.notification_type, 
                    event_frequency, 
                    event_start_date, 
                    event_status 
                FROM 
                    events e 
                INNER JOIN 
                    clients c USING (client_id) 
                INNER JOIN 
                    notifications n USING (notification_id)
                WHERE event_id = '$id'";
            $statements_current_event = get_db_clients($db_conn, $sql_current_event);
            $fields = array();
            $i = 0;
            foreach ($statements_current_event as $row) {
                foreach ($row as $data) {
                    $fields[$i] = $data;
                    $i++;
                }
            }
            $sql_clients = "SELECT * FROM clients";
            $statements_clients = get_db_clients($db_conn, $sql_clients);

            $sql_notifications = "SELECT * FROM notifications";
            $statements_notifications = get_db_clients($db_conn, $sql_notifications);
            break;
        }
    case 'doUpdate': {
            $currentId = get('id');
            $client_info = explode(',', get('client'));
            $client_id = $client_info[0];
            $notification_info = explode(',', get('notification'));
            $notification_id = $notification_info[0];
            $event_frequency = get('frequency');
            $event_start_date = get('starting_from');
            $event_status = get('event_status');

            $fields = set_events_field_names();
            $regex = set_events_regex();
            $required = set_events_required_fields();
            $errorMsgs = set_events_error_messages();
            $errors = [];
            $data = [];
            foreach ($fields as $field) {
                $data[$field] = get($field);
            }
            for ($i = 0; $i < count($fields); $i++) {
                validate($fields[$i], $data, $regex[$i], $required[$i], $errorMsgs[$i], $errors);
            }
            if (count($errors) == 0) {
                // No errors
                $sql = "UPDATE events 
                        SET client_id = '$client_id',
                            notification_id = '$notification_id',
                            event_frequency = '$event_frequency',
                            event_start_date = '$event_start_date',
                            event_status = '$event_status'
                        WHERE events.event_id = $currentId";
                if (mysqli_query($db_conn, $sql)) {
                    $msg = 'Success: event id ' . $currentId . ' event updated. ';
                } else {
                    $msg = 'Error: no event updated. ';
                }
                if ($data['event_status'] == 'active') {
                    //$event_status = 'active';
                    $sql = retrieve_events_view($data['event_status']);
                    $statements = get_db_clients($db_conn, $sql);
                    $msg;
                    $view = $current_view . 'activeEvents.phtml';
                } elseif ($data['event_status'] == 'archived') {
                    //$event_status = 'archived';
                    $sql = retrieve_events_view($data['event_status']);
                    $statements = get_db_clients($db_conn, $sql);
                    $msg;
                    $view = $current_view . 'archivedEvents.phtml';
                }
            } else {
                $view = $current_view . 'updateEvent.phtml';
                $id = get('id');
                $sql = "SELECT * FROM events WHERE event_id = $id";
                $statements = get_db_clients($db_conn, $sql);
                $fields = array();
                $i = 0;
                foreach ($statements as $row) {
                    foreach ($row as $data) {
                        $fields[$i] = $data;
                        $i++;
                    }
                }
            }
            break;
        }
    case 'save': {
            $client_info = explode(',', get('client'));
            $client_id = $client_info[0];
            $notification_info = explode(',', get('notification'));
            $notification_id = $notification_info[0];
            $event_frequency = get('frequency');
            $event_start_date = get('starting_from');
            $event_status = get('event_status');

            $fields = set_events_field_names();
            $regex = set_events_regex();
            $required = set_events_required_fields();
            $errorMsgs = set_events_error_messages();
            $errors = [];
            $data = [];
            foreach ($fields as $field) {
                $data[$field] = get($field);
            }
            for ($i = 0; $i < count($fields); $i++) {
                validate($fields[$i], $data, $regex[$i], $required[$i], $errorMsgs[$i], $errors);
            }
            if (count($errors) == 0) {
                // No errors
                $sql = "INSERT INTO events 
                        (event_id, client_id, notification_id, event_frequency, event_start_date, event_status) 
                    VALUES 
                        (NULL, '$client_id', '$notification_id', '$event_frequency', '$event_start_date', '$event_status')";
                if (mysqli_query($db_conn, $sql)) {
                    $msg = 'Success: 1 event added. ';
                } else {
                    $msg = 'Error: no event added. ';
                }
                if ($data['event_status'] == 'active') {
                    $sql = "SELECT 
                            event_id, 
                            client_id, 
                            c.company_name, 
                            notification_id, 
                            n.notification_name,
                            n.notification_type, 
                            event_frequency, 
                            event_start_date, 
                            event_status 
                        FROM 
                            events e 
                        INNER JOIN 
                            clients c USING (client_id) 
                        INNER JOIN 
                            notifications n USING (notification_id)
                        WHERE event_status = 'active'";
                    $statements = get_db_clients($db_conn, $sql);
                    $msg;
                    $view = $current_view . 'activeEvents.phtml';
                } elseif ($data['event_status'] == 'archived') {
                    $sql = "SELECT 
                            event_id, 
                            client_id, 
                            c.company_name, 
                            notification_id, 
                            n.notification_name,
                            n.notification_type, 
                            event_frequency, 
                            event_start_date, 
                            event_status 
                        FROM 
                            events e 
                        INNER JOIN 
                            clients c USING (client_id) 
                        INNER JOIN 
                            notifications n USING (notification_id)
                        WHERE event_status = 'archived'";
                    $statements = get_db_clients($db_conn, $sql);
                    $msg;
                    $view = $current_view . 'archivedEvents.phtml';
                }
            } else {
                $sql_clients = "SELECT * FROM clients";
                $statements_clients = get_db_clients($db_conn, $sql_clients);

                $sql_notifications = "SELECT * FROM notifications";
                $statements_notifications = get_db_clients($db_conn, $sql_notifications);
                $view = $current_view . 'addEvent.phtml';
            }
            break;
        }

    case 'add': {
            $view = $current_view . 'addEvent.phtml';
            $sql_clients = "SELECT * FROM clients";
            $statements_clients = get_db_clients($db_conn, $sql_clients);

            $sql_notifications = "SELECT * FROM notifications";
            $statements_notifications = get_db_clients($db_conn, $sql_notifications);
            break;
        }
    case 'search': {
            $current_list = get('current_view');
            $searched_content = cleanData(trim(get('search')));
            $searched_content = mysqli_real_escape_string($db_conn, $searched_content);
            if($searched_content == '' && $current_list == 'active'){
                $sql = retrieve_events_view($current_list);
            }
            elseif($searched_content !== ''){
                $sql = search_events($searched_content, $current_list);
            }
            $statements = get_db_clients($db_conn, $sql);
            if (is_array($statements) && $current_list == 'active') {
                $view = $current_view . 'activeEvents.phtml';
            } elseif (is_array($statements) && $current_list == 'archived') {
                $view = $current_view . 'archivedEvents.phtml';
            } elseif (!is_array($statements) && $current_list == 'active') {
                $msg = "No results were found. ";
                $view = $current_view . 'activeEvents.phtml';
                break;
            } elseif (!is_array($statements) && $current_list == 'archived') {
                $msg = "No results were found. ";
                $view = $current_view . 'archivedEvents.phtml';
                break;
            }
        break;
        }
}

echo "<a href='/folder_view/vs.php?s=" . __FILE__ . "' target='_blank'>View Source: events.php</a> | ";
