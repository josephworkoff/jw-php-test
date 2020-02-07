<html>
<head>
<?php 
// if( (session_status == PHP_SESSION_ACTIVE) && (array_key_exists('id', $_SESSION)) ){
//     header('Location: https://jw-php-test.herokuapp.com/profile.php');
//     exit;
// }

require_once("./views/header.html"); ?>   
</head>


<body>
<div class="jumbotron text-center">
<div class="container">

<?php require_once("./views/nav.html");

    echo("<p>Login</p>");

    $conn = pg_connect(getenv("DATABASE_URL"));
    $stat = pg_connection_status($conn);
    if ($stat === PGSQL_CONNECTION_OK) {
        echo 'Connection status ok';
    } else {
        echo 'Connection status bad';
    }  

    $result = pg_prepare($conn, "my_query", 'SELECT id, pass FROM users WHERE email = $1');
    $result = pg_execute($conn, "my_query", array($_POST['loginemail']));

    if(!$result){
        echo("<p>User does not exist.</p>");
    }
    else{    
        $row = pg_fetch_row($result);
        echo($row[1]);

        if($_POST['loginpassword'] == $row[1]){
            echo "<p>Login Successful</p>";
            session_start();
            $_SESSION['id'] = $row[0];
            echo("<p>id = {$_SESSION['id']}</p>");
            //session_destroy();
        }
        else{
            echo "<p>Invalid Credentials.</p>";
        }
    }
?>

  </div>
</div>

</body>
</html>