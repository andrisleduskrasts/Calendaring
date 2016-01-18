<?php

	$query = $this->db->get_where('lietotajs', array('id' => $id)); //atrodam datubāzes lietotāja ierakstu
	if($query->num_rows() == 1){ //tā kā mēs zinām, ka būs viens ieraksts (vai nebūs), varam veidot visu saturu iekš šāda "if" nosacījuma. ja nav ieraksta, nebūs satura

		foreach($query->result() as $row){ 
			echo "<div id='lietotaj_info'>";
			echo "<p class='errorText'>";
			echo "Lietotājs tiek atpazīts kā ";
			$vards = $row->atpazisanasVards;
			echo $vards;
			echo ". Saraksts ar lietotāja ierakstiem:";
			if($id == $this->session->userdata('id')){
				echo "<a href='";
				echo base_url();
				echo "login/delete'><div class='loginbtn_main text'>Dzēst</div></a>";
			}
			echo "</div>";

			date_default_timezone_set('Europe/Riga'); //izmantosim PHP datuma funkciju, tāpēc norādām laika joslu
			$t_datums = (date("Y/m/d")); //izveidojam datuma mainīgo, ko varam lietot SQL pieprasījumos
			$tempCount = $this->db->get_where('notikumi', array('Autora_id' => $id));
			$tempId = $id;
			if($tempCount->num_rows() >= 6){
				$results = $this->db->query('SELECT * FROM notikumi WHERE Autora_id = "$tempId" ORDER BY Vertejums DESC, Datums DESC LIMIT 0, 6'); //ja ir 6 notikumi vai vairāk vienam autoram, atgriež tikai populārākos
				foreach($results->result() as $row){
					echo "<div class = 'notikums'>";
					echo "<a href='content/notikums/";
					$nr = $row->id;
					echo $nr;
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
			} else {
				$results = $this->db->get_where('notikumi', array('Autora_id' => $tempId)); //skatās uz visiem notikumiem, kuros ir šāds autora id
				foreach($results->result() as $row){
					echo "<div class = 'notikums'>";
					echo "<a href='content/notikums/";
					$nr = $row->id;
					echo $nr;
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
			}
		}
	}
?>