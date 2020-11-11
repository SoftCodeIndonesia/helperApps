<?php

    class Kategoribantuan extends Controller {
        
        public function index($param1 = "ini param")
        {
            $data['title'] = 'village assistance - kategori bantuan';
            $this->view("kategori_bantuan/index",$data);
        }
    }