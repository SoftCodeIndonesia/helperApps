<?php

    class ConfigSet extends Controller
    {
        public function __construct()
        {
            $this->helper = new Helper;
        }


        public function destroy_session()
        {
            $session = $_POST['session'];
            $this->helper->session_destory([$session]);
            echo json_encode(true);
        }
    }
    