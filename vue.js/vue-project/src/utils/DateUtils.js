export default {
    getTimestamp: function(date) {  // date 파라미터는 Date객체여야 함.
        date.setHours(date.getHours() + 9);
        return date.toISOString().replace('T','').substring(0,19);
    }
}