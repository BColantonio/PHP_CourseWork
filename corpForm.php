<div class="jumbotron text-center">
	<h1>Corporations App </h1>
</div>
<div id="CorpForm">
<?php
/*
$email = $emailErr = "";

	if (empty($_POST['email']))
	{
		$email = test_input($formCorp['email']);
	}
	else
	{
		$email = test_input($_POST['email']);
	}*/
	$id = "";
	if (isset($formCorp['id']))
	{		
	if ($formCorp['id'] > 0)
	{
		$id = "?id=" . $formCorp['id'];
	}
	}
	?>

<form method='post' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?><?php echo $id; ?>">
<label for='corp'>Corperation: </label>
<input type='text' name='corp' value='<?php echo $formCorp['corp']; ?>' /><span class="error"><?php echo $corpErr; ?></span><br />
<label for='email'>Email: </label>
<input type='text' name='email' value='<?php echo $formCorp['email']; ?>'/>
<span class="error"><?php echo $emailErr; ?></span><br />
<label for='zipcode'>Zipcode: </label>
<input type='text' name='zipcode' value='<?php echo $formCorp['zipcode']; ?>'/><span class="error"><?php echo $zipcodeErr; ?></span><br />
<label for='owner'>Owner: </label>
<input type='text' name='owner' value='<?php echo $formCorp['owner']; ?>'/><span class="error"><?php echo $ownerErr; ?></span><br />
<label for='phone'>Phone: </label>
<input type='text' name='phone' value='<?php echo $formCorp['phone']; ?>'/><span class="error"><?php echo $phoneErr; ?></span><br />
<input type='submit' name='action' value='<?php echo $value; ?>' /><br />
</form>
</div>
