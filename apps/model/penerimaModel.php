<?php

    class PenerimaModel
    {
        private $db;
        private $table = 'penerima_bantuan';
        public function __construct()
        {
            $this->db = new Database;
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
        
    }
    