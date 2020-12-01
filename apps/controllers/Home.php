<?php

    class Home extends Controller {
        
        public function index($param1 = "ini param")
        {
            $data['title'] = 'village assistance';
            $data['js'] = [
                'home/home.js'
            ];
            $this->view("home/index",$data);
        }
    }