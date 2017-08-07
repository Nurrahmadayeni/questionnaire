 <?php
	$dbhost = 'localhost';
	$dbuser = 'root';
	$dbpass = '';
	$dbname = 'survey_db';

	$mysqli = new mysqli($dbhost,$dbuser,$dbpass,$dbname);

	if ($mysqli->connect_error) {
	    die('Terjadi Kegagalan : '. $mysqli->connect_error );
	}
?>