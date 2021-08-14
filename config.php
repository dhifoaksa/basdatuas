<?php
//error_reporting(E_ALL);
date_default_timezone_set('Asia/Jakarta');
ini_set('memory_limit', '1024M');
$date = date("Y-m-d");
$time = date("H:i:s");
$httpReferer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : null;

$fo = mysqli_connect('localhost', 'root', '', 'basdatuas');
if (!$fo) {
    die("Server Down!" . mysqli_connect_error());
    error_log("Connection Failed : ");
}

function _DIR_($path)
{
    global $_SERVER;
    return $_SERVER['DOCUMENT_ROOT'] . '/' . $path;
}

function base_url($x = '')
{
    global $_SERVER;
    return 'http://' . $_SERVER['SERVER_NAME'] . '/' . $x;
}

function filter($data)
{
    global $fo;
    return $fo->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($data, ENT_QUOTES)))));
}
function notif($status, $msg)
{
    if ($status == true) {
        $_SESSION['notif'] = "<script>Swal.fire(
            'Good job!',
            '$msg',
            'success'
          )</script>";
    } else {
        $_SESSION['notif'] = "<script>Swal.fire(
            'Something Wrong!',
            '$msg',
            'error'
          )</script>";
    }
}

function notif_check()
{
    if (isset($_SESSION['notif'])) {
        echo $_SESSION['notif'];
        unset($_SESSION['notif']);
    }
}
