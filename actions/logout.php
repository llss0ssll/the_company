<?php

include "../classes/user.php";

// create object / instantiate
$user_obj= new User;
$user_obj -> logout($_POST);

?>