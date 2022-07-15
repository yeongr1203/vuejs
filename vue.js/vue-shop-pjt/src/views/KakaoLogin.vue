<template>
  <div>
    <a id="custom-login-btn" @click="kakaoLogin">
        <!-- 도구>JS SDK데모 > 카카오로그인 > 로그인 -->
        <img
            src="//k.kakaocdn.net/14/dn/btroDszwNrM/I6efHub1SN5KCJqLm1Ovx1/o.jpg"
            width="222" alt="카카오 로그인 버튼" 
        />
    </a>
  </div>
</template>

<script>
export default {
    methods: {
        kakaoLogin() {
            window.Kakao.Auth.login({
                scope: 'profile_nickname, profile_image, account_email',
                // 문서>카카오 로그인>설정하기 참조.
                success: this.getKakaoAccount,
                fail: e => {
                    console.error(e);
                }
            });
        },
        getKakaoAccount() {            
            window.Kakao.API.request({
                url: '/v2/user/me',
                success: res => {
                    const acc = res.kakao_account;
                    console.log(acc);
                    const params = {
                        email: acc.email,
                        nickname: acc.profile.nickname,
                        profile_img: acc.profile.profile_image_url,
                        thumb_img: acc.profile.thumbnail_image_url
                    }
                    console.log(params);

                    alert('로그인 성공!')
                },
                fail: e => {
                    console.error(e);
                }
            });
        }
    }
}
</script>

<style>

</style>