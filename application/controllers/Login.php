<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller{

	public function login_validate(){
		$this->load->library('form_validation');

		$validationConfig = array( //uzstādam masīvu ar ievadlauku nosacījumiem
							array(
							'field' => 'Lietotajvards',
							'label' => 'Lietotajvards',
							'rules' => 'required|min_length[4]|max_length[20]|callback_dataCheck'), //"callback" izsauks kādu citu funkciju un gaidīs atgriezto vērtību
							array(
							'field' => 'password',
							'label' => 'password',
							'rules' => 'required|min_length[8]|max_length[20]|md5')
							);

		$this->form_validation->set_rules($validationConfig); //tiek pievienoti iepriekš masīvā pierakstītie noteikumi validācijai

		if($this->form_validation->run()){ //visu nosacījumu (arī ar "callback" izsaukto funkciju) pārbaude
		$query = $this->db->get_where('lietotajs', array('Lietotajvards' => $this->input->post('Lietotajvards')));
		foreach($query->result() as $row){
			$id=$row->id;
		}
		$sessionData = array( //"true" gadījumā uzstādam sesijas informāciju
						'Lietotajvards' => $this->input->post('Lietotajvards'),
						'id' => $id,
						'is_logged_in' => 1);
		$this->session->set_userdata($sessionData);

		$this->goHome();
		} else {
			$this->load->view('login');
		}

	}


	public function dataCheck(){ //papildfunkcija, kas izsauks modeli un salīdzinās vertības ar datu bāzē esošajām
		$this->load->model('loginCheck');

		 if ($this->loginCheck->isDataCorrect()) {
		 	return true;
		 }	else {
		 	$this->form_validation->set_message('dataCheck','<p class ="errorText">Nepareizs lietotajvārds/parole</p>'); //paziņojums kļūdas gadījumā
		 	return false;
		 }

	}

	public function LogOut(){ //funkcija lietotāja iziešanai
		$this->session->sess_destroy(); //tiek izdzēsta sesija, attiecīgi pārbaudes ar "is_logged_in" atgriezīs tukšas vērtības
		redirect('main/index');
	}

	public function goHome(){
		$this->load->model('content'); //ielādējam dinamiskā satura veidotāja modeli
		$lietotajs = $this->session->userdata('Lietotajvards');
		$results["notikumuSaraksts"] = $this->content->get8results($lietotajs); //ielādējam sākuma skata informāciju
		if($this->session->userdata('is_logged_in') == 1){ //pārbaude, vai lietoājs ir autorizējies vai nav
			$this->load->view('logStart');
			$this->load->view('content', $results);
			$this->load->view('logStart2');
		}
		else {
			$this->load->view('start'); // Ieladejam sakuma skatu
			$this->load->view('content', $results);
			$this->load->view('start2');
		}
	}

	public function edit(){
		if($this->session->userdata('is_logged_in') == 1) { //pārbaudam, vai nav sesija beigusies, piemēram, ja lietotājs ir aizgājis prom
			$this->load->view('singlePageStart');
			$this->load->view('editInfo');
			$this->load->view('singlePageEnd');
		}
		else {
			$this->goHome();
		}
	}

	public function change_validate(){
		$validationConfig = array( //uzstādam pārbaudi, vai ievade atbilst prasībam, izņemot esošo paroli
							array(
							'field' => 'Parole',
							'label' => 'Parole',
							'rules' => 'min_length[8]|max_length[20]'), 
							array(
							'field' => 'Atpazisanas vards',
							'label' => 'Atpazisanas vards',
							'rules' => 'min_length[3]|max_length[30]'),
							array(
							'field' => 'old_password',
							'label' => 'Parole',
							'rules' => 'required|min_length[8]|max_length[20]')
							);
		$this->load->model('loginCheck'); //ielādējam mdeli, kurā esam ievietojuši paroles pārbaudīšanas funkciju

		if($this->loginCheck->checkPassword()){ //izsaucam paroles pārbaudīšanas funkciju un gaidam "true" atbildi
			$id=$this->session->userdata('id');
			if($this->input->post('Parole') != ''){ //ja ir norādīta jauna parole, ievadam to datubāzē
				$data = array('Parole' => md5($this->input->post('Parole'))); //izveidojam jauno informāciju
				$this->db->where('id', $id); //atrodam īsto rindu
				$this->db->update('lietotajs', $data); //atjaunojam datus
			}
			if($this->input->post('Atpazisanas vards') != ''){ //ja ir norādīts jauns atpazīšanas vārds, ievadam to datubāzē
				$data = array('atpazisanasVards' => $this->input->post('Atpazisanas vards'));
				$this->db->where('id', $id); //atrodam īsto rindu
				$this->db->update('lietotajs', $data);
			}
		redirect('main');
		}
		else {
			echo "Parole ir nepareiza";
			$this->load->view('singlePageStart');
			$this->load->view('editInfo');
			$this->load->view('singlePageEnd');
		}
	}

	public function delete($id){ //funkcija lietotāja izdzēšanai
		if($this->session->userdata('is_logged_in' == 1)){ //pārbaude, vai lietotāja sesija vēl nav beigusies
			$this->db->delete('lietotajs', array('id' => $id));
			$this->LogOut();
		} else {
			redirect('main/goHome');
		}
	}
}
?>