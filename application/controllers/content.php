<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Content extends CI_Controller {

	public function validateEvent(){

		$this->load->library('form_validation');

		$validationConfig = array( //uzstādam masīvu ar ievadlauku nosacījumiem
							array(
							'field' => 'Nosaukums',
							'label' => 'Nosaukums',
							'rules' => 'required|min_length[2]|max_length[60]'),
							array(
							'field' => 'datums',
							'label' => 'datums',
							'rules' => 'required|min_length[10]|max_length[10]'),
							array(
							'field' => 'Laiks',
							'label' => 'Laiks',
							'rules' => 'min_length[5]|max_length[30]'),
							array(
							'field' => 'Apraksts',
							'label' => 'Apraksts',
							'rules' => 'max_length[200]'),
							array(
							'field' => 'Notikuma vieta',
							'label' => 'Notikuma vieta',
							'rules' => 'min_length[4]|max_length[40]'),
							array(
							'field' => 'atslegvards',
							'label' => 'Notikuma vieta',
							'rules' => 'min_length[3]|max_length[10]'),
							array(
							'field' => 'atslegvards2',
							'label' => 'Notikuma vieta',
							'rules' => 'min_length[3]|max_length[10]'),
							array(
							'field' => 'atslegvards3',
							'label' => 'Notikuma vieta',
							'rules' => 'min_length[3]|max_length[10]'),
							);

		$this->form_validation->set_rules($validationConfig); //tiek pievienoti iepriekš masīvā pierakstītie noteikumi validācijai

		if($this->form_validation->run()){ //visu nosacījumu (arī ar "callback" izsaukto funkciju, ja tādas ir) pārbaude
			$this->load->model('manage');
			if($this->manage->submitEvent()){ //izsaucam modeli, kurš pievienos notikumu datubāzei
				$this->user($this->session->userdata('id'));
			}
			else {
				echo "Some problem occured.";
			}
		} else {
			$this->load->view('submitEvent');
		}
	}

	public function user($id){ //funkcija, kas atver individuāla lietotāja skatu
		$data['id']=$id; //saglabājam padoto parametru tā, lai to varētu padot tālāk skatam

		if($this->session->userdata('is_logged_in') == 1){ //pārbaudam, vai lietotājs ir autorizējies. Lietotājus apskatīt var tikai autorizējušies lietotāji
			$this->load->view('singlePageStart');
			$this->load->view('userView', $data); //padodam lietotāja id, kuru grib apskatīt
			$this->load->view('singlePageEnd');
		} else {
		$this->load->view('login');
		}
	}

	public function notikums($nummurs){
		$data['id'] = $nummurs;
		$this->load->view('singlePageStart');
		$this->load->view('event', $data);
		$this->load->view('singlePageEnd');
	}

	public function voteUp($id){ // vērtējuma (pozitīva) nodošana
		if($this->session->userdata('is_logged_in') == 1){
			$autoraID=$this->session->userdata('id');
			$query = $this->db->get_where('balsojums', array( //pārbaudam, vai lietotājs jau ir balsojis par attiecīgo notikumu
												'Lietotaja_id' => $autoraID,
												'Notikuma_id' => $id));
			if($query->num_rows() == 1){ //ja neskaita kādu tiešā veidā datu bāzē ievadītu kļūdainu ierakstu, sistēma neatļautu atbilst nosacījumiem vairāk kā vienam ierakstam
				foreach($query->result() as $row){
				$vertiba = $row->Balsojums;
					if($vertiba == 1){
					echo "Esi jau balsojis par notikumu";
					redirect('login/goHome');
					}
					else {
					$data = array('Balsojums' => 1); //šajā punktā funkcija nonāk, ja balsojums ir bijis pirms tam, bet pretējs tagadējam
					$this->db->update('balsojums', $data, array(//atrodam īsto rindu un atjaunojam datus
														'Lietotaja_id' => $autoraID,
														'Notikuma_id' => $id));
					$query = $this->db->get_where('notikumi', array('id' => $id)); //atrodam tagadējo notikuma vērtējumu, lai pēc tam to varētu  atjaunot
					foreach($query->result() as $row){
						$vertejums = $row->Vertejums;
					}
					$vertejums += 2; //Šajā situācijā vērtējums kāps pa 2 punktiem, jo tas pārmainās no negatīva uz pozitīvu
					$data = array('Vertejums' => $vertejums); //norādam datus, kas tiks mainīti
					$this->db->update('notikumi', $data, array(//atrodam īsto rindu un atjaunojam datus
														'id' => $id));
					redirect('login/goHome');
					}
				}
			} else { //uzskatām, ka citos variantos $query būs tukšs, tātad lietotājs nebūs balsojis par šo notikumu
				$query = $this->db->get_where('notikumi', array('id' => $id)); //atrodam tagadējo notikuma vērtējumu, lai pēc tam to varētu  atjaunot
				foreach($query->result() as $row){
					$vertejums = $row->Vertejums;
				}
				$vertejums += 1; //Šajā situācijā vērtējums kāps pa 1 punktu, jo pirms tam nav bijusi balss
				$data = array('Vertejums' => $vertejums); //norādam datus, kas tiks mainīti
				$this->db->update('notikumi', $data, array(//atrodam īsto rindu un atjaunojam datus
													'id' => $id));
				$data = array(
						'Lietotaja_id' => $autoraID,
						'Notikuma_id' => $id,
						'Balsojums' => 1);
				$this->db->insert('balsojums', $data); //atzīmējam jauno balsojumu
				redirect('login/goHome');
			}
		} else {
			redirect('main/account');
		}
	}

	public function voteDown($id){ //vērtējuma negatīva nodošana
		if($this->session->userdata('is_logged_in') == 1){
			$autoraID=$this->session->userdata('id');
			$query = $this->db->get_where('balsojums', array( //pārbaudam, vai lietotājs jau ir balsojis par attiecīgo notikumu
												'Lietotaja_id' => $autoraID,
												'Notikuma_id' => $id));
			if($query->num_rows() == 1){ //ja neskaita kādu tiešā veidā datu bāzē ievadītu kļūdainu ierakstu, sistēma neatļautu atbilst nosacījumiem vairāk kā vienam ierakstam
				foreach($query->result() as $row){
				$vertiba = $row->Balsojums;
				}
				if($vertiba == -1){
				echo "Esi jau balsojis par notikumu";
				redirect('login/goHome');
				}
				else {
				$data = array('Balsojums' => -1); //šajā punktā funkcija nonāk, ja balsojums ir bijis pirms tam, bet pretējs tagadējam
				$this->db->update('balsojums', $data, array(//atrodam īsto rindu un atjaunojam datus
													'Lietotaja_id' => $autoraID,
													'Notikuma_id' => $id));
				$query = $this->db->get_where('notikumi', array('id' => $id)); //atrodam tagadējo notikuma vērtējumu, lai pēc tam to varētu  atjaunot
				foreach($query->result() as $row){
					$vertejums = $row->Vertejums;
				}
				$vertejums -= 2; //Šajā situācijā vērtējums kritīs pa 2 punktiem, jo tas pārmainās no pozitīva uz negatīvu
				$data = array('Vertejums' => $vertejums); //norādam datus, kas tiks mainīti
				$this->db->update('notikumi', $data, array(//atrodam īsto rindu un atjaunojam datus
													'id' => $id));
				redirect('login/goHome');
				}
			} else { //uzskatām, ka citos variantos $query būs tukšs, tātad lietotājs nebūs balsojis par šo notikumu
				$query = $this->db->get_where('notikumi', array('id' => $id)); //atrodam tagadējo notikuma vērtējumu, lai pēc tam to varētu  atjaunot
				foreach($query->result() as $row){
					$vertejums = $row->Vertejums;
				}
				$vertejums -= 1; //Šajā situācijā vērtējums kritīs pa 1 punktu, jo pirms tam nav bijusi balss no attiecīgā lietotāja
				$data = array('Vertejums' => $vertejums); //norādam datus, kas tiks mainīti
				$this->db->update('notikumi', $data, array(//atrodam īsto rindu un atjaunojam datus
													'id' => $id));
				$data = array(
						'Lietotaja_id' => $autoraID,
						'Notikuma_id' => $id,
						'Balsojums' => -1);
				$this->db->insert('balsojums', $data); //atzīmējam jauno balsojumu
				redirect('login/goHome');
			} 
		}
		else {
			redirect('main/account');
		}
	}
}