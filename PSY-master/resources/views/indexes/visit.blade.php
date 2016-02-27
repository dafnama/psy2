@extends('app')

@section('page-title')
    <h1>ביקורים</h1>
@stop

@section('content')

    <table border="1">
         <thead>
        <tr>
            <td>ערוך</td>
            <td>מחק</td>
            <td>מזהה</td>
            <td>מוסד</td>
            <td>תאריך</td>
            <td>פעילות</td>
            <td>משך הביקור</td>
            <td>תיאור מפגש</td>
        </tr>
        </thead>

        @foreach ($visits as $vis)
            <tr>
                <td>
                    <a href="{{{route('visit.edit', $vis->id)}}}">
                        <img src="{{{asset('images/icons/edit.png')}}}">
                    </a>
                </td>
                <td>
                    <form action="{{route('visit.destroy', $vis->id)}}" method="post">
                        <input type="hidden" name="_method" value="DELETE"/>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit">
                            <img src="{{{asset('images/icons/delete.png')}}}">
                        </button>
                    </form>

                </td>
                <td>{{$vis->id}}</td>
                <td>{{{$vis->intitute_name_const}}}</td>
                <td>{{{$vis->date}}}</td>
                <td>{{{$vis->activity}}}</td>
                <td>{{{$vis->length}}}</td>
                <td>{{{$vis->comment}}}</td>
            </tr>
        @endforeach
    </table>




@stop
