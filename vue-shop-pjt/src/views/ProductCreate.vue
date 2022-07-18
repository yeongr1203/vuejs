<!-- container 작업한 이유는? 그리드 시스템 사용을 위해서! -->
<template>
  <main class="mt-3">
    <div class="container">
      <h2 class="text-center">제품등록</h2>

      <div class="mb-3 row">
        <label class="col-md-3 col-form-label">제품명</label>
        <div class="col-md-9">
          <input type="text" class="form-control" ref="product_name" v-model="product.product_name">
        </div>
      </div>

      <div class="mb-3 row">
        <label class="col-md-3 col-form-label">제품가격</label>
        <div class="col-md-9">
          <div class="input-group mb-3">
            <input type="number" class="form-control" ref="product_price" v-model="product.product_price">
            <span class="input-group-text">원</span>
          </div>
        </div>
      </div>

      <div class="mb-3 row">
        <label class="col-md-3 col-form-label">배송비</label>
        <div class="col-md-9">
          <div class="input-group mb-3">
            <input type="number" class="form-control" ref="delivery_price" v-model="product.delivery_price">
            <span class="input-group-text">원</span>
          </div>
        </div>
      </div>

      <div class="mb-3 row">
        <label class="col-md-3 col-form-label">추가배송비(도서산간)</label>
        <div class="col-md-9">
          <div class="input-group mb-3">
            <input type="number" class="form-control" ref="add_delivery_price" v-model="product.add_delivery_price">
            <span class="input-group-text">원</span>
          </div>
        </div>
      </div>

      <div class="mb-3 row">
        <label class="col-md-3 col-form-label">카테고리</label>
        <div class="col-md-9">

          <div class="row">
            <div class="col-auto">              
              <select class="form-select" v-model="cate1" @change="changeCate1">
                <!-- getCategoryList는 여기서 뿌리기. -->
                <option :key="name" v-for="(value, name) of categoryObj">{{ name }}</option>
                <!-- key에도 값을 사용. {{ name }} 찍는 것도 키값사용. -->
              </select>
            </div>

            <div class="col-auto" v-if="cate1 !== ''">
              <select class="form-select" v-model="cate2" @change="changeCate2">
                <!-- change한 이유는 값이 변경되야하기 때문에 설정. 안하면 앞에 값이 그대로 있음. -->
                <option :key="name" v-for="(value, name) of categoryObj[cate1]">{{ name }}</option>
              </select>
            </div>

            <div class="col-auto" v-if="cate2 !== ''">
              <select class="form-select" v-model="selectedCateId">
                <option :value="cate.id" :key="cate.id" v-for="cate in categoryObj[cate1][cate2]">{{ cate.value }}</option>
                <!-- in 사용한 것은 ?? -->
                <!-- 찍는건 cate.value -->
              </select>
            </div>
            {{ selectedCateId }}  
            <!-- 나오는 값을 볼 수있음.  -->
          </div>
        </div>
      </div>

      <div class="mb-3 row">
        <label class="col-md-3 col-form-label">태그</label>
        <div class="col-md-9">
          <input type="text" class="form-control" v-model="product.tags">
        </div>
      </div>

      <div class="mb-3 row">
        <label class="col-md-3 col-form-label">출고일</label>
        <div class="col-md-9">
          <div class="input-group mb-3">
            <input type="number" class="form-control" v-model="product.outbound_days">
            <span class="input-group-text">일 이내 출고</span>
          </div>
        </div>
      </div>

      <div class="mb-3 row">
        <div class="col-6 d-grid p-1">
          <button type="button" class="btn btn-lg btn-dark" @click="goToList">취소</button>
        </div>
        <div class="col-6 d-grid p-1">
          <button type="button" class="btn btn-lg btn-danger" @click="productInsert">저장</button>
          <!-- productInsert는 메소드에 설정함. -->
        </div>
      </div>

    </div>
  </main>
</template>

<script>
export default {
  data() {
    return {
      product: {
        product_name: '',
        product_price: 0,
        delivery_price: 0,
        add_delivery_price: 0,
        tags: '',
        outbound_days: 0,
        category_id: 1,
        seller_id: 1
      },      
      categoryObj: {},    
      cate1: '',
      cate2: '',
      cate3: '',
      selectedCateId: '',
    };
  },
  created() {
    this.getCategoryList();
  },
  methods: {    // getCategoryList 를 정리한 것 = 여기 부분.
    async getCategoryList() {
      const categoryList = await this.$get('/api/categoryList', {});
      // http://localhost/api/categoryList
      console.log(categoryList);  // [] 넘어오는 것을 확인가능.
      
      // cate1, cate2를 빈칸으로 변수생성.
      let cate1 = '';
      let cate2 = '';      
      categoryList.forEach(item => {
        // item.cate1과 ''로 설정한 변수 cate1이랑 다르면 아래 실행.
        if(item.cate1 !== cate1) {  
          cate1 = item.cate1;
          this.categoryObj[cate1] = {}; // {} = 객체로 넘어옴
          cate2 = '';          
        }
        /* 결과
          categoryObj: {
            '전자제품':{}
          }
        */
        // item.cate2와 ''인 cate2가 다르면 아래 실행.
        if(item.cate2 !== cate2) {
          cate2 = item.cate2;
          this.categoryObj[cate1][cate2] = [];  // []=배열로받음
        }
        /* 결과
          categoryObj: {
            '전자제품':{
              '컴퓨터':[]
            }
          }
        */
        const obj = {
          id: item.id,
          value: item.cate3
        }
        /* 결과
          categoryObj: {
            '전자제품':{
              '컴퓨터':[
                id:1,
                value: '악세사리'
              ]
            }
          }
        */
        this.categoryObj[cate1][cate2].push(obj);
      });      
    },
    changeCate1() {
      this.cate2 = '';
      this.selectedCateId = '';
    },
    changeCate2() {
      this.selectedCateId = '';
    },
    productInsert() {
      if(this.product.product_name === '') {
        this.$refs.product_name.focus();
        //focus는 포커스가 거기로 가도록 설정.
        return this.$swal('제품명은 필수 입력값입니다.');
      }

      if(this.product.product_price() === '' || this.product.product_price === 0) {
        this.$refs.product_price.focus();
        return this.$$swal('제품 가격을 입력해주세요.');
      }

      if(this.product.delivery_price() === '' || this.product.delivery_price === 0) {
        this.$refs.delivery_price.focus();
        return this.$swal('배송료를 입력하세요.');
      }



    }
  }
}
</script>
<style>

</style>