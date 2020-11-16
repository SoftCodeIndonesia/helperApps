<?php

    class Helper
    {
        public function redrect($url)
        {
            header('location: ' . $url);
        }

        public function form_error($field)
        {
            if(!empty($_SESSION['form_error'][$field]))
            {
                echo $_SESSION['form_error'][$field];
            }
        }

        public function set_value($field)
        {
            if(!empty($_SESSION['set_value'][$field]))
            {
                echo $_SESSION['set_value'][$field];
            }

            
        }

        public function session_destory($session = [])
        {
            foreach ($session as $value) {
                unset($_SESSION[$value]);
            }
        }
    }