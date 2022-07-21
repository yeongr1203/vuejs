<template>
  <main class="mt-3">
    <div class="container">
      <div class="float-end mb-1">
        <router-link class="nav-link" to="/create">
          <button type="button" class="btn btn-dark">제품등록</button>
        </router-link>
      </div>

      <table class="table table-bordered">
        <thead>
          <tr>
            <th>
            </th>
            <th>제품명</th>
            <th>제품가격</th>
            <th>배송비</th>
            <th>추가배송비</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(product, idx) in productList" :key="product.id">
            <!-- 통으로 받은 product2를 각 줄로 출력이 되는데, 이것을 각각 따로 보내려면, item을 뿌려줄 기준이 되는 id로 분류해서 출력시켜야 하기 때문에, item.id로 key값을 지정함. -->
            <td>
              <img v-if="product.path !== null" 
                :src="`/static/img/${product.id}/1/${product.path}`" 
                style="height:50px; width:auto;">
            </td>
            <td>{{ product.product_name }}</td>
            <td>{{ product.product_price }}</td>
            <td>{{ product.delivery_price }}</td>
            <td>{{ product.add_delivery_price }}</td>
            <td>
              <!-- router-link = 선생님풀이, 책은 조금다름. 맘에 드는걸로!! -->
              <!-- <router-link class="nav-link" :to="{ path:'/image_insert', query: { product_id: product.id } }">
                <button type="button" class="btn btn-info me-1">사진등록</button>
              </router-link> -->
              <button type="button" class="btn btn-info me-1" @click="goToImageInsert(Idx)">사진등록</button>
              <button type="button" class="btn btn-warning me-1">수정</button>
              <button type="button" class="btn btn-danger" @click="deleteProduct(product.id, idx)">삭제</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </main>
  

  <!-- <div>
    <h1>SalesList</h1>
    <router-link class="nav-link" to="/create">제품등록</router-link>
    // router로 연결된 것이라서 쿼리스트링으로 주소값이동하면 먹히지 않음. 
  </div> -->
</template>

<script>
export default {
  data() {
    return {
      // 통으로 받아온 값을 배열로 받아오기 때문에 담을 배열이 필요함.
      productList: [],
      cate1List: [],
      cate2List: [],
      cate3List: []
    }
  },
  created() {
      this.getProductList();
  },
  methods: {
    async getProductList() {
      this.productList = await this.$get('/api/productList2', {});
      // ProductList 를 배열로 통으로 받아오는 것을 product2 값으로 넣기 위해서 아래처럼 작성.
      // console.log(this.productList);  // proxy에서 배열로 들어온것 보임
      console.log(this.productList);
    },
    goToImageInsert(idx) {
      this.$store.commit('sallerSelectedProduct', this.productList[idx]);
      this.$router.push( {path: '/image_insert'} );
    },
    async deleteProduct(productId, idx) {
      console.log(productId);
      const res = await this.$delete(`/api/deleteProduct/${productId}`, {});
      if(res.result === 1) {
        this.productList.splice(idx, 1);        
      }
    }
  },
}
</script>

<style>

</style>