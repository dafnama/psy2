@extends('app')

@section('page-title')
    <h1>עמוד שפ"ח</h1>
@stop

@section('content')

    <div class="row">
        <label>שם השפ"ח:</label>
        <span class="label-data">{{$shapah->shapah_name}}</span>
    </div>

    <div class="row">
        <label>מנהל השפ"ח:</label>
        <span class="label-data">{{$shapah->manager_first_name}} {{$shapah->manager_last_name}}</span>
    </div>



<div class="row">
        <label>כתובת:</label>
        <span class="label-data">{{$shapah->address}}</span>
    </div>

<!--
<div class="row">
        <label>מפה:</label>
        <span class="label-data">< a href="">   </a></span>
    </div>
-->


<div class="row">
        <label>טלפון:</label>
        <span class="label-data">{{$shapah->phone}}</span>
    </div>

<div class="row">
        <label>פקס:</label>
        <span class="label-data">{{$shapah->fax}}</span>
    </div>

    <div>
        <h2>הפסיכולוגים בשפ"ח</h2>
        <table border="1">
               <tr>
            <td>מזהה</td>
            <td>מספר רשיון</td>
            <td>שם פרטי</td>
            <td>שם משפחה</td>
            <td>עיר מגורים</td>
            <td>דואר אלקטרוני</td>
        </tr>
            @foreach($shapah->psychologists as $psychologist)
                <tr>
                     <td><a href="{{route('psychologist.show', $psychologist->id)}}">
                         {{$psychologist->id}}</td>
                    <td>{{$psychologist->license_number}}</td>
                    <td>{{$psychologist->first_name}}</td>
                    <td>{{$psychologist->last_name}}</td>
                    <td>{{$psychologist->city_of_residence}}</td>
                    <td>{{$psychologist->email}}</td>
            @endforeach
        </table>
    </div>

@stop
