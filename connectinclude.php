

<?

$ip="********"
$user="********"
$password="********"
$db="********"
if(get_magic_quotes_gpc()) {
    $_REQUEST = array_map( 'stripslashes', $_REQUEST);
}
$_REQUEST = array_map( 'mysql_real_escape_string', $_REQUEST);
$conn=mysql_connect($ip,$user,$password) or die("Cannot connect to server!".mysql_error());
mysql_select_db($db,$conn) or die("Cannot select database!".mysql_error());

?>
