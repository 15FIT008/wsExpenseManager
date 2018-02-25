<?php

/**
 * Description of BookDaoImpl
 *
 * @author Gisela Kurniawati
 */
class IncomeDaoImpl {

    /**
     *
     * @var Income $data
     */
    private $data;

    public function setData($data) {
        $this->data = $data;
    }

    public function getAllIncomes() {
        $link = PDOUtil::createPDOConnection();
        $query = "SELECT * FROM Income i JOIN IncomeCategoty ic ON i.incomeCategory_id = ic.id";
        $result = $link->query($query);
        $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Income');
        PDOUtil::closePDOConnection($link);
        return $result;
    }

    public function addNewIncome() {
        if (isset($this->data) && !empty($this->data)) {
            $link = PDOUtil::createPDOConnection();
            $query = "INSERT INTO income (`amount`, `description`, `date`, `IncomeCategory_id`, `User_id`) VALUES (?,?,?,?,?)";
            $stmt = $link->prepare($query);
            $stmt->bindValue(1, $this->data->getAmount(), PDO::PARAM_STR);
            $stmt->bindValue(2, $this->data->getDescription(), PDO::PARAM_STR);
            $stmt->bindValue(3, $this->data->getDate(), PDO::PARAM_STR);
            $stmt->bindValue(4, $this->data->getCategory()->getId(), PDO::PARAM_STR);
            $stmt->bindValue(5, $this->data->getUser()->getId(), PDO::PARAM_STR);
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

    public function updateIncome() {
        if (isset($this->data) && !empty($this->data)) {
            $link = PDOUtil::createPDOConnection();
            $query = "UPDATE `income` SET `amount`=?, `description`=?, `date`=?, `IncomeCategory_id` = ?, `User_id`=? WHERE `id`= ?;";
            $stmt = $link->prepare($query);
            $stmt->bindValue(1, $this->data->getAmount(), PDO::PARAM_STR);
            $stmt->bindValue(2, $this->data->getDescription(), PDO::PARAM_STR);
            $stmt->bindValue(3, $this->data->getDate(), PDO::PARAM_STR);
            $stmt->bindValue(4, $this->data->getCategory()->getId(), PDO::PARAM_STR);
            $stmt->bindValue(5, $this->data->getUser()->getId(), PDO::PARAM_STR);
            $stmt->bindValue(6, $this->data->getId(), PDO::PARAM_STR);
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

    public function deleteIncome() {
        if (isset($this->data) && !empty($this->data)) {
            $link = PDOUtil::createPDOConnection();
            $query = "DELETE FROM Income WHERE id = ?";
            $stmt = $link->prepare($query);
            $stmt->bindValue(1, $data->getId(), PDO::PARAM_INT);
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

}
