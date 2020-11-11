<?php

    class Catatanbantuan extends Controller
    {
        public function index()
        {
            $data['title'] = 'village assistance - catatan bantuan';
            $this->view('catatan_bantuan/index',$data);
        }
    }
    