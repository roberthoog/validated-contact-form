

<?php
// helper function that disables HTML/script insertions

function _e( $string ) {
    return htmlentities($string, ENT_QUOTES, 'UTF-8', false);
};

// accept these fields
$whitelist = array( 'name', 'email', 'message' );

// e-mail submission sends to
$email_address = "minadress@gmail.com";

// subject of submissions
$subject = "New Form from Web";

