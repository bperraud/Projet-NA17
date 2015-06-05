	<?php
		include 'includes/header.php';
	include 'connect.php';
	include 'includes/fonctions.php';

		$vConnect = Connect();
		$requestkarateka = "SELECT * FROM competition;";
		if( !($resultcompetition = pg_query($vConnect, $requestkarateka)) ) {
			echo pg_last_error() ;
			exit();
		}
	?>
	 <section class="bg-default image" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 ">	<div class="table-responsive">
	<table class="table table-bordered">
	<CAPTION>Liste des competitions</CAPTION>
	<thead>
	<tr><th>#</th><th>Name</th><th>place</th><th>date</th><th>type</th><th>organisator</th></tr></thead><tbody>
	<?php while($competition = pg_fetch_array($resultcompetition)){
	echo"<tr>";
		echo"<td>$competition[id]</td><td>$competition[name]</td><td>$competition[place]</td><td>$competition[date]</td><td>$competition[type]</td><td>$competition[organisator]</td>";
		echo "</tr>";
		}
	?>
		</tbody></table></div></div></div></div></section>
	<?php pg_close($vConnect); ?>