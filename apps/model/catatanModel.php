<?php
    class CatatanModel 
    {
        private $db;
        private $table = 'bantuan';
        var $column_search = ['kat.name','ban.periode','ban.description','kel.kepala_keluarga','ban.created_at'];

        public function __construct()
        {
            $this->db = new Database;
        }

        public function getAllData()
        {
            $query = "SELECT *,kat.name as name, ban.description as description, ban.id_bantuan as id_bantuan, from_unixtime(ban.periode,'%d %M %Y') as periode,kel.kepala_keluarga as created_by,from_unixtime(ban.created_at,'%d %M %Y') as created_at FROM bantuan ban LEFT JOIN kategori_bantuan kat ON ban.id_kategori_bantuan = kat.id_kategori_bantuan LEFT JOIN keluarga kel ON kel.id_keluarga = ban.created_by LEFT JOIN penerima_bantuan pen ON pen.id_bantuan = ban.id_bantuan";

            if(!empty($_POST['search']['value']))
            {
                $query = $query . " WHERE ";
                foreach ($this->column_search as $key => $column) {
                    $explode = explode('.',$column);
                    if($key == 1)
                    {
                        $query = $query . " from_unixtime(". $column .",'%d %M %Y') LIKE CONCAT(:" . $explode[1] . ") OR ";
                    }else if($key + 1 == count($this->column_search)){
                        $query = $query . " from_unixtime(". $column .",'%d %M %Y') LIKE CONCAT(:" . $explode[1] . ")";
                    }else{
                        $query = $query . $column . " LIKE CONCAT(:" . $explode[1] . ") OR ";
                    }
                    
                }
            }

            $query = $query . " ORDER BY ban.id_bantuan ASC";
            $this->db->query($query);
            if(!empty($_POST['search']['value']))
            {
                foreach ($this->column_search as $key => $column) {
                    $explode = explode('.',$column);
                    $this->db->bind($explode[1], '%' . $_POST['search']['value'] . '%');
                }
            }
            return $this->db->resultSet();
        }

        public function count_filtered()
        {
            $this->db->query('SELECT * FROM ' . $this->table);
            return $this->db->num_rows();
        }

        public function getKategoriBantuan()
        {
            $query = "SELECT * FROM kategori_bantuan";

            $this->db->query($query);
            
            return $this->db->resultset();
        }

        public function getByPeriodeAndName($id_kategori,$periode)
        {
            $query = "SELECT * FROM bantuan WHERE id_kategori_bantuan = :id_kategori_bantuan AND periode = :periode";

            $this->db->query($query);

            $this->db->bind('id_kategori_bantuan',$id_kategori);
            $this->db->bind('periode',$periode);

            return $this->db->single();
        }

        public function insert($data)
        {
            $query = "INSERT INTO bantuan VALUES (null, :id_kategori_bantuan, :periode, :description, :created_at, :created_by)";

            $this->db->query($query);

            $this->db->bind('id_kategori_bantuan',$data['id_kategori_bantuan']);
            $this->db->bind('periode',$data['periode']);
            $this->db->bind('description',$data['description']);
            $this->db->bind('created_at',$data['created_at']);
            $this->db->bind('created_by',$data['created_by']);

            return $this->db->num_rows();
        }

        public function getById($id_catatan)
        {
            $query = "SELECT *,kat.name as name, ban.description as description, ban.id_bantuan as id_bantuan,kel.kepala_keluarga as created_by FROM bantuan ban LEFT JOIN kategori_bantuan kat ON ban.id_kategori_bantuan = kat.id_kategori_bantuan LEFT JOIN keluarga kel ON kel.id_keluarga = ban.created_by LEFT JOIN penerima_bantuan pen ON pen.id_bantuan = ban.id_bantuan WHERE ban.id_bantuan = :id_bantuan";

            $this->db->query($query);

            $this->db->bind('id_bantuan',$id_catatan);

            return $this->db->single();
        }

        public function update($data,$id_catatan)
        {
            $query = "UPDATE bantuan SET id_kategori_bantuan = :id_kategori_bantuan, periode = :periode, description = :description, created_at = :created_at, created_by = :created_by WHERE id_bantuan = :id_bantuan";

            $this->db->query($query);

            $this->db->bind('id_kategori_bantuan',$data['id_kategori_bantuan']);
            $this->db->bind('periode',$data['periode']);
            $this->db->bind('description',$data['description']);
            $this->db->bind('created_at',$data['created_at']);
            $this->db->bind('created_by',$data['created_by']);
            $this->db->bind('id_bantuan',$id_catatan);

            return $this->db->num_rows();
        }


        public function delete($id_bantuan)
        {
            $query = "DELETE FROM bantuan WHERE id_bantuan = :id_bantuan";

            $this->db->query($query);

            $this->db->bind('id_bantuan',$id_bantuan);

            return $this->db->num_rows();
        }

    }