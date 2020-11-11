<?php

    class Rules extends Controller {
        
        public function index($param1 = "ini param")
        {
            $data['title'] = 'village assistance - rules';
            $this->view("rules/index",$data);
        }
    }