<?php
/**
 * Description of BookDaoImpl
 *
 * @author Gisela Kurniawati
 */
class IncomeCategoryDaoImpl {
    public function getAllIncomeCategory() {
        $link = PDOUtil::createPDOConnection();
        $query = "SELECT * FROM IncomeCategory";
        $result = $link->query($query);
        $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'IncomeCategory');
        PDOUtil::closePDOConnection($link);
        return $result;
    }
    public function addNewIncomeCategory(IncomeCategory $ic) {
        $link = PDOUtil::createPDOConnection();
        $query = "INSERT INTO IncomeCategory(category) VALUES(?)";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $ic->getCategory(), PDO::PARAM_STR);
        $link->beginTransaction();
        if ($stmt->execute()) {
            $link->commit();
        } else {
            $link->rollBack();
        }
        PDOUtil::closePDOConnection($link);
    }
}