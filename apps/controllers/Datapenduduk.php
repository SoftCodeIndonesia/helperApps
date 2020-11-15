<?php

    class Datapenduduk extends Controller
    {
        private $db;
        private $form_validation;
        public function __construct()
        {
            $this->helper = new Helper;
            $this->db = new Database;
            $this->form_validation = new FormValidation;
        }

        public function index()
        {
            
            
            $data['title'] = 'village assistance - Data penduduk';

            $data['js'] = [
                'penduduk/penduduk.js',
            ];

            $this->view('data_penduduk/index',$data);
        }

        public function getData()
        {
            $data = $this->model('penduduk')->getAll();
            $dataPenduduk = [];
            $no = 1;
            foreach ($data as $value) {
                $penduduk = [];

                $linkUbah = '<a href="' . BASE_URL . 'datapenduduk/edit/'. $value['id_keluarga'] .'" class="btn btn-sm btn-warning">ubah</a>';
                $linkHapus = '<a href="' . BASE_URL . 'datapenduduk/delete/'. $value['id_keluarga'] .'" class="btn btn-sm btn-danger" id="btn-delete" data-id="'.$value['id_keluarga'].'">hapus</a>';
                $linkLogin = '<a href="'.BASE_URL.'login" class="btn btn-sm btn-info">Login</a>';
                $penduduk[] = "<th>". $no++ ."</th>";
                $penduduk[] = "<th>".$value['no_kk']."</th>";
                $penduduk[] = "<th>".$value['kepala_keluarga']."</th>";
                $penduduk[] = "<th>".$value['pekerjaan']."</th>";
                $penduduk[] = "<th>".$value['jumlah_keluarga']."</th>";
                $penduduk[] = "<th>".$value['jumlah_anak']."</th>";
                $penduduk[] = "<th>".$value['rt']."</th>";
                $penduduk[] = "<th>".$value['rw']."</th>";
                $penduduk[] = "<th>".$value['created_by']."</th>";
                $penduduk[] = "<th>".date('d M Y',$value['created_at'])."</th>";
                if(!empty($_SESSION['userdata'])){
                    $penduduk[] = "<th>".$linkUbah. " " . $linkHapus." </th>";
                }else{
                    $penduduk[] = "<th>".$linkLogin."</th>";
                }

                $dataPenduduk[] = $penduduk;
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => count($data),
                "recordsFiltered" => $this->model('penduduk')->count_filtered(),
                "data" => $dataPenduduk,
            );
            // var_dump($dataPen)
            echo json_encode($output);
            exit();
        }

        public function create()
        {
            if(!empty($_SESSION['userdata']))
            {
                var_dump($this->form_validation);
                if($this->form_validation == FALSE)
                {
                    $data['js'] = [
                        'penduduk/tambah.js'
                    ];
                    $data['title'] = 'village assistance - tambah';
                    $this->view('data_penduduk/tambah',$data);
                }
                
            }else{
                $this->redirect('login');
            }
        }

        public function storeCreated()
        {
            if(!empty($_SESSION['userdata'])){

                
                if($this->form_validation == FALSE)
                {
                    $this->create();
                }else{
                    $data['rules_id'] = 2;
                    $data['no_kk'] = $_POST['nokk'];
                    $data['kepala_keluarga'] = htmlspecialchars($_POST['kepala_keluarga']);
                    $data['jumlah_keluarga'] = $_POST['jml_kel'];
                    $data['jumlah_anak'] = $_POST['jumlah_anak'];
                    $data['rt'] = $_POST['rt'];
                    $data['rw'] = $_POST['rw'];
                    $pekerjaan = htmlspecialchars($_POST['pekerjaan']);
                    $data['alamat'] = "" . htmlspecialchars($_POST['alamat']) . "";
                    $data['pass'] = md5('123');
                    $data['created_at'] = (int) time();
                    $data['created_by'] = $_SESSION['userdata']['id_keluarga'];
                    $pekerjaan = $this->model('PekerjaanModel')->getByName(strtolower($pekerjaan));
                    

                    
                    if($pekerjaan)
                    {
                        $data['id_pekerjaan'] = $pekerjaan['id_pekerjaan'];
                        if($this->model('penduduk')->insert($data) > 0){
                            $this->redirect(BASE_URL . 'datapenduduk');
                        }
                    }else{
                        $pekerjaan['name'] = htmlspecialchars($_POST['pekerjaan']);
                        $pekerjaan['description'] = '';
                        $pekerjaan['created_at'] = time();
                        $pekerjaan['created_by'] = $_SESSION['userdata']['id_keluarga'];
                        $data['id_pekerjaan'] = $this->model('pekerjaanModel')->insert($pekerjaan);
                        if($data['id_pekerjaan'] > 0){
                            if($this->model('penduduk')->insert($data) > 0){
                                $this->redirect(BASE_URL . 'datapenduduk');
                            }else{
                                echo "<script>alert('data gagal ditambahkan')</script>";
                                $this->redirect(BASE_URL . 'datapenduduk/create');
                            }
                        }
                    }
                }

            }else{
                $this->redirect('login');
            }
        
            
        }


        public function delete()
        {
            if(!empty($_SESSION['userdata']))
            {
                $id_keluarga = $_POST['id_keluarga'];

                $callback = $this->model('Penduduk')->delete($id_keluarga);

                echo json_encode($callback);
            }else{
                $callback = 0;
                echo json_encode($callback);
            }
        }

        public function edit($id_keluarga)
        {
            $data['keluarga'] = $this->model('penduduk')->getDataById($id_keluarga);
            $data['title'] = "Village Assistance - update";
            $this->view('data_penduduk/ubah',$data);
        }
    }
    