<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class register extends CI_Controller{

	public function register_validate(){
		$this->load->library('form_validation');

		$validationConfig = array( //uzstādam masīvu ar ievadlauku nosacījumiem
							array(
							'field' => 'Lietotajvards',
							'label' => 'Lietotajvards',
							'rules' => 'required|min_length[4]|max_length[20]|is_unique[lietotajs.Lietotajvards]'), //"callback" izsauks kādu citu funkciju un gaidīs atgriezto vērtību
							array(
							'field' => 'password',
							'label' => 'parole',
							'rules' => 'required|min_length[8]|max_length[20]|matches[repeat_password]'),
							array(
							'field' => 'repeat_password',
							'label' => 'Atkartot',
							'rules' => 'required|min_length[8]|max_length[20]'),
							array(
							'field' => 'Atpazisanas Vards',
							'label' => 'Atpazisanas Vards',
							'rules' => 'min_length[3]|max_length[30]')
							);

		$this->form_validation->set_rules($validationConfig); //tiek pievienoti iepriekš masīvā pierakstītie noteikumi validācijai

		$this->form_validation->set_message('is_unique','<p class="errorText">Lietotajvārds jau ir aizņemts</p>'); //pārsaucam kļūdas paziņojumu, tas tiks izvadīts latviešu valodā, kā arī pievienojam stilu

		if($this->form_validation->run()){ //visu nosacījumu (arī ar "callback" izsaukto funkciju) pārbaude
			$this->load->model('logincheck');
			if($this->logincheck->addUser()){ //izsaucam modeli, kurš pievienos lietotāju datubāzei
				$sessionData = array( //"true" gadījumā uzstādam sesijas informāciju
							'Lietotajvards' => $this->input->post('Lietotajvards'),
							'is_logged_in' => 1);
				$this->session->set_userdata($sessionData); //ar šo mēs uzskatām, ka pēc reģistrācijas lietotājs ir arī autorizējies.
				redirect('login/goHome');
			}
			else {
				echo "Some problem occured.";
			}
		} else {
			$this->load->view('register');
		}
	}
}