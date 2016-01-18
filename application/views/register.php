<!DOCTYPE html>
<html lang='en'>
<head>
	<link href='http://fonts.googleapis.com/css?family=Merriweather+Sans' rel='stylesheet' >
	<link href="<?php echo base_url(); ?>css/book-style2.css" rel="stylesheet" type="text/css" />
	<meta charset="UTF-8">
	<title>Register</title>
	<script src="<?php echo base_url(); ?>js_funkcijas/jquery_1.9.1.js"></script>
	<script src="<?php echo base_url(); ?>js_funkcijas/jsfunctions.js"></script>
</head>
<body>
<div id="centercontainer">
 <div id="registerField">
	 <?php 	
	 $formAttributes = array('id' => 'Registerform'); //veidojam masīvu formas atribūtiem
	 echo form_open('register/register_validate',$formAttributes); //Formu veidošana ar CodeIgniter "form helper" dotajām funkcijām. 

	 echo validation_errors();

	 $formAttributes1 = array( //veidojam masīvu ar vairākiem atribūtiem pirmajam ievadlaukam
	 					'name' => 'Lietotajvards',
	 					'id' => 'username',
	 					'value' => $this->input->post('Lietotajvards'), //ja neizdodas reģistrēties, nākamajā ielādēšanas reizē būs jau aizpildīts lietotājvārds
	 					'type' => 'text',
	 					'pattern' => '.{4,20}',);  //HTML5 atļauj noteikt minimālo un maksimālo simbolu skaitu ar 'pattern' atribūtu
	 echo "<span id='registerUsername' class='textReg'>Lietotājvārds(4-20)"; 
	 echo form_input($formAttributes1); //atribūti tiek pievienoti lietotājvārda ievadlaukam
	 echo "</span>";
	 $formAttributes2 = array( //izveidojam masīvu, kas saglabā atribūtus ievadlaukam
	 					'name' => 'password',
	 					'id' => 'password',
	 					'type' => 'text',
	 					'value' => '', //ja "value" tiek atstāts tukšs, pie paroles loga nerādīsies kāda līdz uzspiešanai esoša vertība
	 					'pattern' => '.{8,20}'); //Dokumentācijā noteikts, ka parole drīkst būt starp 8 un 20 simboliem gara
	 echo "<span id='passcontainer2' class='textReg'>Parole(8-20)";
	 echo form_password($formAttributes2);
	 echo "</span>";
	 $formAttributes3 = array( //masīvs paroles atkārtošanas atribūtiem, tātad ļoti līdzīgi paroles laukam
	 					'name' => 'repeat_password',
	 					'id' => 'repeat_password',
	 					'type' => 'text',
	 					'value' => '',
	 					'pattern' => '.{8,20}'); //Dokumentācijā noteikts, ka parole drīkst būt starp 8 un 20 simboliem gara
	 echo "<span id='passcontainer3' class='textReg'>Atkārtot";
	 echo form_password($formAttributes3);
	 echo "</span>";
	 $formAttributes4 = array( //Vēl viens masīvs, kas saglabā atribūtus otrajam ievadlaukam
	 					'name' => 'Atpazisanas vards',
	 					'id' => 'atpazVards',
	 					'type' => 'text',
	 					'value' => $this->input->post('Atpazisanas Vards'),
	 					'pattern' => '.{3,30}'); //Dokumentācijā noteikts, ka parole drīkst būt starp 8 un 20 simboliem gara
	 echo "<span id='atpazisanasVards' class='textReg'>Alias";
	 echo form_input($formAttributes4);
	 echo "</span>";
	 $formAttributes5 = array( //atribūti "submit" pogai
	 					'type' => 'submit',
	 					'name' => 'register_submit',
	 					'value' => 'Reģistrēties',
	 					'class' => 'loginbtn_login2 text');
	 echo form_submit($formAttributes5);
	 echo form_close();
	 echo "<p class='textInLogin'>Vai</br></p>";
	 ?>
	 <p class="textInLogin"><a href="<?php echo base_url(); //iekš "config.php" faila esam uzstādījuši, kāda vērtība tiek atgriezta "base_url()" funkcijai
	 ?>main/account">autorizējies</a></br></p>
	 <p class="textInLogin"><a href="<?php echo base_url();?>">Sākums</p>
  </div>
  </div>
</body>
</html>