<?php

    class Pekerjaan extends Controller {
        
        public function index($param1 = "ini param")
        {
            $data['title'] = 'village assistance - pekerjaan';
            $this->view("pekerjaan/index",$data);
        }
    }