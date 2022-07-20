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
        async $get(url, param) {        //$get(url=>문자열, param=>객체)
            return (await axios.get(url, { 
                params: param   
                // get방식으로 받아오기 때문에! param을 꼭 params: 안에 넣어줘야함!
            }).catch(e => {
                console.error(e);
            })).data;
        },

        // 상세페이지 img 삭제
        async $delete(url, param) {        
            return (await axios.delete(url, { 
                params: param   
            }).catch(e => {
                console.error(e);
            })).data;
        },
        /*  -- 선생님풀이
            async $delete(url, param) {        
                return (await axios.delete(url, { 
                    params: param   
                }).catch(e => {
                    console.error(e);
                })).data;
            },
        */

        // 문자열 상태로 변경한 다음에 백엔드로 보내기 위해서 사용
        $base64(file) {
            return new Promise(resolve => { 
                // Promise에 resolve 값을 줌.
                const fr = new FileReader();    // FileReader 객체화
                fr.onload = e => {  // FileReader에 이벤트 걸어뒀고, 그게 끝이 났다면 이걸 실행해라. 
                    // 로딩이 끝난 이벤트, 그 이벤트에는 문자열이 있음.
                    resolve(e.target.result);   
                    // e.target.result : 이미지를 문자열로 변경.
                    // e.target.result = 로딩이 끝난 문자열이 있음.
                }   // 실행이 된다면 e.target.result에 담기는 것이고,
                fr.readAsDataURL(file); 
                // base64에 file에 들어오는데, 아래에 이벤트가 끝나서 로딩이 끝나면 파일을 읽어줌.
            })
        }
    }
}