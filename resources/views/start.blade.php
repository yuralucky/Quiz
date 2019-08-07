@extends('layouts.app')
@section('content')
    <h2>Старт</h2>
    @include('layouts.errors')
    <form action="{{route('store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="Email">Укажите свой email</label>
            <input class="form-control" type="email" name="email" value="" placeholder="Enter email">
        </div>
        <div class="form-group">
            <label for="Avatar">Выберите свой аватар</label>

            <input type="file" class="form-control" name="avatar" value="">
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-block btn-success" value="Next">
        </div>

    </form>
@endsection
@section('table')
    <table class="table-bordered table table-striped">
        <tr>
            <th>Email</th>
            <th>Количество баллов</th>
            <th>Время прохождения теста,секунд</th>
        </tr>
        @if(isset($results))
            @foreach($results as $result)
                <tr>
                    <th>{{$result->user->email }}  </th>
                    <th>{{$result->rating}}</th>
                    <th>{{$result->time}}</th>
                </tr>
            @endforeach
        @else
            <h3>No last results</h3>
        @endif
    </table>

@endsection