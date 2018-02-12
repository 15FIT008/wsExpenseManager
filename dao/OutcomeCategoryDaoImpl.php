<?php
/**
 * Description of BookDaoImpl
 *
 * @author Gisela Kurniawati
 */
class OutcomeCategoryDaoImpl {
    public function getAllOutcomeCategory() {
        $link = PDOUtil::createPDOConnection();
        $query = "SELECT * FROM OutcomeCategory";
        $result = $link->query($query);
        $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'OutcomeCategory');
        PDOUtil::closePDOConnection($link);
        return $result;
    }
    public function addNewOutcomeCategory(OutcomeCategory $oc) {
        $link = PDOUtil::createPDOConnection();
        $query = "INSERT INTO OutcomeCategory(category) VALUES(?)";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $oc->getCategory(), PDO::PARAM_STR);
        $link->beginTransaction();
        if ($stmt->execute()) {
            $link->commit();
        } else {
            $link->rollBack();
        }
        PDOUtil::closePDOConnection($link);
    }
}