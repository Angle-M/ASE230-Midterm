<?php
session_start();
//unsets the session without destroying
unset($_SESSION['logged']);
unset($_SESSION['logged_user']);
// redirect the user to the public page.
header('location:../authors/index.php');
