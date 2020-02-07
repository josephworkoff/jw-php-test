<?php 
    session_start();
    if(!(array_key_exists('id', $_SESSION))){
        header('Location: /login');
    }
?>

<!DOCTYPE html>
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
      <p>PROFILE</p>

        <?php

            $conn = pg_connect(getenv("DATABASE_URL"));
            // $stat = pg_connection_status($conn);
            // if ($stat === PGSQL_CONNECTION_OK) {
            //     echo 'Connection status ok';
            // } else {
            //     echo 'Connection status bad';
            // }  

            //session_start();
            if (!isset($_SESSION['id'])){
                echo "not logged in";
            }

        echo "<p>Logged in as: {$_SESSION['id']}</p>";
            //get user info

            if(!(array_key_exists('id', $_GET))){
                $_GET['id'] = $_SESSION['id'];
            }

            $result = pg_prepare($conn, "fetchRequestedUser", 'SELECT * FROM users WHERE id = $1');
            $uid = (int)$_GET['id'];
            $result = pg_execute($conn, "fetchRequestedUser", array($uid));

            if (!$result){ //user doesn't exist
                echo "<p>Profile not found.</p>"; //replace this with the user's profile if get is empty
            }
            else{
                $row = pg_fetch_row($result);

                //user can edit profile if they are the owner or the admin
                $canEdit = ( ( ($_SESSION['id'] == $row[0]) || ($_SESSION['id'] == 999) ) ? TRUE : FALSE);
                //user can view the page if the page isn't private or they are the owner/admin
                $canView = ( (($row[6] == 't') || ($canEdit)) ? TRUE : FALSE); 

                if (!$canView){
                    echo "<p>Unable to view page.</p>";
                }
                else{
                    //get user bio
                    $result = pg_prepare($conn, "fetchRequestedBio", 'SELECT bio FROM user_profiles WHERE id = $1');
                    $uid = (int)$row[0];
                    $result = pg_execute($conn, "fetchRequestedBio", array($uid));
                    $bio = pg_fetch_row($result);

                    echo " <div>
                        <label>$row[1] $row[2] 's Profile</label>
                        <p>Phone: $row[3]</p>
                        <p>Email: $row[4]</p>
                        <p><label>Bio:</label></p>
                        <p>{$bio[0]}</p>
                    </div>";

                    if ($canEdit){
                        $privacy = ( ($row[6] == 't') ? 'Private' : 'Public');
                        echo "
                        <form class=\"loginform\" method=\"post\" action=\"updateProfile.php\">
                            <br><label>First Name</label><br>
                            <input type=\"text\" name=\"displayfn\" value=\"{$row[1]}\"><br>
                            <br><label>Last Name</label><br>
                            <input type=\"text\" name=\"displayln\" value=\"{$row[2]}\"><br>
                            <br><label>Phone Number</label><br>
                            <input type=\"text\" name=\"displaypn\" value=\"{$row[3]}\"><br>
                            <br><label>Email Address</label><br>
                            <input type=\"text\" name=\"displayemail\" value=\"{$row[4]}\"><br>
                            <input type=\"hidden\" name=\"form\" value=\"info\"/>
                            <input type=\"hidden\" name=\"uid\" value=\"$uid\"/>
                            <br><button>Update Profile</button><br>
                        </form>

                        <form id=\"bioForm\" class=\"aboutyourself\" method=\"post\" action=\"updateProfile.php\">
                            <br><label>Tell Us About Yourself</label><br>
                            <textarea form=\"bioForm\" name=\"displaybio\" rows=\"80\" cols=\"120\" value=\"{$bio[0]}\"></textarea>
                            <input type=\"hidden\" name=\"form\" value=\"bio\"/>
                            <input type=\"hidden\" name=\"uid\" value=\"$uid\"/>
                            <br><button>Update Profile</button><br>
                        </form>

                        <form id=\"privacy\" class=\"aboutyourself\" method=\"post\" action=\"updateProfile.php\">
                        <br><label>Profile is currently $privacy:</label><br>
                        <br><label>Click to toggle Privacy:</label><br>
                        <input type=\"hidden\" name=\"form\" value=\"privacy\"/>
                        <input type=\"hidden\" name=\"uid\" value=\"$uid\"/>
                        <br><button>Toggle Private</button><br>
                        </form>
                        ";
                    }
                }
            }
        ?>





    </div>
  </div>

  <div class="jumbotron text-center" th:fragment="footer">
    <a type="button" class="btn btn-lg btn-primary" href="/"><span class="glyphicon glyphicon-home"></span> HOME</a>
    <a type="button" class="btn btn-lg btn-primary" href="/profile"><span class="glyphicon glyphicon-user"></span> PROFILE</a>
    <a type="button" class="btn btn-lg btn-primary" href="/matches"><span class="glyphicon glyphicon-heart"></span> MATCHES</a>
    <a type="button" class="btn btn-lg btn-primary" href="/search"><span class="glyphicon glyphicon-search"></span> SEARCH</a>
    <a type="button" class="btn btn-lg btn-primary" href="/faq"><span class="glyphicon glyphicon-list"></span> FAQ</a>

    <p>&copy; 2020 Bear Link</p>
  </div>


</body>
</html>

