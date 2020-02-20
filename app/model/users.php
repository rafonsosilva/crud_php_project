<?php
require_once $config['LIB_PATH'] . 'db_connection.php';
$current_view = $config['VIEW_PATH'] . 'users' . DS;

switch (get('action')) {
    case 'viewActiveUsers': {
            $view = $current_view . 'activeUsers.phtml';
            $sql = "SELECT * FROM users WHERE user_status = 'active' ";
            $statements = get_db_clients($db_conn, $sql);
            break;
        }
    case 'viewArchivedUsers': {
            $view = $current_view . 'archivedUsers.phtml';
            $sql = "SELECT * FROM users WHERE user_status = 'archived' ";
            $statements = get_db_clients($db_conn, $sql);
            break;
        }
    case 'archive': {
            $id = get('id');
            $sql = "UPDATE users
                SET user_status = 'archived'
                WHERE users.user_id = $id";
            if (mysqli_query($db_conn, $sql)) {
                $msg = 'Success: client id ' . $id . ' archived. ';
            } else {
                $msg = 'Error: client not archived. ';
            }
            $sql = "SELECT * FROM users WHERE user_status = 'active' ";
            $statements = get_db_clients($db_conn, $sql);
            $view = $current_view . 'activeUsers.phtml';
            break;
        }
    case 'activate': {
            $id = get('id');
            $sql = "UPDATE users
                SET user_status = 'active'
                WHERE users.user_id = $id";
            if (mysqli_query($db_conn, $sql)) {
                $msg = 'Success: client id ' . $id . ' activated. ';
            } else {
                $msg = 'Error: client not activated. ';
            }
            $sql = "SELECT * FROM users WHERE user_status = 'archived' ";
            $statements = get_db_clients($db_conn, $sql);
            $view = $current_view . 'archivedUsers.phtml';
            break;
        }

    case 'update': {
            $view = $current_view . 'updateUser.phtml';
            $id = get('id');
            $sql = "SELECT * FROM users WHERE user_id = $id";
            $statements = get_db_clients($db_conn, $sql);
            $fields = array();
            $i = 0;
            foreach ($statements as $row) {
                foreach ($row as $data) {
                    $fields[$i] = $data;
                    $i++;
                }
            }
            break;
        }
    case 'doUpdate': {
            $currentId = get('id');
            $user_Fname = get('user_Fname');
            $user_Lname = get('user_Lname');
            $user_email = get('user_email');
            $user_cellphone = get('user_cellphone');
            $user_position = get('user_position');
            $username = get('username');
            $password = get('password');
            $user_status = get('user_status');
            $user_picture = get('user_picture');

            $fields = set_user_field_names();
            $regex = set_users_regex();
            $required = set_user_required_fields();
            $errorMsgs = set_user_error_messages();
            $data = set_client_data_array($fields);
            $errors = [];
            for ($i = 0; $i < count($fields); $i++) {
                validate($fields[$i], $data, $regex[$i], $required[$i], $errorMsgs[$i], $errors);
            }
            if (count($errors) == 0) {
                if (!empty($user_picture)) {
                    $sql = "UPDATE users 
                    SET user_Fname = '$user_Fname', 
                        user_Lname = '$user_Lname', 
                        user_email = '$user_email', 
                        user_cellphone = '$user_cellphone', 
                        user_position = '$user_position', 
                        username = '$username', 
                        password = '$password', 
                        user_status = '$user_status',
                        user_picture = '$user_picture'
                    WHERE users.user_id = $currentId";
                } else {
                    $sql = "UPDATE users 
                    SET user_Fname = '$user_Fname', 
                        user_Lname = '$user_Lname', 
                        user_email = '$user_email', 
                        user_cellphone = '$user_cellphone', 
                        user_position = '$user_position', 
                        username = '$username', 
                        password = '$password', 
                        user_status = '$user_status'
                    WHERE users.user_id = $currentId";
                }
                if (mysqli_query($db_conn, $sql)) {
                    $msg = 'Success: user id ' . $currentId . ' updated.';
                } else {
                    $msg = 'Error: user not updated.';
                }
                if ($data['user_status'] == 'active') {
                    $sql = "SELECT * FROM users WHERE user_status = 'active' ";
                    $statements = get_db_clients($db_conn, $sql);
                    $msg;
                    $view = $current_view . 'activeUsers.phtml';
                } elseif ($data['user_status'] == 'archived') {
                    $sql = "SELECT * FROM users WHERE user_status = 'archived' ";
                    $statements = get_db_clients($db_conn, $sql);
                    $msg;
                    $view = $current_view . 'archivedUsers.phtml';
                }
            } else {
                $view = $current_view . 'updateUser.phtml';
                $id = get('id');
                $sql = "SELECT * FROM users WHERE user_id = $id";
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
            $user_Fname = get('user_Fname');
            $user_Lname = get('user_Lname');
            $user_email = get('user_email');
            $user_cellphone = get('user_cellphone');
            $user_position = get('user_position');
            $username = get('username');
            $password = md5(get('password'));
            $user_status = get('user_status');
            $user_picture = get('user_picture');

            $fields = set_user_field_names();
            $regex = set_users_regex();
            $required = set_user_required_fields();
            $errorMsgs = set_user_error_messages();
            $data = set_client_data_array($fields);
            $errors = [];
            for ($i = 0; $i < count($fields); $i++) {
                validate($fields[$i], $data, $regex[$i], $required[$i], $errorMsgs[$i], $errors);
            }

            if(validate_username($db_conn, $username)){
                $errors['username'] = 'Not a valid username. The entered username was already taken. Please try another one.';
            }

            if (count($errors) == 0) {
                $sql = "INSERT INTO users (user_id, user_Fname, user_Lname, user_email, user_cellphone, user_position, username, password, user_status, user_picture) 
            VALUES (NULL, '$user_Fname', '$user_Lname', '$user_email', '$user_cellphone', '$user_position', '$username', '$password', '$user_status', '$user_picture')";
                if (mysqli_query($db_conn, $sql)) {
                    $msg = 'Success: 1 user created. ';
                } else {
                    $msg = 'Error: something went wrong. Please try again.';
                }
                if ($data['user_status'] == 'active') {
                    $sql = "SELECT * FROM users WHERE user_status = 'active' ";
                    $statements = get_db_clients($db_conn, $sql);
                    $msg;
                    $view = $current_view . 'activeUsers.phtml';
                } elseif ($data['user_status'] == 'archived') {
                    $sql = "SELECT * FROM users WHERE user_status = 'archived' ";
                    $statements = get_db_clients($db_conn, $sql);
                    $msg;
                    $view = $current_view . 'archivedUsers.phtml';
                }
            } else {
                $data;
                $errors;
                $view = $current_view . 'addUser.phtml';
            }
            break;
        }
    case 'add': {
            $view = $current_view . 'addUser.phtml';
            break;
        }
    case 'search': {
            $current_list = get('current_view');
            $searched_content = cleanData(trim(get('search')));
            $searched_content = mysqli_real_escape_string($db_conn, $searched_content);
            if ($searched_content == '') {
                $sql = "SELECT * FROM users WHERE user_status = '$current_list' ";
            } elseif ($searched_content !== '') {
                $sql = search_users($searched_content, $current_list);
            }
            $statements = get_db_clients($db_conn, $sql);
            if (is_array($statements) && $current_list == 'active') {
                $view = $current_view . 'activeUsers.phtml';
            } elseif (is_array($statements) && $current_list == 'archived') {
                $view = $current_view . 'archivedUsers.phtml';
            } elseif (!is_array($statements) && $current_list == 'active') {
                $msg = "No results were found. ";
                $view = $current_view . 'activeUsers.phtml';
                break;
            } elseif (!is_array($statements) && $current_list == 'archived') {
                $msg = "No results were found. ";
                $view = $current_view . 'archivedUsers.phtml';
                break;
            }
            break;
        }
}
echo "<a href='/folder_view/vs.php?s=" . __FILE__ . "' target='_blank'>View Source: users.php</a> | ";
