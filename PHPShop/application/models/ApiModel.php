<?php
namespace application\models;
use PDO;

class ApiModel extends Model {
    public function getCategoryList() {
        $sql =
        " SELECT * FROM t_category ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
        // fetch => 객체, fetchAll => 사용시 각 원하는 객체/배열이 되어야함.
    }
}