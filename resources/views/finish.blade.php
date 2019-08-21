@extends('layouts.app')
@section('content')
    <h2> {{$user->email??'user'}} </h2>
    <h2>Поздравляем!!! Вы успешно прошли тест</h2>
    {{--<img class="img-thumbnail" src="{{asset($user->avatar)}}">--}}
    {{--<h5>Ваше количество баллов равно <strong>{{$rating}}</strong></h5>--}}
    @include('layouts.flash')
    <h4>Вы прошли тест за {{$duration}} секунд </h4>
    <a href="/start" class="btn btn-block btn-success">Вернуться в начало теста</a>
@endsection