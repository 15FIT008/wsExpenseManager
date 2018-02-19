<?php
/**
 * Description of BookDaoImpl
 *
 * @author Gisela Kurniawati
 */
class IncomeDaoImpl {
    public function getAllIncomes() {
        $link = PDOUtil::createPDOConnection();
        $query = "SELECT * FROM Income i JOIN IncomeCategoty ic ON i.incomeCategory_id = ic.id";
        $result = $link->query($query);
        $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Income');
        PDOUtil::closePDOConnection($link);
        return $result;
    }
    public function addNewIncome (Income $income) {
        $link = PDOUtil::createPDOConnection();
        $query = "INSERT INTO Income (amount, description, date, IncomeCategory_id, User_id) VALUES(?,?,?,?,?,?)";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $income->getAmount(), PDO::PARAM_STR);
        $stmt->bindValue(2, $income->getDescription(), PDO::PARAM_STR);
        $stmt->bindValue(3, $income->getDate(), PDO::PARAM_STR);
        $stmt->bindValue(4, $income->getCategory()->getId(), PDO::PARAM_STR);
        $stmt->bindValue(5, $income->getUser()->getId(), PDO::PARAM_STR);
        $link->beginTransaction();
        if ($stmt->execute()) {
            $link->commit();
        } else {
            $link->rollBack();
        }
        PDOUtil::closePDOConnection($link);
    }
    
    public function updateIncome (Income $income) {
        $link = PDOUtil::createPDOConnection();
        $query = "UPDATE Income SET amount = ? , description = ?, date = ?, IncomeCategory_id = ?, User_id = ? WHERE id = ?";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $income->getAmount(), PDO::PARAM_STR);
        $stmt->bindValue(2, $income->getDescription(), PDO::PARAM_STR);
        $stmt->bindValue(3, $income->getDate(), PDO::PARAM_STR);
        $stmt->bindValue(4, $income->getCategory()->getId(), PDO::PARAM_STR);
        $stmt->bindValue(5, $income->getUser()->getId(), PDO::PARAM_STR);
        $stmt->bindValue(6, $income->getId(), PDO::PARAM_STR);
        $link->beginTransaction();
        if ($stmt->execute()) {
            $link->commit();
        } else {
            $link->rollBack();
        }
        PDOUtil::closePDOConnection($link);
    }

    public function deleteIncome(Income $income) {
        $link = PDOUtil::createPDOConnection();
        $query = "DELETE FROM Income WHERE id = ?";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $income->getId(), PDO::PARAM_INT);
        $link->beginTransaction();
        if ($stmt->execute()) {
            $link->commit();
        } else {
            $link->rollBack();
        }
        PDOUtil::closePDOConnection($link);
    }
}