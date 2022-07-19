import axios from 'axios';

export default {
    methods: {
        async $post(url, data) {
            return (await axios({
                method: 'post',
                url,
                data
            }).catch(e => {
                console.log(e);
            })).data;
        },

        // productCreate 안에있는 method 안에 get을 여기에 작성함.
        async $get(url, param) {    
            return (await axios.get(url, { 
                params: param   
                // get방식으로 받아오기 때문에! param을 꼭 params: 안에 넣어줘야함!
            }).catch(e => {
                console.error(e);
            })).data;
        },

        $base64(file) {
            return new Promise(resolve => {
                const fr = new FileReader();
                fr.onload = e => {
                    resolve(e.target.result);
                }
                fr.readAsDataURL(file);
            })
        }
    }
}