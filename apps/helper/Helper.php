<?php

    class Helper
    {
        public function redrect($url)
        {
            header('location: ' . $url);
        }
    }