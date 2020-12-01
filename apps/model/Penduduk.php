<?php

    class Penduduk {
        private $table = 'keluarga';
        private $db;

        var $column_search = ["kel.no_kk","kel.kepala_keluarga","pek.name","kel.jumlah_keluarga","kel.jumlah_anak","kel.rt","kel.rw","kel.kepala_keluarga","kel.created_at"];

        public function __construct()
        {
            $this->db = new Database;
        }

        public function getAll()
        {
            $query = "SELECT kel.*, pek.name as pekerjaan, kel.kepala_keluarga as kepala_keluarga, kelu.kepala_keluarga as created_by,from_unixtime(kel.created_at,'%d %M %Y') as created_at FROM keluarga kel LEFT JOIN pekerjaan pek ON kel.id_pekerjaan = pek.id_pekerjaan LEFT JOIN keluarga kelu ON kelu.id_keluarga = kel.created_by";

    
            if(strlen($_POST['search']['value']) > 0)
            {
                $query = $query . " WHERE ";
                foreach ($this->column_search as $key => $column) {
                    $explode = explode('.',$column);
                    if($key + 1 == count($this->column_search)){
                        $query = $query . " from_unixtime(". $column .",'%d %M %Y') LIKE CONCAT(:" . $explode[1] . ")";
                    }else{
                        $query = $query . $column . " LIKE CONCAT(:" . $explode[1] . ") OR ";
                    }
                    
                }
            }

            $query = $query . ' ORDER BY kel.kepala_keluarga ASC'; 
            
            
            $this->db->query($query);

            if(strlen($_POST['search']['value']) > 0)
            {
                foreach ($this->column_search as $column) {
                    $explode = explode('.',$column);
                    $this->db->bind($explode[1], '%'.$_POST['search']['value'].'%');
                }
            }
            return $this->db->resultSet();
        }

        public function count_filtered()
        {
            $this->db->query('SELECT * FROM ' . $this->table);
            return $this->db->num_rows();
        }

        public function login($nokk)
        {
            $query = 'SELECT * FROM ' . $this->table . ' WHERE ' . $this->table . '.no_kk = ' . $nokk;
            
            $this->db->query($query);
            return $this->db->single();
        }

        public function insert($data)
        {
            $query = "INSERT INTO keluarga VALUES (null, :rules_id, :no_kk, :id_pekerjaan, :kepala_keluarga, :jumlah_keluarga, :jumlah_anak, :rt, :rw, :alamat, :lat,:lng, :pass, :created_at, :created_by)";
            
            $this->db->query($query);
            $this->db->bind('rules_id',$data['rules_id']);
            $this->db->bind('no_kk', $data['no_kk']);
            $this->db->bind('id_pekerjaan', $data['id_pekerjaan']);
            $this->db->bind('kepala_keluarga',$data['kepala_keluarga']);
            $this->db->bind('jumlah_keluarga',$data['jumlah_keluarga']);
            $this->db->bind('jumlah_anak',$data['jumlah_anak']);
            $this->db->bind('rt',$data['rt']);
            $this->db->bind('rw',$data['rw']);
            $this->db->bind('alamat',$data['alamat']);
            $this->db->bind('lat',$data['lat']);
            $this->db->bind('lng',$data['lng']);
            $this->db->bind('pass',$data['pass']);
            $this->db->bind('created_at',$data['created_at']);
            $this->db->bind('created_by',$data['created_by']);
           
 

            return $this->db->num_rows();
        }

        public function delete($id_keluarga)
        {
            $query = "DELETE FROM keluarga WHERE id_keluarga = :id_keluarga";
            $this->db->query($query);
            $this->db->bind('id_keluarga',$id_keluarga);
            $this->db->execute();
            return $this->db->num_rows();
        }

        public function getDataById($id_keluarga)
        {
            $query = "SELECT kel.*, pek.*, pek.name as pekerjaan, kel.id_pekerjaan as keluarga_id_pekerjaan FROM keluarga kel LEFT JOIN pekerjaan pek ON kel.id_pekerjaan = pek.id_pekerjaan WHERE id_keluarga = :id_keluarga";

            $this->db->query($query);
            $this->db->bind('id_keluarga',$id_keluarga);
            return $this->db->single();
        }

        public function getByNoKK($no_kk)
        {
            $query = "SELECT * FROM keluarga WHERE no_kk = :no_kk";
            $this->db->query($query);
            $this->db->bind('no_kk',$no_kk);
            return $this->db->single();
        }

        public function update($data,$id_keluarga)
        {
            $query = "UPDATE keluarga SET no_kk = :no_kk, id_pekerjaan = :id_pekerjaan, kepala_keluarga = :kepala_keluarga, jumlah_keluarga = :jumlah_keluarga, jumlah_anak = :jumlah_anak, rt = :rt, rw = :rw, alamat = :alamat, lat = :lat, lng = :lng, created_at = :created_at, created_by = :created_by WHERE id_keluarga = :id_keluarga";
            
            $this->db->query($query);
            $this->db->bind('no_kk', $data['no_kk']);
            $this->db->bind('id_pekerjaan', $data['id_pekerjaan']);
            $this->db->bind('kepala_keluarga',$data['kepala_keluarga']);
            $this->db->bind('jumlah_keluarga',$data['jumlah_keluarga']);
            $this->db->bind('jumlah_anak',$data['jumlah_anak']);
            $this->db->bind('rt',$data['rt']);
            $this->db->bind('rw',$data['rw']);
            $this->db->bind('alamat',$data['alamat']);
            $this->db->bind('lat',$data['lat']);
            $this->db->bind('lng',$data['lng']);
            $this->db->bind('created_at',$data['created_at']);
            $this->db->bind('created_by',$data['created_by']);
            $this->db->bind('id_keluarga',$id_keluarga);
 

            return $this->db->num_rows();
        }

    }