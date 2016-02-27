@extends('app')

@section('page-title')
    <h1>המוסדות במסגרת שלי</h1>
@stop

@section('content')
    <table border="1">
        <thead>
        <tr>
            <td >ערוך</td>
            <td>מזהה</td>
            <td>שם המוסד</td>
            <td>שפ"ח</td>
            <td>עיר</td>
            <td>מספר כיתות</td>
            <td>מספר כיתות מיוחדות</td>
            <td>מספר תלמידים בחינוך מיוחד</td>
            <td> מספר תלמידים בכיתות א</td>
            <td>מספר תלמידים בכיתות ב-יב</td>
            <td>סוג גן</td>
            <td>ילדי גן</td>
        </tr>
        </thead>
        @foreach ($institutes as $ei)
            @if ($ei->name <> "דיווח כללי")
                <tr>
                    <td>
                        <a href="{{{route('institute.edit', $ei->id)}}}">
                            <img src="{{{asset('images/icons/edit.png')}}}">
                        </a>
                    </td>

                    <td>{{{$ei->id}}}</td>
                    <td>{{{$ei->name}}}</td>
                    <td>{{{$ei->shapah_name}}}</td>
                    <td>{{{$ei->city}}}</td>
                    <td>{{{$ei->number_of_classes}}}</td>
                    <td>{{{$ei->number_of_special_classes}}}</td>
                    <td>{{{$ei->number_of_special_students}}}</td>
                    <td>{{{$ei->number_of_alef_students}}}</td>
                    <td>{{{$ei->number_of_non_alef_students}}}</td>
                    <td>{{{$ei->kindergaten_type}}}</td>
                    <td>{{{$ei->number_of_kindergarten_children}}}</td>

                </tr>
            @endif
        @endforeach
    </table>

{!! $institutes->render() !!}
@stop
