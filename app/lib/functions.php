<?php
ob_start();
function get($name, $def = '')
{
    return isset($_REQUEST[$name]) ? trim($_REQUEST[$name]) : $def;
}

function set_clients_field_names()
{
    $fields = [
        'company_name',
        'business_number',
        'first_name',
        'last_name',
        'phone',
        'cellphone',
        'website',
        'client_status'
    ];
    return $fields;
}

function set_events_field_names()
{
    $fields = [
        'client',
        'notification',
        'frequency',
        'starting_from',
        'event_status'
    ];
    return $fields;
}

function set_user_field_names(){
    $fields = [
        'user_Fname',
        'user_Lname',
        'user_email',
        'user_cellphone',
        'user_position',
        'username',
        'password',
        'user_status',
        'user_picture'
    ];
    return $fields;
}

function set_clients_regex()
{
    $regex = [
        "/([a-zA-Z0-9&])\w+/",
        "/[0-9]{9}[r][c|m|p|t][0-9]{4}/i",
        "/([a-zA-Z])\w+/",
        "/([a-zA-Z])\w+/",
        "/\D*([2-9]\d{2})(\D*)([2-9]\d{2})(\D*)(\d{4})\D*/",
        "/\D*([2-9]\d{2})(\D*)([2-9]\d{2})(\D*)(\d{4})\D*/",
        "/^(https?\:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})(\/[\w]*)*$/",
        "/^(active|archived)$/"
    ];
    return $regex;
}

function set_events_regex()
{
    $regex = [
        "/\d/",
        "/\d/",
        "/[1-9]{1,}[0-9]+/",
        "/([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))/",
        "/^(active|archived)$/"
    ];
    return $regex;
}

function set_users_regex(){
    $regex = [
        "/([a-zA-Z])\w+/",
        "/([a-zA-Z])\w+/",
        "/^(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){255,})(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){65,}@)(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22))(?:\\.(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-+[a-z0-9]+)*\\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-+[a-z0-9]+)*)|(?:\\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\\]))$/iD",
        "/\D*([2-9]\d{2})(\D*)([2-9]\d{2})(\D*)(\d{4})\D*/",
        "/^(Manager|Senior Accountant|Junior Accountant|Chartered Accountant|Book Keeper)$/",
        "/([a-zA-Z])\w+/",
        "/./",
        "/^(active|archived)$/",
        "/./",
    ];
    return $regex;
}

function set_clients_required_fields()
{
    $required = [1, 1, 1, 1, 1, 1, 0, 1];
    return $required;
}

function set_events_required_fields()
{
    $required = [1, 1, 1, 1, 1];
    return $required;
}

function set_user_required_fields(){
    $required = [1, 1, 1, 1, 1, 1, 1, 1, 0];
    return $required;
}

function set_client_error_messages()
{
    $errorMsgs = [
        "Not a valid company name. Only letters (a-z) or numbers (0-9) allowed.",
        "Not a valid business number. Only valid business number without spaces or especial characters allowed.",
        "Not a valid first name. Only letters allowed.",
        "Not a valid last name. Only letters allowed.",
        "Not a valid phone number. Only 10-digit (including area code) north-american phone numbers allowed.",
        "Not a valid cellphone number. Only 10-digit (including area code) north-american phone numbers allowed.",
        "Not a valid website. Please try again.",
        "Not a valid status. Please refresh the page and try again."
    ];
    return $errorMsgs;
}

function set_events_error_messages()
{
    $errorMsgs = [
        "Not a valid client. Please select one client from the list provided.",
        "Not a valid notification. Please select one notification from the list provided.",
        "Not a valid frequency. Please enter a valid positive number to represent the frequency in days.",
        "Not a valid date. Please enter a valid date in the format 'yyyy-mm-dd.",
        "Not a valid status. Please refresh the page and try again."
    ];
    return $errorMsgs;
}

function set_user_error_messages()
{
    $errorMsgs = [
        "Not a valid first name. Only letters (a-z) allowed.",
        "Not a valid last name. Only letters (a-z) allowed.",
        "Not a valid email. Please enter a valid email.",
        "Not a valid cellphone. Please enter a valid cellphone.",
        "Not a valid position. Please select one of the positions listed.",
        "Not a valid username. The entered username was already taken. Please try another one.",
        "Not a valid password. Please try again.",
        "Not a valid status. Please refresh the page and try again.",
        ""
    ];
    return $errorMsgs;
}
function set_client_data_array($fields)
{
    $data = [];
    foreach ($fields as $field) {
        $data[$field] = get($field);
    }
    return $data;
}

function validate($fieldName, &$data, $regex, $isRequired, $errorMsg, &$errors)
{
    if ($data[$fieldName] == "" && $isRequired == 0) {
        return;
    }
    if (@preg_match_all($regex, $data[$fieldName])) {
        return;
    }
    $errors[$fieldName] = $errorMsg;
}

function update($file, $id)
{
    $record_to_update = '';
    foreach ($file as $index => $row) {
        $fields = explode(',', $row);
        if ($fields[0] == $id) {
            $record_to_update = $fields;
            break;
        }
    }
    return $record_to_update;
}

function search($file, $searched_content)
{
    $searched_id = [];
    $searched_id_index = 0;
    foreach ($file as $row) {
        $row_fields = explode(',', $row);
        foreach ($row_fields as $field) {
            $words = explode(' ', $field);
            foreach ($words as $word) {
                if (strcasecmp($word, $searched_content) == 0) {
                    $searched_id[$searched_id_index] = $row_fields[0];
                    $searched_id_index++;
                }
            }
        }
    }
    return $searched_id;
}

function has_error($field_name, $errors)
{
    if (!empty($errors)) {
        $error_msg = '';
        foreach ($errors as $error) {
            $words = explode(' ', $error);
            foreach ($words as $word) {
                if ($word == $field_name) {
                    $error_msg = $error;
                }
            }
        }
        return $error_msg;
    }
}

function get_db_clients($db_conn, $sql)
{
    $statements = array();
    $result = mysqli_query($db_conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        //retrieve data and store records in 2d array
        $i = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $statements[$i] = $row;
            $i++;
        }
        return $statements;
    } else {
        $no_results = "No records to show";
        return $no_results;
    }
    mysqli_close($db_conn);
}

function get_db_notifications($db_conn, $sql)
{
    $statements = array();
    $result = mysqli_query($db_conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        //retrieve data and store records in 2d array
        $i = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $statements[$i] = $row;
            $i++;
        }
        return $statements;
    } else {
        $no_results = "No records to show";
        return $no_results;
    }
    mysqli_close($db_conn);
}

function cleanData($data)
{
    $d = trim($data);
    $d = stripslashes($d);
    $d = strip_tags($d);
    return $d;
}

