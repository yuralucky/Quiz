@extends('layouts.app')
@section('content')
    @include('layouts.flash')
    <h2>Чтобы получить еще 1 балл - угадайте какой сегодня день недели </h2>
    <form action="{{route('page5')}}" class="form-group" method="post">
        @csrf
        @foreach($data as $datum)
            <div class="radio">
                <label><input type="radio" name="day" value="{{$datum}}">{{$datum}}</label>
            </div>
        @endforeach

        <input type="submit" class="btn btn-block btn-success" value="Next">
    </form>

@endsection