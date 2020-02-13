@extends('layouts.app')

@section('content')
    <page size="12">
        <panel titulo="Semáforo das Tarefas" color="panel-success">
            <breadcrumbs v-bind:linklist="{{$breadcrumbsList}}"> </breadcrumbs>

            Clique abaixo, em cada card, para visualizar as tarefas de acordo com seu grau de prioridade:

            <div class="row">
                <div class="col-md-4">
                    <box tasks="{{$totalUrgentTasks}}" title="Tarefas com Prioridade Máxima" url="{{route('tasks.urgent.list')}}" icon="ion ion-nuclear" color="red" ></box>
                </div>

                <div class="col-md-4">
                    <box tasks="{{$totalMediumTasks}}" title="Tarefas com Prioridade Média" url="{{route('tasks.medium.list')}}" icon="ion ion-alert-circled" color="#f5c242" ></box>
                </div>

                <div class="col-md-4">
                    <box tasks="{{$totalLowTasks}}" title="Tarefas com Prioridade Baixa" url="{{route('tasks.low.list')}}" icon="ion ion-checkmark-round" color="green" ></box>
                </div>
            </div>
        </panel>
    </page>
@endsection
