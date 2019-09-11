@extends('layouts.app')
@section('content')
    <h2> {{$user['email']??'user'}} </h2>
    <h2>Поздравляем!!! Вы успешно прошли тест</h2>
    <img class="img-thumbnail" src="{{asset($user['id']->avatar)}}">
    <h5>Ваше количество баллов равно <strong>{{$user['rating']}}</strong></h5>
    <h4>Вы прошли тест за {{$user['duration']}} секунд </h4>
    <form action="{{route('finish')}}" method="post">
        @csrf
        <input type="hidden" name="rating" value="{{$user['rating']}}">
        <input type="hidden" name="duration" value="{{$user['duration']}}">
        <input type="hidden" name="user_id" value="{{$user['id']->id}}">
        <button type="submit" class="btn btn-block btn-success">Вернуться в начало теста</button>
    </form>
@endsection