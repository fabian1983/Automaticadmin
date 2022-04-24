<?PHP 
//SQL LOGIN
define('DB_SERVER', 'localhost:3307');
define('DB_USERNAME', 'xxxx');
define('DB_PASSWORD', 'xxxx');
define('DB_NAME', 'xxxx');
 
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
