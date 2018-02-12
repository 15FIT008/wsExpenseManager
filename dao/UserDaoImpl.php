<?php
/**
 * Description of BookDaoImpl
 *
 * @author Gisela Kurniawati
 */
class UserDaoImpl {
    public function login(User $user) {
        $link = PDOUtil::createPDOConnection();
        $query = "SELECT * FROM User WHERE email = ? AND password = PASSWORD(?) LIMIT 1";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $user->getEmail(), PDO::PARAM_STR);
        $stmt->bindValue(2, $user->getPassword(), PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        $result = $stmt->fetch();
        PDOUtil::closePDOConnection($link);
        return $result;
    }
    public function addNewUser(User $user) {
        $link = PDOUtil::createPDOConnection();
        $query = "INSERT INTO User(fullname, email, password) VALUES(?,?,?)";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $user->getFullname(), PDO::PARAM_STR);
        $stmt->bindValue(2, $user->getEmail(), PDO::PARAM_STR);
        $stmt->bindValue(3, $user->getPassword(), PDO::PARAM_STR);
        $link->beginTransaction();
        if ($stmt->execute()) {
            $link->commit();
        } else {
            $link->rollBack();
        }
        PDOUtil::closePDOConnection($link);
    }
}