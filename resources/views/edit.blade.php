@extends('app')


@section('content')

    <task-management v-bind:tasks="{{$list->tasks}}" :id={{$list->id}}></task-management>
    <edit-list v-bind:list="{{$list}}"></edit-list>
@endsection

