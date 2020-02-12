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
            header("Location: /profile.php?id=$uid");
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
            header("Location: /profile.php?id=$uid");
        }
    }
    elseif ($_POST['form'] == "privacy") {
        $result = pg_prepare($conn, "fetchPrivacy", 'SELECT private FROM users WHERE id=$1' );
        $uid = (int)$_POST['uid'];
        $result = pg_execute($conn, "fetchPrivacy", array($uid));

        if (!$result){
            echo "<p>Failed to get current privacy setting.</p>"; //replace this with the user's profile if get is empty
        }

        $row = pg_fetch_row($result);

        $privacy = ( ( $row[0] == 'f') ? 't' : 'f');

        $result = pg_prepare($conn, "togglePriv", 'UPDATE users SET private=$1 WHERE id=$2');
        $result = pg_execute($conn, "togglePriv", array($privacy,$uid));

        if (!$result){
            echo "<p>Failed to change privacy setting.</p>"; //replace this with the user's profile if get is empty
        }
        else{
            header("Location: /profile.php?id=$uid");
        }
    }
    elseif ($_POST['form'] == "delete") {
        $result = pg_prepare($conn, "deleteUser", 'DELETE FROM users WHERE id=$1');
        $uid = (int)$_POST['uid'];
        $result = pg_execute($conn, "deleteUser", array($uid));

        if (!$result){ //user doesn't exist
            echo "<p>Failed to delete account.</p>"; //replace this with the user's profile if get is empty
        }
        else{
            $result = pg_prepare($conn, "deleteBio", 'DELETE FROM user_profiles WHERE id=$1');
            $result = pg_execute($conn, "deleteBio", array($uid));

            if($_SESSION['id'] == $uid){
                header("Location: /logout.php");
            }
            else{
                header("Location: /");
            }
            
        }
    }
}
?>