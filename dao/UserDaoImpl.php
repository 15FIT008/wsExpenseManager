<?php

/**
 * Description of BookDaoImpl
 *
 * @author Gisela Kurniawati
 */
class UserDaoImpl {

    /**
     *
     * @var User $data
     */
    private $data;

    public function setData($data) {
        $this->data = $data;
    }

    public function login() {
        if (isset($this->data)) {
            $query = 'SELECT * FROM user WHERE email = ? and password = MD5(?) LIMIT 1';
            $link = PDOUtil::createPDOConnection();
            $stmt = $link->prepare($query);
            $stmt->bindValue(1, $this->data->getEmail(), PDO::PARAM_STR);
            $stmt->bindValue(2, $this->data->getPassword(), PDO::PARAM_STR);
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            $stmt->execute();
            $result = $stmt->fetch();
            PDOUtil::closePDOConnection($link);
            $this->data = NULL;
        }
        return $result;
    }

    public function addNewUser() {
        $link = PDOUtil::createPDOConnection();
        $query = "INSERT INTO User(fullname, email, password) VALUES(?,?,MD5(?))";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $this->data->getFullname(), PDO::PARAM_STR);
        $stmt->bindValue(2, $this->data->getEmail(), PDO::PARAM_STR);
        $stmt->bindValue(3, $this->data->getPassword(), PDO::PARAM_STR);
        $link->beginTransaction();
        if ($stmt->execute()) {
            $link->commit();
        } else {
            $link->rollBack();
        }
        $this->data = NULL;
        PDOUtil::closePDOConnection($link);
    }

}
