<?php
    
    class Login extends Controller
    {
        protected $helper;

        public function __construct()
        {
            $this->helper = new Helper;
        }

        public function index()
        {
            require_once '../apps/views/login/index.php';
        }

        public function auth()
        {
            $nokk = $_POST['nokk'];
            $pass = $_POST['password'];

            
            
            if(!empty($pass) && !empty($pass))
            {
                $user = $this->model('penduduk')->login($nokk);
                if($user)
                {
                    
                    if($user['pass'] == md5($pass)){
                        $_SESSION['userdata'] = $user;
                        $this->redirect(BASE_URL);
                    }else{
                        $_SESSION['message'] = '<div class="alert alert-danger" role="alert">
                    No KK atau Password salah!
                    </div>';

                    $this->redirect(BASE_URL . 'login');
                    }

                }else{
                    $_SESSION['message'] = '<div class="alert alert-danger" role="alert">
                    No KK atau Password salah!
                    </div>';

                    $this->redirect(BASE_URL . 'login');
                }
            }else{
                $_SESSION['message'] = '<div class="alert alert-danger" role="alert">
                    No KK dan Passwod harus diisi!
                </div>';

                $this->redirect(BASE_URL . 'login');
            }
        }

        public function logout()
        {
            session_unset();
            session_destroy();
            $this->redirect(BASE_URL . 'login');
        }
    }