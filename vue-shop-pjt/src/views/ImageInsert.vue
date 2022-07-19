<template>
  <main class="mt-3">
    <h1>ImageInsert</h1>
    <div>{{ productId }}</div>
  </main>
</template>

<script>
export default {
  data() {
    return {
      productId: 0,
      productName: '',
      productDtail: {},
      productImage: []
    }
  },
  created() {
    this.productId = this.$route.query.product_id;
  }
}
</script>

<style>

</style>