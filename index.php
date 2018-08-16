


<?php
include_once('config.php');

// instantiate vars
$errors = array();
$fields = array();
$email ="";
$sent = "";

// check form submission
if ( ! empty( $_POST ) ) {

    // validate math. "intval" makes sure it's an integer entered
    if ( intval($_POST['human']) !== 7 ) {
        $errors[] = 'Wrong number. Please try again.';
    }

    // validate email
    if ( ! empty($_POST[$email] ) && !filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL ) ) {
        $errors[] = " Incorrect email";
    }

    // whitelisting
    foreach ( $whitelist as $key) {
        $fields[$key] = $_POST[$key];
        //print_r($_POST);
    }

    // validation of data
    foreach ( $fields as $field => $data ) {
        if ( empty( $data ) ) {
            $errors[] = 'Please enter your ' . $field;

        }
    }

// check all and process
    if ( empty($errors)) {
        $sent = mail($email_address, $subject, $fields['message']);
    }



}

?>
<html>
<head>
    <meta charset="UTF-8">
    <title="Validated Contact form"></title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300" rel="stylesheet">
    <link rel="stylesheet" href="style.css">

</head>


<section class="section" id="contact-form">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Enter message</h1>
                <p>Källkod: <a href="">
                <?php if (! empty($errors ) ) : ?>
                <div class="errors">
                    <p class="bg-danger">
                        <?php echo implode('</p><p class="bg-danger">', $errors); ?>
                    </p>
                </div>
                <?php elseif ( $sent ) : ?>
                <div class="success">
                    <p class="bg-success">Your message was sent. We'll be in touch.</p>
                </div>
                <?php endif; ?>

                <form action="index.php" method="post" role="form">
                    <div class="form-group">
                        <label for="name" class="control-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="e.g. John Doe" value="<?php echo isset( $fields['name'] ) ? _e( $fields['name'] ) : '' ?>">
                    </div>

                    <div class="form-group">
                        <label for="email" class="control-label">E-mail</label>
                        <input type="text" class="form-control"  id="email" name="email" placeholder="you@email.com" value="<?php echo isset( $fields['email'] ) ? _e( $fields['email'] ) : '' ?>">
                    </div>
                    <div class="form-group">
                        <label for="message" class="control-label">message</label>

                        <textarea rows="4" type="text" class="form-control"  id="message" name="message" placeholder="Your message" value="<?php echo isset( $fields['message'] ) ? _e( $fields['message'] ) : '' ?>"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="human" class="control-label">5 + 2 = ?</label>
                        <input type="text" class="form-control" id="human" name="human" placeholder="Your Answer">
                    </div>
                    <div class="form-group">
                        <input id="submit" name="submit" type="submit" value="Send" class="btn btn-primary">
                    </div>

                </form>
				
            </div>
        </div>
    </div>

</section>
</html>







