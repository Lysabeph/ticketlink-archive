<?php
// Basic logout page using Session Management
require_once "php-bin/SessionFunctions.php";

expire_session(get_session_user_id());
header("Location: .");
?>



