
<div class = 'notikums'>
	<div class = 'nosaukums'>
		<p class = 'centerText'>Nosaukums</p>
	</div>
	<div class = 'nosaukums'>
		<p class = 'centerText'>Saite uz autora lapu</p>
	</div>
	<div class = 'datums'>
		<p class = 'centerText'>Datums</p>
	</div>
	<div class = 'vertejums2'>
		<p class = 'centerText'>Vertejums</p>
	</div>
	<div class = 'nosaukums'>
		<p class = 'centerText'>Atslēgvārds</p>
	</div>
</div>


<?php
	foreach($notikumuSaraksts as $row){ //katram notikumam rinda ar informāciju un dažādām saitēm
		echo "<div class = 'notikums'>";
		echo "<a href='";
		echo base_url();
		echo "content/notikums/";
		$id = $row->id;
		echo $id;
		echo "'>";
		echo "<div class = 'nosaukums'>";
		echo "<p class = 'centerText'>";
		$nosaukums = $row->Nosaukums;
		echo $nosaukums;
		echo "</p>";
		echo "</div>";
		echo "</a>";
		echo "<a href='content/user/";
		$Autora_id = $row->Autora_id;
		echo $Autora_id;
		echo "'>";
		echo "<div class = 'nosaukums'>";
		echo "<p class = 'centerText'>";
		echo "Autors";
		echo "</p>";
		echo "</div>";
		echo "</a>";
		echo "<div class = 'datums'>";
		echo "<p class = 'centerText'>";
		$datums = $row->Datums;
		echo $datums;
		echo "</p>";
		echo "</div>";
		echo "<div class = 'vertejums'>";
		echo "<a href='";
		echo base_url();
		echo "content/voteup/";
		echo $id;
		echo "'>";
		echo "<img src='";
		echo base_url();
		echo "resources/smallarrow.png' class ='votes'></a>";
		echo "<a href='";
		echo base_url();
		echo "content/votedown/";
		echo $id;
		echo "'>";
		echo "<img src='";
		echo base_url();
		echo "resources/smallarrowDown.png' class ='votes'></a>";
		echo "<p class = 'centerText'>";
		$Vertejums = $row->Vertejums;
		echo $Vertejums;
		echo "</p>";
		echo "</div>";
		echo "<div class = 'nosaukums'>";
		echo "<p class = 'centerText'>";
		$atslegvards = $row->Atslegvards;
		echo $atslegvards;
		echo "</p>";
		echo "</div>";
		echo "</div>";
	}

	?>