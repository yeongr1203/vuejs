<?php
namespace application\controllers;

class ApiController extends Controller {
    public function categoryList() {
        return $this->model->getCategoryList();
    }

    public function productInsert() {   // model안에 불러운 정보들을 넣어주는 것.
        $json = getJson();
        return [_RESULT => $this->model->productInsert($json)];
    }

    public function productList2() {
        $result = $this->model->productList2();
        return $result === false ? [] : $result;
    }
}