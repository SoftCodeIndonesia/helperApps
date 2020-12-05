<?php

    class PenerimaModel
    {
        private $db;
        private $table = 'penerima_bantuan';
        private $column_search = ['kb.name','katban.name','pb.status_terima'];

        public function __construct()
        {
            $this->db = new Database;
        }

        public function getAllData()
        {
            $query = "SELECT *,katban.name as jenis_bantuan,buk.name as bukti_terima,kel.no_kk as nomer_kk,kel.kepala_keluarga as nama_keluarga,kel.lat as lat, kel.lng as lng,kelu.kepala_keluarga as created_by,pek.name as pekerjaan, kb.periode as periose FROM penerima_bantuan pb LEFT JOIN bantuan kb ON pb.id_bantuan = kb.id_bantuan LEFT JOIN kategori_bantuan katban ON katban.id_kategori_bantuan = kb.id_kategori_bantuan LEFT JOIN keluarga kel ON kel.id_keluarga = pb.id_keluarga LEFT JOIN pekerjaan pek ON pek.id_pekerjaan = kel.id_pekerjaan LEFT JOIN bukti_terima buk ON buk.id_bukti_terima = pb.id_bukti_terima LEFT JOIN keluarga kelu ON kelu.id_keluarga = pb.created_by";

            if($_POST['search']['value'] !== '')
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

            $query = $query . " ORDER BY  pek.id_pekerjaan ASC";
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

        public function getBantuanByKeluargaAndbantuan($id_keluarga,$id_bantuan)
        {
            $query = 'SELECT * FROM penerima_bantuan WHERE id_bantuan = :id_bantuan AND id_keluarga = :id_keluarga';

            $this->db->query($query);
            $this->db->bind('id_bantuan',$id_bantuan);
            $this->db->bind('id_keluarga',$id_keluarga);
            return $this->db->single();
        }

        public function insert_bukti_terima($data)
        {
            $query = 'INSERT INTO bukti_terima VALUES (null, :name, :source, :created_at, :created_by)';

            $this->db->query($query);
            $this->db->bind('name',$data['name']);
            $this->db->bind('source',$data['source']);
            $this->db->bind('created_at',$data['created_at']);
            $this->db->bind('created_by',$data['created_by']);

            return $this->db->insert_id();
        }

        public function insert($data)
        {
            $query = 'INSERT INTO penerima_bantuan VALUES (null,:id_bantuan,:id_keluarga,:status_terima,:id_bukti_terima,:tgl_terima,:created_at,:created_by)';

            $this->db->query($query);
            $this->db->bind('id_bantuan',$data['id_bantuan']);
            $this->db->bind('id_keluarga',$data['id_keluarga']);
            $this->db->bind('status_terima',$data['status_terima']);
            $this->db->bind('id_bukti_terima',$data['id_bukti_terima']);
            $this->db->bind('tgl_terima',$data['tgl_terima']);
            $this->db->bind('created_at',$data['created_at']);
            $this->db->bind('created_by',$data['created_by']);
            return $this->db->num_rows();
        }

        public function getById($id_bantuan)
        {
            $query = "SELECT *,katban.name as jenis_bantuan,buk.name as bukti_terima,kel.no_kk as nomer_kk,kel.kepala_keluarga as nama_keluarga,katban.name as jenis_bantuan, kelu.kepala_keluarga as created_by,pek.name as pekerjaan, kb.periode as periose,kel.no_kk as nomer_kk FROM penerima_bantuan pb LEFT JOIN bantuan kb ON pb.id_bantuan = kb.id_bantuan LEFT JOIN kategori_bantuan katban ON katban.id_kategori_bantuan = kb.id_kategori_bantuan LEFT JOIN keluarga kel ON kel.id_keluarga = pb.id_keluarga LEFT JOIN pekerjaan pek ON pek.id_pekerjaan = kel.id_pekerjaan LEFT JOIN bukti_terima buk ON buk.id_bukti_terima = pb.id_bukti_terima LEFT JOIN keluarga kelu ON kelu.id_keluarga = pb.created_by WHERE pb.id_penerima = :id_penerima";

            $this->db->query($query);
            $this->db->bind('id_penerima',$id_bantuan);
            return $this->db->single();
        }

        public function getRt()
        {
            $query = "SELECT * FROM keluarga GROUP BY rt ORDER BY rt";
            $this->db->query($query);
            return $this->db->resultSet();
        }

        public function getRw()
        {
            $query = "SELECT * FROM keluarga GROUP BY rw ORDER BY rw";
            $this->db->query($query);
            return $this->db->resultSet();
        }

        public function filter($rt,$rw,$id_bantuan)
        {
            
            // WHERE kel.rt = :rt AND kel.rw = :rw ORDER BY pb.id_penerima
            $query = "SELECT *,katban.name as jenis_bantuan,buk.name as bukti_terima,kel.no_kk as nomer_kk,kel.kepala_keluarga as nama_keluarga,kel.rt as rt, kel.rw as rw,kelu.kepala_keluarga as created_by,pek.name as pekerjaan, kb.periode as periose FROM penerima_bantuan pb LEFT JOIN bantuan kb ON pb.id_bantuan = kb.id_bantuan LEFT JOIN kategori_bantuan katban ON katban.id_kategori_bantuan = kb.id_kategori_bantuan LEFT JOIN keluarga kel ON kel.id_keluarga = pb.id_keluarga LEFT JOIN pekerjaan pek ON pek.id_pekerjaan = kel.id_pekerjaan LEFT JOIN bukti_terima buk ON buk.id_bukti_terima = pb.id_bukti_terima LEFT JOIN keluarga kelu ON kelu.id_keluarga = pb.created_by WHERE ";

            if($rt !== ''){
                $query = $query . 'kel.rt = :rt';
            }

            if($rw !== ''){
                if($rt !== ''){
                    $query = $query . 'AND kel.rw = :rw';
                }else{
                    $query = $query . 'kel.rw = :rw';
                }
            }

            if($id_bantuan !== ''){
                if($rt !== '' || $rw !== ''){
                $query = $query . 'AND kb.id_bantuan = :id_bantuan';
                }else{
                    $query = $query . 'kb.id_bantuan = :id_bantuan';
                }
            }


            $this->db->query($query);
            if($rt !== ''){
                $this->db->bind('rt',$rt);
            }

            if($rw !== ''){
                $this->db->bind('rw',$rw);
            }

            if($id_bantuan !== ''){
                $this->db->bind('id_bantuan',$id_bantuan);
            }

            return $this->db->resultSet();
        }

        public function getFileById($id_bukti_terima)
        {
            $query = "SELECT * FROM bukti_terima WHERE id_bukti_terima = :id_bukti_penerima";

            $this->db->query($query);

            $this->db->bind('id_bukti_penerima',$id_bukti_terima);

            return $this->db->single();
        }


        public function delete_file($id_bukti_terima)
        {
            $query = "DELETE FROM bukti_terima WHERE id_bukti_terima = :id_bukti_terima";

            $this->db->query($query);

            $this->db->bind('id_bukti_terima',$id_bukti_terima);

            return $this->db->num_rows();
        }

        public function update($data,$id_penerima)
        {
            $query = 'UPDATE penerima_bantuan SET id_bantuan = :id_bantuan, id_keluarga = :id_keluarga,status_terima = :status_terima, id_bukti_terima = :id_bukti_terima,tgl_terima = :tgl_terima,created = :created_at,created_by = :created_by';

            $this->db->query($query);

            $this->db->bind('id_bantuan',$data['id_bantuan']);
            $this->db->bind('id_keluarga',$data['id_keluarga']);
            $this->db->bind('status_terima',$data['status_terima']);
            $this->db->bind('id_bukti_terima',$data['id_bukti_terima']);
            $this->db->bind('tgl_terima',$data['tgl_terima']);
            $this->db->bind('created_at',$data['created_at']);
            $this->db->bind('created_by',$data['created_by']);

            return $this->db->num_rows();
        }

        public function delete($id_penerima)
        {
            $query = "DELETE FROM penerima_bantuan WHERE id_penerima = :id_penerima";

            $this->db->query($query);

            $this->db->bind('id_penerima',$id_penerima);

            return $this->db->num_rows();
        }
        
    }
    