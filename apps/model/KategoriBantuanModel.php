<?php

    class KategoriBantuanModel
    {
        private $db;
        private $table = 'kategori_bantuan';
        var $column_search = ['kat.name','kat.description'];


        public function __construct()
        {
            $this->db = new Database;
        }

        public function getAllData()
        {
            $query = "SELECT * FROM kategori_bantuan kat LEFT JOIN keluarga kel ON kel.id_keluarga = kat.created_by";

            if($_POST['search']['value'] !== '')
            {
                $query = $query . " WHERE ";
                foreach ($this->column_search as $key => $column) {
                    $explode = explode('.',$column);
                    if($key + 1 == count($this->column_search)){
                        $query = $query . $column . " LIKE CONCAT(:" . $explode[1] . ", '%%')";
                    }else{
                        $query = $query . $column . " LIKE CONCAT(:" . $explode[1] . ", '%%') OR ";
                    }
                    
                }
            }

            $query = $query . " ORDER BY  kat.id_kategori_bantuan ASC";
            
            $this->db->query($query);
            
            if(strlen($_POST['search']['value']) > 0)
            {
                foreach ($this->column_search as $column) {
                    $explode = explode('.',$column);
                    $this->db->bind($explode[1], $_POST['search']['value']);
                }
            }
            return $this->db->resultSet();
        }

        public function count_filtered()
        {
            $this->db->query('SELECT * FROM ' . $this->table);
            return $this->db->num_rows();
        }

        public function getByName($name)
        {
            $query = "SELECT * FROM kategori_bantuan WHERE name = :name";
            
            $this->db->query($query);

            $this->db->bind('name',$name);

            return $this->db->single();
        }


        public function insert($data)
        {
            $query = "INSERT INTO kategori_bantuan VALUES (null, :name, :description, :created_at, :created_by)";

            $this->db->query($query);

            $this->db->bind('name',$data['name']);
            $this->db->bind('description',$data['description']);
            $this->db->bind('created_at',$data['created_at']);
            $this->db->bind('created_by',$data['created_by']);

            return $this->db->num_rows();
        }
    }
    