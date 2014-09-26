<?php
	require "ini.php";
	if ($_GET['cin'])
	try {
		$q = $db->prepare('SELECT DISTINCT president from signatures where cin=:cin');
		$q->bindValue(':cin', ltrim($_GET['cin'],'0'));
		if ($q->execute()) $presidents = $q->fetchAll(PDO::FETCH_COLUMN);
	} catch (Exception $e) {
		fatal_error($e->getMessage());
	}
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <title>Presidentielles Tunisie 2014 Verifiez quel candidat vous parrainez! :3</title>
  <link href="http://getbootstrap.com/2.3.2/assets/css/bootstrap.css" rel="stylesheet">
  </head>

</body>
<div class="container row-fluid">
<h1>Parrainage Présidentielles 2014</h1>
<form action="." method="get">
<p>Saisissez votre N° CIN, nous allons vérifier si vous parrainez un candidat aux élections présidentielles</p>
<div class='input-append'>
<input type='text' name='cin' placeholder='Votre CIN' />
<button type='submit' class='btn'>Vérifier</button>
</div>
<?php
	if ($_GET['cin'] && !$presidents) print "<div class='alert alert-success'><b>Vous ne parrainez aucun candidat!</b></div>";
	if ($presidents) print "<div class='alert alert-error'>Vous parrainez :<br/><ol><li>". implode("</li><li>", $presidents) ."</ol></div>";
?>
</form>
<small class="muted pull-right" style="position:fixed; right:5px; bottom:5px;">Contact <a href="https://twitter.com/trojette">@trojette</a> & <a href="https://twitter.com/slim404">@slim404</a> source code <a href="https://github.com/PPTN/mounachid">https://github.com/PPTN/mounachid</a></small>
</div>
</body>
</html>
