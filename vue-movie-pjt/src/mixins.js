// 재사용성 극대화 -> 믹스인... 안그럼 import가 많아짐.
import axios from 'axios';

export default {
    data() {
        return {
            key: 'de024e41172ba2b7f13cb5d286ad1162',
            baseUrl: 'http://www.kobis.or.kr/kobisopenapi/webservice/rest/',
            boxOfficeByDay:'boxoffice/searchDailyBoxOfficeList.json',
            WeekBoxOffice:'boxoffice/searchWeeklyBoxOfficeList.json',
        }
    },
    methods: {
        async $api(url, parameter) {
            return (await axios.get(url,{
                params: parameter
            })
            .catch(e => {
                console.log(e);
            })).data;   
        }, 
        async getBoxOfficeByDay(targetDt) {
            const parameter = {
                key: this.key,
                targetDt        //'targetDT' : targetDT 와 같음
            }
            const url = this.baseUrl + this.boxOfficeByDay;
            return await this.$api(url, parameter);
        },
        // 주간박스오피스 =>통신영역
        async getWeekBoxOffice(targetDt, weekGb) {
            const parameter = {
                key: this.key,
                targetDt,
                weekGb
            }
            const url = this.baseUrl + this.WeekBoxOffice;
            return await this.$api(url,parameter);
        },
        getOnlyDateStr(date) {
            return date.toISOString().split('T')[0]
        },
        
    }
}