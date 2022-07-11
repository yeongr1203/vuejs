<template>
    <div class="inputBox shadow">
        <input type="text" v-model="newTodoItem" @keyup.enter="addTodo" placeholder="Type what you have to do" autofocus>
        <!-- autofocus => input 자동 cursor // 개별로 한 것 -->
        <span class="addContainer" @click="addTodo">
            <i class="addBtn fas fa-plus" aria-hidden="true"></i>
        </span>
        <!-- <button @click="addTodo">추가</button> -->
    </div>
</template>

<style scoped>
    input:focus { outline: none; }
    .inputBox { 
        background-color: white; height:50px; line-height: 50px; border-radius: 5px;
        display: flex;
    }
    .inputBox input { border-style: none; font-size: 0.9rem; flex-grow: 1; padding: 0 10px;}
    .addContainer {
        background: linear-gradient(to right, #6478FB, #8763fb);
        width: 3rem;
        border-radius: 0 5px 5px 0;
    }
    .addContainer > .addBtn {
        color: white;
    }
</style>

<script>
export default {
    data() {
        return {
            newTodoItem: ''
        }
    },
    methods: {
        addTodo() {
            /* 선생님풀이
            if(this.newTodoItem.trim() === '') {
                this.$emit('noInputValue');
            }
             */
            // 내풀이
            if(this.newTodoItem.trim() !== '') {
                const value = this.newTodoItem.trim();
                this.$emit('childAddTodo', value);
            } else {
                this.$emit('noInputValue');
            }
            this.newTodoItem = '';

            // // console.log(this.newTodoItem);   // 1번 출력확인
            // // if(this.newTodoItem.trim() === '') { return; } // 직접 값을 주지 않으려고 주석처리함.
            // if(this.newTodoItem.trim() !== '') {
            //     // 스페이스바 공백이 앞에 먼저 있다면 그 공백을 뺀 나머지를 스토리지에 넣어준다.
            //     const value = this.newTodoItem.trim();
            //     // // localStorage.setItem(this.newTodoItem, this.newTodoItem);
            //     // localStorage.setItem(value, value); // 직접 값을 주지 않으려고 주석처리함.
            //     // // 값을 넣을 때, setItem 하는 것도 중요하지만, todolist에서 todoitem=[] 해주는 것도 중요함.
            //     this.$emit('childAddTodo', value);
            // } else {
            //     this.$emit('addvalue');
            // }
            // this.newTodoItem = '';
        }
    }
}
</script>
