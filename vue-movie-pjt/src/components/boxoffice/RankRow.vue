<template>
    <tr>
        <td>{{ item.rank }}</td>
        <td>{{ item.movieNm }}</td>
        <td>{{ item.openDt }}</td>
        <td>{{ getaudiAcc }}명</td>
        <td>{{ getsalesAcc }}원</td>
    </tr>    
</template>

<script>
export default {
    props: {
        item: Object
        // 보내는 타입이 다르기 때문에 객체로 전송.
    },
    computed: {
        getaudiAcc() {
            return this.numberComma(this.item.audiAcc);
        },
        getsalesAcc() {
            return this.numberComma(this.item.salesAcc);
        }
    },
    methods: {
        numberComma(num) {
            return String(num).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
    }, 
}
</script>
