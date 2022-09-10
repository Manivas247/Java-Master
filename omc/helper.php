<?php



function validate_input_text($textValue){
    if (!empty($textValue)){
        $trim_text = trim($textValue);
        // remove illegal character
        $sanitize_str = filter_var($trim_text, FILTER_SANITIZE_STRING);
        return $sanitize_str;
    }
    return '';
}


function validate_input_email($emailValue){
    if (!empty($emailValue)){
        $trim_text = trim($emailValue);
        // remove illegal character
        $sanitize_str = filter_var($trim_text, FILTER_SANITIZE_EMAIL);
        return $sanitize_str;
    }
    return '';
}

function clean($text) {
    $text = preg_replace('/[^\S\n]+/', ' ', $text);
return $text;
}


// get user info
function get_user_info($con, $userID){
$query = "SELECT * FROM user WHERE email=?";
$q = mysqli_stmt_init($con);

mysqli_stmt_prepare($q, $query);

// bind the statement
mysqli_stmt_bind_param($q, 's', $userID);

// execute sql statement
mysqli_stmt_execute($q);
$result = mysqli_stmt_get_result($q);

$row = mysqli_fetch_array($result);
return empty($row) ? false : $row;
}