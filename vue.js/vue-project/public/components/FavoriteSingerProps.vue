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
    .imgsize { width: 700px;}
</style>