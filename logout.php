<?php

// seesion start is required in every page
session_start();

//to destroy session variables
session_destroy();

// to go to main page
echo "<script type='text/javascript'> window.location.href='page-login.php'</script>";


?>
