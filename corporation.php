<div class="jumbotron text-center">
	<h1> Corporations App </h1>
</div>
<form>
<div id="corporation">
<action="index.php" method="get" id="resetForm">
<?php 
echo $corps['corp'] . " " . $corps['intcorp_dt'] . " " . $corps['email'] . " " .
$corps['zipcode'] . " " . $corps['owner'] . " " . $corps['phone'];?><br /> <input type="submit" name="action" value="Reset" /><br />
</div>
</form>
	