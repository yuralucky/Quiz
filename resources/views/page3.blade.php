@extends('layouts.app')
@section('content')
    {{--<h2>У вас {{$rating}} балл(ов)</h2>--}}
    {{--{{$duration}}--}}
    @include('layouts.flash')
    <h2>Чтобы получить балл - решите пример </h2>
    <h4>{{$randNumber[0]}}+{{$randNumber[1]}}</h4>
    <form action="{{route('page3')}}" method="post">
        @csrf
        <div class="form-group align-content-center">
            <input type="hidden" name="number1" value="{{$randNumber[0]}}">
            <input type="hidden" name="number2" value="{{$randNumber[1]}}">
            <input type="number" name="sum" value="">
        </div>
        <input type="submit" class="btn btn-block btn-success" value="Next">
    </form>
@endsection