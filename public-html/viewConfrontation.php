Obtenir la liste de toutes confrontations et résultats (classement par karatéka et par club) d'une compétition en cours ou terminée

<?php
$title = "Vu des Confrontations d'une Compétition" ;
include 'includes/header.php' ;
include 'connect.php' ;
$vConnect = Connect();
?>
<section class="bg-default image" id="about">
<div class="container">
<div class="row">
<div class="col-lg-8 col-lg-offset-2 text-center">
<?php
	// affichage du titre
	if (isset($_GET['competition'])) {
		$request = "SELECT name FROM competition WHERE id = $_GET[competition]";
	if ( !($result = pg_query($vConnect, $request)) ) {
		echo pg_last_error() ;
		exit();
	}
	$name = pg_fetch_array($result);
	echo "<h1>Confrontations de la Compétition <strong>$name[name]</strong></h1>";
	$display = true;
	} else {
	echo "<h1>Affichage des confrontations d'une compétition...</h1>";
	?>
	<form method="get" action="viewConfrontation.php">
	<?php
		$requestcompetition = "SELECT id, name FROM competition;";

		if( !($resultcompetition = pg_query($vConnect, $requestcompetition)) ) {
			echo pg_last_error() ;
			exit();
		}

	?>
	<label for="competition">Compétition :</label>
	<select name="competition" required>
		<?php 
		while($competition = pg_fetch_array($resultcompetition))
			echo "<option value='$competition[id]'>$competition[name]</option>";
		?>
	</select>
		
	<input type="submit" value="Envoyer" />
		
	</form>
	<?php
	$display = false;
}
if ($display) {
	?>
	<div class="table-responsive">
	<table  class="table table-bordered">
		<caption>Récapitulatif des Confrontations</caption>
		<thead><tr><td>Round</td><td>Statut</td><td>Karatéka 1 (points marqués)</td><td>Karatéka 2 (points marqués)</td></tr></thead>
		<?php
		// fat requête of the dark
		$request = "SELECT  p.confrontation, c.round, c.statut, 
						k.firstname as firstname1,
						k.lastname as lastname1,
						p.points as points1,
						k2.firstname as firstname2,
						k2.lastname as lastname2,
						p2.points as points2
						FROM confrontation c
					LEFT JOIN participation p ON p.confrontation = c.id
					LEFT JOIN vkarateka k ON k.id = p.karateka
					LEFT JOIN participation p2 ON p2.confrontation = c.id AND p2.karateka <> p.karateka
					LEFT JOIN vkarateka k2 on k2.id = p2.karateka 
					WHERE c.competition = $_GET[competition]
					ORDER BY confrontation; ";
		if ( !($result = pg_query($vConnect, $request)) ) {
			echo pg_last_error() ;
			exit();
		}
		// affichage ligne par ligne du tableau
		while( $confrontation = pg_fetch_array($result) ) {
			echo "<tr>
					<td>$confrontation[round]</td>
					<td>$confrontation[statut]</td>
					<td>$confrontation[firstname1] $confrontation[lastname1] ($confrontation[points1])</td>
					<td>$confrontation[firstname2] $confrontation[lastname2] ($confrontation[points2])</td>
				</tr>";
				$confrontation = pg_fetch_array($result); // ligne supplémentaire pour supprimer les doublons
		}
		?>
	</table>
	</div>
	<div class="table-responsive">
	<table  class="table table-bordered">
		<caption>Classement par Karatéka</caption>
		<thead><tr><td>N°</td><td>Karatéka</td><td>Nombre de Points Total</td></tr></thead>
		<?php
		$request = "SELECT  k.id, k.firstname, k.lastname,
						SUM(p.points) as total
					FROM confrontation c
					LEFT JOIN participation p ON p.confrontation = c.id
					LEFT JOIN vkarateka k ON k.id = p.karateka
					WHERE c.competition = $_GET[competition]
					GROUP BY k.id, k.firstname, k.lastname
					ORDER BY total DESC;";
		if ( !($result = pg_query($vConnect, $request)) ) {
			echo pg_last_error() ;
			exit();
		}
		$i = 1;
		// affichage ligne par ligne du tableau
		while( $karateka = pg_fetch_array($result) ) {
			echo "<tr>
					<td>$i</td>
					<td>$karateka[firstname] $karateka[lastname]</td>
					<td>$karateka[total]</td>
				</tr>";
			$i++;
		}
		?>
	</table>
	</div>
	<div class="table-responsive">
	<table  class="table table-bordered">
		<caption>Classement par Club</caption>
		<thead><tr><td>N°</td><td>Club</td><td>Nombre de Points Total</td></tr></thead>
		<?php
		$request = "SELECT CASE 
								WHEN club.name IS NULL THEN 'Sans club' 
								ELSE club.name
							END as name,
						SUM(p.points) as total
					FROM confrontation c
					LEFT JOIN participation p ON p.confrontation = c.id
					LEFT JOIN vkarateka k ON k.id = p.karateka
					LEFT JOIN club on k.clubname = club.name
					WHERE c.competition = $_GET[competition]
					GROUP BY name
					ORDER BY total DESC;";
		if ( !($result = pg_query($vConnect, $request)) ) {
			echo pg_last_error() ;
			exit();
		}
		$i = 1;
		// affichage ligne par ligne du tableau
		while( $club = pg_fetch_array($result) ) {
			echo "<tr>
					<td>$i</td>
					<td>$club[name]</td>
					<td>$club[total]</td>
				</tr>";
			$i++;
		}
		?>
	</table>
	</div>
	<?php
	pg_close($vConnect);
}