function retrieve_events_view($event_status)
{
    if (isset($event_status) && $event_status == 'active') {
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
                WHERE event_status = 'active'
                ORDER BY event_id";
    } elseif (isset($event_status) && $event_status == 'archived') {
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
                WHERE event_status = 'archived'
                ORDER BY event_id";
    }
    return $sql;
}
function search_events($searched_content, $event_status)
{
    if ($event_status == 'active') {
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
                WHERE (event_id LIKE '%$searched_content%'
                    OR client_id LIKE '%$searched_content%'
                    OR c.company_name LIKE '%$searched_content%'
                    OR n.notification_name LIKE '%$searched_content%'
                    OR n.notification_type LIKE '%$searched_content%'
                    OR event_frequency LIKE '%$searched_content%'
                    OR event_start_date LIKE '%$searched_content%')
                    AND event_status LIKE 'active'";
    }
    elseif($event_status == 'archived'){
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
                WHERE (event_id LIKE '%$searched_content%'
                    OR client_id LIKE '%$searched_content%'
                    OR c.company_name LIKE '%$searched_content%'
                    OR n.notification_name LIKE '%$searched_content%'
                    OR n.notification_type LIKE '%$searched_content%'
                    OR event_frequency LIKE '%$searched_content%'
                    OR event_start_date LIKE '%$searched_content%')
                    AND event_status LIKE 'archived'";
    }
    return $sql;
}
function search_clients($searched_content, $event_status){
    if ($event_status == 'active') {
        $sql = "SELECT * FROM clients
                WHERE (client_id LIKE '%$searched_content%'
                    OR company_name LIKE '%$searched_content%'
                    OR business_number LIKE '%$searched_content%'
                    OR first_name LIKE '%$searched_content%'
                    OR last_name LIKE '%$searched_content%'
                    OR phone_number LIKE '%$searched_content%'
                    OR cellphone LIKE '%$searched_content%'
                    OR website LIKE '%$searched_content%')
                    AND status LIKE 'active'";
    }
    elseif($event_status == 'archived'){
        $sql = "SELECT * FROM clients
                WHERE (client_id LIKE '%$searched_content%'
                    OR company_name LIKE '%$searched_content%'
                    OR business_number LIKE '%$searched_content%'
                    OR first_name LIKE '%$searched_content%'
                    OR last_name LIKE '%$searched_content%'
                    OR phone_number LIKE '%$searched_content%'
                    OR cellphone LIKE '%$searched_content%'
                    OR website LIKE '%$searched_content%')
                    AND status LIKE 'archived'";
    }
    return $sql;
}
function search_notifications($searched_content, $event_status){
    if($event_status == 'active'){
        $sql = "SELECT * FROM notifications
                WHERE (notification_id LIKE '%$searched_content%'
                    OR notification_name LIKE '%$searched_content%'
                    OR notification_type LIKE '%$searched_content%')
                    AND notification_status LIKE 'active'";
    }
    elseif($event_status == 'archived'){
        $sql = "SELECT * FROM notifications
                WHERE (notification_id LIKE '%$searched_content%'
                    OR notification_name LIKE '%$searched_content%'
                    OR notification_type LIKE '%$searched_content%')
                    AND notification_status LIKE 'archived'";
    }
    return $sql;
}

function search_users($searched_content, $user_status){
    if ($user_status == 'active') {
        $sql = "SELECT * FROM users
                WHERE (user_id LIKE '%$searched_content%'
                    OR user_Fname LIKE '%$searched_content%'
                    OR user_Lname LIKE '%$searched_content%'
                    OR user_email LIKE '%$searched_content%'
                    OR user_cellphone LIKE '%$searched_content%'
                    OR user_position LIKE '%$searched_content%'
                    OR username LIKE '%$searched_content%'
                    OR user_status LIKE '%$searched_content%')
                    AND user_status LIKE 'active'";
    }
    elseif($user_status == 'archived'){
        $sql = "SELECT * FROM users
                WHERE (user_id LIKE '%$searched_content%'
                    OR user_Fname LIKE '%$searched_content%'
                    OR user_Lname LIKE '%$searched_content%'
                    OR user_email LIKE '%$searched_content%'
                    OR user_cellphone LIKE '%$searched_content%'
                    OR user_position LIKE '%$searched_content%'
                    OR username LIKE '%$searched_content%'
                    OR user_status LIKE '%$searched_content%')
                    AND user_status LIKE 'archived'";
    }
    return $sql;
}

function authenticate($db_conn, $sql)
{
    $result = mysqli_query($db_conn, $sql);
    if(!empty($result)){
        return true;
    }
    else {
        return false;
    }
    mysqli_close($db_conn);
}

function validate_username($db_conn, $username)
            {
                $sql = "SELECT username FROM users WHERE username LIKE '$username'";
                $result = mysqli_query($db_conn, $sql);
                if (mysqli_num_rows($result) != 0){
                    return true;
                } else {
                    return false;
                }
                mysqli_close($db_conn);
            }

//FUNCTIONS TO DISPLAY VIEW PAGES
?>

<?php function addClient_view($data = null, $errors = null){?>
<h1>Add new client</h1>
<form method="post" action="?page=clients&action=save">
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="companyName">Company Name</label><span class="required_field"> *</span>
            <input type="text" class="form-control" id="companyName" placeholder="ABC Company" name="company_name"
                <?php
                if(!empty($errors)){
                    echo 'value="'.$data['company_name'].'"';
                }
                ?> required>
            <span class="warning_error"><?php
                $field_name = 'company';
                if(!empty($errors)) : echo has_error($field_name, $errors); endif;?>
            </span>
        </div>
        <div class="form-group col-md-6">
            <label for="businessNumber">Business Number</label><span class="required_field"> *</span>
            <input type="text" class="form-control" id="businessNumber" placeholder="123456789RC0001" name="business_number"
                <?php
                if(!empty($errors)){
                    echo 'value="'.$data['business_number'].'"';
                }
                ?> required>
            <span class="warning_error"><?php
                $field_name = 'business';
                if(!empty($errors)) : echo has_error($field_name, $errors); endif;?>
            </span>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="contFirstName">Contact's First Name</label><span class="required_field"> *</span>
            <input type="text" class="form-control" id="contFirstName" placeholder="Contact's First Name" name="first_name"
                <?php
                if(!empty($errors)){
                    echo 'value="'.$data['first_name'].'"';
                }
                ?> required>
            <span class="warning_error"><?php
                $field_name = 'first';
                if(!empty($errors)) : echo has_error($field_name, $errors); endif;?>
            </span>
        </div>
        <div class="form-group col-md-6">
            <label for="contLastName">Contact's Last Name</label><span class="required_field"> *</span>
            <input type="text" class="form-control" id="contLastName" placeholder="Contact's Last Name" name="last_name"
                <?php
                if(!empty($errors)){
                    echo 'value="'.$data['last_name'].'"';
                }
                ?> required>
            <span class="warning_error"><?php
                $field_name = 'last';
                if(!empty($errors)) : echo has_error($field_name, $errors); endif;?>
            </span>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="phone">Phone Number</label><span class="required_field"> *</span>
            <input type="text" class="form-control" id="phone" placeholder="(999)999-9999" name="phone"
                <?php
                if(!empty($errors)){
                    echo 'value="'.$data['phone'].'"';
                }
                ?> required>
            <span class="warning_error"><?php
                $field_name = 'phone';
                if(!empty($errors)) : echo has_error($field_name, $errors); endif;?>
            </span>
        </div>
        <div class="form-group col-md-6">
            <label for="cellPhone">Cell Phone Number</label><span class="required_field"> *</span>
            <input type="text" class="form-control" id="cellPhone" placeholder="(999)999-9999" name="cellphone"
                <?php
                if(!empty($errors)){
                    echo 'value="'.$data['cellphone'].'"';
                }
                ?> required>
            <span class="warning_error"><?php
                $field_name = 'cellphone';
                if(!empty($errors)) : echo has_error($field_name, $errors); endif;?>
            </span>
        </div>
    </div>
    <div class="form-group">
        <label for="website">Website</label>
        <input type="text" class="form-control" id="website" placeholder="http://www.companyswebsite.ca" name="website"
            <?php
            if(!empty($errors)){
                echo 'value="'.$data['website'].'"';
            }
            ?>>
        <span class="warning_error"><?php
            $field_name = 'website.';
            if(!empty($errors)) : echo has_error($field_name, $errors); endif;?>
        </span>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="client_status" value="active" id="active" checked>
        <label class="form-check-label" for="active">Active</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="client_status" value="archived" id="archive">
        <label class="form-check-label" for="archive">Archive</label>
    </div>
    <br><br>
    <button type="submit" class="btn btn-primary" name="submit" value="save">Save</button>
    <input type="reset" class="btn btn-danger" value="Reset">
</form>
<br>
<p class="required_field">* Required fields</p>

<?php } ?>

