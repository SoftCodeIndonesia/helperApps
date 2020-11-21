<?php

    class Kategoribantuan extends Controller {
        
        private $model;

        public function __construct()
        {   
            $this->helper = new Helper;
            $this->model = $this->model('KategoriBantuanModel');
        }
        
        public function index()
        {
            $this->helper->session_destory(["form_error","set_value"]);
            $data['title'] = 'village assistance - kategori bantuan';
            $data['js'] = [
                'kategori/script.js'
            ];
            $this->view("kategori_bantuan/index",$data);
        }

        public function allDataKategori()
        {
            $datakategori = $this->model->getAllData();
            $kategori = [];
            $no = 1;
            foreach ($datakategori as $value) {
                $data = [];

                $linkUbah = '<a href="' . BASE_URL . 'Pekerjaan/edit/'. $value['id_kategori_bantuan'] .'" class="btn btn-sm btn-warning">ubah</a>';
                $linkHapus = '<a href="' . BASE_URL . 'Pekerjaan/delete/'. $value['id_kategori_bantuan'] .'" class="btn btn-sm btn-danger" id="btn-delete" data-id="'.$value['id_kategori_bantuan'].'">hapus</a>';
                $linkLogin = '<a href="'.BASE_URL.'login" class="btn btn-sm btn-info">Login</a>';
                $data[] = "<th>". $no++ ."</th>";
                $data[] = "<th>".$value['name']."</th>";
                $data[] = "<th>".$value['description']."</th>";
                if(!empty($_SESSION['userdata'])){
                    $data[] = "<th class='text-center'>" . $linkUbah ." ". $linkHapus."</th>";
                }else{
                    $data[] = "<th>".$linkLogin."</th>";
                }
                $kategori[] = $data;
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => count($kategori),
                "recordsFiltered" => $this->model->count_filtered(),
                "data" => $kategori,
            );
            
            echo json_encode($output);
            exit();
        }

        public function tambah()
        {
            if(!empty($_SESSION['userdata']))
            {
                $data['title'] = 'Village assistance - tambah';
                $this->view('kategori_bantuan/tambah',$data);
            }else{
                $this->redirect(BASE_URL . 'login');
            }
        }

        public function storeCreated()
        {
            if(!empty($_SESSION['userdata']))
            {
                $data['name'] = htmlspecialchars($_POST['name']);
                $data['description'] = $_POST['description'];
                $data['created_at'] = time();
                $data['created_by'] = $_SESSION['userdata']['id_keluarga'];

                $bantuan = $this->model->getByName($data['name']);
                
                $_SESSION['set_value'] = $data;

                if($bantuan)
                {
                    
                    $_SESSION['form_error'] = [
                        'name' => 'Kategori bantuan sudah ada!'
                    ];

                    $this->redirect(BASE_URL .'Kategoribantuan/tambah');
                }else{

                    if($this->model->insert($data) > 0)
                    {
                        $this->helper->session_destory(["form_error","set_value"]);
                        $_SESSION['flash'] = 'berhasil ditambahkan';
                        $this->redirect('Kategoribantuan');
                    }else{
                        $this->helper->session_destory(["form_error","set_value"]);
                        $_SESSION['flash'] = 'gagal ditambahkan';
                        $this->redirect('Kategoribantuan');
                    }

                }

            }else{
                $this->redirect(BASE_URL . 'login');
            }
        }
    }