<template>
    <table>
            <thead>
                <tr>
                <th>순위</th>
                <th>제목</th>
                <th>개봉일</th>
                <th>누적관객수</th>
                <th>누적매출액</th>
                </tr> 
            </thead>
            <tbody>
                <rank-row :item="item" v-for="item in list" :key="item.movieCd" />                
            </tbody>
        </table>
</template>

<script>
import RankRow from './RankRow.vue';

export default {
  components: { RankRow },
    props: {    // 일방통행, 위에서 아래로만 받을 수 있음.
        // 리스트: Array => 배열이기 때문에
        list: Array
    }
}
</script>

<style scoped>

</style>