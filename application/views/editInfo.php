 <div id="login2">
 <?php 	
	 $formAttributes = array('id' => 'loginform'); //veidojam masīvu formas atribūtiem
	 echo form_open('login/change_validate',$formAttributes); //Formu veidošana ar CodeIgniter "form helper" dotajām funkcijām. 

	 echo validation_errors();

	 $formAttributes1 = array( //veidojam masīvu ar vairākiem atribūtiem pirmajam ievadlaukam
	 					'name' => 'Parole',
	 					'id' => 'password',
	 					'value' => '', //ja neizdodas reģistrēties, nākamajā ielādēšanas reizē būs jau aizpildīts lietotājvārds
	 					'type' => 'text',
	 					'pattern' => '.{8,20}',);  //HTML5 atļauj noteikt minimālo un maksimālo simbolu skaitu ar 'pattern' atribūtu
	 echo "<span id='registerUsername' class='textReg'>Jaunā parole(8-20)"; 
	 echo form_password($formAttributes1); //atribūti tiek pievienoti lietotājvārda ievadlaukam
	 echo "</span>";
	 $formAttributes4 = array( //Vēl viens masīvs, kas saglabā atribūtus otrajam ievadlaukam
	 					'name' => 'Atpazisanas vards',
	 					'id' => 'atpazVards',
	 					'type' => 'text',
	 					'value' => '',
	 					'pattern' => '.{3,30}'); //Dokumentācijā noteikts, ka parole drīkst būt starp 8 un 20 simboliem gara
	 echo "<span id='atpazisanasVards2' class='textReg'>Alias";
	 echo form_input($formAttributes4);
	 echo "</span>";
	 $formAttributes3 = array( //masīvs paroles atkārtošanas atribūtiem, tātad ļoti līdzīgi paroles laukam
	 					'name' => 'old_password',
	 					'id' => 'old_password',
	 					'type' => 'text',
	 					'value' => '',
	 					'pattern' => '.{8,20}'); //Dokumentācijā noteikts, ka parole drīkst būt starp 8 un 20 simboliem gara
	 echo "<span id='oldpassword' class='textReg'>Parole";
	 echo form_password($formAttributes3);
	 echo "</span>";
	 $formAttributes5 = array( //atribūti "submit" pogai
	 					'type' => 'submit',
	 					'name' => 'change_submit',
	 					'value' => 'Izmainīt',
	 					'class' => 'loginbtn_login2 text');
	 echo form_submit($formAttributes5);
	 echo form_close();
?>
<p class="textInLogin"><a href="<?php echo base_url();?>">Sākums</p>