@extends('layouts.app')
@section('content')
    <h2>У вас {{$rating}} балл(ов)</h2>
    @include('layouts.flash')
    <h2>Чтобы получить еще 1 балл - угадайте какой сегодня день недели </h2>
    <form action="{{route('finish')}}" class="form-group" method="post">
        @csrf

            <div class="radio">
                <label><input type="radio" name="day" value="{{$currentDay[0]}}">{{$currentDay[0]}}</label>
            </div>
            <div class="radio">
                <label><input type="radio" name="day" value="{{$currentDay[1]}}">{{$currentDay[1]}}</label>
            </div>
            <div class="radio ">
                <label><input type="radio" name="day" value="{{$currentDay[2]}}">{{$currentDay[2]}}</label>
            </div>
            <div class="radio ">
                <label><input type="radio" name="day" value="{{$currentDay[3]}}">{{$currentDay[3]}}</label>
            </div>

        <input type="submit" class="btn btn-block btn-success" value="Next">
    </form>


@endsection