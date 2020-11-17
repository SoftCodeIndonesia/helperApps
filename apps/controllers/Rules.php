<?php

    class Rules extends Controller {
        
        public function __construct()
        {
            $this->helper = new Helper;
        }
        
        public function index($param1 = "ini param")
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
                $data = [];

                $linkHapus = '<a href="' . BASE_URL . 'Pekerjaan/delete/'. $value['id_keluarga'] .'" class="btn btn-sm btn-danger" id="btn-delete" data-id="'.$value['id_keluarga'].'">hapus</a>';
                $linkLogin = '<a href="'.BASE_URL.'login" class="btn btn-sm btn-info">Login</a>';
                $data[] = "<th>". $no++ ."</th>";
                $data[] = "<th>".$value['name']."</th>";
                $data[] = "<th>".$value['description']."</th>";
                if(!empty($_SESSION['userdata'])){
                    $data[] = "<th class='text-center'>". $linkHapus."</th>";
                }else{
                    $data[] = "<th>".$linkLogin."</th>";
                }
                $dataRules[] = $data;
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
    }