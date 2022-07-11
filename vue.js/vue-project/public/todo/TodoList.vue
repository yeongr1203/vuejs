<template>
    <section>
        <transition-group name="list" tag="ul">
            <li :key="todoItem.key" v-for="todoItem in propsItems" class="shadow">
            <!-- idx로 하면 문제점?  -->
            <!-- v-for="(todoItem, index) in todoItems" 값, 인덱스 위치 // 혹시 v-for="todoItem in todoItems" todoItem 자리에 값이 넘어옴.  -->
                <i class="checkBtn fas fa-check" aria-hidden="true"></i>
                {{ todoItem.value }}
                <span class="removeBtn" type="button" @click="removeTodo(todoItem.key)">
                <!-- <span class="removeBtn" type="button" @click="removeTodo(todoItem, idx)"> -->
                    <!-- 이제 todoItem 없어도 되고 idx값만 필요해서 -->
                    <i class="far fa-trash-alt" aria-hidden="true"></i>
                </span>
            </li>
            <!-- 반복문 설정시, key 설정이 필수! 왜냐면 배열에서 키값으로 구분하기 때문에 무조건 다른 값을 설정해야함. -->
        </transition-group>
    </section>
</template>

<script>
export default {
    // data() {
    //     return {
    //         // todoItems에 값이 들어가는 시점은. created 할때만 여기에 값이 들어간다.
    //         // 화면이 다 만들어지고 난 다음에 todoItem에 값을 넣는 소스는 없다.
    //         // 대신 값을 더 추가할 수 있는 부분이 있는데, 그 부분은 todoInput에 있다.
    //         todoItems: []
    //         // todoItems: ["A","B","C","D","E","F"] // 배열이 어떻게 나타나는지 확인하는 방법.
    //         // 이렇게 작성하면 화면에 찍혀져 나타남.
    //         // 비용이 많이 발생하지 않고, 저렴하게 빠르게 파일 저장이 된다.
    //         // 그리고 원래는 이 todolist가 app.vue에 있어야 한다. 구조자체가 잘못됨. app.vue에서 하고 list에서 당겨서 사용해야함.

    //     }
    // },
    props: { propsItems: Array },    // props:['todoItems'], 이렇게 작성 가능.
    methods: {
        removeTodo(key) {       // doto 삭제
        // removeTodo(todoItem, idx) {       // doto 삭제
            // // alert(todoItem + "," + index);   // 확인
            // localStorage.removeItem(todoItem);
            // this.todoItems.splice(index,1);
            // // this.todoItems 여기서 작업하는 것이라서 바로바로 적용이 됨.
            // // 쓰레기통 누르면 삭제가 s되는 지 확인.
            // console.log(todoItem + "," + idx);
            // this.$emit('childDelTodo',todoItem,idx);
            this.$emit('childDelTodo',key);
        }
        
    },  // 라이프사이클 훅

}
</script>

<style scoped>

    .list-enter-active, .list-leave-active { transition: all 1s; }
    .list-enter-from, .list-leave-to {
        opacity: 0; transform: translateY(-30px);
        /* -30은 위에서 밑으로 떨어지는 것, 30은 아래에서 위로 */
    }

    ul { 
        list-style-type: none; padding-left: 0; margin-top: 0; text-align: left;
    }
    li { 
        display: flex; min-height: 50px; height: 50px; line-height: 50px; margin: 0.5rem 0; padding: 0 0.9rem;
        background-color: white; border-radius: 5px;
    }
    .checkBtn { 
        /* line-height: 50px; color: #62acde; margin-right: 5px; */
        line-height: 50px; color: #6478FB; margin-right: 5px;
    }
    .removeBtn { 
        margin-left: auto; color: #de4343;
    }
</style>