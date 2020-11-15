<?php

    class PekerjaanModel{

        private $table = 'pekerjaan';
        private $db;

        public function __construct()
        {
            $this->db = new Database;
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
    }