<?php
include "../classes/User.php";

// creat object or instatiate
$user_obj = new User;
$user_obj -> store($_POST);
//$_POST contain all calues of the input

?>
