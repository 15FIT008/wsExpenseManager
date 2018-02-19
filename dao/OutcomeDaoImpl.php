<?php
/**
 * Description of BookDaoImpl
 *
 * @author Gisela Kurniawati
 */
class IncomeDaoImpl {
    public function getAllOutcomes() {
        $link = PDOUtil::createPDOConnection();
        $query = "SELECT * FROM Outcome o JOIN OutcomeCategoty oc ON o.incomeCategory_id = oc.id";
        $result = $link->query($query);
        $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Outcome');
        PDOUtil::closePDOConnection($link);
        return $result;
    }
    public function addNewOutcome(Outcome $outcome) {
        $link = PDOUtil::createPDOConnection();
        $query = "INSERT INTO Outcome(amount, description, date, OutcomeCategory_id, User_id) VALUES(?,?,?,?,?,?)";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $outcome->getAmount(), PDO::PARAM_STR);
        $stmt->bindValue(2, $outcome->getDescription(), PDO::PARAM_STR);
        $stmt->bindValue(3, $outcome->getDate(), PDO::PARAM_STR);
        $stmt->bindValue(4, $outcome->getCategory()->getId(), PDO::PARAM_STR);
        $stmt->bindValue(5, $outcome->getUser()->getId(), PDO::PARAM_STR);
        $link->beginTransaction();
        if ($stmt->execute()) {
            $link->commit();
        } else {
            $link->rollBack();
        }
        PDOUtil::closePDOConnection($link);
    }
    
    public function updateOutcome (Outcome $outcome) {
        $link = PDOUtil::createPDOConnection();
        $query = "UPDATE Outcome SET amount = ? , description = ?, date = ?, IncomeCategory_id = ?, User_id = ? WHERE id = ?";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $outcome->getAmount(), PDO::PARAM_STR);
        $stmt->bindValue(2, $outcome->getDescription(), PDO::PARAM_STR);
        $stmt->bindValue(3, $outcome->getDate(), PDO::PARAM_STR);
        $stmt->bindValue(4, $outcome->getCategory()->getId(), PDO::PARAM_STR);
        $stmt->bindValue(5, $outcome->getUser()->getId(), PDO::PARAM_STR);
        $stmt->bindValue(6, $outcome->getId(), PDO::PARAM_STR);
        $link->beginTransaction();
        if ($stmt->execute()) {
            $link->commit();
        } else {
            $link->rollBack();
        }
        PDOUtil::closePDOConnection($link);
    }

    public function deleteOutcome(Outcome $outcome) {
        $link = PDOUtil::createPDOConnection();
        $query = "DELETE FROM Outcome WHERE id = ?";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $outcome->getId(), PDO::PARAM_INT);
        $link->beginTransaction();
        if ($stmt->execute()) {
            $link->commit();
        } else {
            $link->rollBack();
        }
        PDOUtil::closePDOConnection($link);
    }
}