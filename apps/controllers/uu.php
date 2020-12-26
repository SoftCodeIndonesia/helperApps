<?php  
class uu extends Controller 
 {
        protected $helper;

        public function __construct()
        {
            $this->helper = new Helper;
        }

        public function index()
        {
            $data['title'] = 'UU Penerima Bantuan';
          
             
            $this->view("uu/index",$data);
        }

}
?>