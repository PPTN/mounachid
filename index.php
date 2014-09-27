<?php
require_once "ini.php";
try {
	if ( (!empty($_POST["cin"])) || ( (!empty($_POST["fname"])) && (!empty($_POST["sname"])) && (!empty($_POST["familyname"])) ) ) {
		$q = $db->prepare('SELECT DISTINCT president FROM signatures WHERE cin=:cin OR (fname = :fname AND sname = :sname AND familyname = :familyname)');
		$q->bindValue(':cin', ltrim($_POST['cin'],'0'));
		$q->bindValue(':fname',$_POST["fname"]);
		$q->bindValue(':sname',$_POST["sname"]);
		$q->bindValue(':familyname',$_POST["familyname"]);
		if ($q->execute()) $presidents = $q->fetchAll(PDO::FETCH_COLUMN);
		if (!$presidents) $print = "<div class='alert alert-success'><b>Vous ne parrainez aucun des candidats suivants :</b><br/><ul>
				<li>Abderrahim Zouari</li>
				<li>Ali Chourabi</li>
				<li>Beji Caïd Essebsi</li>
				<li>Feris Mabrouk</li>
				<li>Hachemi Hamdi</li>
				<li>Mustapha Kamel Nabli</li>
				<li>Noureddine Hached</li>
				<li>Safi Saïd</li>
				<li>Slim Riahi</li>
				</ul></div>";
		else $print =  "<div class='alert alert-error'>Vous parrainez :<br/><ol><li>". implode("</li><li>", $presidents) ."</ol></div>";
	} else {
		$print = "<div class='alert alert-error'>Veuillez saisir votre CIN ou votre nom</div>";
	}
} catch (Exception $e) {
	fatal_error($e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Presidentielles Tunisie 2014 Verifiez quel candidat vous parrainez! :3</title>
		<link href="style.css" rel="stylesheet" >
		<link href="http://getbootstrap.com/2.3.2/assets/css/bootstrap.css" rel="stylesheet">
	</head>
<body>
	<div class="container row-fluid">
		<h1>Parrainage Présidentielles 2014</h1>
		<?php if (!empty($print)) echo $print; ?>
		<form action="." method="post">
			<p>Saisissez votre N° CIN ou vos prénom complet et nom de famille (en arabe) et nous allons vérifier si vous parrainez un candidat aux élections présidentielles</p>
			<div class='input-append'>
				<ul>
					<li><input type='text' name='cin' placeholder='Votre CIN' /></li>
					<li><input type='text' name='fname' placeholder='الإسم' /></li>
					<li><input type='text' name='sname' placeholder='إسم لأب' /></li>
					<li><input type='text' name='familyname' placeholder='اللقب'  /> </li>
					<li><button type='submit' class='btn btn-info'>Vérifier</button></li>
				</ul>
			</div>
		</form>
		<small class="muted pull-right" style="position:fixed; right:5px; bottom:5px;">Contact <a href="https://twitter.com/trojette">@trojette</a> & <a href="https://twitter.com/slim404">@slim404</a> source code <a href="https://github.com/PPTN/mounachid">https://github.com/PPTN/mounachid</a></small>
	</div>
<script type="text/javascript" src="http://api.yamli.com/js/yamli_api.js"></script>
<script type="text/javascript">
	if (typeof(Yamli) == "object" && Yamli.init( { uiLanguage: "fr" , startMode: "onOrUserDefault" } ))
	{
		Yamli.yamlify( "fname", { settingsPlacement: "inside" } );
		Yamli.yamlify( "sname", { settingsPlacement: "inside" } );
		Yamli.yamlify( "familyname", { settingsPlacement: "inside" } );

	}
</script>
</body>
</html>
