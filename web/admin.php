<?php
    session_start();

?>


<?php


$conn = pg_connect(getenv("DATABASE_URL"));

if (!isset($_SESSION['id'])){
    echo "not logged in";
}

echo "<p>Logged in as: {$_SESSION['id']}</p>";
//get user info
//$result = pg_query($conn, "SELECT id FROM users");

/*$result = pg_prepare($conn, "fetchRequestedUser", 'SELECT * FROM users WHERE id = $1');
$uid = (int)$_GET['id'];
$result = pg_execute($conn, "fetchRequestedUser", array($uid));
*/

//$all = pg_query($conn, "SELECT * FROM users");

//echo $result;


//echo $result['id'];

if ($_SESSION['id'] == 999){
  echo "Hello Admin";

}
else {
  echo "not admin";





//  header('Location: /login');
}

 /*<!DOCTYPE html>
<html>
<head>
    <?php require_once("./views/header.html"); ?>
</head>


<body>
<?php require_once("./views/nav.html") ?>;

<html xmlns:th="http://www.thymeleaf.org" th:replace="~{fragments/layout :: layout (~{::body},'profile')}">
<body>
  <div class="jumbotron text-center">
    <div class="container">
      <h1>Bear Link</h1>



<?php
$conn = pg_connect(getenv("DATABASE_URL"));


session_start();
if (!isset($_SESSION['id'])){
    echo "not logged in";
}

echo "<p>Logged in as: {$_SESSION['id']}</p>";
//get user info

if(!(array_key_exists('id', $_GET))){
    $_GET['id'] = $_SESSION['id'];
}
/*
$result = pg_prepare($conn, "fetchRequestedUser", 'SELECT * FROM users WHERE id = $1');
$uid = (int)$_GET['id'];
$result = pg_execute($conn, "fetchRequestedUser", array($uid));
*/
?>
