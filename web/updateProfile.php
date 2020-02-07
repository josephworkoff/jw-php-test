<?php 

if(array_key_exists('form', $_POST)){
    $conn = pg_connect(getenv("DATABASE_URL"));
    session_start();

    if($_POST['form'] == "info"){
        $result = pg_prepare($conn, "updateUser", 'UPDATE users SET first_name=$1, last_name=$2, phone=$3, email=$4 WHERE id=$5');
        $uid = (int)$_POST['uid'];
        $result = pg_execute($conn, "updateUser", array($_POST['displayfn'], $_POST['displayln'], $_POST['displaypn'],$_POST['displayemail'],$uid));

        if (!$result){ //user doesn't exist
            echo "<p>User update failed.</p>"; //replace this with the user's profile if get is empty
        }
        else{
            header('Location: /profile');
        }
    }
    elseif ($_POST['form'] == "bio") {
        $result = pg_prepare($conn, "updateBio", 'UPDATE user_profiles SET bio=$1 WHERE id=$2');
        $uid = (int)$_POST['uid'];
        $result = pg_execute($conn, "updateBio", array($_POST['displaybio'],$uid));

        if (!$result){ //user doesn't exist
            echo "<p>Bio update failed.</p>"; //replace this with the user's profile if get is empty
        }
        else{
            header('Location: /profile');
        }
    }
    elseif ($_POST['form'] == "privacy") {
        echo($_POST['displaybio']);
        $result = pg_prepare($conn, "updateBio", 'UPDATE user_profiles SET bio=$1 WHERE id=$2');
        $uid = (int)$_POST['uid'];
        $result = pg_execute($conn, "updateBio", array($_POST['displaybio'],$uid));

        if (!$result){ //user doesn't exist
            echo "<p>Bio update failed.</p>"; //replace this with the user's profile if get is empty
        }
        else{
            header('Location: /profile');
        }
    }
}



//header('Location: /profile');



?>