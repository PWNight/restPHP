<?php
    class Utils {
        private $settings;
        public $conn;
        public $dsn;
        // Connect to DB
        public function conn() {
            try {
              $this->settings = parse_ini_file("conn.ini", false);
              $this->dsn = 'mysql:host='.$this->settings['database_host'].';dbname='.$this->settings['database_name'];
              $this->conn = new PDO($this->dsn, $this->settings['database_user'], $this->settings['database_password']);
              $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
              die('Connectionn Failed' . $e->getMessage());
            }
            return $this->conn;
          }
        public function fetch($id = 0) {
            $sql = 'SELECT * FROM users';
            if ($id != 0) {
                $sql .= ' WHERE id = :id';
            }
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['id' => $id]);
            $rows = $stmt->fetchAll();
            return $rows;
        }

        // Insert an user in the database
        public function insert($name, $email, $phone) {
            $sql = 'INSERT INTO users (name, email, phone) VALUES (:name, :email, :phone)';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['name' => $name, 'email' => $email, 'phone' => $phone]);
            return true;
        }

        // Update an user in the database
        public function update($name, $email, $phone, $id) {
            $sql = 'UPDATE users SET name = :name, email = :email, phone = :phone WHERE id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['name' => $name, 'email' => $email, 'phone' => $phone, 'id' => $id]);
            return true;
        }

        // Delete an user from database
        public function delete($id) {
            $sql = 'DELETE FROM users WHERE id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['id' => $id]);
            return true;
        }
        // JSON Format Converter Function
        public function message($status,$content) {
            return json_encode(['Status' => $status, 'Content-Type' => 'application/json', 'message' => $content]);
        }
    }