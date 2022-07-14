<template>
    <div>
        <h1>{{ title }}</h1>
        <div>
            <input type="date" v-model="weekSelected">
            <button @click="weekSearch">검색</button>
        </div>
        <rank-table :list="list" />
    </div>
</template>

<script>
import RankTable from '../components/boxoffice/RankTable';

export default {
    components: {
        RankTable
    },
    data() {
        return {
            title: '주간 박스오피스',
            weekSelected: '',
            list: []
        }
    },
    methods: {
        weekSearch() {
            const targetDt = this.weekSelected.replaceAll('-','');
            this.getData(targetDt);
        },
        async getData(targetDt) {
            const data = await this.getWeekBoxOffice(targetDt);
            this.list = data.boxOfficeResult.weeklyBoxOfficeList;
        }
    },
    created() {
        const w = new Date();
        w.setDate(w.getDate() -8);
        this.weekSelected = this.getOnlyDateStr(w);
        this.weekSearch();
    }
}
</script>

