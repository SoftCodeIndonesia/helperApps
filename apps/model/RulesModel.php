<?php

    class RulesModel
    {
        private $table = 'rules_users';
        private $db;

        var $column_search = ["rule.name","kel.kepala_keluarga","rule.description","kel.kepala_keluarga","rule.created_at"];

        public function __construct()
        {
            $this->db = new Database;
        }

        public function getAllData()
        {
            $query = "SELECT rule.*,kel.*,kel.kepala_keluarga as name,from_unixtime(rule.created_at,'%d %M %Y') as created_at,kel.kepala_keluarga as created_by FROM rules_users rule LEFT JOIN keluarga kel ON kel.rules_id = rule.id_rules";

            if(!empty($_POST['search']) && $_POST['search']['value'] !== '')
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

            if(!empty($_POST['search']) && $_POST['search']['value'] !== '')
            {
                $query = $query . "AND rule.id_rules = :id_rules ORDER BY rule.id_rules ASC";
            }else{
                $query = $query . " WHERE rule.id_rules = :id_rules ORDER BY rule.id_rules ASC";
            }

            
            $this->db->query($query);
            if(!empty($_POST['search']) && $_POST['search']['value'] !== '')
            {
                foreach ($this->column_search as $column) {
                    $explode = explode('.',$column);
                    $this->db->bind($explode[1], '%'.$_POST['search']['value'].'%');
                }
               
            }
            
            $this->db->bind("id_rules",1);
            return $this->db->resultSet();
        }

        public function count_filtered()
        {
            $this->db->query('SELECT * FROM ' . $this->table);
            return $this->db->num_rows();
        }

        public function setRules($data,$id_keluarga)
        {
            $query = "UPDATE keluarga SET rules_id = :rules_id WHERE id_keluarga = :id_keluarga";

            $this->db->query($query);
            $this->db->bind('rules_id',$data['rules_id']);
            $this->db->bind('id_keluarga',$id_keluarga);

            return $this->db->num_rows();
        }
    }