<?php function activeClients($msg = null, $statements = null){?>
<h1>Active Clients</h1>
<br>
<form method="post" action="?page=clients&action=viewActiveClients" class="clear_search_button">
    <button type="submit" class="btn btn-primary mb-2 btn btn-danger" name="cancel" value="Cancel">Clear Search</button>
</form>
<form class="form-inline search_button" method="post" action="?page=clients&action=search">
    <label class="sr-only" for="search_box">Search box</label>
    <div class="input-group mb-2 mr-sm-2">
        <input type="text" class="form-control" id="search_box" name="search" size="20" placeholder="search by any field">
        <input type="hidden" name="current_view" value="active">
    </div>
    <button type="submit" class="btn btn-primary mb-2 btn btn-success">Search</button>&nbsp
</form>
<?php if(isset($msg)) echo $msg; ?>
<table class="table-striped">
    <?php
    echo '<tr>';
    echo '<th>' . 'Client ID' . '</th>' .
        '<th>' . 'Company Name' . '</th>' .
        '<th>' . 'Business Number' . '</th>' .
        '<th>' . 'Contact\'s First Name' . '</th>' .
        '<th>' . 'Contact\'s Last Name' . '</th>' .
        '<th>' . 'Phone Number' . '</th>' .
        '<th>' . 'Cellphone Number' . '</th>' .
        '<th>' . 'Website' . '</th>' .
        '<th>' . 'Status' . '</th>' .
        '<th colspan="2" class="colspanCenter">' . 'Actions' . '</th>';
    echo '</tr>';
    echo '<tr>';
    if(is_array($statements)){
        foreach ($statements as $row){
            echo '<td>'.$row['client_id'].'</td>';
            echo '<td>'.$row['company_name'].'</td>';
            echo '<td>'.$row['business_number'].'</td>';
            echo '<td>'.$row['first_name'].'</td>';
            echo '<td>'.$row['last_name'].'</td>';
            echo '<td>'.$row['phone_number'].'</td>';
            echo '<td>'.$row['cellphone'].'</td>';
            echo '<td>'.$row['website'].'</td>';
            echo '<td>'.$row['status'].'</td>';
            echo '<td class="actions"><a href="?page=clients&action=archive&id=' . $row['client_id'] . '">Archive</td>';
            echo '<td class="actions"><a href="?page=clients&action=update&id=' . $row['client_id'] . '">Update</td>';
            echo '</tr>';
        }
    }
    else{
        echo $statements;
    }
    ?>
</table>
<?php } ?>

<?php function archivedClients($msg = null, $statements = null){?>

<h1>Archived Clients</h1>
<br>
<form method="post" action="?page=clients&action=viewArchivedClients" class="clear_search_button">
    <button type="submit" class="btn btn-primary mb-2 btn btn-danger" name="cancel" value="Cancel">Clear Search</button>
</form>
<form class="form-inline search_button" method="post" action="?page=clients&action=search">
    <label class="sr-only" for="search_box">Search box</label>
    <div class="input-group mb-2 mr-sm-2">
        <input type="text" class="form-control" id="search_box" name="search" size="20" placeholder="search by any field">
        <input type="hidden" name="current_view" value="archived">
    </div>
    <button type="submit" class="btn btn-primary mb-2 btn btn-success">Search</button>&nbsp
</form>
<?php if(isset($msg)) echo $msg; ?>
<table class="table-striped">
    <?php
    echo '<tr>';
    echo '<th>' . 'Client ID' . '</th>' .
        '<th>' . 'Company Name' . '</th>' .
        '<th>' . 'Business Number' . '</th>' .
        '<th>' . 'Contact\'s First Name' . '</th>' .
        '<th>' . 'Contact\'s Last Name' . '</th>' .
        '<th>' . 'Phone Number' . '</th>' .
        '<th>' . 'Cellphone Number' . '</th>' .
        '<th>' . 'Website' . '</th>' .
        '<th>' . 'Status' . '</th>' .
        '<th colspan="2" class="colspanCenter">' . 'Actions' . '</th>';
    echo '</tr>';
    echo '<tr>';
    if(is_array($statements)){
        foreach ($statements as $row){
            echo '<td>'.$row['client_id'].'</td>';
            echo '<td>'.$row['company_name'].'</td>';
            echo '<td>'.$row['business_number'].'</td>';
            echo '<td>'.$row['first_name'].'</td>';
            echo '<td>'.$row['last_name'].'</td>';
            echo '<td>'.$row['phone_number'].'</td>';
            echo '<td>'.$row['cellphone'].'</td>';
            echo '<td>'.$row['website'].'</td>';
            echo '<td>'.$row['status'].'</td>';
            echo '<td class="actions"><a href="?page=clients&action=activate&id=' . $row['client_id'] . '">Activate</td>';
            echo '<td class="actions"><a href="?page=clients&action=update&id=' . $row['client_id'] . '">Update</td>';
            echo '</tr>';
        }
    }
    else{
        echo $statements;
    }
    ?>
</table>
<?php } ?>

<?php function updateClients($statements = null, $fields = null, $errors = null){?>
<h1>Update client</h1>
<br>
<?php if (is_array($statements)) : ?>
    <form method="post" action="?page=clients&action=doUpdate">
        <div class="form-group col-md-3">
            <h5>Client ID: <?php echo $fields[0]; ?></h5>
            <input type="hidden" class="form-control" id="id" name="id" 
            value="<?php echo $fields[0]; ?>">
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="companyName">Company Name</label><span class="required_field"> *</span>
                <input type="text" class="form-control" id="companyName" placeholder="ABC Company" name="company_name" value="<?php echo $fields[1]; ?>">
                <span class="warning_error"><?php
                    $field_name = 'company';
                    if(!empty($errors)) : echo has_error($field_name, $errors); endif;?>
                </span>
            </div>
            <div class="form-group col-md-6">
                <label for="businessNumber">Business Number</label><span class="required_field"> *</span>
                <input type="text" class="form-control" id="businessNumber" placeholder="112346789MM0001" name="business_number" value="<?php echo $fields[2]; ?>">
                <span class="warning_error"><?php
                    $field_name = 'business';
                    if(!empty($errors)) : echo has_error($field_name, $errors); endif;?>
                </span>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="contFirstName">Contact's First Name</label><span class="required_field"> *</span>
                <input type="text" class="form-control" id="contFirstName" placeholder="Contact's First Name" name="first_name" value="<?php echo $fields[3]; ?>">
                <span class="warning_error"><?php
                    $field_name = 'first';
                    if(!empty($errors)) : echo has_error($field_name, $errors); endif;?>
                </span>
            </div>
            <div class="form-group col-md-6">
                <label for="contLastName">Contact's Last Name</label><span class="required_field"> *</span>
                <input type="text" class="form-control" id="contLastName" placeholder="Contact's Last Name" name="last_name" value="<?php echo $fields[4]; ?>">
                <span class="warning_error"><?php
                    $field_name = 'last';
                    if(!empty($errors)) : echo has_error($field_name, $errors); endif;?>
                </span>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="phone">Phone Number</label><span class="required_field"> *</span>
                <input type="text" class="form-control" id="phone" placeholder="(999)999-999-9999" name="phone" value="<?php echo $fields[5]; ?>">
                <span class="warning_error"><?php
                    $field_name = 'phone';
                    if(!empty($errors)) : echo has_error($field_name, $errors); endif;?>
                </span>
            </div>
            <div class="form-group col-md-6">
                <label for="cellPhone">Cell Phone Number</label><span class="required_field"> *</span>
                <input type="text" class="form-control" id="cellPhone" placeholder="(999)999-999-9999" name="cellphone" value="<?php echo $fields[6]; ?>">
                <span class="warning_error"><?php
                    $field_name = 'cellphone';
                    if(!empty($errors)) : echo has_error($field_name, $errors); endif;?>
                </span>
            </div>
        </div>
        <div class="form-group">
            <label for="website">Website</label>
            <input type="text" class="form-control" id="website" placeholder="http://www.companyswebsite.ca" name="website" value="<?php echo $fields[7]; ?>">
            <span class="warning_error"><?php
                $field_name = 'website.';
                if(!empty($errors)) : echo has_error($field_name, $errors); endif;?>
            </span>
        </div>
        <input type="hidden" name="client_status" value="<?php echo $fields[8]; ?>">
        <button type="submit" class="btn btn-primary" name="submit" value="save">Update Client</button>
    </form>
    <?php
    $action = '';
    if($fields[8] == 'active'){
        $action = 'viewActiveClients';
    }
    elseif($fields[8] == 'archived'){
        $action = 'viewArchivedClients';
    }
    ?>
    <form method="post" action="?page=clients&action=<?php echo $action ?>">
        <button type="submit" class="btn btn-danger" name="cancel" value="cancel">Cancel</button>
    </form>
    <br>
    <p class="required_field">* Required fields</p>
<?php else : ?>
    <h1>Cannot find the client</h1>
<?php endif; ?>
<?php } ?>

