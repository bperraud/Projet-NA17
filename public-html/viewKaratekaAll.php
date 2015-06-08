<?php
		include 'includes/header.php';
	include 'connect.php';
	include 'includes/fonctions.php';

		$vConnect = Connect();
		$requestkarateka = "SELECT * FROM vkarateka;";
		if( !($resultkarateka = pg_query($vConnect, $requestkarateka)) ) {
			echo pg_last_error() ;
			exit();
		}
	?>
	 <section class="bg-default image" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 ">	<div class="table-responsive">
	<table class="table table-bordered">
	<CAPTION>Liste des karatekas</CAPTION>
	<thead>
	<tr><th>#</th><th>Name</th><th>Last Name</th><th>Details</th></tr></thead><tbody>
	<?php while($karateka = pg_fetch_array($resultkarateka)){
	echo"<tr>";
		echo"<td>$karateka[id]</td><td>$karateka[firstname]</td><td>$karateka[lastname]</td><td><a href='viewKarateka.php?id=$karateka[id]'>here</a></td>";
		echo "</tr>";
		}
	?>
		</tbody></table></div></div></div></div></section>
	<?php pg_close($vConnect); ?>