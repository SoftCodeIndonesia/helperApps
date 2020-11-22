<?php

    class Catatanbantuan extends Controller
    {
        private $model;
        public function __construct()
        {
            $this->helper = new Helper;
            $this->model = $this->model('catatanModel');

        }

        public function index()
        {
            $this->helper->session_destory(["form_error","set_value"]);
            $data['title'] = 'village assistance - catatan bantuan';
            $data['js'] = [
                'catatan/index.js'
            ];
            $this->view('catatan_bantuan/index',$data);
        }

        public function allCatatan()
        {
            $catatan = $this->model->getAllData();
            $catatan_bantuan = [];
            $no = 1;
            foreach ($catatan as $value) {
                $data = [];

                $linkUbah = '<a href="' . BASE_URL . 'catatan/edit/'. $value['id_bantuan'] .'" class="btn btn-sm btn-warning">ubah</a>';
                $linkHapus = '<a href="' . BASE_URL . 'catatan/delete/'. $value['id_bantuan'] .'" class="btn btn-sm btn-danger" id="btn-delete" data-id="'.$value['id_bantuan'].'">hapus</a>';
                $linkLogin = '<a href="'.BASE_URL.'login" class="btn btn-sm btn-info">Login</a>';
                $data[] = "<th>". $no++ ."</th>";
                $data[] = "<th>".$value['name']."</th>";
                $data[] = "<th>". $value['periode'] ."</th>";
                $data[] = "<th>". $no++ ."</th>";
                $data[] = "<th>".$value['description']."</th>";
                $data[] = "<th>".$value['created_by']."</th>";
                $data[] = "<th>".$value['created_at']."</th>";
                if(!empty($_SESSION['userdata'])){
                    $data[] = "<th class='text-center'>" . $linkUbah ." ". $linkHapus."</th>";
                }else{
                    $data[] = "<th>".$linkLogin."</th>";
                }
                $catatan_bantuan[] = $data;
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => count($catatan_bantuan),
                "recordsFiltered" => $this->model->count_filtered(),
                "data" => $catatan_bantuan,
            );
            
            echo json_encode($output);
            exit();
        }

        public function tambah()
        {
            if($_SESSION['userdata'])
            {
                $data['title'] = 'Village Assistance - tambah data';
                $data['kategori'] = $this->model->getKategoriBantuan();
                $this->view('catatan_bantuan/tambah',$data);
            }else{
                $this->redirect(BASE_URL . "login");
            }
        }

        public function storeCreated()
        {
            $data['id_kategori_bantuan'] = $_POST['kategori'];
            $data['periode'] = strtotime($_POST['periode']);
            $data['description'] = $_POST['description'];
            $data['created_at'] = time();
            $data['created_by'] = $_SESSION['userdata']['id_keluarga'];

            $kategori = $this->model('kategoriBantuanModel')->getById($data['id_kategori_bantuan']);
            $catatan = $this->model->getByPeriodeAndName($data['id_kategori_bantuan'],$data['periode']);

            if($catatan)
            {
                $_SESSION['set_value'] = $data;
                $_SESSION['form_error'] = [
                    'periode' => $kategori['name'] . ' periode ' . date('Y-M-d',$data['periode']) . ' sudah ada!',
                ];
                $this->redirect(BASE_URL . "catatanbantuan/tambah");
            }else{
                if($this->model->insert($data) > 0)
                {
                    $_SESSION['flash'] = 'berhasil ditambahkan';
                    $this->redirect(BASE_URL . 'catatanbantuan');
                }
            }
        }
    }
    