<?php

class Manage extends CI_Model{

	public function submitEvent(){
		$data = array( //saglabājam ievadīto informāciju
				'Autora_id' => $this->session->userdata('id'),
				'Nosaukums' => $this->input->post('Nosaukums'),
				'Datums' => $this->input->post('Date'),
				'Laiks' => $this->input->post('Laiks'),
				'Apraksts' => $this->input->post('Apraksts'),
				'Notikuma vieta' => $this->input->post('Notikuma vieta'),
				'Atslegvards' => $this->input->post('atslegvards'),
				'Atslegvards2' => $this->input->post('atslegvards2'),
				'Atslegvards3' => $this->input->post('atslegvards3')
				);
	
		if($this->db->insert('notikumi', $data)){ //ievadam informāciju datubāzē un atgriežam funkcijas vērtību kā "true" vai "false", ja kaut kas notiek nepareizi
			return true;
		} else {
			return false;
		}
	}
}