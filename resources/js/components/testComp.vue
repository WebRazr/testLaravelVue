<template>

<div class="width-table center-block ">


<!-- Modal -->
<div class="modal fade" id="exampleModalTwo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">редактирование задачи</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <div class="modal-body">
        <div v-if="showError">
                        <ul v-for="(error, index) in errors"  v-bind:key="`C-${index}`">
                            <li class="list-group-item-danger">{{ error }}</li>
                        </ul>
                        </div>
            <form  v-for="(showed, index) in editShow"  v-bind:key="`A-${index}`">
                      <div class="form-group">
                         <label for="formGroupExampleInput">Название задачи: {{ showed.task_name }}</label>
                         <input type="text" v-model="nameTaskShow" class="form-control"  id="formGroupExampleInput" placeholder="Введите название">
                          </div>
                          <div class="form-group">
                             <label for="formGroupExampleInput2">актуальный текст: {{ showed.task }} </label>
                              <input type="text" v-model="textTaskShow" class="form-control" id="formGroupExampleInput2" placeholder="Введите задачу">
                            </div>
            </form>
        </div>
        <div class="modal-footer" v-for="(showed, index) in editShow"  v-bind:key="`B-${index}`">
            <button type="button" class="btn btn-secondary" v-on:click="errFalse()" data-dismiss="modal">Закрыть</button>

                            <div v-if="awesome">  
                                <button type="button"  class="btn btn-primary" v-on:click="editTask(showed.id)">сохранить изменения</button>
                            </div>
                            <div v-else>  
                                <button type="button" data-dismiss="modal" class="btn btn-primary" v-on:click="editTask(showed.id)">сохранить изменения</button>
                            </div>

            
        </div>
        </div>
    </div>
</div>
<div class="border">
        <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Название задачи</th>
                <th scope="col">задача</th>
                <th scope="col">операция</th>
                </tr>
            </thead>
            <tbody v-for="(todo, index) in todos"  v-bind:key="index">
                <tr>
                <th scope="row">{{ index + 1 }}</th>
                <td>{{ todo.task_name }}</td>
                <td>{{ todo.task }}</td>
                    <td>
                        <button type="button" v-on:click="editShowTask(todo.id)" class="btn btn-success" data-toggle="modal" data-target="#exampleModalTwo">редактировать</button>
                        <button type="button" v-on:click="deletTask(todo.id)" class="btn btn-danger">Удалить</button>
                    </td>
                </tr>
               
            </tbody>
        </table>
</div>
</div>
</template>

<script>
    export default {
        
         props: ['todos'],

        
        data: function(){
            return {
                errors: [],
                 a: [],
                 editShow: [],
                 nameTaskShow: '',
                 textTaskShow: '',
                 awesome: true,
                 showError: false,
                 tod: this.todos

             };
        },
        mounted() {
            console.log(this.tod.title);
        },
        methods: {
            
            deletTask(index){
            if(confirm("вы действительно хотите удалить задачу?")){
                             axios.delete('/VueTasks/public/task/' + index)
                    .then(function (response) {
                        console.log(response);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                   
                    console.log(index.data),
                    this.$emit('upd-arr',{
                        email: 'dff',
                        pass: 'sdff'
                    })
                  }
            },
            editShowTask(id){

              
                axios.get('/VueTasks/public/task/showedit/' + id)
                .then(response => {
                    this.editShow = response.data;
                    console.log(response.data[0]);
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })   
            },
            editTask(id){
                           this.errors = [];
                  if(this.nameTaskShow < 1){
                       this.errors.push('Укажите название');
                  }  
                  if(this.textTaskShow < 1){
                       this.errors.push('напишите текст задачи');
                  }  
                    if(this.errors.length < 1) {
                        this.awesome = false;

                let arrayEdit = { 
                    id: id
                };
                
                console.log(this.tod);
                console.log(arrayEdit)
            
            
                   axios.post('/VueTasks/public/task/editask', {id:id, titleTask:this.nameTaskShow, textTask:this.textTaskShow})
                    .then(function (response) {
                        console.log(response);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                    this.nameTaskShow = '';
                    this.textTaskShow = '';
                    this.$emit('upd-arr',{
                        email: 'dff',
                        pass: 'sdff'
                    })

                        
                    }
                     else{
                this.showError = true
                console.log(this.errors)
            }
    
            },
            errFalse(){
                this.showError = false
            }
        }
       
    }
    
</script>
<style>
 .width-table{
     width: 800px;
     margin: auto;
 }
 .but-bot{
     margin-bottom: 28px;
 }
</style>
