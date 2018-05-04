<!--
//db.php = Database connection.
//corps.php = Associative array = corporations information.
//allCorpsTable.php = Builds and populates table and inserts into HTML.
//header.php = All header information and sort/search form HTML.
//corps.php = function collection.
//footer.php = footer information.-->
<?php
$dsn = "mysql:host=localhost;dbname=phpclassspring2018";
$userName = "PHPClassSpring2018";
$pWord = "SE266";
try {
	$db = new PDO($dsn, $userName, $pWord); 
} catch (PDOExeption $e) {
	die("Cannot connect to the database");
}
?>