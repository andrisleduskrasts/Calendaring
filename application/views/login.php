<!DOCTYPE html>
<html lang='en'>
<head>
	<link href='http://fonts.googleapis.com/css?family=Merriweather+Sans' rel='stylesheet' >
	<link href="<?php echo base_url(); ?>css/book-style2.css" rel="stylesheet" type="text/css" />
	<meta charset="UTF-8">
	<title>Login page</title>
	<script src="<?php echo base_url(); ?>js_funkcijas/jquery_1.9.1.js"></script>
	<script src="<?php echo base_url(); ?>js_funkcijas/jsfunctions.js"></script>
</head>
<body>
<div id="centercontainer">
 <div id="login">
	 <?php 	
	 $formAttributes = array('id' => 'loginform'); //veidojam masīvu formas atribūtiem
	 echo form_open('Login/login_validate',$formAttributes); //Formu veidošana ar CodeIgniter "form helper" dotajām funkcijām. 

	 echo validation_errors(); //paziņos par kļūdām, kuras pārbauda uzstādītajā formas validācijā
	 
	 $formAttributes1 = array( //veidojam masīvu ar vairākiem atribūtiem pirmajam ievadlaukam
	 					'name' => 'Lietotajvards',
	 					'id' => 'username',
	 					'value' => 'Lietotajvards',
	 					'type' => 'text',
	 					'onfocus' => "return makeItUsername('loginforminput')", //izsauc javascript funkciju teksta novākšanai
	 					'pattern' => '.{4,20}',);  //HTML5 atļauj noteikt minimālo un maksimālo simbolu skaitu ar 'pattern' atribūtu
	 echo "<span id='loginforminput'>"; 
	 echo form_input($formAttributes1); //atribūti tiek pievienoti lietotājvārda ievadlaukam
	 echo "</span>";
	 
	 $formAttributes2 = array( //Vēl viens masīvs, kas saglabā atribūtus otrajam ievadlaukam
	 					'name' => 'password',
	 					'id' => 'password',
	 					'type' => 'text',
	 					'value' => 'Password',
	 					'pattern' => '.{8,20}', //Dokumentācijā noteikts, ka parole drīkst būt starp 8 un 20 simboliem
	 					'onfocus' => "return makeItPassword('passcontainer'),");
	 echo "<span id='passcontainer'>";
	 echo form_password($formAttributes2);
	 echo "</span>";
	 
	 $formAttributes3 = array( //atribūti "submit" pogai
	 					'type' => 'submit',
	 					'name' => 'login_submit',
	 					'value' => 'Sākt',
	 					'class' => 'loginbtn_login text');
	 echo form_submit($formAttributes3);
	 
	 echo form_close();
	 
	 echo "<p class='textInLogin'>Vai</br></p>";
	 ?>
	 <p class="textInLogin"><a href="<?php echo base_url(); //iekš "config.php" faila esam uzstādījuši, kāda vērtība tiek atgriezta "base_url()" funkcijai
	 ?>main/Register">piereģistrējies</a></br></p>
	 <p class="textInLogin"><a href="<?php echo base_url();?>">Sākums</p>
  </div>
  </div>
</body>
</html>