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
  $result = pg_prepare($conn, "updateUser", 'UPDATE users SET first_name=$1, last_name=$2, phone=$3, email=$4 WHERE id=$5');
  $uid = (int)$_POST['uid'];
  $result = pg_execute($conn, "updateUser", array($_POST['updatefn'], $_POST['updateln'], $_POST['updatepn'],$_POST['updateemail'],$uid));

echo "<p>User associated with User ID: '$uid' has been updated</p>";
}
else {
  echo "User information not updateed";
}




//pg_delete($conn, 'DELETE * FROM users WHERE id ='$d' ');


 ?>
</body>
