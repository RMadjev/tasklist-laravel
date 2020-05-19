@extends('app')


@section('content')
    <all-lists v-bind:lists="{{$lists}}"></all-lists>
    <div class="new-task-list">
        <div>
            <form method="POST" action="/list">
                @csrf
                <div class="field">
                    <label class="label">Add new todo list:</label>
                    <div class="control">
                        <input class="input" name="name" type="text" placeholder="List name">
                    </div>
                </div>
                <div class="field is-grouped">
                    <div class="control">
                        <button class="button is-link">Add</button>
                    </div>
                </div>
            </form>
        </div>
        @if ($errors->any())
            <div class="alert-danger">
                <article class="message is-danger">
                    <div class="message-body">
                        @foreach ($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                </article>
            </div>
        @endif
    </div>
@endsection

