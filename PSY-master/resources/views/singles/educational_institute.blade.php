@extends('app')

@section('page-title')
    <h1>עמוד מוסד</h1>
@stop

@section('content')

    <div class="row">
        <label>מזהה מוסד:</label>
        <span class="label-data">{{$institute->id}}</span>
    </div>


    <div class="row">
    <label>שפ"ח:</label>
        <span class="label-data">{{$institute->shapah->shapah_name}}</span>

</div>
    <div class="row">
    <label>שם מוסד:</label>
        <span class="label-data">{{$institute->name}}</span>
</div>
    <div class="row">
    <label>עיר:</label>
        <span class="label-data">{{$institute->city}}</span>
</div>
    <div class="row">    <label>כתובת:</label>
        <span class="label-data">{{$institute->address}}</span>
</div>
    <div class="row">
         <div class="row">    <label>טלפון:</label>
        <span class="label-data">{{$institute->phone}}</span>
</div>
            <div class="row">
         <div class="row">    <label>דואר אלקטרוני:</label>
        <span class="label-data">{{$institute->email}}</span>
</div>
                    <div class="row">
         <div class="row">    <label>סוג המוסד:</label>
        <span class="label-data">{{$institute->type}}</span>
</div>

                          <div class="row">
         <div class="row">    <label>שם פרטי - מנהל:</label>
        <span class="label-data">{{$institute->principal_first_name}}</span>
</div>

                                                        <div class="row">
         <div class="row">    <label>שם משפחה - מנהל:</label>
        <span class="label-data">{{$institute->principal_last_name}}</span>
</div>

                                                             <div class="row">
         <div class="row">    <label>מספר כיתות כולל:</label>
        <span class="label-data">{{$institute->number_of_classes}}</span>
</div>

                                                                                                                              <div class="row">
         <div class="row">    <label>מספר כיתות מיוחדות:</label>
        <span class="label-data">{{$institute->number_of_special_classes}}</span>
</div>

                                                                                                                                                            <div class="row">
         <div class="row">    <label>מספר תלמידים כיתות א:</label>
        <span class="label-data">{{$institute->number_of_alef_students}}</span>
</div>

                                                                   <div class="row">
         <div class="row">    <label>מספר תלמידים כיתות ב - יב:</label>
        <span class="label-data">{{$institute->number_of_non_alef_students}}</span>
</div>

                                                                                                                                          <div class="row">
         <div class="row">    <label>מספר תלמידים חינוך מיוחד:</label>
        <span class="label-data">{{$institute->number_of_special_students}}</span>
</div>
                                                                                                                                  <div class="row">
         <div class="row">    <label>גן ילדים- סוג:</label>
        <span class="label-data">{{$institute->kindergaten_type}}</span>
</div>

                                                                                                                                                                               <div class="row">
         <div class="row">    <label>מספר הילדים בגן:</label>
        <span class="label-data">{{$institute->number_of_kindergarten_children}}</span>
</div>





  <div>
        <table border="1">
            @foreach($institute->visits as $visit)
                <tr>
                    <td>{{$visit->id}}</td>
                    <td>{{$visit->date}}</td>
                    <td>{{$visit->activity}}</td>
                    <td>{{$visit->comment1}}</td>
                    <td>{{$visit->length}}</td>
                    <td>{{$visit->comment}}</td>
                </tr>
            @endforeach
        </table>
    </div>

@stop
