<!--
//db.php = Database connection.
//corps.php = Associative array = corporations information.
//allCorpsTable.php = Builds and populates table and inserts into HTML.
//header.php = All header information and sort/search form HTML.
//corps.php = function collection.
//footer.php = footer information.-->
<?php
require_once("db.php");
require_once("corps.php");

$action = filter_input(INPUT_POST, "action", FILTER_SANITIZE_STRING) ?? 
		filter_input(INPUT_GET, "action", FILTER_SANITIZE_STRING) ?? null;
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT) ??
		filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT) ?? null;
$corp = filter_input(INPUT_POST, "corp", FILTER_SANITIZE_STRING) ?? null;
$intcorp_dt = filter_input(INPUT_POST, (new \DateTime())->format('Y-m-d H:i:s'), FILTER_SANITIZE_STRING) ?? null;
$email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING) ?? null;
$zipcode = filter_input(INPUT_POST, "zipcode", FILTER_SANITIZE_STRING) ?? null;
$owner = filter_input(INPUT_POST, "owner", FILTER_SANITIZE_STRING) ?? null;
$phone = filter_input(INPUT_POST, "phone", FILTER_SANITIZE_STRING) ?? null;
$emailErr = '';
switch($action){
	case "Add":
		$tz = 'US/Eastern';
		$timestamp = time();
		$dt = new DateTime("now", new DateTimeZone($tz));
		$dt->setTimestamp($timestamp);
		$intcorp_dt = $dt->format('Y-m-d H:i:s');
		//$intcorp_dt = (new \DateTime())->format('Y-m-d H:i:s', new DateTimeZone('America/NewYork'));
		include('header.php');
		$value = "Add";
		// get the view template to create a new person
		//$corp = getCorps($db, $id);
		//$corps = getCorp();
		include('sortSearchForm.php');
		addCorp($db, $corp, $intcorp_dt, $email, $zipcode, $owner, $phone);
		$corps = getCorp();
		include_once('corpTable.php');
		include('footer.php');
		break;
	case "Save":
		include('header.php');
		//get the corps as an array and pass it to the view
		/*if (empty($corp && $email && $zipcode && $owner && $phone))
		{
			$formCorp = getCorps($db, $id);
			$corp = $email = $zipcode = $owner = $phone = $data = '';*/
			if (empty($email)) 
			{
				$formCorp = getCorps($db, $id);
				$email = $data = '';
				$emailErr = "* Email is required";
				$value = "Save";
				include('corpForm.php');
			}
 
			else if (!filter_var($email, FILTER_VALIDATE_EMAIL))
			{
				$formCorp = getCorps($db, $id);
				$email = $data = '';
				$emailErr = "Invalid email format";
				$value = "Save";
				include('corpForm.php')	;				
			}
			
			else
			{
				updateCorp($db, $corp, $intcorp_dt, $email, $zipcode, $owner, $phone, $id);
				$corps = getCorps($db, $id);
				include('corporation.php');
			}
			
		include('footer.php');		
		break;
	case "Read":
		// Read
		include('header.php');
		// get the corp by id as an array and pass it to the view
		$value = "Reset";
		$corps = getCorps($db, $id);
		include('corporation.php');
		include('footer.php');		
		break;
	case "Update":
	
		include_once('header.php');
		// Set a button value variable to Add
		$value = "Save";
		$formCorp = getCorps($db, $id);
		// get the view template to create a new person
		include_once('corpForm.php');
		include_once('footer.php');
	/*
		//Update
		include('header.php');
		//Set a button value variable to add
		$value = "Save";
		// get the person and pass it to the templace view
		$formCorp = getCorps($db, $id);
		var_dump($formCorp);
		// get the view template to create a new corp
		include('corpForm.php');
		include('footer.php');*/
		break;
	case "Delete":
		//delete
		deleteCorp($db, $id);
		include_once('header.php');
		//get the corps as an array and pass it to the view
		//vardump($corps);
		include_once("header.php");
		// get the corps as an array and pass it to the views
		//$corps = getCorp();
		include_once("sortSearchForm.php");
		$corps = getCorp();
		include_once("corpTable.php");
		include_once("footer.php");
		break;
	case "Create":
		// Create
		include_once('header.php');
		// Set a button value variable to Add
		$value = "Add";
		// get the view template to create a new person
		$formCorp['id'] = '';
		$formCorp['corp'] = '';
		$formCorp['email'] = '';
		$formCorp['zipcode'] = '';
		$formCorp['owner'] = '';
		$formCorp['phone'] = '';
	
		include_once('corpForm.php');
		include_once('footer.php');
		break;
	case "sort":
		$corps = getCorp();
		include('header.php');
		include("sortSearchForm.php");
		if ($_GET["col"] == "id")
		{
			if (isset($_GET["dir"]))
			{
				$dir = $_GET["dir"];
				if ($dir == "ASC")
				{
					$corps = sortDataIdAsc();
				}
				else
				{
					$corps = sortDataIdDesc();
				}
			}
			else
			{
				$corps = sortDataIdAsc();
			}
		}
		else if ($_GET["col"] == "corp")
		{
			if (isset($_GET["dir"]))
			{
				$dir = $_GET["dir"];
				if ($dir == "ASC")
				{
					$corps = sortDataCorpAsc();
				}
				else
				{
					$corps = sortDataCorpDesc();
				}
			}
			else
			{
				$corps = sortDataCorpAsc();
			}
		}
		else if ($_GET["col"] == "intcorp_dt")
		{
			if (isset($_GET["dir"]))
			{
				$dir = $_GET["dir"];
				if ($dir == "ASC")
				{
					$corps = sortDataDateAsc();
				}
				else
				{
					$corps = sortDataDateDesc();
				}
			}
			else
			{
				$corps = sortDataAsc();
			}
		}
		else if ($_GET["col"] == "email")
		{
			if (isset($_GET["dir"]))
			{
				$dir = $_GET["dir"];
				if ($dir == "ASC")
				{
					$corps = sortDataEmailAsc();
				}
				else
				{
					$corps = sortDataEmailDesc();
				}
			}
			else
			{
				$corps = sortDataEmailAsc();
			}
		}
		else if ($_GET["col"] == "zipcode")
		{
			if (isset($_GET["dir"]))
			{
				$dir = $_GET["dir"];
				if ($dir == "ASC")
				{
					$corps = sortDataZipAsc();
				}
				else
				{
					$corps = sortDataZipDesc();
				}
			}
			else
			{
				$corps = sortDataZipAsc();
			}
		}
		else if ($_GET["col"] == "owner")
		{
			if (isset($_GET["dir"]))
			{
				$dir = $_GET["dir"];
				if ($dir == "ASC")
				{
					$corps = sortDataOwnerAsc();
				}
				else
				{
					$corps = sortDataOwnerDesc();
				}
			}
			else
			{
				$corps = sortDataOwnerAsc();
			}
		}
		else if ($_GET["col"] == "phone")
		{
			if (isset($_GET["dir"]))
			{
				$dir = $_GET["dir"];
				if ($dir == "ASC")
				{
					$corps = sortDataPhoneAsc();
				}
				else
				{
					$corps = sortDataPhoneDesc();
				}
			}
			else
			{
				$corps = sortDataPhoneAsc();
			}
		}
		include("corpTable.php");
		break;		
	case "search":
	//include('header.php');
		if ($_GET["col"] == 'id')
		{	
			//$term = filter_input(INPUT_GET, "term", FILTER_SANITIZE_STRING) ?? null;

			//$col = $_GET["col"];
			//if(preg_match("/^[  0-9a-zA-Z]+/", $_GET["term"])){ 
			$term = $_GET["term"];
			$corps = searchDataId($term);
			/*?> <div> <?php print $term; ?> </div> <?php*/			
		}
		else if ($_GET["col"] == 'corp')
		{	
			$term = $_GET["term"];
			$corps = searchDataCorp($term);		
		}
		else if ($_GET["col"] == 'intcorp_dt')
		{	
			$term = $_GET["term"];
			$corps = searchDataDt($term);
		}
		else if ($_GET["col"] == 'email')
		{	
			$term = $_GET["term"];
			$corps = searchDataEmail($term);
		}
		else if ($_GET["col"] == 'zipcode')
		{	
			$term = $_GET["term"];
			$corps = searchDataZip($term);
		}
		else if ($_GET["col"] == 'owner')
		{	
			$term = $_GET["term"];
			$corps = searchDataOwner($term);
		}
		else if ($_GET["col"] == 'phone')
		{	
			$term = $_GET["term"];
			$corps = searchDataPhone($term);
		}
		else
		{
			echo "Please enter valid search parameters.";
		}
		include("header.php");
		include('sortSearchForm.php');
		include("corpTable.php");		
		include("footer.php");
		break;		
		case "Reset":
		include_once('header.php');
		include_once("sortSearchForm.php");
		$corps = getCorp();
		include_once("corpTable.php");
		include_once("footer.php");
		/*if (isset($_GET["dir"]))
			{
				$dir = $_GET["dir"];
				if ($dir == "ASC")
				{
					$corps = sortDataIdAsc();
				}
				else
				{
					$corps = sortDataIdDesc();
				}
			}
			else
			{
				$corps = sortDataIdAsc();
			}
		include_once("allCorpsTable.php");
		include_once("footer.php");*/
		break;		
	default:
		include("header.php");
		// get the corps as an array and pass it to the views
		include_once("sortSearchForm.php");
		$corps = getCorp();
		//echo $count;
		include_once("corpTable.php");
		include_once("footer.php");
		break;
}
?>