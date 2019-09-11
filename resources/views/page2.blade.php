@extends('layouts.app')
@section('content')
    @include('layouts.flash')
    <form action="{{route('page2')}}" method="post">
        @csrf

        <h2>Чтобы получить первый балл - внимательно прочитайте текст </h2>
        <p>Lorem Ipsum - это текст-"рыба", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной
            "рыбой" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую
            коллекцию
            размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов. Lorem Ipsum не только успешно
            пережил
            без заметных изменений пять веков, но и перешагнул в электронный дизайн. </p>
        <button type="submit" class="btn btn-block btn-success">Next</button>
    </form>
@endsection