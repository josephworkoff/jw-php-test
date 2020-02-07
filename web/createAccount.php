<html>
<head>
<?php require_once("./views/header.html"); ?>   
</head>


<body>
<div class="jumbotron text-center">
<div class="container">
<?php require_once("./views/nav.html");
    echo("CREATE");

    $conn = pg_connect(getenv("DATABASE_URL"));

    $stat = pg_connection_status($conn);
    if ($stat === PGSQL_CONNECTION_OK) {
        echo 'Connection status ok';
    } else {
        echo 'Connection status bad';
    }  

    $result = pg_prepare($conn, "create", 'INSERT INTO users (first_name, last_name, phone, email, pass) VALUES ($1, $2, $3, $4, $5)');
    $result = pg_execute($conn, "create", array($_POST['createfn'], $_POST['createln'], $_POST['createpn'], $_POST['createemail'], $_POST['createpassword']));

    if (!$result) {
        echo "<p>An error occurred.</p>";
    }
    else{
        echo "<p>Insert Successful</p>";

        $result = pg_prepare($conn, "fetch", 'SELECT id FROM users WHERE email = $1');
        $result = pg_execute($conn, "fetch", array($_POST['createemail']));

        if(!$result){
            echo "<p>Failed to add to user_profiles.</p>";
        }
        else{
            $user = pg_fetch_row($result);

            $id = (int)$user[0];
            $result = pg_query($conn, "INSERT INTO user_profiles (id) VALUES ($id)");
        }        
    }

    ?>
  </div>
</div>

</body>
</html>