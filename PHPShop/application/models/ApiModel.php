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

    public function productInsert(&$param) {        // DB 넣을 정보를 입력
        $sql = 
        "   INSERT INTO t_product
            SET product_name = :product_name
              , product_price = :product_price
              , delivery_price = :delivery_price
              , add_delivery_price = :add_delivery_price
              , tags = :tags
              , outbound_days = :outbound_days
              , category_id = :category_id        
              , seller_id = :seller_id        
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt -> bindValue(':product_name', $param['product_name']);
        $stmt -> bindValue(':product_price', $param['product_price']);
        $stmt -> bindValue(':delivery_price', $param['delivery_price']);
        $stmt -> bindValue(':add_delivery_price', $param['add_delivery_price']);
        $stmt -> bindValue(':tags', $param['tags']);
        $stmt -> bindValue(':outbound_days', $param['outbound_days']);
        $stmt -> bindValue(':category_id', $param['category_id']);
        $stmt -> bindValue(':seller_id', $param['seller_id']);
        $stmt->execute();
        return $stmt->intval($this->lastInsertId());
    }

    public function productList2() {
        $sql = 
        "   SELECT t3.*, t4.path
            FROM ( SELECT t1.*, t2.cate1, t2.cate2, t2.cate3
                    FROM t_product t1
                    INNER JOIN t_category t2
                    ON t1.category_id = t2.id
                ) t3
                LEFT JOIN (
                    SELECT * FROM t_product_img WHERE type = 1
                ) t4
                ON t3.id = t4.id
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt -> execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}