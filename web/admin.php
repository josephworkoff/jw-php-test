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
    header('Location: /');
    exit();
}

<html>
<head><?php require_once("./views/header.html"); ?></head>

<body>
<?php require_once("./views/nav.html") ?>;

<html xmlns:th="http://www.thymeleaf.org" th:replace="~{fragments/layout :: layout (~{::body},'profile')}">
<body>



<form class="loginform" method="post" action="adminDeleteUser.php"
    <br><label>Enter User ID to DELETE</label><br>
    <input type="deletedID" name="deletedID" placeholder="Enter User ID"><br>

    </html>


?>
