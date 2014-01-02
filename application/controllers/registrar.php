<?php
class Registrar extends CI_Controller {
   
   function index(){
      //http://localhost/ebay/index.php/registrar
      	$data['tituloHead'] = "IWeBay Regístrate";
		$data['tituloBody'] = "IWeBay";
		$this->load->view('registrar/registrar.php', $data);
   }

}
?>