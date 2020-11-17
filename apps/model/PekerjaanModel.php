<?php

    class PekerjaanModel{

        private $table = 'pekerjaan';
        private $db;
        var $column_search = ['pek.name','pek.description'];

        public function __construct()
        {
            $this->db = new Database;
        }

        public function getAllData()
        {
            $query = "SELECT pek.*,kel.*, pek.id_pekerjaan as id_pekerjaan FROM pekerjaan pek LEFT JOIN keluarga kel ON kel.id_keluarga = pek.created_by";

            if($_POST['search']['value'] !== '')
            {
                $query = $query . " WHERE ";
                foreach ($this->column_search as $key => $column) {
                    $explode = explode('.',$column);
                    if($key + 1 == count($this->column_search)){
                        $query = $query . $column . " LIKE CONCAT(:" . $explode[1] . ", '%')";
                    }else{
                        $query = $query . $column . " LIKE CONCAT(:" . $explode[1] . ", '%') OR ";
                    }
                    
                }
            }

            $query = $query . " ORDER BY  pek.id_pekerjaan ASC";
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
            $query = "SELECT * FROM " . $this->table . " WHERE name = :name";
            
            $this->db->query($query);
            $this->db->bind('name',$name);
            return $this->db->single();
        }

        public function getAutocomplete()
        {
            $query = "SELECT * FROM pekerjaan";
            $this->db->query($query);
            return $this->db->resultSet();
        }
        public function insert($data)
        {
            $query = "INSERT INTO ". $this->table ." VALUES (null, :name, :description, :created_at, :created_by)";
            $this->db->query($query);
            $this->db->bind('name',$data['name']);
            $this->db->bind('description',$data['description']);
            $this->db->bind('created_at',$data['created_at']);
            $this->db->bind('created_by',$data['created_by']);


            return $this->db->insert_id();
        }

        public function getById($id_pekerjaan)
        {
            $query = "SELECT * FROM pekerjaan WHERE id_pekerjaan = :id_pekerjaan";
            
            $this->db->query($query);
            
            $this->db->bind('id_pekerjaan',$id_pekerjaan);

            return $this->db->single();

        }


        public function update($data,$id_pekerjaan)
        {
            $query = "UPDATE ". $this->table ." SET name = :name, description = :description, created_at = :created_at, created_by = :created_by WHERE id_pekerjaan = :id_pekerjaan";
            
            $this->db->query($query);
            $this->db->bind('name', $data['name']);
            $this->db->bind('description', $data['description']);
            $this->db->bind('created_at',$data['created_at']);
            $this->db->bind('created_by',$data['created_by']);
            $this->db->bind('id_pekerjaan',$id_pekerjaan);
 

            return $this->db->num_rows();
        }

        public function delete($id_pekerjaan)
        {
            $query = "DELETE FROM pekerjaan WHERE id_pekerjaan = :id_pekerjaan";

            $this->db->query($query);
            $this->db->bind('id_pekerjaan',$id_pekerjaan);
            return $this->db->num_rows();
        }
    }