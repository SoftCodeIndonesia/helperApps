<?php

    class Pekerjaan extends Controller {

        public function __construct()
        {
            $this->helper = new Helper;
        }
        
        public function index()
        {
            $this->helper->session_destory(["form_error","set_value"]);
            $data['title'] = 'village assistance - pekerjaan';
            $data['js'] = [
                'pekerjaan/index.js'
            ];
            $this->view("pekerjaan/index",$data);
        }

        public function allDataPekerjaan()
        {
            $pekerjaan = $this->model("PekerjaanModel")->getAllData();
            $dataPekerjaan = [];
            $no = 1;
            foreach ($pekerjaan as $value) {
                $data = [];

                $linkUbah = '<a href="' . BASE_URL . 'Pekerjaan/edit/'. $value['id_pekerjaan'] .'" class="btn btn-sm btn-warning">ubah</a>';
                $linkHapus = '<a href="' . BASE_URL . 'Pekerjaan/delete/'. $value['id_pekerjaan'] .'" class="btn btn-sm btn-danger" id="btn-delete" data-id="'.$value['id_pekerjaan'].'">hapus</a>';
                $linkLogin = '<a href="'.BASE_URL.'login" class="btn btn-sm btn-info">Login</a>';
                $data[] = "<th>". $no++ ."</th>";
                $data[] = "<th>".$value['name']."</th>";
                $data[] = "<th>".$value['description']."</th>";
                $data[] = "<th>".$value['created_by']."</th>";
                $data[] = "<th>".$value['created_at']."</th>";
                if(!empty($_SESSION['userdata'])){
                    $data[] = "<th class='text-center'>" . $linkUbah ." ". $linkHapus."</th>";
                }else{
                    $data[] = "<th>".$linkLogin."</th>";
                }
                $dataPekerjaan[] = $data;
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => count($dataPekerjaan),
                "recordsFiltered" => $this->model("PekerjaanModel")->count_filtered(),
                "data" => $dataPekerjaan,
            );
            
            echo json_encode($output);
            exit();
        }

        public function getAutocomplete()
        {
            $pekerjaan = $this->model('PekerjaanModel')->getAutocomplete();
            // $pekerjaan = $this->model('pekerjaan')->getByName('pengangguran');
            $callback = [];
            foreach ($pekerjaan as $value) {
                $callback[] .= $value['name'];
            }

            echo json_encode($callback);
        }

        public function created()
        {
            $data['title'] = 'Village Assistance - tambah data';
            $this->view('pekerjaan/tambah',$data);
        }

        public function storeCreated()
        {
            $data['name'] = htmlspecialchars($_POST['name']);
            $data['description'] = $_POST['description'];
            $data['created_at'] = time();
            $data['created_by'] = $_SESSION['userdata']['id_keluarga'];

            $pekerjaan = $this->model('PekerjaanModel')->getByName($data['name']);
          
            if($pekerjaan)
            {
                $_SESSION['set_value'] = $data;
                $_SESSION['form_error'] = [
                    'name' => 'nama pekerjaan sudah ada!'
                ];  
                $this->redirect(BASE_URL . 'pekerjaan/created');
                return false;
            }else{
                
                $this->helper->session_destory(["form_error","set_value"]);
                if($this->model('PekerjaanModel')->insert($data) > 0){
                    $_SESSION['flash'] = 'ditambahkan';
                    $this->redirect(BASE_URL . 'pekerjaan');
                }
            }
        }


        public function edit($id_pekerjaan)
        {
            $data['pekerjaan'] = $this->model("PekerjaanModel")->getById($id_pekerjaan);
            $data['title'] = 'Village Assistance - ubah data';
            $this->view('pekerjaan/ubah',$data);
        }

        public function storeUpdated()
        {
            if(!empty($_SESSION['userdata']))
            {
                $id_pekerjaan = $_POST['id_pekerjaan'];

                $pekerjaan = $this->model("pekerjaanModel")->getById($id_pekerjaan);

                $data['name'] = htmlspecialchars($_POST['name']);
                $data['description'] = $_POST['description'];
                $data['created_at'] = time();
                $data['created_by'] = $_SESSION['userdata']['id_keluarga'];

                if($pekerjaan['name'] == $data['name']){
                    if($this->model('PekerjaanModel')->update($data,$id_pekerjaan) > 0){
                        $_SESSION['flash'] = 'diubah';
                        $this->redirect(BASE_URL . 'penduduk');
                    }   
                }else{
                    $pekerjaan = $this->model("pekerjaanModel")->getByName($data['name']);

                    if($pekerjaan)
                    {
                        $_SESSION['set_value'] = $data;
                        $_SESSION['form_error'] = [
                            'name' => 'nama pekerjaan sudah ada!'
                        ];  
                        $this->redirect(BASE_URL . 'pekerjaan/edit/' . $id_pekerjaan);
                        return false;
                    }else{
                        if($this->model('PekerjaanModel')->update($data,$id_pekerjaan) > 0){
                            $_SESSION['flash'] = 'diubah';
                            $this->redirect(BASE_URL . 'pekerjaan');
                        }   
                    }
                }
            }
        }

        public function delete()
        {
            
            if(!empty($_SESSION['userdata']))
            {
                $id_pekerjaan = $_POST['id_pekerjaan'];

                $callback = $this->model('PekerjaanModel')->delete($id_pekerjaan);

                echo json_encode($callback);
            }else{
                $callback = 0;
                echo json_encode($callback);
            }
        }
    }