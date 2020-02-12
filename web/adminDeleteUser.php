<?php session_start(); ?>
<html>
<head><?php require_once("./views/header.html"); ?></head>
<body>
<html xmlns:th="http://www.thymeleaf.org" th:replace="~{fragments/layout :: layout (~{::body},'profile')}">
<?php require_once("./views/nav.html") ?>;




<?php
//$d = $_POST['deletedID'];
//$postid = (string)$d;

//$conn = pg_connect(getenv("DATABASE_URL"));

$conn = pg_connect(getenv("DATABASE_URL"));

if(isset($_POST['uid'])){
  $result = pg_prepare($conn, "deleteUser", 'DELETE FROM users WHERE id=$1');
  $uid = (int)$_POST['uid'];
  $result = pg_execute($conn, "deleteUser", array($uid));

echo "<p>User associated with User ID: '$uid' has been deleted</p>";
}
else {
  echo "User not deleted";
}




//pg_delete($conn, 'DELETE * FROM users WHERE id ='$d' ');


 ?>
</body>
