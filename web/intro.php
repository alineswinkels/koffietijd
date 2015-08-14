<?php
	include('header.php');
?>

<form action='koffietijd.php' method='POST'>
<h1>koffiecode</h1>
<input type="number" name="koffiecode" required><br/>
<input type='submit' value='submit' name='submit'>
</form>
<?php
	include('footer.html');
?>