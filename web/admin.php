<?php
    session_start();

?>
<html>
<head><?php require_once("./views/header.html"); ?></head>
<body>
  <html xmlns:th="http://www.thymeleaf.org" th:replace="~{fragments/layout :: layout (~{::body},'profile')}">
<?php require_once("./views/nav.html") ?>;
<?php


$conn = pg_connect(getenv("DATABASE_URL"));

if (!isset($_SESSION['id'])){
    echo "not logged in";
}

//echo "<p>Logged in as: {$_SESSION['id']}</p>";
?>



<?php
if ($_SESSION['id'] == 999){
  //echo "<p><center>Hello Admin</center></p>";

}
else {
    header('Location: /');
    exit();
}

?>



<form class="loginform" method="post" action="adminDeleteUser.php"
    <br><label><font color="black">Enter User ID to DELETE</font></label><br>
    <input type="text" name="uid" placeholder="Enter ID"><br>
    <br><button>Delete UserID</button><br>
  </form>

<form class="loginform" method="post" action="adminUpdateUser.php"
<br><label><font color="black">Enter User ID to UPDATE</font></label><br>
<input type="text" name="uid" placeholder="Enter ID"><br>
<!-- Function makes it so only letters are able to be entered.
-->
<script>
function lettersOnly(input){
  var regex = /[^a-z]/gi;
  input.value = input.value.replace(regex, "");
}
</script>

  <br><label>First Name</label><br>
  <input type="text" name="updatefn" placeholder="First Name" onkeyup="lettersOnly(this)"><br>
  <br><label>Last Name</label><br>
  <input type="text" name="updateln" placeholder="Last Name" onkeyup="lettersOnly(this)"><br>
  <!--
                   This function makes it so only numbers are able to be entered
                 -->
                   <script>
                   function numbersOnly(input){
                     var regex = /[^0-9,-]/g;
                     input.value = input.value.replace(regex, "");
                   }
                   </script>


  <br><label>Phone Number</label><br>
  <input type="tel" name="updatepn" placeholder="###-###-####" onkeyup="numbersOnly(this)"><br>
  <br><label>Email Address</label><br>
  <input type="email" name="updateemail" placeholder="someone@somewhere.com"><br>
  <br><label>Password</label><br>
  <input type="password" name="updatepassword" placeholder="********"><br>
  <br><button>Update User Account</button><br>
</form>






</body>
    </html>
