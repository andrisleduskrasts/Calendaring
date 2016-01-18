<?php 	
	 date_default_timezone_set('Europe/Riga');
	 $formAttributes = array('id' => 'eventForm'); //veidojam masīvu formas atribūtiem
	 echo form_open('content/validateEvent',$formAttributes); //Formu veidošana ar CodeIgniter "form helper" dotajām funkcijām. 

	 echo validation_errors();

	 $formAttributes1 = array( //veidojam masīvu ar vairākiem atribūtiem pirmajam ievadlaukam
	 					'name' => 'Nosaukums',
	 					'id' => 'nosaukumLauks',
	 					'value' => $this->input->post('Nosaukums'), //ja neizdodas reģistrēties, nākamajā ielādēšanas reizē būs jau aizpildīts lietotājvārds
	 					'type' => 'text',
	 					'pattern' => '.{2,60}',);  //HTML5 atļauj noteikt minimālo un maksimālo simbolu skaitu ar 'pattern' atribūtu
	 echo "<span id='registerUsername' class='textReg'>Nosaukums(2-60)"; 
	 echo form_input($formAttributes1); //atribūti tiek pievienoti lietotājvārda ievadlaukam
	 echo "</span>";
	 $dateAttributes = array( //izveidojam masīvu, kas saglabā atribūtus ievadlaukam
	 					'name' => 'datums',
	 					'id' => 'datumlauks',
	 					'type' => 'text',
	 					'value' => date("Y-m-d"), //Lai parādītu pareizo formātu, automātiski izsaucam date() funkciju, kas parādīs attiecīgo datumu
	 					'pattern' => '.{10,10}'); //Dokumentācijā noteikts, ka parole drīkst būt starp 8 un 20 simboliem gara
	 echo "<span id='datumTeksts' class='textReg'>Notikuma datums:";
	 echo "</span>";
	 echo "<span id='datumTeksts' class='textReg'>YYYY-mm-dd";
	 echo form_input($dateAttributes);
	 echo "</span>";
	 $formAttributes2 = array( //izveidojam masīvu, kas saglabā atribūtus ievadlaukam
	 					'name' => 'Laiks',
	 					'id' => 'Laiks',
	 					'type' => 'text',
	 					'value' => '', //ja "value" tiek atstāts tukšs, pie paroles loga nerādīsies kāda līdz uzspiešanai esoša vertība
	 					'pattern' => '.{5,30}'); //Dokumentācijā noteikts, ka parole drīkst būt starp 8 un 20 simboliem gara
	 echo "<span id='timeField' class='textReg'>Laiks(5-30)";
	 echo form_input($formAttributes2);
	 echo "</span>";
	 $formAttributes3 = array( //masīvs paroles atkārtošanas atribūtiem, tātad ļoti līdzīgi paroles laukam
	 					'name' => 'Apraksts',
	 					'id' => 'Apraksts',
	 					'type' => 'text',
	 					'value' => '',
	 					'pattern' => '.{0,200}'); //Dokumentācijā noteikts, ka parole drīkst būt starp 8 un 20 simboliem gara
	 echo "<span id='descriptionField' class='textReg'>Apraksts(līdz 200 simboliem)";
	 echo form_input($formAttributes3);
	 echo "</span>";
	 $formAttributes4 = array( //Vēl viens masīvs, kas saglabā atribūtus otrajam ievadlaukam
	 					'name' => 'Notikuma vieta',
	 					'id' => 'location',
	 					'type' => 'text',
	 					'value' => '',
	 					'pattern' => '.{4,40}'); //Dokumentācijā noteikts, ka parole drīkst būt starp 8 un 20 simboliem gara
	 echo "<span id='vietasLauks' class='textReg'>Notikuma vieta(4-40)";
	 echo form_input($formAttributes4);
	 echo "</span>";
	 $keywordAttributes = array (
	 					'type' => 'text',
	 					'name' => 'atslegvards',
	 					'class' => 'atslegvards',
	 					'pattern' => '.{3,10}');
	 $keywordAttributes2 = array (
	 					'type' => 'text',
	 					'name' => 'atslegvards2',
	 					'class' => 'atslegvards',
	 					'pattern' => '.{3,10}');
	 $keywordAttributes3 = array (
	 					'type' => 'text',
	 					'name' => 'atslegvards3',
	 					'class' => 'atslegvards',
	 					'pattern' => '.{3,10}');
	 echo "<span class='atslegvardlauks textReg'>Atslēgvārdi(3-10)";
	 echo form_input($keywordAttributes);
	 echo form_input($keywordAttributes2);
	 echo form_input($keywordAttributes3);
	 echo "</span>";

	 $formAttributes5 = array( //atribūti "submit" pogai
	 					'type' => 'submit',
	 					'name' => 'event_submit',
	 					'value' => 'Iesūtīt',
	 					'class' => 'loginbtn_login2 text');
	 echo form_submit($formAttributes5);
	 echo form_close();
	 ?>



<p class="textInLogin"><a href="<?php echo base_url();?>">Sākums</p>