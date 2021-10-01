<?php
	include("config/config.php");
	include('helpers/url_helpers.php');
	include("layout/header.php");
?>
<div class="s002">
	<form action="search" method="GET">
		<fieldset>
			<legend>BROWSE THE WEB</legend>
		</fieldset>
		<div class="inner-form">
			<div class="input-field first-wrap">
				<input autocomplete="off" id="search" type="text" name="q" placeholder="What are you looking for?" />
			</div>
			<div class="input-field fifth-wrap">
				<button class="btn-search" type="button">SEARCH</button>
			</div>
		</div>
	</form>
</div>
<?php include('layout/footer.php'); ?>