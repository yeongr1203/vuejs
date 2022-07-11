<template>
    <img class="imgsize" v-bind:src="imgSrc">  
</template>

<script>
export default {
    props: {
        imgSrc: String, 
    },
}
</script>

<style scoped>
/* scoped는 이 Css는 이 안에서만 사용하겠다는 뜻. */
/* 즉, 전역이 아니라서 상속되지 않음. */
    .imgsize { width: 700px;}
</style>