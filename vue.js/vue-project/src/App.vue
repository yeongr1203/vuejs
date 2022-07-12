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
import axios from 'axios';
import DateUtils from './utils/DateUtils';  // str폴더 

export default {
    name: 'App',
    data() {
      return {
        todoItems: [],
        // cnt: 0,
        modalShow: false,
      }
    },
    methods: {
      // 내 풀이 
      changeModal() { // 모달창 띄우기
        if( this.modalShow === true) {
          this.modalShow = false;
        } else {
          this.modalShow = true;
        }
      // 선생님 풀이
      // changeModal() { this.modalShow = true; },
      // changeModal() { this.modalShow = false; }
        
      },
      addTodo(todoItem) {
        const param = {
          'todo' : todoItem
        };
        axios.post('/todo/index', param)
        .then(res => {
          if(res.status === 200 && res.data ) { 
            // res.status === 200 통신이 원활(성공)
            // res.status === 404 통신 불가(실패)

            const item = {    // 들어올 값 = pk값
              'itodo' : res.data.result,
              'todo' : todoItem,
              'created_at' : DateUtils.getTimestamp(new Date())
            }
            this.todoItems.push(item);
          }
        })
        /*
        this.todoItems.push({
          key: this.cnt++,
          value: todoItem
        });
        */
      },
      removeTodo(key) {
        this.todoItems.forEach((item,idx) => {
            if(item.itodo === key) {
              this.todoItems.splice(idx,1); //해당 인덱스 1개만 삭제
              axios.delete(`/todo/index/${item.itodo}`)  
              .then(res => {
                console.log(res);
              });      
            }
        });
      },
      clearTodo() {
        axios.delete(`/todo/index`)
        .then(res => {
          if(res.status === 200 && res.data.result ) {
            this.todoItems.splice(0);
          }
        })
        // this.cnt = 0;
               
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
    /*
    watch: { 
      todoItems: {
        deep: true, 
        handler() {
          this.changeValue();
        }
      }
    },
    */
    created() { 
      // axios => .then이 하나인 이유? 보내는 값만 있어서 하나만 작성.
      axios.get('/todo/index')
      .then(res => {                  
        if(res.status === 200 && res.data.length > 0 ) {
          res.data.forEach(item => {  
            this.todoItems.push(item);
          });
        }
        console.log(res);  // 확인용
      });
      /*
      const json = localStorage.getItem("todoItems");
      if(json) {
        const todoItems = JSON.parse(json);
        todoItems.forEach(item => {
          this.todoItems.push(item);
        });        
        const cnt = localStorage.getItem("cnt");
        this.cnt = cnt;        
      }
      */
    }
}
</script>

<style>
body {  text-align: center; background-color: #f6f6f8; }
input { border-style: groove; width: 200px; }
button { border-style: groove; }

.ctnt { font-size: 1rem; }
.d-flex { display: flex; }

.flex-col {flex-direction: column;}
.flex-row {flex-direction: row;}
.grow_1 { flex-grow: 1; }
.shadow { box-shadow: 5px 10px 10px rgba(0, 0, 0, 0.03); }
.justify_content_evenly { justify-content: space-evenly;}
</style>