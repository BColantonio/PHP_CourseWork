<body>
<div class="jumbotron text-center">
	<h1> Corporations App </h1>
	</div>
	<div class="container">
	<div id="collect">
	<form class="form-inline">
		<div class="input-group">
		<label for="col">Sort Column: </label>
			<select name="col" id="col">
				<option value="id">id</option>
				<option value="corp">corp</option>
				<option value="intcorp_dt">intcorp_dt</option>
				<option value="email">email</option>
				<option value="zipcode">zipcode</option>
				<option value="owner">owner</option>
				<option value="phone">phone</option>
			</select>
		<label for="asc">Ascending: </label>
			<input type="radio" name="dir" value="ASC" id="asc">
		<label for="desc">Descending: </label>
			<input type="radio" name="dir" value="DESC" id="desc">
		<input type="submit" name="action" value="sort">
		<!--<input type="submit">-->
		<input type="submit" name="action" value="Reset" />
	</div>
	</form>		
	<div id="search">
	<form action="index.php" method="get" id="searchForm">
		<label for="col">Seach Column: </label>
			<select name="col" id="col">
			<option value="id">id</option>
			<option value="corp">corp</option>
			<option value="intcorp_dt">intcorp_dt</option>
			<option value="email">email</option>
			<option value="zipcode">zipcode</option>
			<option value="owner">owner</option>
			<option value="phone">phone</option>
			</select>
	<label for="term">Term: </label>
		<input type="text" name="term" id="term">
		<input type="submit" name="action" value="search">
		<!--<input type="submit">-->
		<input type="submit" name="action" value="Reset">
	</form>
		</div>
	</div>
</body>