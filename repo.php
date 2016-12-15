<?php
    require_once 'vendor/autoload.php';

    class Repository {
        private $db;

        public function __construct() {
            $this->db = new mysqli('localhost', 'root', '', 'fitness');
            if($this->db->connect_errno > 0){
                die('Unable to connect to database [' . $this->db->connect_error . ']');
            }
        }

        public function fetch_pushup_target() {
            $query = "SELECT `day`, `target` FROM `pushup_target`";

            if(!$result = $this->db->query($query)){
                die('There was an error running the query [' . $this->db->error . ']');
            }

            $data = array();
            while($row = $result->fetch_assoc()){
                $data[$row['day']] = (int)$row['target'];
            }

            return json_encode($data, JSON_PRETTY_PRINT);
        }

        public function save_pushup_target($new_targets) {
            $loader = new Twig_Loader_Filesystem('templates');
            $twig = new Twig_Environment($loader);

            $save_query = $twig->render('save_query.twig', array('new_targets' => (array)$new_targets));
            $this->db->query('TRUNCATE TABLE `pushup_target`');

            if ($this->db->query($save_query) === true) {
                echo '{"status": "succeeded"}';
            } else {
                echo '{"status": "failed", "error": "' . $this->db->error . '"}';
            }
        }
    }
