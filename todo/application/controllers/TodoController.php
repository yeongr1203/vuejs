<?php
namespace application\controllers;
/*
    Delete에서 get방식과 쿼리스트링으로 날린다고 했는데, 
    (get) board -> list
    (get) board/1 -> detail
    RESTful API에서는 쿼리스트링 안쓰려고 함.

    (delete) board/1 ==> 1번글 삭제하라는 뜻.
    경로로 주소값을 보내는 방식으로 작성하기!!
    쿼리스트링 board/1?ddd=11 이렇게 하는것은 

    (delete) todo/index
        => 
    (delete) todo/index/1
        => 2번칸에 값이 있다면, 2번칸자리에 작성된 번호삭제 => 부분삭제
*/

class TodoController extends controller {
    public function main() {
        return "index.html";
    }

    public function index() {
        switch(getMethod()) {
            case _GET:
                return $this->model->selTodoList();
            case _POST:
                // $param = [ "todo" => $_POST["todo"] ];  // 내풀이
                $json = getJson(); // 선생님 풀이, param 대신 json사용
                $result = $this->model->insTodo($json);
                return [_RESULT => $result];
            case _DELETE:
                // 선생님풀이
                $urlPaths = getUrlPaths();
                $param = [ "itodo" => 0 ];  // 0이면 전체삭제

                if(isset($urlPaths[2])) {  // 0이 아니면 부분삭제 
                    $param["itodo"] = intval($urlPaths[2]);
                }

                return [_RESULT => $this->model->delTodo($param)];
                
                // 내풀이
                // $param = [
                //     "itodo" => $_GET["itodo"]
                // ];
                // return [_RESULT => $this->model->delTodo($param)];
        }
    }
}