<?php function activeEvents($msg = null, $statements = null){?>
<h1>Active Events</h1>
<br>
<form method="post" action="?page=events&action=viewActiveEvents" class="clear_search_button">
    <button type="submit" class="btn btn-primary mb-2 btn btn-danger" name="cancel" value="Cancel">Clear Search</button>
</form>
<form class="form-inline search_button" method="post" action="?page=events&action=search">
    <label class="sr-only" for="search_box">Search box</label>
    <div class="input-group mb-2 mr-sm-2">
        <input type="text" class="form-control" id="search_box" name="search" size="20" placeholder="search by any field">
        <input type="hidden" name="current_view" value="active">
    </div>
    <button type="submit" class="btn btn-primary mb-2 btn btn-success">Search</button>&nbsp
</form>
<?php if(isset($msg)) echo $msg; ?>
<table class="table-striped">
    <?php
    echo '<tr>';
    echo '<th>' . 'Event ID' . '</th>' .
        '<th>' . 'Client ID' . '</th>' .
        '<th>' . 'Client name' . '</th>' .
        '<th>' . 'Notification ID' . '</th>' .
        '<th>' . 'Notification name' . '</th>' .
        '<th>' . 'Notification type' . '</th>' .
        '<th>' . 'Event frequency in days' . '</th>' .
        '<th>' . 'Start date' . '</th>' .
        '<th>' . 'Event Status' . '</th>' .
        '<th colspan="2" class="colspanCenter">' . 'Actions' . '</th>';
    echo '</tr>';
    echo '<tr>';
    if(is_array($statements)){
        foreach ($statements as $row){
            echo '<td>'.$row['event_id'].'</td>';
            echo '<td>'.$row['client_id'].'</td>';
            echo '<td>'.$row['company_name'].'</td>';
            echo '<td>'.$row['notification_id'].'</td>';
            echo '<td>'.$row['notification_name'].'</td>';
            echo '<td>'.$row['notification_type'].'</td>';
            echo '<td>'.$row['event_frequency'].'</td>';
            echo '<td>'.$row['event_start_date'].'</td>';
            echo '<td>'.$row['event_status'].'</td>';
            echo '<td class="actions"><a href="?page=events&action=archive&id=' . $row['event_id'] . '">Archive</td>';
            echo '<td class="actions"><a href="?page=events&action=update&id=' . $row['event_id'] . '">Update</td>';
            echo '</tr>';
        }
    }
    else{
        echo $statements;
    }
    ?>
</table>
<?php } ?>

<?php function addEvent($statements_clients, $statements_notifications, $errors = null, $msg = null){?>
<h1>Create new event</h1>
<form method="post" action="?page=events&action=save">
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="exampleFormControlSelect1">Select Client (Id, Company name)</label><span class="required_field"> *</span>
            <select class="form-control" id="exampleFormControlSelect1" name="client">
                <?php
                if(is_array($statements_clients)){
                    foreach ($statements_clients as $row) {
                        if (isset($row[status]) && $row[status] == 'active') {
                            $option_client = $row[client_id] . ', ' . $row[company_name];
                            echo '<option>' . $option_client . '</option>';
                        }
                    }
                }
                else{
                    $msg_client = "There is no active clients to display.";
                }
                ?>
            </select>
            <span class="warning_error">
                <?php
                    $field_name = 'client';
                    if(!empty($errors)) : echo has_error($field_name, $errors); endif;
                    if(isset($msg_client)) : echo $msg; endif;
                    ?>
            </span>
        </div>
        <div class="form-group col-md-6">
            <label for="exampleFormControlSelect1">Select Notification (Id, Notification name, Type)</label><span
                    class="required_field"> *</span>
            <select class="form-control" id="exampleFormControlSelect1" name="notification">
                <?php
                if(is_array($statements_notifications)){
                    foreach ($statements_notifications as $row) {
                        if (isset($row[notification_status]) && $row[notification_status] == 'active') {
                            $option_client = $row[notification_id] . ', ' . $row[notification_name]. ', ' . $row[notification_type];
                            echo '<option>' . $option_client . '</option>';
                        }
                    }
                }
                else{
                    $msg_notification = "There is no active notifications to display.";
                }
                ?>
            </select>
            <span class="warning_error"><?php
                $field_name = 'notification';
                if(!empty($errors)) : echo has_error($field_name, $errors); endif;
                if(isset($msg_notification)) : echo $msg_notification; endif;
                ?>
            </span>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="notificationName">Inform the frequency in days (only integers allowed)</label><span
                    class="required_field"> *</span>
            <input type="text" class="form-control" id="notificationName" placeholder="" name="frequency">
            <span class="warning_error"><?php
                $field_name = 'frequency.';
                if(!empty($errors)) : echo has_error($field_name, $errors); endif;?>
            </span>
        </div>
        <div class="form-group col-md-6">
            <label for="notificationName">Starting from</label><span class="required_field"> *</span>
            <input type="date" class="form-control" id="notificationName" placeholder="" name="starting_from">
            <span class="warning_error"><?php
                $field_name = 'date.';
                if(!empty($errors)) : echo has_error($field_name, $errors); endif;?>
            </span>
        </div>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="event_status" id="active" value="active" checked>
        <label class="form-check-label" for="sms">Active</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="event_status" id="archived" value="archived">
        <label class="form-check-label" for="email">Archive</label>
        <span class="warning_error"><?php
            $field_name = 'status';
            if(!empty($errors)) : echo has_error($field_name, $errors); endif;?>
        </span>
    </div>
    <br><br>
    <button type="submit" class="btn btn-primary" name="submit" value="save">Create notification</button>
</form>
<br>
<p class="required_field">* Required fields</p>
<?php } ?>

