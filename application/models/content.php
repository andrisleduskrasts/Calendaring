<?php

class Content extends CI_Model{


	public function get8results($lietotajs){ //funkcija pirmo 8 rezultātu iegūšanai

		date_default_timezone_set('Europe/Riga'); //izmantosim PHP datuma funkciju, tāpēc norādām laika joslu
		$t_datums = (date("Y/m/d")); //izveidojam datuma mainīgo, ko varam lietot SQL pieprasījumos
		$tempCount = $this->db->query('SELECT * FROM notikumi WHERE Datums >= "$t_datums"');
		if($tempCount->num_rows() >= 8){
			if($this->session->userdata('is_logged_in') != 1) { //sākam veidot saturu, ja lietotājs nav autorizējies, tātad pamata skatījums bez nosacījumiem
				$query = $this->db->get_where('notikumi', array('Datums' => $t_datums)); //ielādēs tekošās dienas notikumus, kuri ir tas, ko pamatā redz, ja vienā dienā ir vairāk par 8 notikumiem, lapa būs pilna ar vienas dienas notikumiem.
				if ($query->num_rows() > 8){

					$results = $this->db->query('SELECT * FROM notikumi WHERE Datums = "$t_datums" ORDER BY Vertejums DESC,Nosaukums ASC LIMIT 0, 8'); //skatās tikai uz attiecīgās dienas datubāzi un atgriež 8 ar lielāko vērtējumu
					return $results->result();
				} else {

					$results = $this->db->query('SELECT * FROM notikumi ORDER BY Datums ASC, Vertejums DESC, Nosaukums ASC LIMIT 0, 8');//skatās uz visiem notikumiem, atgriež  8 pirmos pēc kritērijiem
					return $results->result();
				}
			} else { //ja lietotājs ir autorizējies, rezultātiem jāseko viņa iestatītajām nozarēm
				$query = $this->db->query('SELECT * FROM lietotajs WHERE Lietotajvards = "$lietotajs"');
				$nozare1 = '';
				$nozare2 = '';
				$nozare3 = '';
				foreach($query->result() as $row){ //ir tikai viens rezultāts, kas piešķirs mainīgajiem lietotāja izvēlētās nozares
					$nozare1 = $row->autoIzvele;
					$nozare2 = $row->autoIzvele2;
					$nozare3 = $row->autoIzvele3;
				}
				if($nozare1 != ''){ //veidojam nosacījumu koku, kā rezultātā rezultāti atbildīs lietotāja iestatījumiem
					if($nozare2 != ''){
						if($nozare3 != ''){
							$results = $this->db->query('SELECT * FROM notikumi WHERE autoIzvele = "$nozare1" AND autoIzvele2 = "$nozare2" AND autoIzvele3 = "$nozare3" ORDER BY Datums ASC, Vertejums Desc, Nosaukums ASC LIMIT 0, 8');
							return $results->result();
						}
						$results = $this->db->query('SELECT * FROM notikumi WHERE autoIzvele = "$nozare1" AND autoIzvele2 = "$nozare2" ORDER BY Datums ASC, Vertejums Desc, Nosaukums ASC LIMIT 0, 8');
						return $results->result();
					}
					$results = $this->db->query('SELECT * FROM notikumi WHERE autoIzvele = "$nozare1" ORDER BY Datums ASC, Vertejums Desc, Nosaukums ASC LIMIT 0, 8');
					return $results->result();
				}
				else {
					$results = $this->db->query('SELECT * FROM notikumi ORDER BY Datums ASC, Vertejums DESC, Nosaukums ASC LIMIT 0, 8'); //rezultāti, ja lietotājs ir autorizējies, bet viņam nav apskates iestatījumu
					return $results->result();
				}
			}
		}
		else {
			if($this->session->userdata('is_logged_in') != 1){
				$results = $this->db->query('SELECT * FROM notikumi ORDER BY Datums ASC, Vertejums DESC, Nosaukums ASC');
				return $results->result();
			}
			else{
				$nozare1 = '';
				$nozare2 = '';
				$nozare3 = '';
				$query = $this->db->query('SELECT * FROM lietotajs WHERE Lietotajvards = "$lietotajs"');
				foreach($query->result() as $row){ //ir tikai viens rezultāts, kas piešķirs mainīgajiem lietotāja izvēlētās nozares
					$nozare1 = $row->autoIzvele;
					$nozare2 = $row->autoIzvele2;
					$nozare3 = $row->autoIzvele3;
				}
				if($nozare1 != ''){ //veidojam nosacījumu koku, kā rezultātā rezultāti atbildīs lietotāja iestatījumiem
					if($nozare2 != ''){
						if($nozare3 != ''){
							$results = $this->db->query('SELECT * FROM notikumi WHERE autoIzvele = "$nozare1" AND autoIzvele2 = "$nozare2" AND autoIzvele3 = "$nozare3" ORDER BY Datums ASC, Vertejums Desc, Nosaukums ASC');
							return $results->result();
						}
						$results = $this->db->query('SELECT * FROM notikumi WHERE autoIzvele = "$nozare1" AND autoIzvele2 = "$nozare2" ORDER BY Datums ASC, Vertejums Desc, Nosaukums ASC');
						return $results->result();
					}
					$results = $this->db->query('SELECT * FROM notikumi WHERE autoIzvele = "$nozare1" ORDER BY Datums ASC, Vertejums Desc, Nosaukums ASC');
					return $results->result();
				}
				else {
					$results = $this->db->query('SELECT * FROM notikumi ORDER BY Datums ASC, Vertejums DESC, Nosaukums ASC'); //rezultāti, ja lietotājs ir autorizējies, bet viņam nav apskates iestatījumu
					return $results->result();
				}
			}
		}
	}
}