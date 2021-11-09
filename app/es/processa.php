<?php 
require_once "wp-config.php";

$dir = "noticias/es/";
$bucket = "files.adventistas.org";

try {
	$params = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'");
	$dbh = new PDO("mysql:dbname=".DB_NAME.";host=".DB_HOST, DB_USER, DB_PASSWORD, $params);

//	$sql = "SELECT * FROM wp_postmeta where post_id > 30061 AND meta_key = 'amazonS3_info'";
	$sql = "SELECT * FROM wp_postmeta where meta_key = 'amazonS3_info'";
	foreach ($dbh->query($sql) as $row) {
		$post_id = $row['post_id'];
		$value = unserialize($row['meta_value']);
		echo $post_id ." - ";
		print_r($value);
		$value["bucket"] = $bucket;
		$value["key"] = $dir . $value["key"];
		// echo "<br>";
		// echo $row['meta_value'];
		//echo "<br>";
		$value = serialize($value);
		//echo $value;
		echo "<br>";
		$update = "UPDATE wp_postmeta SET meta_value = '". $value ."' where post_id = $post_id";
		echo $update;
		echo "<br/><br/>";
		
		$dbh->query($update);
	}

} catch (PDOException $e) {
	echo 'Connection failed: ' . $e->getMessage();
}
