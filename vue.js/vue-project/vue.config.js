const { defineConfig } = require('@vue/cli-service')
module.exports = defineConfig({
  transpileDependencies: true,
  // 아래부터 내가 작성한 것 => devServer!! 상단 true까지는 기본! 
  devServer: {  // devServer와 통신되도록 proxy설정을 위해 작성됨.
    proxy: {
      '/todo' : {
        target: 'http://localhost'
      }
    }
  }
});
