<template>
    <div class="inputBox shadow">
        <input type="text" v-model="newTodoItem" @keyup.enter="addTodo" placeholder="Type what you have to do" autofocus>
        <span class="addContainer" @click="addTodo">
            <i class="addBtn fas fa-plus" aria-hidden="true"></i>
        </span>
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
        }
    }
}
</script>
