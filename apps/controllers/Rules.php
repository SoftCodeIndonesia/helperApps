<?php

    class Rules extends Controller {
        
        public function __construct()
        {
            $this->helper = new Helper;
        }
        
        public function index()
        {
            $data['title'] = 'village assistance - rules';
            $data['js'] = [
                'rules/index.js'
            ];
            $this->view("rules/index",$data);
        }

        public function getAllRules()
        {
            $rules = $this->model("RulesModel")->getAllData();
            $dataRules = [];
            $no = 1;
            foreach ($rules as $value) {
                if($value['rules_id'] == 1)
                {
                    $data = [];

                    $linkHapus = '<a href="' . BASE_URL . 'Rules/setRules/'. $value['id_keluarga'] .'/2" class="btn btn-sm btn-danger" id="btn-delete" data-id="'.$value['id_keluarga'].'">Batalkan</a>';
                    $linkLogin = '<a href="'.BASE_URL.'login" class="btn btn-sm btn-info">Login</a>';
                    $data[] = "<th>". $no++ ."</th>";
                    $data[] = "<th>".$value['name']."</th>";
                    $data[] = "<th>".$value['description']."</th>";
                    $data[] = "<th>".$value['created_by']."</th>";
                    $data[] = "<th>".$value['created_at']."</th>";
                    if(!empty($_SESSION['userdata'])){
                        $data[] = "<th class='text-center'>". $linkHapus."</th>";
                    }else{
                        $data[] = "<th>".$linkLogin."</th>";
                    }
                    $dataRules[] = $data;
                }
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => count($dataRules),
                "recordsFiltered" => $this->model("RulesModel")->count_filtered(),
                "data" => $dataRules,
            );
            
            echo json_encode($output);
            exit();
        }

        public function tambah()
        {
            if(!empty($_SESSION['userdata']))
            {
                $data['title'] = "Village assistance - Tambah";
                $data['js'] = [
                    'rules/tambah.js'
                ];
                $this->view('rules/tambah',$data);
            }
        }
        

        public function getAllPenduduk()
        {
            if(!empty($_SESSION['userdata']))
            {
                $data = $this->model('penduduk')->getAll();
                $dataPenduduk = [];
                $no = 1;
                foreach ($data as $value) {
                    $penduduk = [];
    
                    if($value['rules_id'] == 1){
                        $linkAction = '<a href="' . BASE_URL . 'rules/setRules/'. $value['id_keluarga'] .'/2" class="btn btn-sm btn-danger">Batalkan</a>';
                    }else{
                        $linkAction = '<a href="' . BASE_URL . 'rules/setRules/'. $value['id_keluarga'] .'/1" class="btn btn-sm btn-info">Jadikan Pengurus</a>';
                    }
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
                        $penduduk[] = "<th>" . $linkAction . " </th>";
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

        public function setRules($id_keluarga,$status)
        {
            $data['rules_id'] = $status;
            if($this->model('RulesModel')->setRules($data,$id_keluarga) > 0)
            {
                $_SESSION['flash'] = "berhasil diubah";
                $this->redirect(BASE_URL . 'Rules/tambah');
            }else{
                $_SESSION['flash'] = "gagal diubah";
                $this->redirect(BASE_URL . 'Rules/tambah');
            }
        }
    }