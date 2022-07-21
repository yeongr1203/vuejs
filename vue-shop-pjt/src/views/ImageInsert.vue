<template>
  <main class="mt-3">
    <div class="container">
      <h2 class="text-center">제품 사진 등록</h2>

      <div class="mb-3 row">
        <label class="col-md-3 col-form-label">제품ID</label>
        <div class="col-md-9">{{ productDetail.id }}</div>
      </div>

      <div class="mb-3 row">
        <label class="col-md-3 col-form-label">제품명</label>
        <div class="col-md-9">{{ productDetail.product_name }}</div>
      </div>

      <div class="mb-3 row">
        <label class="col-md-3 col-form-label">썸네일 이미지</label>
        <div class="col-md-9">
          <div class="row">

            <!-- TODO: 썸네일 이미지 리스트 가져오는 로직 후 구현 -->
            <div class="col-lg-3 col-md-4 col-sm-2" 
              :key="item.id" 
              v-for="(item) in productImage.filter( c => c.type === 1)">
              <div class="position-relative">
                <img :src="`/static/img/${item.product_id}/${item.type}/${item.path}`" class="img-fluid">
                <div class="position-absolute top-0 end-0" style="cursor:pointer;" @click="deleteImage(item.id)"> X </div>
                <!-- "deleteImg" = 주솟값복사. => 파라미터로 보낼 수 없다. 
                      / "deleteImg(item.id);" 호출한 것. => 파라미터 보낼 수 있다. -->
              </div>              
            </div>

          </div>
          <input type="file" class="form-control" 
            accept="image/png,image/jpeg" 
            @change="uploadFile($event.target.files, 1)">
          <div class="alert alert-secondary" role="alert">
            <ul>
              <li>이미지 사이즈 : 350 * 350</li>
              <li>파일 사이즈 : 1Mb 이하</li>
              <li>파일 확장자 : png, jpg만 가능</li>
            </ul>
          </div>
        </div>
      </div>

      <div class="mb-3 row">
        <label class="col-md-3 col-form-label">제품 이미지</label>
        <div class="col-md-9">
          <div class="row">
            <!-- TODO: 제품 이미지 리스트 가져오는 로직 후 구현 -->
            <div class="col-lg-3 col-md-4 col-sm-2" 
              :key="item.id" 
              v-for="(item) in productImage.filter( function(c) {
                return c.type === 2;
              } )">
              <div class="position-relative">
                <img :src="`/static/img/${item.product_id}/${item.type}/${item.path}`" class="img-fluid">
                <div class="position-absolute top-0 end-0" style="cursor:pointer;" @click="deleteImage(item.id)"> X </div>
                <!-- "deleteImg" = 주솟값복사. => 파라미터로 보낼 수 없다. 
                      / "deleteImg(item.id);" 호출한 것. => 파라미터 보낼 수 있다. -->
              </div>              
            </div>

          </div>
          <input type="file" class="form-control" 
                    accept="image/png,image/jpeg" 
                    @change="uploadFile($event.target.files, 2)">
          <div class="alert alert-secondary" role="alert">
            <ul>
              <li>최대 5개 가능</li>
              <li>이미지 사이즈 : 700 * 700</li>
              <li>파일 사이즈 : 1Mb 이하</li>
              <li>파일 확장자 : png, jpg만 가능</li>
            </ul>
          </div>
        </div>
      </div>


      <div class="mb-3 row">
        <label class="col-md-3 col-form-label">제품 설명 이미지</label>
        <div class="col-md-9">
          <div class="row">
            <!-- TODO: 제품 설명 이미지 리스트 가져오는 로직 후 구현 -->
            <div class="col-lg-3 col-md-4 col-sm-2" 
              :key="item.id" 
              v-for="(item) in productImage.filter( c => c.type === 3)">
              <div class="position-relative">
                <img :src="`/static/img/${item.product_id}/${item.type}/${item.path}`" class="img-fluid">
                <div class="position-absolute top-0 end-0" style="cursor:pointer;" @click="deleteImage(item.id)"> X </div>
                <!-- "deleteImg" = 주솟값복사. => 파라미터로 보낼 수 없다. 
                      / "deleteImg(item.id);" 호출한 것. => 파라미터 보낼 수 있다. -->
              </div>              
            </div>

          </div>
          <input type="file" class="form-control" 
                  accept="image/png,image/jpeg" 
                  @change="uploadFile($event.target.files, 3)">
                  <!-- 마지막에 괄호 뒤편에 muliple만 입력하면 여러장 배열에 넣을 수 있음. -->
          <div class="alert alert-secondary" role="alert">
            <ul>
              <li>파일 사이즈 : 5Mb 이하</li>
              <li>파일 확장자 : png, jpg만 가능</li>
            </ul>
          </div>
        </div>
      </div>

      <div class="mb-3 row m-auto">
        <router-link class="nav-link" to="/sales">
          <button type="button" class="btn btn-lg btn-dark">확인</button>
        </router-link>
      </div>


    </div>
  </main>
