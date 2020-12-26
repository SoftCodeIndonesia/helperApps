<?php  
class Pekalongan extends Controller 
 {
        protected $helper;

        public function __construct()
        {
            $this->helper = new Helper;
        }

        public function index()
        {
            $data['title'] = 'profil kab pekalongan';
          
             
            $this->view("pekalongan/index",$data);
        }

}
?>