<?php
// CONNECTION TO RUN AT LOCALHOST
$db_conn = mysqli_connect('localhost', 'root', '', 'notification_system');

// CONNECTION TO RUN ON GBLEARN SERVER
//$db_conn = mysqli_connect('gblearn.com', 'f9202754', 'GBC84586Ras', 'f9202754_mydb');

//2. validation
if(mysqli_connect_errno() > 0){
    die('cannot connect to database'. mysqli_connect_error());
}