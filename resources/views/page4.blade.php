@extends('layouts.app')
@section('content')
    {{--<h2>У вас {{$rating}} балл(ов)</h2>--}}
    @include('layouts.flash')
    <h2> Выберите языки программирования,которые вы изучили </h2>
    <form action="{{route('page4')}}" method="post">
        @csrf
        <div class="form-check">
            @foreach($languages as $language)
                <label for="{{$language}}">{{$language}}</label>
                <input type="checkbox" name="language[]" value="{{$language}}">
            @endforeach

        </div>
        <input type="submit" class="btn btn-block btn-success" value="Next">
    </form>
@endsection