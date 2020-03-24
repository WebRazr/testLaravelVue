<template>
<div class="width-table center-block">
<button type="button" class="btn btn-primary btn-success" data-toggle="modal" data-target="#exampleModal">
  добавить задание
</button>
             <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Создание новой задачи</h5>
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
                        <form >
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Название задачи</label>
                                            <input type="text" v-model="titleTask" class="form-control"  id="formGroupExampleInput" placeholder="Введите название">
                                        </div>
                                        <div class="form-group">
                                            <label for="formGroupExampleInput2">задача</label>
                                            <input type="text" v-model="textTask" class="form-control" id="formGroupExampleInput2" placeholder="Введите задачу">
                                        </div>
                      </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" v-on:click="errFalse()" data-dismiss="modal">Закрыть</button>
                              <div v-if="awesome">  
                                <button type="button" v-on:click="subData" class="btn btn-primary">сохранить</button>
                            </div>
                            <div v-else>  
                                <button type="button" v-on:click="subData" data-dismiss="modal" class="btn btn-primary">сохранить</button>
                            </div>
                        </div>
                        </div>
  </div>
</div>
      
</div>
  


</template>

<script>

    export default {
        data: function(){
            return {
            errors: [],
            visible: false,
            titleTask: '',
            textTask: '',
            awesome: true,
            showError: false
            }
        },
        methods: {
            errFalse(){
                this.showError = false
            },
            subData(){

                  this.errors = [];
                  if(this.titleTask < 1){
                       this.errors.push('Укажите название');
                  }  
                  if(this.textTask < 1){
                       this.errors.push('напишите текст задачи');
                  }  
                    if(this.errors.length < 1) {
                        this.awesome = false;

                        axios.post('/VueTasks/public/task', {titleTask:this.titleTask, textTask:this.textTask})
                    .then(function (response) {
                        console.log(response);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                    this.titleTask = '',
                    this.textTask = '',
                    this.$emit('upd-arr',{
                        email: 'dff',
                        pass: 'sdff'
                    }
                    )
            }
            else{
                this.showError = true
                console.log(this.errors)
            }
            }
        },
        mounted() {
            console.log('Component mounted.')
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





