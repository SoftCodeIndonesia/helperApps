<?php

    class FormValidation 
    {
        public function __construct()
        {
            $this->checkPost();
        }


        public function checkPost()
        {
            if(empty($_POST))
            {
                return FALSE;
            }
        }
    }