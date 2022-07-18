<?php
namespace application\controllers;

class UserController extends Controller {
    public function signup() {
        $json = getJson();      // 배열로 넘어옴!
        $result = $this->model->signup($json);
        if($result) {   // 성공했다면,
            $this->flash(_LOGINUSER, $result);
            return [_RESULT => $result];
        }
        return [_RESULT => 0];  //실패했다면.
    }
    
    public function logout() {
        $this->flash(_LOGINUSER);
        return [_RESULT => 1];
    }
}