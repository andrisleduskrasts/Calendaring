</div>
	<div id="pageEven">
  
		  <div class="contbookm" id="number1">
		  	<p class="text textWithLogin">
		  	<?php
		  	echo "Esat autorizējies kā ";
		  	echo $this->session->userdata('Lietotajvards');
		  	echo "</p>";
		  	?>
		  </div>

		  <div class="contbookm" id="number2">
		  	<a href="<?php echo base_url(); ?>login/logout"><div class="loginbtn_main text">Logout</div></a>
		  </div>

		  <div class="contbookm" id="number3">
		  	<a href="<?php echo base_url(); ?>main/submitEvent"><div class="loginbtn_main text">Iesūtīt</div></a><p class="text textWithLogin">Varat pievienot jaunu notikumu</p>
		  </div>

		  <div class="contbookm" id="number4">
		  	<a href="<?php echo base_url(); ?>login/edit"><div class="loginbtn_main text">Šeit</div></a><p class="text textWithLogin">Lai mainītu iestatījumus, spiežat</p>
		  </div>

		  <div class="contbookm" id="number5">
		  	<a href="<?php echo base_url(); ?>content/user/<?php
		  		echo $this->session->userdata('id');
		  	?>"><p class="text textWithLogin">Jūsu lapa</p></a>
		  </div>

		  <div class="contbookm" id="number6">
		  </div>

		  <div class="contbookm" id="number7">
		  </div>
  
  </div>
  </div>
  <div id='bookmarks'>
  </div>
  </div>
</div>
</body>
</html>