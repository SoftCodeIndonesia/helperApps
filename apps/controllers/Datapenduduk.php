<?php

    class Datapenduduk extends Controller
    {
        public function index()
        {
            
            
            $data['title'] = 'village assistance - Data penduduk';

            $data['js'] = [
                'penduduk.js',
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
                $linkHapus = '<a href="' . BASE_URL . 'datapenduduk/delete/'. $value['id_keluarga'] .'" class="btn btn-sm btn-danger">hapus</a>';

                $penduduk[] = "<th>". $no++ ."</th>";
                $penduduk[] = "<th>".$value['no_kk']."</th>";
                $penduduk[] = "<th>".$value['kepala_keluarga']."</th>";
                $penduduk[] = "<th>".$value['pekerjaan']."</th>";
                $penduduk[] = "<th>".$value['jumlah_keluarga']."</th>";
                $penduduk[] = "<th>".$value['jumlah_anak']."</th>";
                $penduduk[] = "<th>".$value['rt']."</th>";
                $penduduk[] = "<th>".$value['rw']."</th>";
                $penduduk[] = "<th>".$value['created_at']."</th>";
                $penduduk[] = "<th>".$value['created_by']."</th>";
                $penduduk[] = "<th>".$linkUbah. " " . $linkHapus." </th>";

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
            $data['title'] = 'village assistance - tambah';
            $this->view('data_penduduk/tambah',$data);
        }

        public function storeCreated()
        {
            $nokk = $_POST['nokk'];
            $kepala_keluarga = htmlspecialchars($_POST['kepala_keluarga']);
            $jml_kel = $_POST['jml_kel'];
            $jml_anak = $_POST['jumlah_anak'];
            $rt = $_POST['rt'];
            $rw = $_POST['rw'];
            $alamat = htmlspecialchars($_POST['alamat']);
            $created_at = time();
            
        }
    }
    