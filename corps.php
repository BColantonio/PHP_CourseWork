<!--
//db.php = Database connection.
//corps.php = Associative array = corporations information.
//allCorpsTable.php = Builds and populates table and inserts into HTML.
//header.php = All header information and sort/search form HTML.
//corps.php = function collection.
//footer.php = footer information.-->
<?php
$term_error = "";
$message = $url = $success = "";
	function getCorp(){
		// grab the db object
		global $db;
		// create the sql string
		$sql = "SELECT * FROM `Corps`";
		try{
			//prepare it
			$stmt = $db->prepare($sql);		
			// execute it
			$stmt->execute();
			//global $count;
			// retrieve the records as an associative array
			$corps = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$count = $stmt->rowCount();?>
			<p><?php
			print ("$count rows returned.");?>
			</p><?php
			// return it
			return $corps;
		} catch(PDOException $e) {
			exit("There was a problem retrieving the Corps table");
		}
	}	
	function getCorps($db, $id)
	{
		//create the sql string
		$sql = "SELECT * FROM `Corps` WHERE id=:id";
		try {
			//prepare it
			$stmt = $db->prepare($sql);
			// bind parameter(s) to the placeholder(s)
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			//execute it
			$stmt->execute();
			//retrieve the record as an associative array
			$corp = $stmt->fetch(PDO::FETCH_ASSOC);
			return $corp;
		} catch (PDOException $e) {
			exit("There was a problem retrieving the corporation");	
		}	
	}
	function deleteCorp($db, $id)
	{
		// create the sql 
		$sql = "DELETE FROM `Corps` WHERE id=:id";
		try {
			// prepare it
			$stmt = $db->prepare($sql);
			// bind parameter(s) to the placeholder(s)
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			//execute it
			$stmt->execute();
		} catch (PDOException $e) {
			exit("There was a problem deleting the corporation");
		}
		
	}
	
	function addCorp($db, $corp, $email, $zipcode, $owner, $phone)
	{
		$sql = "INSERT INTO 
			`Corps` (corp, email, zipcode, owner, phone)
			VALUES (:corp, :email, :zipcode, :owner, :phone)";
		try {
			//prepare it
			$stmt = $db->prepare($sql);
			// bind parameter(s) to the placeholder(s)
			$stmt->bindParam(':corp', $corp, PDO::PARAM_STR);
			//$stmt->bindParam(':intcorp_dt', $intcorp_dt, PDO::PARAM_STR);
			$stmt->bindParam(':email', $email, PDO::PARAM_STR);
			$stmt->bindParam(':zipcode', $zipcode, PDO::PARAM_STR);
			$stmt->bindParam(':owner', $owner, PDO::PARAM_STR);
			$stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
			//execute it
			$stmt->execute();
			$count = $stmt->rowCount();
			return print("$count rows added.\n");
		} catch (PDOException $e) {
			exit("There was a problem adding the person");
		}
			
	}
	
	function updateCorp($db, $corp, $intcorp_dt, $email, $zipcode, $owner, $phone, $id)
	{		
		$sql = "UPDATE `Corps` 
				SET corp = :corp,
				intcorp_dt = :intcorp_dt,
				email = :email,
				zipcode = :zipcode,
				owner = :owner,
				phone = :phone
				WHERE id = :id";
				
		try {
			//prepare it
			$stmt = $db->prepare($sql);
			// bind parameter(s) to the placeholder(s)
			$stmt->bindParam(':corp', $corp, PDO::PARAM_STR);
			$stmt->bindParam(':intcorp_dt', $intcorp_dt, PDO::PARAM_STR);
			$stmt->bindParam(':email', $email, PDO::PARAM_STR);
			$stmt->bindParam(':zipcode', $zipcode, PDO::PARAM_STR);
			$stmt->bindParam(':owner', $owner, PDO::PARAM_STR);
			$stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			
			//execute it
			$stmt->execute();
			//$corps = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$count = $stmt->rowCount();?>
			
			<p><?php
			print ("$count row updated.");?>
			</p><?php
			
			//return $corps;
		} catch (PDOEXCEPTION $e) {
			exit("There was a problem updating the corp");
		}
	}
	
	function searchResults()
	{
		// grab the db object
		global $db; //declare the PDO object as a global
		// create the sql string
		$sql = "SELECT * FROM `Corps`";
		try{
			//prepare it
			$stmt = $db->prepare($sql);		
		// execute it
			$stmt->execute();
		// retrieve the records as an associative array
			$corps = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $corps;
		} catch(PDOException $e) {
			exit("There was a problem retrieving the Corps table");
		}
	}
	function sortDataIdAsc()
	{
		global $db;		
		$sql = "SELECT * FROM `CORPS` ORDER BY id ASC";
		try {
			//prepare it
			$stmt = $db->prepare($sql);
			//execute it
			$stmt->execute();
			$corps = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $corps;
		} catch (PDOException $e) {
			exit("There was a problem sorting data");
		}
	}	
	function sortDataIdDesc()
	{
		global $db;		
		$sql = "SELECT * FROM `CORPS` ORDER BY id DESC";
		try {
			//prepare it
			$stmt = $db->prepare($sql);
			$stmt->execute();
			$corps = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $corps;
		} catch (PDOException $e) {
			exit("There was a problem sorting data");
		}
	}	
	function sortDataCorpAsc()
	{
		global $db;		
		$sql = "SELECT * FROM `CORPS` ORDER BY corp ASC";
		try {
			//prepare it
			$stmt = $db->prepare($sql);
			//execute it
			$stmt->execute();
			$corps = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $corps;
		} catch (PDOException $e) {
			exit("There was a problem sorting data");
		}
	}
	function sortDataCorpDesc()
	{
		global $db;		
		$sql = "SELECT * FROM `CORPS` ORDER BY corp DESC";
		try {
			//prepare it
			$stmt = $db->prepare($sql);
			$stmt->execute();
			$corps = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $corps;
		} catch (PDOException $e) {
			exit("There was a problem sorting data");
		}
	}	
	function sortDataDateAsc()
	{
		global $db;		
		$sql = "SELECT * FROM `CORPS` ORDER BY intcorp_dt ASC";
		try {
			//prepare it
			$stmt = $db->prepare($sql);
			//execute it
			$stmt->execute();
			$corps = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $corps;
		} catch (PDOException $e) {
			exit("There was a problem sorting data");
		}
	}	
	function sortDataDateDesc()
	{
		global $db;		
		$sql = "SELECT * FROM `CORPS` ORDER BY intcorp_dt DESC";
		try {
			//prepare it
			$stmt = $db->prepare($sql);
			$stmt->execute();
			$corps = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $corps;
		} catch (PDOException $e) {
			exit("There was a problem sorting data");
		}
	}	
	function sortDataEmailAsc()
	{
		global $db;		
		$sql = "SELECT * FROM `CORPS` ORDER BY email ASC";
		try {
			//prepare it
			$stmt = $db->prepare($sql);
			//execute it
			$stmt->execute();
			$corps = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $corps;
		} catch (PDOException $e) {
			exit("There was a problem sorting data");
		}
	}
	function sortDataEmailDesc()
	{
		global $db;		
		$sql = "SELECT * FROM `CORPS` ORDER BY email DESC";
		try {
			//prepare it
			$stmt = $db->prepare($sql);
			$stmt->execute();
			$corps = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $corps;
		} catch (PDOException $e) {
			exit("There was a problem sorting data");
		}
	}	
	function sortDataZipAsc()
	{
		global $db;		
		$sql = "SELECT * FROM `CORPS` ORDER BY zipcode ASC";
		try {
			//prepare it
			$stmt = $db->prepare($sql);
			//execute it
			$stmt->execute();
			$corps = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $corps;
		} catch (PDOException $e) {
			exit("There was a problem sorting data");
		}
	}	
	function sortDataZipDesc()
	{
		global $db;		
		$sql = "SELECT * FROM `CORPS` ORDER BY zipcode DESC";
		try {
			//prepare it
			$stmt = $db->prepare($sql);
			$stmt->execute();
			$corps = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $corps;
		} catch (PDOException $e) {
			exit("There was a problem sorting data");
		}
	}
	
	function sortDataOwnerAsc()
	{
		global $db;		
		$sql = "SELECT * FROM `CORPS` ORDER BY owner ASC";
		try {
			//prepare it
			$stmt = $db->prepare($sql);
			//execute it
			$stmt->execute();
			$corps = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $corps;
		} catch (PDOException $e) {
			exit("There was a problem sorting data");
		}
	}	
	function sortDataOwnerDesc()
	{
		global $db;
		
		$sql = "SELECT * FROM `CORPS` ORDER BY owner DESC";
		
		try {
			//prepare it
			$stmt = $db->prepare($sql);
			$stmt->execute();
			$corps = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $corps;
		} catch (PDOException $e) {
			exit("There was a problem sorting data");
		}
	}	
	function sortDataPhoneAsc()
	{
		global $db;		
		$sql = "SELECT * FROM `CORPS` ORDER BY phone ASC";
		try {
			//prepare it
			$stmt = $db->prepare($sql);
			//execute it
			$stmt->execute();
			$corps = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $corps;
		} catch (PDOException $e) {
			exit("There was a problem sorting data");
		}
	}	
	function sortDataPhoneDesc()
	{
		global $db;		
		$sql = "SELECT * FROM `CORPS` ORDER BY phone DESC";
		try {
			//prepare it
			$stmt = $db->prepare($sql);
			$stmt->execute();
			$corps = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $corps;
		} catch (PDOException $e) {
			exit("There was a problem sorting data");
		}
	}	
	function searchDataId($term)
	{
		global $db;		
		$sql = "SELECT * FROM `CORPS` WHERE id LIKE '%".$term."%'";
		try {
			//prepare it
			$stmt = $db->prepare($sql);
			//execute it
			$stmt->execute();
			$corps = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $corps;
		} catch (PDOException $e) {
			exit("There was a problem sorting data");
		}
	}
	function searchDataCorp($term)
	{
		global $db;
		$sql = "SELECT * FROM `CORPS` WHERE corp LIKE '%".$term."%'";
		try {
			//prepare it
			$stmt = $db->prepare($sql);
			//execute it
			$stmt->execute();
			$corps = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $corps;
		} catch (PDOException $e) {
			exit("There was a problem sorting data");
		}
	}	
	function searchDataDt($term)
	{
		global $db;
		$sql = "SELECT * FROM `CORPS` WHERE intcorp_dt LIKE '%".$term."%'";	try {
			//prepare it
			$stmt = $db->prepare($sql);
			//execute it
			$stmt->execute();
			$corps = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $corps;
		} catch (PDOException $e) {
			exit("There was a problem sorting data");
		}
	}
	function searchDataEmail($term)
	{
		global $db;		
		$sql = "SELECT * FROM `CORPS` WHERE email LIKE '%".$term."%'";		
		try {
			//prepare it
			$stmt = $db->prepare($sql);
			//execute it
			$stmt->execute();
			$corps = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $corps;
		} catch (PDOException $e) {
			exit("There was a problem sorting data");
		}
	}
	function searchDataZip($term)
	{
		global $db;		
		$sql = "SELECT * FROM `CORPS` WHERE zipcode LIKE '%".$term."%'";	try {
			//prepare it
			$stmt = $db->prepare($sql);
			//execute it
			$stmt->execute();
			$corps = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $corps;
		} catch (PDOException $e) {
			exit("There was a problem sorting data");
		}
	}
	function searchDataOwner($term)
	{
		global $db;		
		$sql = "SELECT * FROM `CORPS` WHERE owner LIKE '%".$term."%'";		
		try {
			//prepare it
			$stmt = $db->prepare($sql);
			//execute it
			$stmt->execute();
			$corps = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $corps;
		} catch (PDOException $e) {
			exit("There was a problem sorting data");
		}
	}
	function searchDataPhone($term)
	{
		global $db;		
		$sql = "SELECT * FROM `CORPS` WHERE phone LIKE '%".$term."%'";		
		try {
			//prepare it
			$stmt = $db->prepare($sql);
			//execute it
			$stmt->execute();
			$corps = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $corps;
		} catch (PDOException $e) {
			exit("There was a problem sorting data");
		}
	}
?>