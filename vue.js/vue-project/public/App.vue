<template>
    <div id="app">
      <TodoHeader></TodoHeader>
      <TodoInput @childAddTodo="addTodo" @noInputValue="changeModal"></TodoInput>
      <TodoList :propsItems="todoItems" @childDelTodo="removeTodo"></TodoList>
      <TodoFooter @clearTodo="clearTodo"></TodoFooter>
    </div>
    <AlertModal :show="modalShow" header="알림창" body="내용을 입력해주세요." @close="changeModal"></AlertModal>
</template>

<script>
import TodoHeader from './components/todo/TodoHeader.vue';
import TodoInput from './components/todo/TodoInput.vue';
import TodoList from './components/todo/TodoList.vue';
import TodoFooter from './components/todo/TodoFooter.vue';
import AlertModal from './components/common/AlertModal.vue';

export default {
    name: 'App',
    data() {
      return {
        todoItems: [],
        cnt: 0,
        modalShow: false,
      }
    },
    methods: {
      changeModal() { // 모달창 띄우기
        // 내 풀이 
        if( this.modalShow === true) {
          this.modalShow = false;
        } else {
          this.modalShow = true;
        } 
        
        /* // 선생님 풀이
        showModal() {
          this.modalShow = true
        };
        hiddenModal() {
          this.modalShow = false
        }   
        */     
      },
      changeModal() {
        // 내 풀이 
        if( this.modalShow === true) {
          this.modalShow = false;
        } else {
          this.modalShow = true;
        } 
        
        /* // 선생님 풀이
        showModal() {
          this.modalShow = true
        };
        hiddenModal() {
          this.modalShow = false
        }   
        */     
      },
      addTodo(todoItem) {
        this.todoItems.push({
          key: this.cnt++,
          value: todoItem
        });
      },
      removeTodo(key) {
        this.todoItems.forEach((item,idx) => {
            if(item.key === key) {
              this.todoItems.splice(idx,1);              
            }
        })
      },
      clearTodo() {
        this.todoItems.splice(0);
        this.cnt = 0;
               
      },
      changeValue() {
        const json = JSON.stringify(this.todoItems);
        localStorage.setItem('todoItems', json);
        localStorage.setItem('cnt', this.cnt);
      },
    },
    components: {
      TodoHeader,
      TodoInput,
      TodoList,
      TodoFooter,
      AlertModal
    },
    watch: { 
      todoItems: {
        deep: true, 
        handler() {
          this.changeValue();
        }
      }
    },
    created() { 
      const json = localStorage.getItem("todoItems");
      if(json) {
        const todoItems = JSON.parse(json);
        todoItems.forEach(item => {
          this.todoItems.push(item);
        });
        
        const cnt = localStorage.getItem("cnt");
        this.cnt = cnt;
      }
    }
}
</script>

<style>
body {  text-align: center; background-color: #f6f6f8; }
input { border-style: groove; width: 200px; }
button { border-style: groove; }
.shadow { box-shadow: 5px 10px 10px rgba(0, 0, 0, 0.03); }
</style>