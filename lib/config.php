 <?php
	$dbhost = 'localhost';
	$dbuser = 'root';
	$dbpass = 'passUSU2017';
	$dbname = 'db_survey';

	$mysqli = new mysqli($dbhost,$dbuser,$dbpass,$dbname);

	if ($mysqli->connect_error) {
	    die('Terjadi Kegagalan : '. $mysqli->connect_error );
	}
?>
