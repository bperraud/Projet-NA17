	<?php
		include 'includes/header.php';
	include 'connect.php';
	include 'includes/fonctions.php';

		$vConnect = Connect();
		$requestcompetition = "SELECT * FROM competition;";
		if( !($resultcompetition = pg_query($vConnect, $requestcompetition)) ) {
			echo pg_last_error() ;
			exit();
		}
		$i = 0;
	?>
	 <section class="bg-default image" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-2 ">	<div class="table-responsive">
	<table class="table table-bordered">
	<CAPTION>Liste des competitions</CAPTION>
	<thead>
	<tr><th>#</th><th>Name</th><th>place</th><th>date</th><th>type</th><th>organisator</th><th>inscrit</th><th>statut</th><th>Details</th><th>Results</th></tr></thead><tbody>
	<?php 
	while($competition = pg_fetch_array($resultcompetition)){
			$requestnbkarateka = "SELECT count(*) FROM participate WHERE $competition[id] = participate.competition;";
		if( !($resultnb = pg_query($vConnect, $requestnbkarateka)) ) {
			echo pg_last_error() ;
			exit();
		}
		$result = pg_fetch_array($resultnb);

		
	echo"<tr>";
		echo"<td>$competition[id]</td><td>$competition[name]</td>
			<td>$competition[place]</td>
			<td>$competition[date]</td>
			<td>$competition[type]</td>
			<td>$competition[organisator]</td>
			<td>$result[0] / 8</td>
			<td>$competition[statut]</td>
			<td><a href='viewCompetition.php?id=$competition[id]'>here</a></td>
			<td><a href='viewConfrontation.php?id=$competition[id]'>here</a></td>";
		echo "</tr>";
	}?>
		</tbody></table></div></div></div></div></section>
	<?php pg_close($vConnect); ?>