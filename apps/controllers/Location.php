<?php

    class Location extends Controller
    {
        public function __construct()
        {
            $this->helper = new Helper;
        }

        public function index($lat,$lng,$name)
        {
            $_SESSION['lat'] = $lat;
            $_SESSION['lng'] = $lng;
            $_SESSION['name'] = $name;
            $this->redirect(BASE_URL . 'Location/viewLocation');
        }

        public function viewLocation()
        {
            $data['title'] = 'village assistance - View Location';
            $data['js'] = [
                'location/script.js'
            ];
            $this->view("location/index",$data);
        }
    }
    