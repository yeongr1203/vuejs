<?php
namespace application\models;
use PDO;
/*
    itodo는 자동으로 숫자가 하나씩 올라가고, created_at 역시 생성되면 그 시간이 자동생성되기 때문에, 내가 작성해서 등록할 값은 todo 뿐이다.

    insert 값 = todo값만 입력하면 되기때문에 todo만 작성.
    selTodoList 값 = 어차피 전체 선택이기 때문에 t_todo로부터 전체를 선택
        = 모든걸 받아야하기때문에 fetchAll로 작성.
    delTodo 값 = itodo 번호만 필요 하기 때문에 호출, 리턴.
*/

class TodoModel extends Model {
    public function insTodo(&$param) {
        $sql = 
        "   INSERT INTO t_todo (todo)
            VALUES (:todo)
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt -> bindValue(":todo", $param["todo"]);
        $stmt -> execute();
        return intval($this->pdo->lastInsertId());
        // return $stmt -> rowcount(); // 내풀이
    }

    public function selTodoList() {
        $sql = 
        "   SELECT * 
            FROM t_todo
            ORDER BY itodo  -- order by절 사용은 선생님풀이(추가된것)
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt -> execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function delTodo(&$param) {
        $sql = " DELETE FROM t_todo ";
        $itodo = $param["itodo"];
        if($itodo > 0) {
            $sql .= " WHERE itodo = {$itodo} ";
        }
        $stmt = $this->pdo->prepare($sql);
        $stmt -> execute();
        return $stmt->rowcount();
        /*  // 내풀이
            $sql = " DELETE FROM t_todo WHERE itodo = :itodo ";
            $stmt = $this->pdo->prepare($sql);
            $stmt -> bindValue(":itodo", $param["itodo"]);
            $stmt->execute();
            return $stmt->rowcount();
        */
    }

}