<?php function archivedEvents($msg = null, $statements = null){?>
<h1>Archived Events</h1>
<br>
<form method="post" action="?page=events&action=viewArchivedEvents" class="clear_search_button">
    <button type="submit" class="btn btn-primary mb-2 btn btn-danger" name="cancel" value="Cancel">Clear Search</button>
</form>
<form class="form-inline search_button" method="post" action="?page=events&action=search">
    <label class="sr-only" for="search_box">Search box</label>
    <div class="input-group mb-2 mr-sm-2">
        <input type="text" class="form-control" id="search_box" name="search" size="20" placeholder="search by any field">
        <input type="hidden" name="current_view" value="archived">
    </div>
    <button type="submit" class="btn btn-primary mb-2 btn btn-success">Search</button>&nbsp
</form>
<?php if(isset($msg)) echo $msg; ?>
<table class="table-striped">
    <?php
    echo '<tr>';
    echo '<th>' . 'Event ID' . '</th>' .
        '<th>' . 'Client ID' . '</th>' .
        '<th>' . 'Client name' . '</th>' .
        '<th>' . 'Notification ID' . '</th>' .
        '<th>' . 'Notification name' . '</th>' .
        '<th>' . 'Notification type' . '</th>' .
        '<th>' . 'Event frequency in days' . '</th>' .
        '<th>' . 'Start date' . '</th>' .
        '<th>' . 'Event Status' . '</th>' .
        '<th colspan="2" class="colspanCenter">' . 'Actions' . '</th>';
    echo '</tr>';
    echo '<tr>';
    if(is_array($statements)){
        foreach ($statements as $row){
            echo '<td>'.$row['event_id'].'</td>';
            echo '<td>'.$row['client_id'].'</td>';
            echo '<td>'.$row['company_name'].'</td>';
            echo '<td>'.$row['notification_id'].'</td>';
            echo '<td>'.$row['notification_name'].'</td>';
            echo '<td>'.$row['notification_type'].'</td>';
            echo '<td>'.$row['event_frequency'].'</td>';
            echo '<td>'.$row['event_start_date'].'</td>';
            echo '<td>'.$row['event_status'].'</td>';
            echo '<td class="actions"><a href="?page=events&action=activate&id=' . $row['event_id'] . '">Activate</td>';
            echo '<td class="actions"><a href="?page=events&action=update&id=' . $row['event_id'] . '">Update</td>';
            echo '</tr>';
        }
    }
    else{
        echo $statements;
    }
    ?>
</table>
<?php } ?>

