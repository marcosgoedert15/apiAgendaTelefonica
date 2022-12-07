<?php
require 'db.php';

    class Process extends Db
    {

        public function select($obj)
        {
            $pdo = Db::connect();
            $stmt = $pdo->prepare("SELECT * FROM user WHERE id = :id");
            $stmt->bindParam(":id", $obj->id);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function selectAll()
        {
            $pdo = Db::connect();
            $stmt = $pdo->prepare("SELECT * FROM user");
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function insert($obj)
        {
            $pdo = Db::connect();
            $stmt = $pdo->prepare("INSERT INTO user (email, name, telephone1, telephone2)
                VALUES (:email, :name, :telephone1, :telephone2)");

            try {
                return $stmt->execute([
                    ':email'       => $obj->email,
                    ':name'        => $obj->name,
                    ':telephone1'  => $obj->telephone1 ?? '',
                    ':telephone2'  => $obj->telephone2 ?? ''
                ]);
            } catch (\Throwable $error) {
                echo $error;
            }
        }

        public function remove($obj)
        {
            $pdo = Db::connect();
            $stmt = $pdo->prepare("DELETE FROM user WHERE id = :id");
            $stmt->bindParam(':id', $obj->id);
            try {
                return $stmt->execute();
            } catch (\Throwable $error) {
                echo $error;
            }
        }

        public function update($obj)
        {
            $pdo = Db::connect();
            $sql = "UPDATE user SET name = :name, email = :email, telephone1 = :telephone1, telephone2 = :telephone2
                WHERE id = :id";
            $parameters = [
                ':email'       => $obj->email ?? '',
                ':name'        => $obj->name ?? '',
                ':telephone1'  => $obj->telephone1 ?? '',
                ':telephone2'  => $obj->telephone2 ?? '',
                ':id'          => $obj->id
            ];

            if (!isset($obj->email)) {
                $sql = str_replace("email = :email, ", "", $sql);
                unset($parameters[':email']);
            }
            if (!isset($obj->name)) {
                $sql = str_replace("name = :name, ", "", $sql);
                unset($parameters[':name']);
            }
            if (!isset($obj->telephone1)) {
                $sql = str_replace("telephone1 = :telephone1, ", "", $sql);
                unset($parameters[':telephone1']);
            }
            if (!isset($obj->telephone2)) {
                $sql = str_replace("telephone2 = :telephone2 ", "", $sql);
                unset($parameters[':telephone2']);
            }
            $sql = str_replace(", WHERE", " WHERE", $sql);
            $stmt = $pdo->prepare($sql);
            try {
                return $stmt->execute($parameters);
            } catch (\Throwable $error) {
                echo $error;
            }
        }
    }