@extends('layouts.app')

@section('content')
    <page size="12">
        @if($errors->all())
            <div class="alert alert-danger alert-dismissible text-center" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                @foreach ($errors->all() as $key => $value)
                    <li><strong>{{$value}}</strong></li>
                @endforeach
            </div>
        @endif

        <panel titulo="Lista das Tarefas" color="panel-success">
            <breadcrumbs v-bind:linklist="{{$breadcrumbsList}}"> </breadcrumbs>
            <table-list
                    v-bind:labels="['#', 'Tarefa', 'Descrição', 'Prioridade', 'Criado por', 'Data Estimada Conclusão', 'Status']"
                    v-bind:tasks="{{$listTasks}}"
                    create="#create" details="/tasks/task-view/" edit="/tasks/task-view/" deleter="/tasks/task-delete/" token="{{csrf_token()}}"
                    order="asc" ordercol = "1" modal="yes"
            ></table-list>
        </panel>
    </page>
    <modal name="createTasks" title="Adicionar">
        <formulary id="formAdicionar" css="" action="{{route('tasks.store')}}" method="post" enctype="" token="{{csrf_token()}}">
            <div class="form-group">
                <label for="title">Título</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Título da Tarefa" value="{{old('title')}}">
            </div>
            <div class="form-group">
                <label for="description">Descrição</label>
                <textarea class="form-control" id="description" name="description" rows="5" placeholder="O que fazer?">{{old('description')}}</textarea>
            </div>
            <div class="form-group">
                <label for="priority">Prioridade da Tarefa </label>
                <div>
                    <label class="radio-inline">
                        <input type="radio" name="priority" value="Alta"> Alta
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="priority" value="Media"> Média
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="priority" value="Baixa"> Baixa
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label for="date">Data Estimada Conclusão</label>
                <input type="datetime-local" class="form-control" id="date" name="date" value="{{old('date')}}">
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" name="status" id="status">
                    <option value="Não Iniciada">Não Iniciada</option>
                    <option value="Em Andamento">Em Andamento</option>
                    <option value="Aguardando Terceiros">Aguardando Terceiros</option>
                    <option value="Finalizada">Finalizada</option>
                </select>
            </div>
        </formulary>
        <span slot="buttons">
            <button form="formAdicionar" class="btn btn-info"> Adicionar Tarefa</button>
        </span>
    </modal>

    <modal name="editTasks" title="Editar">
        <formulary id="formEditar" css="" v-bind:action="'/tasks/task-edit/' + $store.state.task.id" method="put" enctype="" token="{{csrf_token()}}">
            <div class="form-group">
                <label for="title">Título</label>
                <input type="text" class="form-control" v-model="$store.state.task.title" id="title" name="title">
            </div>
            <div class="form-group">
                <label for="description">Descrição</label>
                <textarea class="form-control" v-model="$store.state.task.description" id="description" name="description" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="priority">Prioridade da Tarefa </label>
                <div>
                    <label class="radio-inline">
                        <input type="radio" name="priority" value="Alta"> Alta
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="priority" value="Media"> Média
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="priority" value="Baixa"> Baixa
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label for="date">Data Estimada Conclusão</label>
                <input type="datetime-local" class="form-control" id="date" name="date" v-model="$store.state.task.date">
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" name="status" id="status" v-model="$store.state.task.status">
                    <option value="Não Iniciada">Não Iniciada</option>
                    <option value="Em Andamento">Em Andamento</option>
                    <option value="Aguardando Terceiros">Aguardando Terceiros</option>
                    <option value="Finalizada">Finalizada</option>
                </select>
            </div>
        </formulary>
        <span slot="buttons">
            <button form="formEditar" class="btn btn-info"> Editar Tarefa</button>
        </span>
    </modal>
    <modal name="detailTask" v-bind:title="$store.state.task.title">
        <p>Autor: <b>@{{ $store.state.task.author }}</b></p>
        <p>Criado em: <b>@{{ $store.state.task.created_at }}</b></p>
        <p>Ultima Alteração em: <b>@{{ $store.state.task.updated_at }}</b></p>
        <p>Descrição: @{{ $store.state.task.description }}</p>
        <p>Prioridade: <b>@{{ $store.state.task.priority }}</b></p>
        <p>Prev. Término: <b>@{{ $store.state.task.date }}</b></p>
        <p>Status: <b>@{{ $store.state.task.status }}</b></p>
    </modal>
@endsection
