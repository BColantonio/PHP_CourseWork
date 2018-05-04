<?php  
	//corporation table view
	$tbody = "<tbody>" . PHP_EOL;	
	foreach ($corps as $corp) 
	{
		$tbody .= "<tr>";
		$tbody .= "<td>" . $corp['corp'];
		$tbody .= "<td><a href='?action=Read&id=" . $corp['id'] . "'>Read</a> | ";
		$tbody .= "<a href='?action=Update&id=" . $corp['id']. "'>Update</a> | ";
		$tbody .= "<a href='?action=Delete&id=" . $corp['id'] . "'>Delete</a></td>";
		$tbody .= "</tr>" . PHP_EOL;		
	}	
	$tbody .= "</tbody>" . PHP_EOL;
?>

<div id="mainContent">
	<div id="corporationTable">
		<table id="corporation">
			<?php echo $tbody; ?>
		</table>
	</div>
</div>
<div id="create">
	<form action="" method="get" id="createButton">
		<input type="submit" name="action" value="Create" />
	</form>
</div>