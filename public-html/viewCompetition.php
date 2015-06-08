
<?php

$title = "Description détaillée d'une competition" ;
include 'includes/header.php' ;
include 'connect.php' ;

if(isset($_GET['id'])){
	
	$vConnect = Connect();
	$id = $_GET['id'];
	$request = "SELECT * FROM competition WHERE id =$id ;";
	if ( !($result = pg_query($vConnect, $request)) ) {
		echo pg_last_error() ;
		exit();
	}
		$resultcompetition = pg_fetch_array($result);
		if ( !($resultcompetition) ) {
		echo pg_last_error() ;
		exit();
	} 
	$request = "SELECT count(*) FROM participate WHERE $resultcompetition[id] = participate.competition;";
	if ( !($resultnb = pg_query($vConnect, $request)) ) {
		echo pg_last_error() ;
		exit();
	}
		$request = "SELECT vkarateka.* FROM vkarateka,participate WHERE $resultcompetition[id] = participate.competition AND vkarateka.id = participate.idk;";
	if ( !($resultkara = pg_query($vConnect, $request)) ) {
		echo pg_last_error() ;
		exit();
	}

		$resultcompetitionnb = pg_fetch_array($resultnb);
		if ( !($resultcompetitionnb) ) {
		echo pg_last_error() ;
		exit();
	} 
		$request = "SELECT c.name,r.points FROM category c, rule r WHERE $resultcompetition[id] = r.competition AND r.category=c.id";
	if ( !($resultrule = pg_query($vConnect, $request)) ) {
		echo pg_last_error() ;
		exit();
	}
	
?>
	 <section class="bg-default image" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
				<h1><?php echo $resultcompetition['name'] .' / '. $resultcompetition['type'] ?></h1>

	<div class="table-responsive">
	<table  class="table table-bordered"><caption>Liste des inscrits</caption><thead><tr><td>Nom</td><td>Prénom</td></tr></thead>
	<tbody><?php 
	while ($resultkarateka = pg_fetch_array($resultkara))
	{
		echo"<tr>";
		echo"<td>  $resultkarateka[lastname] 	</td><td>  $resultkarateka[firstname] </td>";
		echo "</tr>";
	 }?> </tbody></table></div><?php
	if($resultcompetition['statut'] == "en cours de création" && $resultcompetitionnb[0] < 8)
	{
		include 'includes/Formulaires/inscriptionCompetitionForm.php';
	}
	$ruleIn = false;
	if($resultcompetition['statut'] == "en cours de création" && $resultcompetition['type'] == 'kumite' )
	{
		?><div class="table-responsive">
	<table  class="table table-bordered"><caption>Liste des coups autorisés</caption><thead><tr><td>Nom</td><td>Points</td></tr></thead>
	<tbody><?php 
	while ($rule = pg_fetch_array($resultrule))
	{
		$ruleIn = true;
		echo"<tr>";
		echo"<td>  $rule[name] 	</td><td>  $rule[points] </td>";
		echo "</tr>";
	 }?> </tbody></table></div><?php
	 include 'includes/Formulaires/inscriptionHitForm.php';
	}
	if($resultcompetition['statut'] == "en cours/quart" || $resultcompetition['statut'] == "en cours/demi" || $resultcompetition['statut'] == "en cours/final")
	{
	if($resultcompetition['statut'] == "en cours/quart"){
		$request = "SELECT c.id,c.statut FROM confrontation c WHERE c.competition = $resultcompetition[id] AND c.round = 'quart'";
		if ( !($resultconf = pg_query($vConnect, $request)) ) {
		echo pg_last_error() ;
		exit();
		}
	}elseif($resultcompetition['statut'] == "en cours/demi"){
		$request = "SELECT c.id,c.statut FROM confrontation c WHERE c.competition = $resultcompetition[id] AND c.round = 'demi'";
		if ( !($resultconf = pg_query($vConnect, $request)) ) {
		echo pg_last_error() ;
		exit();
	}
	}elseif($resultcompetition['statut'] == "en cours/final"){
		$request = "SELECT c.id,c.statut FROM confrontation c WHERE c.competition = $resultcompetition[id] AND c.round = 'final'";
		if ( !($resultconf = pg_query($vConnect, $request)) ) {
		echo pg_last_error() ;
		exit();
	}
	}
	
		$done = true;
		$i=1;
		while($conf = pg_fetch_array($resultconf)){
		$request = "SELECT DISTINCT k.id,k.firstname,k.lastname,p.points FROM vkarateka k, participation p WHERE k.id=p.karateka AND p.confrontation=$conf[id]";
				if ( !($resultkaras= pg_query($vConnect, $request)) ) {
				echo pg_last_error() ;
				exit();
			}
					if($resultcompetition['statut'] == "en cours/demi"){
					echo '<div><h1>Demi'.$i.'/'.$conf['statut'].'</h1>';
					}
					elseif(($resultcompetition['statut'] == "en cours/quart")){						
					echo '<div><h1>Quart'.$i.'/'.$conf['statut'].'</h1>';
}else{						
					echo '<div><h1>final'.$i.'/'.$conf['statut'].'</h1>';
}
						$j=0;
						$pointstab = array();
			while($kara = pg_fetch_array($resultkaras)){
			array_push($pointstab,$kara['points']);
			echo "<div class='table-responsive'>
	<table  class='table table-bordered'><caption></caption><thead><tr><td>Nom</td><td>prenom</td><td>Points</td></tr></thead>
	<tbody><tr><td>$kara[firstname]</td><td>$kara[lastname]</td><td>$kara[points]</td></tr></tbody></table></div>";
	
	$request1 = "Select vc.* FROM vconfrontationkata vc WHERE vc.id=$conf[id]";
	$request2 = "Select vc.* FROM vconfrontationkumite vc WHERE vc.id=$conf[id]";
	$request3 = "Select vc.* FROM vconfrontationtw vc WHERE vc.id=$conf[id]";
	if ( !($resultconf1 = pg_query($vConnect, $request1)) ) {
		echo pg_last_error() ;
		exit();
	}			
	if ( !($resultconf2 = pg_query($vConnect, $request2)) ) {
		echo pg_last_error() ;
		exit();
	}			
	if ( !($resultconf3 = pg_query($vConnect, $request3)) ) {
		echo pg_last_error() ;
		exit();
	}
	$result2=pg_num_rows($resultconf2);
	$result3=pg_num_rows($resultconf3);
		if($conf['statut']=='en cours'){
			$done= false;
			if(pg_num_rows($resultconf1)>0)
			{
				
			}
			elseif(pg_num_rows($resultconf2)>0)
			{
				include 'includes/Formulaires/addHitForm.php';
			}
			else
			{
				
			}
		}
		if($j == 0)echo 'VS';

	
	$j++;
			}
			if($pointstab[0] != $pointstab[1] && $conf['statut'] == "en cours")
			{
				?>
					<form enctype="multipart/form-data" method="post" action="endGame.php">
						<input type="number" style="display:none" name="confrontation" value="<?php echo $conf['id'];?>"/>
						<input type="number" style="display:none" name="competition" value="<?php echo $resultcompetition['id'];?>"/>
						<input type="submit" value="Match terminé" />
					</form>
				<?php
			}
			$i++;
			echo '</div>';
		}
		if($done)
		{
		?>
					<form enctype="multipart/form-data" method="post" action="goToNext.php">
						<input type="number" style="display:none" name="competition" value="<?php echo $resultcompetition['id'];?>"/>
						<input type="text" style="display:none" name="statut" value="<?php echo $resultcompetition['statut'];?>"/>
						<input type="submit" value="Lancer le tour suivant" />
					</form>
		<?php
		}
	}
	if($resultcompetition['statut'] == "terminé")
	{
		$request = "SELECT c.id FROM confrontation c WHERE c.competition = $resultcompetition[id] AND c.round = 'final'";
		if ( !($resultconf = pg_query($vConnect, $request)) ) {
		echo pg_last_error() ;
		exit();
	}
		$final = pg_fetch_array($resultconf);
		$request = "SELECT MAX(p.points),p.karateka FROM participation p WHERE p.confrontation = $final[id] GROUP BY p.karateka,p.points ORDER BY p.points DESC";
		if ( !($resultconf = pg_query($vConnect, $request)) ) {
		echo pg_last_error() ;
		exit();
		}
		$winner = pg_fetch_array($resultconf);
		$request = "SELECT k.* FROM vkarateka k WHERE k.id = $winner[karateka]";
		if ( !($resultconf = pg_query($vConnect, $request)) ) {
		echo pg_last_error() ;
		exit();
		}
		$winner = pg_fetch_array($resultconf);
		?>
		<div class="table-responsive">
	<table class="table table-bordered">
	<CAPTION>VAINQUEUR</CAPTION>
	<thead>
	<tr><th>#</th><th>Name</th><th>Last Name</th></tr></thead><tbody>
	<tr>
		<td><?php echo $winner['id'] ?></td><td><?php echo $winner['firstname'] ?></td><td><?php echo $winner['lastname'] ?></td>";
		</tr>
		</tbody></table></div>
		
		<?php

	}
	pg_close($vConnect);
}
if($ruleIn && $resultcompetitionnb[0] == 8 && $resultcompetition['statut'] == "en cours de création"){
?>			
<form method="post" action="changeStatut.php">
	<input type="number" style="display:none" name="competition" value="<?php echo $resultcompetition['id'];?>"/>
	<input type="submit" value="Démarrer Competition" />
		
</form>	<?php } ?>
</div></div></div></section>