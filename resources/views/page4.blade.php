@extends('layouts.app')
@section('content')
    <h2>У вас {{$rating}} балл(ов)</h2>
    @include('layouts.flash')
    <h2>Чтобы получить еще 1 балл - выберите языки программирования,которые вы изучили </h2>
    <form action="{{route('page5')}}" method="post" >
        @csrf
        <div class="form-check">
            <label for="php">Php</label>
            <input type="checkbox" name="language[]" value="PHP">
            <label for="php">Python</label>
            <input type="checkbox" name="language[]" value="Python">
            <label for="php">Javascript</label>
            <input type="checkbox" name="language[]" value="Javascript">
            <label for="php">.NET</label>
            <input type="checkbox" name="language[]" value=".net">
            <label for="php">Visual Basic</label>
            <input type="checkbox" name="language[]" value="Visual Basic">
        </div>
        <input type="submit" class="btn btn-block btn-success" value="Next">
    </form>
@endsection