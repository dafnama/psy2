@extends('app')

@section('page-title')
    <h1>הדרכות</h1>
@stop

@section('content')
<table border="1">
         <thead>
        <tr>
            <td>מחק</td>
            <td>מזהה</td>
            <td>מודרך</td>
            <td>מדריך</td>
            <td>שנה</td>
            <td>שעות</td>
            <td>סוג</td>
        </tr>
         </thead>

@foreach ($trainings as $train)
            <tr>
                <td>
                    <form action="{{route('training.destroy', $train->id)}}" method="post">
                        <input type="hidden" name="_method" value="DELETE"/>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit">
                            <img src="{{{asset('images/icons/delete.png')}}}">
                        </button>
                    </form>

                </td>
                <td>{{$train->id}}</td>
                <td>{{{$train->guided_id}}}</td>
                <td>{{{$train->guide_id}}}</td>
                <td>{{{$train->training_year}}}</td>
                <td>{{{$train->training_hours}}}</td>
                <td>{{{$train->kind}}}</td>
            </tr>
        @endforeach</table>

@stop
