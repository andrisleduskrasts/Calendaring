<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {


	public function index()
	{
		$this->load->model('content'); //ielādējam dinamiskā satura veidotāja modeli
		$lietotajs = $this->session->userdata('Lietotajvards');
		$results["notikumuSaraksts"] = $this->content->get8results($lietotajs);
		
		if ($this->session->userdata('is_logged_in') == 1){
			$this->load->view('logStart'); // Ielādējam sākuma skata pirmo daļu
			$this->load->view('content', $results); //ielādējam dinamisko saturu
			$this->load->view('logStart2'); // Ielādējam sākuma skata otro daļu
		} else {
			$this->load->view('start'); // Ielādējam sākuma skata pirmo daļu
			$this->load->view('content', $results); //ielādējam dinamisko saturu (bet bez autorizēta lietotāja)
			$this->load->view('start2'); // Ielādējam sākuma skata otro daļu
		}
	}

	public function account() 
	{
		$this->load->view('login');
	}

	public function Register()
	{
		if($this->session->userdata('is_logged_in') == 1){ //pārbaudām, vai lietotājs nav autorizējies, pirms ļaujam reģistrēties
			$this->index();
		}
		else {
		$this->load->view('register');
		}
	}

	public function submitEvent(){
		if($this->session->userdata('is_logged_in') != 1){ //iesūtīt notikumus var tikai tad, ja lietotājs ir autorizējies
			$this->load->view('login');
		}
		else{
			$this->load->view('singlePageStart');
			$this->load->view('submitEvent');
			$this->load->view('singlePageEnd');
		}
	}
}
?>