<?php

    class Home extends Controller {
        
        public function index($param1 = "ini param")
        {
            $data['title'] = 'village assistance';
            $this->view("home/index",$data);
        }
    }