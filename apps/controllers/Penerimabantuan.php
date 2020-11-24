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
            $this->view('penerima_bantuan/index',$data);
        }

        public function tambah()
        {
            $data['title'] = 'village assistance - tambah';
            $data['status_penerima'] = ['Belum diterima','Sudah diterima'];
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
    }