<?php function updateEvent($statements_current_event, $fields, $statements_clients, $statements_notifications){?>
<h1>Update event</h1>
<br>
<?php if (is_array($statements_current_event)) : ?>
    <table class="table-bordered">
        <h5>Event to update</h5>
        <?php
        echo '<tr>';
        echo '<th>' . 'Event ID' . '</th>' .
            '<th>' . 'Client ID' . '</th>' .
            '<th>' . 'Client name' . '</th>' .
            '<th>' . 'Notification ID' . '</th>' .
            '<th>' . 'Notification name' . '</th>' .
            '<th>' . 'Notification type' . '</th>' .
            '<th>' . 'Event frequency in days' . '</th>' .
            '<th>' . 'Start date' . '</th>' .
            '<th>' . 'Event Status' . '</th>';
        echo '</tr>';
        echo '<tr>';
        foreach ($fields as $field) {
                echo '<td>' . $field . '</td>';  
        }
        echo '</tr>';
        ?>
    </table>
    <br><br>
    <h5>New information to select</h5>
    <form method="post" action="?page=events&action=doUpdate">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="exampleFormControlSelect1">Select Client (Id, Company name)</label><span
                        class="required_field"> *</span>
                <select class="form-control" id="exampleFormControlSelect1" name="client">
                    <?php
                    if(is_array($statements_clients)){
                        foreach ($statements_clients as $row) {
                            if (isset($row[status]) && $row[status] == 'active') {
                                $option_client = $row[client_id] . ', ' . $row[company_name];
                                if($row[client_id] == $fields[1]){
                                    echo '<option selected>' . $option_client . '</option>';
                                }
                                else{
                                    echo '<option>' . $option_client . '</option>';
                                }
                            }
                        }
                    }
                    else{
                        $msg_client = "There is no active clients to display.";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="exampleFormControlSelect1">Select Notification (Id, Notification name, Type)</label><span
                        class="required_field"> *</span>
                <select class="form-control" id="exampleFormControlSelect1" name="notification">
                    <?php
                    if(is_array($statements_notifications)){
                        foreach ($statements_notifications as $row) {
                            if (isset($row[notification_status]) && $row[notification_status] == 'active') {
                                $option_notification = $row[notification_id] . ', ' . $row[notification_name]. ', ' . $row[notification_type];
                                if($row[notification_id] == $fields[3]){
                                    echo '<option selected>' . $option_notification . '</option>';
                                }
                                echo '<option>' . $option_notification . '</option>';
                            }
                        }
                    }
                    else{
                        $$msg_client = "There is no active clients to display.";
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="notificationName">Inform the frequency in days (only integers allowed)</label><span class="required_field"> *</span>
                <input type="text" class="form-control" id="notificationName" placeholder="" name="frequency" value="<?php echo $fields[6] ?>">
            </div>
            <div class="form-group col-md-3">
                <label for="notificationName">Starting from</label><span class="required_field"> *</span>
                <input type="date" class="form-control" id="notificationName" placeholder="" name="starting_from" value="<?php echo $fields[7] ?>">
            </div>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="event_status" id="active" value="active" <?php if($fields[8] == 'active') : echo 'checked'; endif; ?>>
            <label class="form-check-label" for="sms">Active</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="event_status" id="archived" value="archived" <?php if($fields[8] == 'archived') : echo 'checked'; endif; ?>>
            <label class="form-check-label" for="email">Archive</label>
        </div>
        <input type="hidden" name="id" value="<?php echo $fields[0]; ?>">

        <br><br>
        <button type="submit" class="btn btn-primary" name="submit" value="save">Update notification</button>
    </form>
    <?php
    $action = '';
    if($fields[8] == 'active'){
        $action = 'viewActiveEvents';
    }
    elseif($fields[8] == 'archived'){
        $action = 'viewArchivedEvents';
    }
    ?>
    <form method="post" action="?page=events&action=<?php echo $action ?>">
        <button type="submit" class="btn btn-danger" name="cancel" value="Cancel">Cancel</button>
    </form>
    <br>
    <p class="required_field">* Required fields</p>
<?php else : ?>
    <h1>Cannot find the notification</h1>
<?php endif; ?>
<?php } ?>

<?php function activeNotifications($msg = null, $statements = null){?>
<h1>Active Notifications</h1>
<br>
<form method="post" action="?page=notifications&action=viewActiveNotifications" class="clear_search_button">
    <button type="submit" class="btn btn-primary mb-2 btn btn-danger" name="cancel" value="Cancel">Clear Search</button>
</form>
<form class="form-inline search_button" method="post" action="?page=notifications&action=search">
    <label class="sr-only" for="search_box">Search box</label>
    <div class="input-group mb-2 mr-sm-2">
        <input type="text" class="form-control" id="search_box" name="search" size="20" placeholder="search by any field">
        <input type="hidden" name="current_view" value="active">
    </div>
    <button type="submit" class="btn btn-primary mb-2 btn btn-success">Search</button>&nbsp
</form>
<?php if(isset($msg)) echo $msg; ?>
<table class="table-striped">
    <?php
    echo '<tr>';
    echo '<th>' . 'Notification ID' . '</th>' .
        '<th>' . 'Notification Name' . '</th>' .
        '<th>' . 'Type' . '</th>' .
        '<th>' . 'Status' . '</th>' .
        '<th colspan="2" class="colspanCenter">' . 'Actions' . '</th>';
    echo '</tr>';
    echo '<tr>';
    if(is_array($statements)){
        foreach ($statements as $row){
            echo '<td>'.$row['notification_id'].'</td>';
            echo '<td>'.$row['notification_name'].'</td>';
            echo '<td>'.$row['notification_type'].'</td>';
            echo '<td>'.$row['notification_status'].'</td>';
            echo '<td class="actions"><a href="?page=notifications&action=archive&id=' . $row['notification_id'] . '">Archive</td>';
            echo '<td class="actions"><a href="?page=notifications&action=update&id=' . $row['notification_id'] . '">Update</td>';
            echo '</tr>';
        }
    }
    else{
        echo $statements;
    }
    ?>
</table>
<?php } ?>

<?php function addNotification($passed_validation = null){?>
<h1>Create new notification</h1>
<form method="post" action="?page=notifications&action=save">
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="notificationName">Notification Name</label><span class="required_field"> *</span>
            <input type="text" class="form-control" id="notificationName" placeholder="" name="notification_name" required>
            <span class="warning_error">
                <?php
                if (isset($passed_validation) && !$passed_validation) : echo 'Please provide a notification name';
                endif; ?>
            </span>
        </div>
    </div>
    <div class="form-group col-md-3 checkboxes">
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="notification_type" id="sms" value="sms" checked>
            <label class="form-check-label" for="sms">SMS</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="notification_type" id="email" value="email">
            <label class="form-check-label" for="email">Email</label>
        </div>
    </div>

    <div class="form-group col-md-3 checkboxes">
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="notification_status" value="active" id="active" checked>
            <label class="form-check-label" for="active">
                Active
            </label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="notification_status" value="archived" id="archive">
            <label class="form-check-label" for="archive">
                Archive
            </label>
        </div>
    </div>
    
    <br><br>
    <button type="submit" class="btn btn-primary" name="submit" value="save">Create notification</button>
</form>
<br>
<p class="required_field">* Required fields</p>
<?php } ?>

<?php function archivedNotifications($msg = null, $statements = null){?>
<h1>Archived Notifications</h1>
<br>
<form method="post" action="?page=notifications&action=viewArchivedNotifications" class="clear_search_button">
    <button type="submit" class="btn btn-primary mb-2 btn btn-danger" name="cancel" value="Cancel">Clear Search</button>
</form>
<form class="form-inline search_button" method="post" action="?page=notifications&action=search">
    <label class="sr-only" for="search_box">Search box</label>
    <div class="input-group mb-2 mr-sm-2">
        <input type="text" class="form-control" id="search_box" name="search" size="20" placeholder="search by any field">
        <input type="hidden" name="current_view" value="archived">
    </div>
    <button type="submit" class="btn btn-primary mb-2 btn btn-success">Search</button>&nbsp
</form>
<?php if(isset($msg)) echo $msg; ?>
<table class="table-striped">
    <?php
    echo '<tr>';
    echo '<th>' . 'Notification ID' . '</th>' .
        '<th>' . 'Notification Name' . '</th>' .
        '<th>' . 'Type' . '</th>' .
        '<th>' . 'Status' . '</th>' .
        '<th colspan="2" class="colspanCenter">' . 'Actions' . '</th>';
    echo '</tr>';
    echo '<tr>';
    if(is_array($statements)){
        foreach ($statements as $row){
            echo '<td>'.$row['notification_id'].'</td>';
            echo '<td>'.$row['notification_name'].'</td>';
            echo '<td>'.$row['notification_type'].'</td>';
            echo '<td>'.$row['notification_status'].'</td>';
            echo '<td class="actions"><a href="?page=notifications&action=activate&id=' . $row['notification_id'] . '">Activate</td>';
            echo '<td class="actions"><a href="?page=notifications&action=update&id=' . $row['notification_id'] . '">Update</td>';
            echo '</tr>';
        }
    }
    else{
        echo $statements;
    }
    ?>
</table>
<?php } ?>

<?php function updateNotifications($statements, $fields){?>
<h1>Update notification</h1>
<br>
<?php if (is_array($statements)) : ?>
    <form method="post" action="?page=notifications&action=doUpdate">
        <div class="form-group col-md-3">
            <h5>Notification ID: <?php echo $fields[0]; ?></h5>
            <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $fields[0]; ?>">
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="notificationName">Notification Name</label><span class="required_field"> *</span>
                <input type="text" class="form-control" id="notificationName" name="notification_name" value="<?php echo $fields[1]; ?>">
            </div>
        </div>

        <div class="form-group col-md-2 checkboxes">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="notification_type" id="sms" value="sms" <?php if ($fields[2] == 'sms') {
                                                                                                            echo 'checked';
                                                                                                        }
                                                                                                        echo '' ?>>
                <label class="form-check-label" for="sms">SMS</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="notification_type" id="email" value="email" <?php if ($fields[2] == 'email') {
                                                                                                                echo 'checked';
                                                                                                            }
                                                                                                            echo '' ?>>
                <label class="form-check-label" for="email">Email</label>
            </div>
        </div>
        <div class="form-group col-md-2 checkboxes">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="notification_status" value="active" id="active" <?php if ($fields[3] == 'active') {
                                                                                                            echo 'checked';
                                                                                                        }
                                                                                                        echo '' ?>>
                <label class="form-check-label" for="active">Active</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="notification_status" value="archived" id="archive" <?php if ($fields[3] == 'archived') {
                                                                                                            echo 'checked';
                                                                                                        }
                                                                                                        echo '' ?>>
                <label class="form-check-label" for="archive">Archive</label>
            </div>
        </div>
        <input type="hidden" name="enable_disable" value="<?php echo $fields[3]; ?>">

        <br><br>
        <button type="submit" class="btn btn-primary" name="submit" value="save">Update notification</button>
    </form>
    <?php
        $action = '';
        if ($fields[3] == 'active') {
            $action = 'viewActiveNotifications';
        } elseif ($fields[3] == 'archived') {
            $action = 'viewArchivedNotifications';
        }
        ?>
    <form method="post" action="?page=notifications&action=<?php echo $action ?>">
        <button type="submit" class="btn btn-danger" name="cancel" value="Cancel">Cancel</button>
    </form>
    <br>
    <p class="required_field">* Required fields</p>
<?php else : ?>
    <h1>Cannot find the notification</h1>
<?php endif; ?>
<?php } ?>

<?php function home(){?>
<div class="home_page">
    <h2 >Welcome to the Notification System</h2>
    <br>
    <h3>Use the top navigation bar to manage <br> 
    <strong>Clients</strong>, 
    <strong>Notifications</strong>, 
    <strong>Notification Events</strong>, and
    <strong>Users</strong>.</h3>
</div>
<?php } ?>

<?php function activeUsers($msg = null, $statements = null){?>
<h1>Active Users</h1>
<br>
<form method="post" action="?page=users&action=viewActiveUsers" class="clear_search_button">
    <button type="submit" class="btn btn-primary mb-2 btn btn-danger" name="cancel" value="Cancel">Clear Search</button>
</form>
<form class="form-inline search_button" method="post" action="?page=users&action=search">
    <label class="sr-only" for="search_box">Search box</label>
    <div class="input-group mb-2 mr-sm-2">
        <input type="text" class="form-control" id="search_box" name="search" size="20" placeholder="search by any field">
        <input type="hidden" name="current_view" value="active">
    </div>
    <button type="submit" class="btn btn-primary mb-2 btn btn-success">Search</button>&nbsp
</form>
<?php if(isset($msg)) echo $msg; ?>
<table class="table-striped">
    <?php
    echo '<tr>';
    echo '<th>' . 'User ID' . '</th>' . 
        '<th>' . 'First Name' . '</th>' .
        '<th>' . 'Last Name' . '</th>' .
        '<th>' . 'Email' . '</th>' .
        '<th>' . 'Cellphone' . '</th>' .
        '<th>' . 'Position' . '</th>' .
        '<th>' . 'Username' . '</th>' .
        '<th>' . 'Status' . '</th>' .
        '<th>' . 'Picture' . '</th>' .
        '<th colspan="2" class="colspanCenter">' . 'Actions' . '</th>';
    echo '</tr>';
    echo '<tr>';
    if(is_array($statements)){
        foreach ($statements as $row){
            echo '<td>'.$row['user_id'].'</td>';
            echo '<td>'.$row['user_Fname'].'</td>';
            echo '<td>'.$row['user_Lname'].'</td>';
            echo '<td>'.$row['user_email'].'</td>';
            echo '<td>'.$row['user_cellphone'].'</td>';
            echo '<td>'.$row['user_position'].'</td>';
            echo '<td>'.$row['username'].'</td>';
            echo '<td>'.$row['user_status'].'</td>';
            echo '<td>'.$row['user_picture'].'</td>';
            echo '<td class="actions"><a href="?page=users&action=archive&id=' . $row['user_id'] . '">Archive</td>';
            echo '<td class="actions"><a href="?page=users&action=update&id=' . $row['user_id'] . '">Update</td>';
            echo '</tr>';
        }
    }
    else{
        echo $statements;
    }
    ?>
</table>
<?php } ?>

<?php function archivedUsers($msg = null, $statements = null){?>
<h1>Archived Users</h1>
<br>
<form method="post" action="?page=users&action=viewArchivedUsers" class="clear_search_button">
    <button type="submit" class="btn btn-primary mb-2 btn btn-danger" name="cancel" value="Cancel">Clear Search</button>
</form>
<form class="form-inline search_button" method="post" action="?page=users&action=search">
    <label class="sr-only" for="search_box">Search box</label>
    <div class="input-group mb-2 mr-sm-2">
        <input type="text" class="form-control" id="search_box" name="search" size="20" placeholder="search by any field">
        <input type="hidden" name="current_view" value="archived">
    </div>
    <button type="submit" class="btn btn-primary mb-2 btn btn-success">Search</button>&nbsp
</form>
<?php if(isset($msg)) echo $msg; ?>
<table class="table-striped">
    <?php
    echo '<tr>';
    echo '<th>' . 'User ID' . '</th>' . 
        '<th>' . 'First Name' . '</th>' .
        '<th>' . 'Last Name' . '</th>' .
        '<th>' . 'Email' . '</th>' .
        '<th>' . 'Cellphone' . '</th>' .
        '<th>' . 'Position' . '</th>' .
        '<th>' . 'Username' . '</th>' .
        '<th>' . 'Status' . '</th>' .
        '<th>' . 'Picture' . '</th>' .
        '<th colspan="2" class="colspanCenter">' . 'Actions' . '</th>';
    echo '</tr>';
    echo '<tr>';
    if(is_array($statements)){
        foreach ($statements as $row){
            echo '<td>'.$row['user_id'].'</td>';
            echo '<td>'.$row['user_Fname'].'</td>';
            echo '<td>'.$row['user_Lname'].'</td>';
            echo '<td>'.$row['user_email'].'</td>';
            echo '<td>'.$row['user_cellphone'].'</td>';
            echo '<td>'.$row['user_position'].'</td>';
            echo '<td>'.$row['username'].'</td>';
            echo '<td>'.$row['user_status'].'</td>';
            echo '<td>'.$row['user_picture'].'</td>';
            echo '<td class="actions"><a href="?page=users&action=activate&id=' . $row['user_id'] . '">Activate</td>';
            echo '<td class="actions"><a href="?page=users&action=update&id=' . $row['user_id'] . '">Update</td>';
            echo '</tr>';
        }
    }
    else{
        echo $statements;
    }
    ?>
</table>
<?php } ?>

<?php function updateUser($statements = null, $fields = null, $errors = null){?>
<h1>Add User</h1>
    <br>
<?php if (is_array($statements)) : ?>
    <form method="post" action="?page=users&action=doUpdate">
    <div class="form-group col-md-3">
            <h5>User ID: <?php echo $fields[0]; ?></h5>
            <input type="hidden" class="form-control" id="id" name="id" 
            value="<?php echo $fields[0]; ?>">
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="user_Fname">First Name</label><span class="required_field"> *</span>
                <input type="text" class="form-control" id="user_Fname" placeholder="First Name" 
                    name="user_Fname" <?php if (!empty($errors)) {
                                                echo 'value="' . $data['user_Fname'] . '"';
                                            }?> value="<?php echo $fields[1]; ?>">
                <span class="warning_error"><?php
                                            $field_name = 'first';
                                            if (!empty($errors)) : echo has_error($field_name, $errors);
                                            endif; ?>
                </span>
            </div>
            <div class="form-group col-md-6">
                <label for="user_Lname">Last Name</label><span class="required_field"> *</span>
                <input type="text" class="form-control" id="user_Lname" placeholder="Last Name" 
                    name="user_Lname" <?php if (!empty($errors)) {
                                                echo 'value="' . $data['user_Lname'] . '"';
                                            }?> value="<?php echo $fields[2]; ?>">
                <span class="warning_error"><?php
                                            $field_name = 'last';
                                            if (!empty($errors)) : echo has_error($field_name, $errors);
                                            endif; ?>
                </span>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="user_email">Email</label><span class="required_field"> *</span>
                <input type="text" class="form-control" id="user_email" placeholder="Email" 
                    name="user_email" <?php if (!empty($errors)) {
                                                echo 'value="' . $data['user_email'] . '"';
                                            }?> value="<?php echo $fields[3]; ?>">
                <span class="warning_error"><?php
                                            $field_name = 'email.';
                                            if (!empty($errors)) : echo has_error($field_name, $errors);
                                            endif; ?>
                </span>
            </div>
            <div class="form-group col-md-6">
                <label for="user_cellphone">Cellphone Number</label><span class="required_field"> *</span>
                <input type="text" class="form-control" id="user_cellphone" placeholder="999-999-9999" 
                    name="user_cellphone" <?php if (!empty($errors)) {
                                                    echo 'value="' . $data['user_cellphone'] . '"';
                                                }?> value="<?php echo $fields[4]; ?>">
                <span class="warning_error"><?php
                                            $field_name = 'cellphone.';
                                            if (!empty($errors)) : echo has_error($field_name, $errors);
                                            endif; ?>
                </span>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="user_position">Position</label><span class="required_field"> *</span>
                <select type="" class="form-control" id="user_position" name="user_position" <?php
                                                                                    if (!empty($errors)) {
                                                                                        echo 'value="' . $data['user_position'] . '"';
                                                                                    }
                                                                                    ?> >
                    <option <?php if($fields[5] == "Manager") : echo "selected"; endif; ?> value="Manager">Manager</option>
                    <option <?php if($fields[5] == "Senior Accountant") : echo "selected"; endif; ?> value="Senior Accountant">Senior Accountant</option>
                    <option <?php if($fields[5] == "Junior Accountant") : echo "selected"; endif; ?> value="Junior Accountant">Junior Accountant</option>
                    <option <?php if($fields[5] == "Chartered Accountant") : echo "selected"; endif; ?> value="Chartered Accountant">Chartered Accountant</option>
                    <option <?php if($fields[5] == "Book Keeper") : echo "selected"; endif; ?> value="Book Keeper">Book Keeper</option>
    
                    <span class="warning_error">
                        <?php
                        $field_name = 'position.';
                        if (!empty($errors)) : echo has_error($field_name, $errors);
                        endif; ?>
                    </span>
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="username">Username</label><span class="required_field"> *</span>
                <input type="text" class="form-control" id="username" placeholder="username" 
                    name="username" <?php if (!empty($errors)) {
                                                echo 'value="' . $data['username'] . '"';
                                            }?> value="<?php echo $fields[6]; ?>">
                <span class="warning_error"><?php
                                            $field_name = 'username.';
                                            if (!empty($errors)) : echo has_error($field_name, $errors);
                                            endif; ?>
                </span>
            </div>
            <div class="form-group col-md-6">
                <label for="password">Password</label><span class="required_field"> *</span>
                <input type="password" class="form-control" id="password" 
                    name="password" <?php if (!empty($errors)) {
                                                    echo 'value="' . $data['password'] . '"';
                                                }?> value="<?php echo $fields[7]; ?>">
                <span class="warning_error"><?php
                                            $field_name = 'password.';
                                            if (!empty($errors)) : echo has_error($field_name, $errors);
                                            endif; ?>
                </span>
            </div>
        </div>
        <div class="form-row">
            <div class="form-row col-md-3">
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="user_status" name="user_status" class="custom-control-input" value="active" <?php if($fields[8] == 'active') : echo 'checked'; endif; ?>>
                    <label class="custom-control-label" for="user_status">Active</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="user_status" name="user_status" class="custom-control-input" value="archived" <?php if($fields[8] == 'archived') : echo 'checked'; endif; ?>>
                    <label class="custom-control-label" for="user_status">Archived</label>
                </div>
            </div>
            <div class="col-md-1">User picture:</div>
            <div class="custom-file form-group col-md-3">
                <input type="file" class="custom-file-input" id="user_picture" value="<?php echo $fields[9]; ?>">
                <label class="custom-file-label" for="user_picture">Choose an image file...</label>
            </div>
        </div>
        <br>
        <button type="submit" class="btn btn-primary" name="submit" value="save">Save</button>
        <input type="reset" class="btn btn-danger" value="Reset">
    </form>
    <br>
    <p class="required_field">* Required fields</p>
<?php else : ?>
    <h1>Cannot find the user</h1>
<?php endif; ?>
<?php } ?>

<?php function addUser($data = null, $errors = null){?>
<h1>Add User</h1>
<form method="post" action="?page=users&action=save">
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="user_Fname">First Name</label><span class="required_field"> *</span>
            <input type="text" class="form-control" id="user_Fname" placeholder="First Name" 
                name="user_Fname" <?php if (!empty($errors)) {
                                            echo 'value="' . $data['user_Fname'] . '"';
                                        }?> >
            <span class="warning_error"><?php
                                        $field_name = 'first';
                                        if (!empty($errors)) : echo has_error($field_name, $errors);
                                        endif; ?>
            </span>
        </div>
        <div class="form-group col-md-6">
            <label for="user_Lname">Last Name</label><span class="required_field"> *</span>
            <input type="text" class="form-control" id="user_Lname" placeholder="Last Name" 
                name="user_Lname" <?php if (!empty($errors)) {
                                            echo 'value="' . $data['user_Lname'] . '"';
                                        }?> >
            <span class="warning_error"><?php
                                        $field_name = 'last';
                                        if (!empty($errors)) : echo has_error($field_name, $errors);
                                        endif; ?>
            </span>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="user_email">Email</label><span class="required_field"> *</span>
            <input type="text" class="form-control" id="user_email" placeholder="Email" 
                name="user_email" <?php if (!empty($errors)) {
                                            echo 'value="' . $data['user_email'] . '"';
                                        }?> >
            <span class="warning_error"><?php
                                        $field_name = 'email.';
                                        if (!empty($errors)) : echo has_error($field_name, $errors);
                                        endif; ?>
            </span>
        </div>
        <div class="form-group col-md-6">
            <label for="user_cellphone">Cellphone Number</label><span class="required_field"> *</span>
            <input type="text" class="form-control" id="user_cellphone" placeholder="999-999-9999" 
                name="user_cellphone" <?php if (!empty($errors)) {
                                                echo 'value="' . $data['user_cellphone'] . '"';
                                            }?> >
            <span class="warning_error"><?php
                                        $field_name = 'cellphone.';
                                        if (!empty($errors)) : echo has_error($field_name, $errors);
                                        endif; ?>
            </span>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="user_position">Position</label><span class="required_field"> *</span>
            <select type="" class="form-control" id="user_position" name="user_position" <?php
                                                                                if (!empty($errors)) {
                                                                                    echo 'value="' . $data['user_position'] . '"';
                                                                                }
                                                                                ?> >
                <option value="Manager">Manager</option>
                <option value="Senior Accountant">Senior Accountant</option>
                <option value="Junior Accountant">Junior Accountant</option>
                <option value="Chartered Accountant">Chartered Accountant</option>
                <option value="Book Keeper">Book Keeper</option>

                <span class="warning_error">
                    <?php
                    $field_name = 'position.';
                    if (!empty($errors)) : echo has_error($field_name, $errors);
                    endif; ?>
                </span>
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="username">Username</label><span class="required_field"> *</span>
            <input type="text" class="form-control" id="username" placeholder="username" 
                name="username" <?php if (!empty($errors)) {
                                            echo 'value="' . $data['username'] . '"';
                                        }?> >
            <span class="warning_error"><?php
                                        $field_name = 'username.';
                                        if (!empty($errors)) : echo has_error($field_name, $errors);
                                        endif; ?>
            </span>
        </div>
        <div class="form-group col-md-6">
            <label for="password">Password</label><span class="required_field"> *</span>
            <input type="password" class="form-control" id="password" 
                name="password" <?php if (!empty($errors)) {
                                                echo 'value="' . $data['password'] . '"';
                                            }?> >
            <span class="warning_error"><?php
                                        $field_name = 'password.';
                                        if (!empty($errors)) : echo has_error($field_name, $errors);
                                        endif; ?>
            </span>
        </div>
    </div>
    <div class="form-row">
        <div class="form-row col-md-3">
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="user_status" name="user_status" class="custom-control-input" value="active" checked>
                <label class="custom-control-label" for="user_status">Active</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="user_status" name="user_status" class="custom-control-input" value="archived">
                <label class="custom-control-label" for="user_status">Archived</label>
            </div>
        </div>
        <div class="col-md-1">User picture:</div>
        <div class="custom-file form-group col-md-3">
            <input type="file" class="custom-file-input" id="user_picture">
            <label class="custom-file-label" for="user_picture">Choose an image file...</label>
        </div>
    </div>
    <br>
    <button type="submit" class="btn btn-primary" name="submit" value="save">Save</button>
    <input type="reset" class="btn btn-danger" value="Reset">
</form>
<br>
<p class="required_field">* Required fields</p>
<?php } ?>

<?php echo "<a href='/folder_view/vs.php?s=" . __FILE__ . "' target='_blank'>View Source: functions.php</a> | ";
