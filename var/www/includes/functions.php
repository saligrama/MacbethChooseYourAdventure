<?php

require(dirname(__FILE__) . "/constants.php");

function removeWhitespace($str)
{
	return preg_replace('/\s/', '', preg_replace('~\x{00a0}~siu', '', $str));
}

function sempty($str)
{
	return (empty($str) && ($str !== "0"));
}

function render($template, $values = []) {

    // if template exists, render it
    if (file_exists("../templates/$template")) {
        // extract variables into local scope
        extract($values);

        // render template
        require("../templates/$template");

    }

    // else err
    else
        trigger_error("Invalid template: $template", E_USER_ERROR);

}

function popupAlert($err) {

    echo '<script type="text/javascript">alert("' . $err . '");</script>';

}

function redirectTo($url) {
    echo "<script type='text/javascript'>window.location.replace('$url');</script>";
    exit;
}

function inlineAlert($offset, $width, $err) {

    echo "<div class='alert alert-danger alert-dismissable col-sm-offset-$offset col-sm-$width' role='alert'>";
    echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
    echo '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>';
    echo '<span class="sr-only">Error:</span>';
    echo $err;
    echo '</div>';

}

function dieError($err) {

    popupAlert($err);
    exit;

}

function internalErrorRedirect($url)
{
	popupAlert("Whoopsie! There was an internal error. Please try again");
	redirectTo($url);
}

function dbConnect() {

    $dsn = "mysql:host=" . MYSQL_HOSTNAME . ";dbname=" . MYSQL_DBNAME . ";charset=utf8";

    $opts = [

        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_ERRMODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,

    ];

    $conn = new PDO($dsn, MYSQL_USERNAME, MYSQL_PASSWORD, $opts);
    return $conn;

}

function dbQuery($conn, $query, $values = array()) {

    if (isset($values)) {

        $stmt = $conn->prepare($query);
        $stmt->execute($values);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    else {

        $stmt = $conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

}

function clean($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

?>
