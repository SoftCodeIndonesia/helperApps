<?php

    class Catatanbantuan extends Controller
    {
        public function __construct()
        {
            $this->helper = new Helper;
        }

        public function index()
        {
            $data['title'] = 'village assistance - catatan bantuan';
            $this->view('catatan_bantuan/index',$data);
        }

        public function tambah()
        {
            $data['title'] = 'Village Assistance - tambah data';
            $this->view('catatan_bantuan/tambah',$data);
        }
    }
    