</template>

<script>
export default {
  data() {
    return {
      productName: '',
      productDetail: {},
      productImage: []
    }
  },
  created() {
    // this.productId = this.$route.query.product_id;
    // this.getProductDetail();    
    this.productDetail = this.$store.state.sallerSelectedProduct;
    this.getProductImage();
  },
  methods: {
     changeCate1() {
      this.selectedCate2 = '';
      this.selectedCate3 = 0;
      this.cate2List = [];
      this.cate3List = [];
      this.getCate2List(this.selectedCate1);
      this.getProductList();
    },
    changeCate2() {
      this.selectedCate3 = 0;
      this.cate3List = [];
      this.getCate3List(this.selectedCate1, this.selectedCate2);
      this.getProductList();
    },

    async getProductList() {      
      const param = {};
      if(this.selectedCate3 > 0) {
        param['cate3'] = this.selectedCate3;
      } else {
        if(this.selectedCate1 !== '') {
          param['cate1'] = this.selectedCate1;
        }
        if(this.selectedCate2 !== '') {
          param['cate2'] = this.selectedCate2;
        }
      }
      this.productList = await this.$get('/api/productList', param);
    },

    async getCate1List() {
      this.cate1List = await this.$get('/api/cate1List', {});
    },
    async getCate2List(cate1) {
      this.cate2List = await this.$get(`/api/cate2List/${cate1}`, {});
    },
    async getCate3List(cate1, cate2) {
      this.cate3List = await this.$get(`/api/cate3List/${cate1}/${cate2}`, {});
    },     
    async getProductImage() {
      this.productImage = await this.$get(`/api/productImageList/${this.productDetail.id }`);
    },
  
    // async uploadFile(files, type) {
    //   console.log(files);
    //   const image = await this.$base64(files[0]); 
    //   // resolve 값을 여기로 보내줌.
    //   // image = e.target.result ($base64에서 받을 때 문자열로 받음.)
    //   const formData = { image }; 
    //   const { error } = await this.$post(`/api/upload/${this.productDetail.id}/${type}`, formData); // error면 받는것.
    //   // 객체가 넘어왔을때, numberfild가 error인 것만 받겠다!
    //   console.log(error);
    // },

    // async deleteImage(id) {
    //   const del = await this.$delete(`/api/productImageDelete/${id}`);
    //   console.log(del);
    // },
    /*  --- 선생님 풀이.
      async deleteImage({ id, product_id, type, path }}) {
        const result = await this.$delete(`/api/productImageDelete/${id}/${product_id}/${type}/${path}`);
        console.log(result);
        
        //console.log(item);  //  작업 전에 paramiter에서 item 넣어 넘어오는지 확인.
      },

    */
  }
}

</script>

<style>

</style>
<!--

    // 7-19 작성 후 삭제.
    // async getProductDetail() {
    //   this.productDetail = await this.$get(
    //     `/api/productDetail/${this.productId}`, {} //방법1
    //     // 방법2
    //     // '/api/productDetail', { productId: this.productId }
    //     // ''문자열, {} 객체
    //   );
    //   console.log(productDetail);
    // }

-->