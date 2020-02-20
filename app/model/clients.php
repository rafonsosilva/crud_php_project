<?php
require_once $config['LIB_PATH'] . 'db_connection.php';
$current_view = $config['VIEW_PATH'] . 'clients' . DS;

switch (get('action')) {
    case 'viewActiveClients':
    {
        $view = $current_view . 'activeClients.phtml';
        $sql = "SELECT * FROM clients WHERE status = 'active' ";
        $statements = get_db_clients($db_conn, $sql);
        break;
    }
    case 'viewArchivedClients':
    {
        $view = $current_view . 'archivedClients.phtml';
        $sql = "SELECT * FROM clients WHERE status = 'archived' ";
        $statements = get_db_clients($db_conn, $sql);
        break;
    }
    case 'archive':
    {
        $id = get('id');
        $sql = "UPDATE clients
                SET status = 'archived'
                WHERE clients.client_id = $id";
        if(mysqli_query($db_conn, $sql)){
            $msg = 'Success: client id '. $id .' archived. ';
        }
        else{
            $msg = 'Error: client not archived. ';
        }
        $sql = "SELECT * FROM clients WHERE status = 'active' ";
        $statements = get_db_clients($db_conn, $sql);
        $view = $current_view . 'activeClients.phtml';
        break;
    }
    case 'activate':
    {
        $id = get('id');
        $sql = "UPDATE clients
                SET status = 'active'
                WHERE clients.client_id = $id";
        if(mysqli_query($db_conn, $sql)){
            $msg = 'Success: client id '. $id .' activated. ';
        }
        else{
            $msg = 'Error: client not activated. ';
        }
        $sql = "SELECT * FROM clients WHERE status = 'archived' ";
        $statements = get_db_clients($db_conn, $sql);
        $view = $current_view . 'archivedClients.phtml';
        break;
    }
    case 'update':
    {
        $view = $current_view . 'update.phtml';
        $id = get('id');
        $sql = "SELECT * FROM clients WHERE client_id = $id";
        $statements = get_db_clients($db_conn, $sql);
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
        $company_name = get('company_name');
        $business_number = get('business_number');
        $first_name = get('first_name');
        $last_name = get('last_name');
        $phone_number = get('phone');
        $cellphone = get('cellphone');
        $website = get('website');
        $status = get('client_status');

        $fields = set_clients_field_names();
        $regex = set_clients_regex();
        $required = set_clients_required_fields();
        $errorMsgs = set_client_error_messages();
        $data = set_client_data_array($fields);
        $errors = [];
        for ($i = 0; $i < count($fields); $i++) {
            validate($fields[$i], $data, $regex[$i], $required[$i], $errorMsgs[$i], $errors);
        }
        if (count($errors) == 0){
            $sql = "UPDATE clients 
                    SET company_name = '$company_name', 
                        business_number = '$business_number', 
                        first_name = '$first_name', 
                        last_name = '$last_name', 
                        phone_number = '$phone_number', 
                        cellphone = '$cellphone', 
                        website = '$website', 
                        status = '$status' 
                    WHERE clients.client_id = $currentId";
            if(mysqli_query($db_conn, $sql)){
                $msg = 'Success: client id '. $currentId .' updated.';
            }
            else{
                $msg = 'Error: client not updated.';
            }
            if ($data['client_status'] == 'active') {
                $sql = "SELECT * FROM clients WHERE status = 'active' ";
                $statements = get_db_clients($db_conn, $sql);
                $msg;
                $view = $current_view . 'activeClients.phtml';
            } elseif ($data['client_status'] == 'archived') {
                $sql = "SELECT * FROM clients WHERE status = 'archived' ";
                $statements = get_db_clients($db_conn, $sql);
                $msg;
                $view = $current_view . 'archivedClients.phtml';
            }
        }else{
            $view = $current_view . 'update.phtml';
            $id = get('id');
            $sql = "SELECT * FROM clients WHERE client_id = $id";
            $statements = get_db_clients($db_conn, $sql);
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
        $company_name = get('company_name');
        $business_number = get('business_number');
        $first_name = get('first_name');
        $last_name = get('last_name');
        $phone_number = get('phone');
        $cellphone = get('cellphone');
        $website = get('website');
        $status = get('client_status');

        $fields = set_clients_field_names();
        $regex = set_clients_regex();
        $required = set_clients_required_fields();
        $errorMsgs = set_client_error_messages();
        $data = set_client_data_array($fields);
        $errors = [];
        for ($i = 0; $i < count($fields); $i++) {
            validate($fields[$i], $data, $regex[$i], $required[$i], $errorMsgs[$i], $errors);
        }
        if (count($errors) == 0) {
            $sql = "INSERT INTO clients (client_id, company_name, business_number, first_name, last_name, phone_number, cellphone, website, status) 
            VALUES (NULL, '$company_name', '$business_number', '$first_name', '$last_name', '$phone_number', '$cellphone', '$website', '$status')";
            if(mysqli_query($db_conn, $sql)){
                $msg = 'success';
            }
            else{
                $msg = 'error';
            }
            if ($data['client_status'] == 'active') {
                $sql = "SELECT * FROM clients WHERE status = 'active' ";
                $statements = get_db_clients($db_conn, $sql);
                $msg;
                $view = $current_view . 'activeClients.phtml';
            } elseif ($data['client_status'] == 'archived') {
                $sql = "SELECT * FROM clients WHERE status = 'archived' ";
                $statements = get_db_clients($db_conn, $sql);
                $msg;
                $view = $current_view . 'archivedClients.phtml';
            }
        } else {
            $view = $current_view . 'addClient.phtml';
        }
        break;
    }
    case 'add':
    {
        $view = $current_view . 'addClient.phtml';
        break;
    }
    case 'search':
    {
        $current_list = get('current_view');
        $searched_content = cleanData(trim(get('search')));
        $searched_content = mysqli_real_escape_string($db_conn, $searched_content);
        if($searched_content == ''){
            $sql = "SELECT * FROM clients WHERE status = '$current_list' ";
        }
        elseif($searched_content !== ''){
            $sql = search_clients($searched_content, $current_list);
        }
        $statements = get_db_clients($db_conn, $sql);
        if (is_array($statements) && $current_list == 'active') {
            $view = $current_view . 'activeClients.phtml';
        }
        elseif (is_array($statements) && $current_list == 'archived') {
            $view = $current_view . 'archivedClients.phtml';
        }
        elseif (!is_array($statements) && $current_list == 'active'){
            $msg = "No results were found. ";
            $view = $current_view . 'activeClients.phtml';
            break;
        }
        elseif (!is_array($statements) && $current_list == 'archived'){
            $msg = "No results were found. ";
            $view = $current_view . 'archivedClients.phtml';
            break;
        }
    break;
    }
}
echo "<a href='/folder_view/vs.php?s=" . __FILE__ . "' target='_blank'>View Source: clients.php</a> | ";
