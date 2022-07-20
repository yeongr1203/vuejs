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

    // 제품 사진 등록 page 부분
    public function productDetail() {
        $urlPaths = getUrlPaths();
        if(!isset($urlPaths[2])) {
            exit();
        }
        $param = [
            'product_id' => intval($urlPaths[2])
        ];
        return $this->model->productDetail($param);
    }

    // 파일 업로드 영역. => static/img 폴더 생성됨.
    public function upload() {
        $urlPaths = getUrlPaths();      // urlUtils에 있음.
        // 주소값을 슬러시/ 단위로 쪼갠것. 
        if(!isset($urlPaths[2]) || !isset($urlPaths[3])) {  // 2번칸 = productId, 3번칸 type
            exit();
        }
        $productId = intval($urlPaths[2]);
        $type = intval($urlPaths[3]);
        $json = getJson();
        $image_parts = explode(";base64,", $json["image"]);
        //  $json["image"] = 배열에 
        // 
        $image_type_aux = explode("image/", $image_parts[0]); 
        // $image_parts[0] => 0번칸에 있는 값.     
        $image_type = $image_type_aux[1];      
        $image_base64 = base64_decode($image_parts[1]);
        $dirPath = _IMG_PATH . "/" . $productId . "/" . $type;  
        // 폴더가 없으면 만들어주는 것. = $dirPath
        $filePath = $dirPath . "/" . uniqid() . "." . $image_type;
        // file 특정 key값만들어주는 것. = $filePath
        if(!is_dir($dirPath)) {
            mkdir($dirPath, 0777, true);
            // 폴더가 없다면 폴더까지 생성.
        }
        //$file = _IMG_PATH . "/" . $productId . "/" . $type . "/" . uniqid() . "." . $image_type;
        //$file = "static/" . uniqid() . "." . $image_type;
        $result = file_put_contents($filePath, $image_base64); 
        // 내가 원하는 곳으로 만들어주는 것.
        if($result) {            
           $param = [
            "product_id" => $productId,
            "type" => $type,
            "path" => end(explode("/",$filePath))
           ];
           return $this->model->productImageInsert($param);
           /*   
           end(explode("/",$filePath))는 배열안에서 사용가능.
           explode "/" 기준으로 잘라서 주는 것.
           end => / 기준으로 마지막 부분을 사용하겠다는 뜻.
           $filePath는 경로와 img 명+확장자 모두 가지고 있는 변수, 그래서 마지막에 있는 이미지명+확장자만 뽑아서 사용하기위해 end를 사용함.
           ---- explode(기준점, 사용하는변수)
           */
        }
        /*  // 선생님 풀이
        if(result) {
            $param = [
                "product_id" => productId,
                "type" => $type,
                "path" => $fileNm
            ];
            return $this->model->productImageInsert($param);
            
            // $fileNm 은 filePath에서 uniqid()... 뒤가 필요하기 때문에 그부분만 담아서 따로 생성한 변수이고, $fileNm 은 filePath위에 작성해야 한다.
            // $fileNm = uniqid() . "." . $image_type; 
        }
        */
        return [_RESULT => $result ? 1 : 0];
    }
    
    public function productImageList() {
        $urlPaths = getUrlPaths();
        if(!isset($urlPaths[2])) {
            exit();
        }
        $productId = intval($urlPaths[2]);
        $param = [
            "product_id" => $productId
        ];
        return $this->model->productImageList($param);
    }

    // 상세페이지 안 img 삭제
    public function productImageDelete() {
        $urlPaths = getUrlPaths();
        if(!isset($urlPaths[2])) {
            exit();
        }
        $result = 0;
        switch(getMethod()) {
            case _DELETE:       // 이미지 파일 삭제!
                // 삭제는 쿼리스트링으로 받으면 됨. getJson은 GET/POST만!
                // 첫번째 방법.  model에서 select하는 것 만들면됨.
                // 두번째 방법. 필요한 정보를 프론트엔드로 넘김 -> type, 파일명 필요함.              
                $param = [
                    "product_image_id" => intval($urlPaths[2]),
                ];
                // 1번방법 사용.
                $delpath = $this->model->productImgPath($param);
                $dirPath = _IMG_PATH.'/'.$delpath->product_id.'/'.$delpath->type.'/'.$delpath->path;
                unlink($dirPath);

                $result = $this->model->porductImageDelete($param);
                break;
        }
        return [ _RESULT => $result ];
        /*  -- 선생님 풀이.
            switch(getMethod()) {
                case _DELETE:
                    $product_image_id = intval($urlPaths[2]);
                    $product_id = intval($urlPaths[3]);
                    $type = intval($urlPaths[4]);
                    $path = $urlPaths[5];  // path=>문자열 intval 없음!
                    
                    $imgPath = _IMG_PATH."/".$product_id."/".$type."/".$path;
                    if(unlink($imgPath)) {
                        $param = [
                            "product_image_id" => $product_image_id
                        ];
                        $result = $this->model->porductImageDelete($param);
                    }
                    break;
            }
            return [ _RESULT => $result ];
        */
    }
}