<?php

class LoginCheck extends CI_Model{

	public function isDataCorrect(){ //salīdzinām autorizēšanās ievaddatus ar datubāzi
		$this->db->where('Lietotajvards', $this->input->post('Lietotajvards'));
		$this->db->where('Parole', md5($this->input->post('password')));
		$query = $this->db->get('lietotajs');

		if($query->num_rows() == 1){ //ja ievadinformācija būs pareiza, tiks atgriezta viena rinda, kurā sakritīs lietotājvārds un parole
			return true;
		} else {
			return false;
		}
	}

	public function addUser(){ //funkcija reģistrācijas informācijas saglabāšanai datubāzē
		$atpazvards = '';
		if($this->input->post('Atpazisanas Vards') == ''){
			$atpazvards = $this->input->post('Lietotajvards');
		} else {
			$atpazvards = $this->input->post('Atpazisanas Vards');
		}

		$data = array( //saglabājam ievadīto informāciju
				'Lietotajvards' => $this->input->post('Lietotajvards'),
				'Parole' => md5($this->input->post('password')),
				'atpazisanasVards' => $atpazvards);
	
		if($this->db->insert('lietotajs', $data)){
			return true;
		} 	else {
			return false;
		}
	}

	public function checkPassword(){
		$id = $this->session->userdata('id');
		$query = $this->db->get_where('lietotajs', array('id' => $id)); //atrodam datubāzes lietotāja ierakstu
		foreach($query->result() as $row){
			$password = $row->Parole; //iedodam mainīgajam "$password" šifrētu paroli
		}
		if($password == md5($this->input->post('old_password'))){ //salīdzinam iesūtīto paroli ar īsto paroli
			return true;
		}
		else {
			return false;
		}
	}

}