@extends('layouts.app')
@section('content')
    <h2>У вас {{$rating}} балл(ов)</h2>
    @include('layouts.flash')
    <h2>Чтобы получить балл - решите пример </h2>
    <h4>{{$number1}}+{{$number2}}</h4>
    <form action="{{route('page4')}}" method="post">
        @csrf
        <div class="form-group align-content-center">
            <input type="hidden" name="number1" value="{{$number1}}">
            <input type="hidden" name="number2" value="{{$number2}}">
            <input type="number" name="summ" value="">
        </div>
        <input type="submit" class="btn btn-block btn-success" value="Next">
    </form>
@endsection