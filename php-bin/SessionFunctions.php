<?php 
// Start session on page
session_start();

// Get required functions
require_once "ConnectToDatabase.php";

function create_session($userID) {
    $conn = openConnectionToDatabase();
    $stmt = $conn->prepare("INSERT INTO user_sessions(SESSION_ID, USER_ID, SESSION_START,
                            SESSION_EXPIRE, EXPIRED, USER_IP)
                            VALUES(?, ?, ?, ?, ?, ?);");

    $sess_id        = session_id();
    $current_time   = date("Y-m-d H:i:s");
    $expiry_time    = date("Y-m-d H:i:s", strtotime("+30 minutes"));
    $expired        = false;
    $user_ip        = $_SERVER['REMOTE_ADDR'];

    // Set up new session 
    $stmt->bind_param("sissis", $sess_id, $userID, $current_time,
                      $expiry_time, $expired, $user_ip);

    // Execute and close
    if ($stmt->execute()) { 
        echo "SUCCESS";
     } else {
        echo $sess_id . "<br>";
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }

    $stmt->close();
    closeConnectionToDatabase($conn);
}

function check_user_logged_in() {
    // Make sure session exists
    if (($user_session = get_current_session_data()) != null) {
        // From the result, check if it's expired
        if ($user_session['EXPIRED'] != 1) {
            // Not expired, but we need to check if the time has passed
            $current_time   = time();
            $expiry_time    = strtotime( $user_session['SESSION_EXPIRE'] );

            if ($expiry_time < $current_time) {
                // Time has passed, the session is now expired
                expire_session($user_session['USER_ID']);
                return false;
            }

            // Else return true
            return true;
        }
    }

    // All else fails, return false
    return false;
}

// With already a user_session, this just makes sure that 
// the expiry time hasn't already passes
function u_check_user_logged_in($user_session) {
    // From the result, check if it's expired
    if ($user_session['EXPIRED'] != 1) {
        // Not expired, but we need to check if the time has passed
        $current_time   = time();
        $expiry_time    = strtotime( $user_session['SESSION_EXPIRE'] );

        if ($expiry_time < $current_time) {
            // Time has passed, the session is now expired
            expire_session($user_session['USER_ID']);
            return false;
        }

        // Else return true
        return true;
    }
}

function get_current_session_data() {
    $conn = openConnectionToDatabase();

    // Find current session from session id
    $sess_id = session_id();
    $query = "SELECT * FROM `user_sessions` WHERE `SESSION_ID`='" . $sess_id . "' "
             . "AND `EXPIRED`=0";
    
    // Check if it exists
    if ($result = $conn->query($query))
    {
        if ($session = $result->fetch_assoc()) {
            if (u_check_user_logged_in($session)) {
                return $session;
            }
        }
    }

    // All else fails, return nothing
    return null;
}

function get_session_user_id() {
    if (($user_session = get_current_session_data()) != null) {
        if (u_check_user_logged_in($user_session)) {
            return $user_session["USER_ID"];
        }
    }

    // If no user is signed in, it returns 0
    return 0;
}

function get_session_user_data() {
    if (($user_session = get_current_session_data()) != null) {
        if (u_check_user_logged_in($user_session)) {
            return $user_session;
        }
    }

    // If no user is signed in, it returns null
    return null;
}

function expire_session($user_id) {
    $conn = openConnectionToDatabase();

    // Find current session from user ID
    $sess_id = session_id();
    $query = "UPDATE `user_sessions` SET `EXPIRED`=1 WHERE `USER_ID`='" 
        . $user_id . "' " . "AND `EXPIRED`=0";

    // Check if it exists
    if ($result = $conn->query($query))
    {
        // Create a new session ID
        session_regenerate_id();

        // Expired
        return true;
    }

    return false;
}


?>