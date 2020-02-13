<template>
    <div>
        <div class="form-inline">
            <a v-if="create && !modal" v-bind:href="create">Criar nova Tarefa</a>
            <modal-link v-if="create && modal" type="button" name="createTasks" title="Criar nova Tarefa" css=""></modal-link>
        </div>
        <div class="form-group pull-right">
            <input type="search" class="form-control" placeholder="Buscar Tarefas" v-model="findTask">
        </div>

        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th style="cursor: pointer" v-on:click="orderColumn(index)" v-for="(label, index) in labels">{{label}}</th>
                <th v-if="details || edit || deleter">Ações</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(task, index) in listTasks">
                <td v-for="i in task">{{i}}</td>
                <td v-if="details || edit || deleter">
                    <form v-bind:id="index" v-if="deleter && token" v-bind:action="deleter + task.id" method="post">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" v-bind:value="token">

                        <a v-if="details && !modal" v-bind:href="details">Detalhes|</a>
                        <modal-link v-if="details && modal" v-bind:task="task" v-bind:url="details" type="link" name="detailTask" title=" Detalhes |" css=""></modal-link>

                        <a v-if="edit && !modal " v-bind:href="edit"> Editar |</a>
                        <modal-link v-if="edit && modal" v-bind:url="edit" v-bind:task="task" type="link" name="editTasks" title=" Editar |" css=""></modal-link>

                        <a href="#" v-on:click="executeForm(index)"> Excluir</a>
                    </form>

                    <span v-if="!token">
                        <a v-if="details && !modal" v-bind:href="details">Detalhes |</a>
                        <modal-link v-if="details && modal" v-bind:task="task" v-bind:url="details" type="link" name="detailTask" title=" Detalhes |" css=""></modal-link>

                        <a v-if="edit && !modal " v-bind:href="edit"> Editar |</a>
                        <modal-link v-if="edit && modal" v-bind:task="task" v-bind:url="edit" type="link" name="editTasks" title=" Editar |" css=""></modal-link>

                        <a v-if="deleter" v-bind:href="deleter"> Excluir</a>
                    </span>
                    <span v-if="token && !deleter">
                        <a v-if="details && !modal" v-bind:href="details">Detalhes |</a>
                        <modal-link v-if="details && modal" v-bind:task="task" v-bind:url="details" type="link" name="detailTask" title=" Detalhes |" css=""></modal-link>

                        <a v-if="edit && !modal " v-bind:href="edit"> Editar |</a>
                        <modal-link v-if="edit && modal" v-bind:url="edit" v-bind:task="task" type="link" name="editTasks" title=" Editar |" css=""></modal-link>
                    </span>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        props:['labels','tasks', 'order', 'ordercol', 'create', 'details', 'edit', 'deleter', 'token', 'modal'],
        data: function(){
            return {
                findTask: '',
                orderAux: this.order || 'asc',
                ordercolAux: this.ordercol || '0'
            }
        },
        methods:{
            executeForm: function(index){
                //alert(index)
                document.getElementById(index).submit();
            },
            orderColumn: function (column) {
                this.ordercolAux = column;
                if(this.orderAux.toLowerCase() == "asc"){
                    this.orderAux = "desc"
                }
                else{
                    this.orderAux = "asc"
                }
            }
        },
        computed:{
            listTasks:function(){
                let order = this.orderAux;
                let orderCol = this.ordercolAux;
                order = order.toLowerCase();
                orderCol = parseInt(orderCol);

                if(order == "asc"){
                    this.tasks.sort(function (a,b) {
                        if(Object.values(a)[orderCol] < Object.values(b)[orderCol]){ return 1; }
                        if(Object.values(a)[orderCol] > Object.values(b)[orderCol]){ return -1; }
                        return 0;
                    });
                }
                else{
                    this.tasks.sort(function (a,b) {
                        if(Object.values(a)[orderCol] > Object.values(b)[orderCol]){ return 1; }
                        if(Object.values(a)[orderCol] < Object.values(b)[orderCol]){ return -1; }
                        return 0;
                    });
                }

                if(this.findTask){
                    return this.tasks.filter(res => {
                        res = Object.values(res)
                        for(let i = 0; i < res.length; i++){
                            if((res[i] + "").toLowerCase().indexOf(this.findTask.toLowerCase()) >= 0){
                                return true;
                            }
                        }
                        return false;
                    });
                }
                return this.tasks;
            }
        }
    }
</script>
