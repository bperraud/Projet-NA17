<form method="post" action="addHit.php">

	<?php
		$vConnect = Connect();
		$requestrule = "SELECT c.id,c.name,c.subc,r.points FROM category c,rule r WHERE r.category = c.id and r.competition=$resultcompetition[id];";
		if( !($resultrule = pg_query($vConnect, $requestrule)) ) {
			echo pg_last_error() ;
			exit();
		}
	?><select name="hit" required>
	<?php while($rule = pg_fetch_array($resultrule)){
		echo "<option value='$rule[id]'>$rule[name] - $rule[subc]</option>";
}
	?>
	</select>
	<input type="number" style="display:none" name="karateka" value="<?php echo $kara['id'];?>"/>
	<input type="number" style="display:none" name="confrontation" value="<?php echo $conf['id'];?>"/>
	<input type="number" style="display:none" name="competition" value="<?php echo $resultcompetition['id'];?>"/>
	<input type="submit" value="Ajouter" />
		
</form>