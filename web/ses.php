<?php

// any ini_set() for session configuration goes here when not using .user.ini

session_start();
if (!isset($_SESSION['count'])) {
    $_SESSION['count'] = 0;
}
$_SESSION['count']++;

echo "Hello #" . $_SESSION['count'];