<?php

    class Datapenduduk extends Controller
    {
        private $db;
        private $form_validation;
        public function __construct()
        {
            $this->helper = new Helper;
            $this->db = new Database;
            
        }

        public function index()
        {
            
            $this->helper->session_destory(["form_error","set_value"]);
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

            echo json_encode($output);
            exit();
        }

        public function create()
        {
            if(!empty($_SESSION['userdata']))
            {
                
                $data['js'] = [
                    'penduduk/tambah.js'
                ];
                $data['title'] = 'village assistance - tambah';
                $this->view('data_penduduk/tambah',$data);
                
            }else{
                $this->redirect('login');
            }
        }

        public function storeCreated()
        {
            if(!empty($_SESSION['userdata'])){
                
                
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
                $data['nama_pekerjaan'] = htmlspecialchars($_POST['pekerjaan']);
                $_SESSION['set_value'] = $data;
                if(strlen($data['no_kk']) < 16){
                    $_SESSION['form_error'] = [
                        'nokk' => "No KK harus berisi 16 karakter"
                    ];
                    $this->redirect(BASE_URL . "datapenduduk/create");
                    return false;
                }

                
                if($pekerjaan)
                {  
                    
                    $data['id_pekerjaan'] = $pekerjaan['id_pekerjaan'];
                    if($this->model('penduduk')->insert($data) > 0){
                        $_SESSION['flash'] = "ditambahkan";
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
                            $_SESSION['flash'] = "ditambahkan";
                            $this->redirect(BASE_URL . 'datapenduduk');
                        }else{
                            echo "<script>alert('data gagal ditambahkan')</script>";
                            $this->redirect(BASE_URL . 'datapenduduk/create');
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
            $_SESSION['no_kk'] = $data['keluarga']['no_kk'];
            $data['js'] = [
                'penduduk/tambah.js'
            ];
            $data['title'] = "Village Assistance - update";
            $this->view('data_penduduk/ubah',$data);
        }

        public function storeUpdated()
        {      
            $id_keluarga = $_POST['id_keluarga'];


            $data['no_kk'] = $_POST['nokk'];
            $data['kepala_keluarga'] = htmlspecialchars($_POST['kepala_keluarga']);
            $data['jumlah_keluarga'] = $_POST['jml_kel'];
            $data['jumlah_anak'] = $_POST['jumlah_anak'];
            $data['rt'] = $_POST['rt'];
            $data['rw'] = $_POST['rw'];
            $pekerjaan = htmlspecialchars($_POST['pekerjaan']);
            $data['alamat'] = "" . htmlspecialchars($_POST['alamat']) . "";
            $data['created_at'] = (int) time();
            $data['created_by'] = $_SESSION['userdata']['id_keluarga'];
            $pekerjaan = $this->model('PekerjaanModel')->getByName(strtolower($pekerjaan));
            $data['nama_pekerjaan'] = htmlspecialchars($_POST['pekerjaan']);


            if($data['no_kk'] == $_SESSION['no_kk']){
                if($pekerjaan)
                        {  
                            
                            $data['id_pekerjaan'] = $pekerjaan['id_pekerjaan'];
                            if($this->model('penduduk')->update($data,$id_keluarga) > 0){
                                $_SESSION['flash'] = "diubah";
                                unset($_SESSION['no_kk']);
                                $this->redirect(BASE_URL . 'datapenduduk');
                            }
                        }else{
                            
                            $pekerjaan['name'] = htmlspecialchars($_POST['pekerjaan']);
                            $pekerjaan['description'] = '';
                            $pekerjaan['created_at'] = time();
                            $pekerjaan['created_by'] = $_SESSION['userdata']['id_keluarga'];
                            $data['id_pekerjaan'] = $this->model('pekerjaanModel')->insert($pekerjaan);
                            if($data['id_pekerjaan'] > 0){
                                if($this->model('penduduk')->update($data,$id_keluarga) > 0){
                                    $_SESSION['flash'] = "diubah";
                                    unset($_SESSION['no_kk']);
                                    $this->redirect(BASE_URL . 'datapenduduk');
                                }else{
                                    echo "<script>alert('data gagal ditambahkan')</script>";
                                    $this->redirect(BASE_URL . "datapenduduk/edit/" . $id_keluarga);
                                }
                            }
                        }
            }else{
                if(strlen($data['no_kk']) < 16){
                    $_SESSION['form_error'] = [
                        'nokk' => "No KK harus berisi 16 karakter"
                    ];
                    $this->redirect(BASE_URL . "datapenduduk/edit/" . $id_keluarga);
                    return false;
                }else{
                    $data_keluarga = $this->model('penduduk')->getByNoKK($data['no_kk']);
                    
                    if($data_keluarga){
                        $_SESSION['form_error'] = [
                            'nokk' => "No KK sudah ada"
                        ];
                        $this->redirect(BASE_URL . "datapenduduk/edit/" . $id_keluarga);
                        return false;
                    }else{
                        if($pekerjaan)
                        {  
                            
                            $data['id_pekerjaan'] = $pekerjaan['id_pekerjaan'];
                            if($this->model('penduduk')->update($data,$id_keluarga) > 0){
                                $_SESSION['flash'] = "diubah";
                                unset($_SESSION['no_kk']);
                                $this->redirect(BASE_URL . 'datapenduduk');
                            }
                        }else{
                            
                            $pekerjaan['name'] = htmlspecialchars($_POST['pekerjaan']);
                            $pekerjaan['description'] = '';
                            $pekerjaan['created_at'] = time();
                            $pekerjaan['created_by'] = $_SESSION['userdata']['id_keluarga'];
                            $data['id_pekerjaan'] = $this->model('pekerjaanModel')->insert($pekerjaan);
                            if($data['id_pekerjaan'] > 0){
                                if($this->model('penduduk')->update($data,$id_keluarga) > 0){
                                    $_SESSION['flash'] = "diubah";
                                    unset($_SESSION['no_kk']);
                                    $this->redirect(BASE_URL . 'datapenduduk');
                                }else{
                                    echo "<script>alert('data gagal ditambahkan')</script>";
                                    $this->redirect(BASE_URL . "datapenduduk/edit/" . $id_keluarga);
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    