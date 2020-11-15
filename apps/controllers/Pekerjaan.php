<?php

    class Pekerjaan extends Controller {

        public function __construct()
        {
            $this->helper = new Helper;
        }
        
        public function index()
        {
            $data['title'] = 'village assistance - pekerjaan';
            $this->view("pekerjaan/index",$data);
        }


        public function getAutocomplete()
        {
            $pekerjaan = $this->model('PekerjaanModel')->getAutocomplete();
            // $pekerjaan = $this->model('pekerjaan')->getByName('pengangguran');
            $callback = [];
            foreach ($pekerjaan as $value) {
                $callback[] .= $value['name'];
            }

            echo json_encode($callback);
        }
    }