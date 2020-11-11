<?php

    class Penerimabantuan extends Controller
    {
        public function index()
        {
            $data['title'] = 'village assistance - catatan penerima bantuan';
            $this->view('penerima_bantuan/index',$data);
        }
    }