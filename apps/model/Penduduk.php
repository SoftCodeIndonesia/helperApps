<?php

    class Penduduk {
        private $table = 'keluarga';
        private $db;

        public function __construct()
        {
            $this->db = new Database;
        }

        public function getAll()
        {
            $this->db->query('SELECT *, pek.name as pekerjaan FROM ' . $this->table . ' kel LEFT JOIN pekerjaan pek ON kel.id_pekerjaan = pek.id_pekerjaan ORDER BY kel.kepala_keluarga ASC');
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

    }