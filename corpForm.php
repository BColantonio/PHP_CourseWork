<div class="jumbotron text-center">
	<h1>Corporations App </h1>
</div>
<div id="CorpForm">
<?php
	$id = "";
	if ($formCorp['id'] > 0)
	{
		$id = "?id=" . $formCorp['id'];
	}
	?>
<form method='post' action='index.php<?php echo $id; ?>'>
<label for='corp'>Corperation: </label>
<input type='text' name='corp' value='<?php echo $formCorp['corp']; ?>' /><br />
<label for='email'>Email: </label>
<input type='text' name='email' value='<?php echo $formCorp['email']; ?>'/><br />
<label for='zipcode'>Zipcode: </label>
<input type='text' name='zipcode' value='<?php echo $formCorp['zipcode']; ?>'/><br />
<label for='owner'>Owner: </label>
<input type='text' name='owner' value='<?php echo $formCorp['owner']; ?>'/><br />
<label for='phone'>Phone: </label>
<input type='text' name='phone' value='<?php echo $formCorp['phone']; ?>'/><br />
<input type='submit' name='action' value='<?php echo $value; ?>' /><br />
</form>
</div>
