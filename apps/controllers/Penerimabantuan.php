<?php

    class Penerimabantuan extends Controller
    {
        private $model;
        public function __construct()
        {
            $this->helper = new Helper;
            $this->model = $this->model('penerimaModel');
        }

        public function index()
        {
            $data['title'] = 'village assistance - catatan penerima bantuan';
            $data['js'] = [
                'penerima/index.js'
            ];
            $this->view('penerima_bantuan/index',$data);
        }

        public function getAllData(){
            $penerima = $this->model->getAllData();
            $penerima_bantuan = [];
            $no = 1;
            foreach ($penerima as $value) {
                $data = [];

                $linkUbah = '<a href="' . BASE_URL . 'Pekerjaan/edit/'. $value['id_pekerjaan'] .'" class="btn btn-sm btn-warning">ubah</a>';
                $linkHapus = '<a href="' . BASE_URL . 'Pekerjaan/delete/'. $value['id_pekerjaan'] .'" class="btn btn-sm btn-danger" id="btn-delete" data-id="'.$value['id_pekerjaan'].'">hapus</a>';
                $linkLocation = '<a href="'.BASE_URL.'login" class="btn btn-sm btn-info">lihat lokasi</a>';
                $linkLogin = '<a href="'.BASE_URL.'login" class="btn btn-sm btn-info">Login</a>';
                $data[] = "<th>". $no++ ."</th>";
                $data[] = "<th>".$value['jenis_bantuan']."</th>";
                $data[] = "<th>".date('d-M-Y',$value['periode'])."</th>";
                $data[] = "<th>".$value['no_kk']."</th>";
                $data[] = "<th>".$value['nama_keluarga']."</th>";
                $data[] = "<th>".$value['pekerjaan']."</th>";
                $data[] = "<th>".$value['status_terima'] == 1 ? "sudah diterima" : "belum diterima"."</th>";
                $data[] = "<th>". date('d-M-Y',$value['tgl_terima']) ."</th>";
                $data[] = "<th>".$value['id_bukti_terima']."</th>";
                $data[] = "<th>".$value['created_by']."</th>";
                $data[] = "<th>".date('d-M-Y',$value['created_at'])."</th>";
                if(!empty($_SESSION['userdata'])){
                    $data[] = "<th class='text-center'>" . $linkUbah ." ". $linkHapus. " " . $linkLocation . "</th>";
                }else{
                    $data[] = "<th>" . $linkLocation . "</th>";
                }
                $penerima_bantuan[] = $data;
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => count($penerima_bantuan),
                "recordsFiltered" => $this->model("PekerjaanModel")->count_filtered(),
                "data" => $penerima_bantuan,
            );
            
            echo json_encode($output);
            exit();
        }

        public function tambah()
        {
            $data['title'] = 'village assistance - tambah';
            $data['status_penerima'] = [
                [
                    'value' => 0,
                    'name' => 'belum diterima'
                ],
                [
                    'value' => 1,
                    'name' => 'sudah diterima'
                ]
            ];
            $data['js'] = [
                'penerima/tambah.js'
            ];
            
            $this->view('penerima_bantuan/tambah',$data);
        }

        public function allCatatan()
        {
            $catatan = $this->model('CatatanModel')->getAllData();
            $catatan_bantuan = [];
            $no = 1;
            foreach ($catatan as $value) {
                $data = [];

               
                $linkHapus = '<a href="' . BASE_URL . 'catatanbantuan/delete/'. $value['id_bantuan'] .'" class="btn btn-sm btn-success" id="btn-select" data-id="'.$value['id_bantuan'].'" data-name="'.$value['name'].'" data-periode="'.$value['periode'].'" data-dismiss="modal">Pilih</a>';
                $linkLogin = '<a href="'.BASE_URL.'login" class="btn btn-sm btn-info">Login</a>';
                $data[] = "<th>". $no++ ."</th>";
                $data[] = "<th>".$value['name']."</th>";
                $data[] = "<th>". $value['periode'] ."</th>";
                if(!empty($_SESSION['userdata'])){
                    $data[] = "<th class='text-center'>" . $linkHapus. "</th>";
                }else{
                    $data[] = "<th>".$linkLogin."</th>";
                }
                $catatan_bantuan[] = $data;
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => count($catatan_bantuan),
                "recordsFiltered" => $this->model('CatatanModel')->count_filtered(),
                "data" => $catatan_bantuan,
            );
            
            echo json_encode($output);
            exit();
        }

        public function getData()
        {
            $data = $this->model('penduduk')->getAll();
            $dataPenduduk = [];
            $no = 1;
            foreach ($data as $value) {
                $penduduk = [];

                $linkUbah = '<a href="' . BASE_URL . 'datapenduduk/edit/'. $value['id_keluarga'] .'" class="btn btn-sm btn-success" id="btn-select-penduduk" data-id="'. $value['id_keluarga'] .'" data-kk="'. $value['no_kk'] .'" data-nama="'.$value['kepala_keluarga'].'" data-dismiss="modal">Pilih</a>';
                $linkLogin = '<a href="'.BASE_URL.'login" class="btn btn-sm btn-info">Login</a>';
                $penduduk[] = "<th>". $no++ ."</th>";
                $penduduk[] = "<th>".$value['no_kk']."</th>";
                $penduduk[] = "<th>".$value['kepala_keluarga']."</th>";
                $penduduk[] = "<th>".$value['pekerjaan']."</th>";
                $penduduk[] = "<th>".$value['rt']."</th>";
                $penduduk[] = "<th>".$value['rw']."</th>";
                if(!empty($_SESSION['userdata'])){
                    $penduduk[] = "<th>".$linkUbah. "</th>";
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


        public function storeCreated()
        {
            // var_dump($_POST);
            // var_dump($_FILES);
            // die;
            $data['id_bantuan'] = $_POST['id_bantuan'];
            $data['id_keluarga'] = $_POST['id_keluarga'];
            $data['status_terima'] = $_POST['status'];
            $data['tgl_terima'] = strtotime($_POST['tgl_terima']);
            $data['created_at'] = time();
            $data['created_by'] = $_SESSION['userdata']['id_keluarga'];

           
            $file_error = $_FILES['bukti_terima']['error'];
            $fileName = $_FILES['bukti_terima']['name'];
            $fileName = explode('.',$fileName);
            $tmp_name = $_FILES['bukti_terima']['tmp_name'];
            $_SESSION['set_value'] = $data;
            $_SESSION['set_value']['bantuan'] = $_POST['bantuan'];
            $_SESSION['set_value']['periode'] = $_POST['periode'];
            $_SESSION['set_value']['no_kk'] = $_POST['no_kk'];
            $_SESSION['set_value']['keluarga'] = $_POST['keluarga'];
            $file['name'] = $_POST['keluarga'] . $data['id_bantuan'] . '.' . end($fileName);
            $file['source'] = 'assets/bukti_terima';
            $file['created_by'] = $_SESSION['userdata']['id_keluarga'];
            $file['created_at'] = time();
            if($data['status_terima'] == 1 && $file_error > 0 || $data['status_terima'] == 0 && $file_error == 0)
            {
                $_SESSION['form_error'] = [
                    'file' => 'jika status sudah diterima mohon upload bukti terima dan sebaliknya!'
                ];
                $this->redirect(BASE_URL . 'penerimabantuan/tambah');
            }else{

                $getBantuan = $this->model->getBantuanByKeluargaAndbantuan($data['id_keluarga'],$data['id_bantuan']);
                if($getBantuan)
                {
                    $this->helper->session_destory(['form_error']);
                    $_SESSION['flash'] = 'Data sudah ada!';
                    $this->redirect(BASE_URL . 'penerimabantuan/tambah');
                }else{
                    $data['id_bukti_terima'] = $this->model->insert_bukti_terima($file);

                    move_uploaded_file($tmp_name,$file['source'] . '/' . $file['name']);

                    if($this->model->insert($data) > 0)
                    {
                        $_SESSION['flash'] = 'berhasil ditambahkan';
                        $this->helper->session_destory(['form_error','set_value']);
                        $this->redirect(BASE_URL . 'penerimabantuan');
                    }else{
                        $_SESSION['flash'] = 'gagal ditambahkan';
                        $this->helper->session_destory(['form_error','set_value']);
                        $this->redirect(BASE_URL . 'penerimabantuan');
                    }

                }

            }
        }
    }