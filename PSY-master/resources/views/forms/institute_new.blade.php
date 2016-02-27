@extends('app')

@section('page-title')
    <h1>טופס מוסד חינוכי</h1>
@stop

@section('content')
    <!--form-->

    <form class="psy-form" action="{{{route('institute.update', $institute->id)}}}" method="post">
        @if(isset($is_new) && !$is_new)
            <input type="hidden" name="_method" value="PUT">
        @endif
        <input type="hidden" name="_token" value="{{ csrf_token() }}">


        <div class="input-line clearfix">
            <select name="shapah_id" class="pull-right mult" required>
                <option disabled="disabled" selected="selected" value="">בחר שירות</option>
                @foreach ($shapahs as $shapah)
                    <option value="{{{$shapah->id}}}" {{$institute->shapah_id == $shapah->id ? 'selected' : ''}}>{{{$shapah->shapah_name}}}</option>
                @endforeach
            </select>
            <span class="error"></span>
        </div>


        <div class="input-line clearfix">
            <select name="type" class="pull-right mult"
                    value="{{{$institute->type}}}" required >
                <option disabled="disabled" selected="selected"  value="">בחר סוג המוסד</option>
                <option>גן ילדים</option>
                <option>בית ספר יסודי</option>
                <option>חטיבת ביניים</option>
                <option>בית ספר תיכון</option>
                <option>בית ספר תיכון + חטיבת ביניים</option>
                <option>בית ספר יסודי + חטיבת ביניים</option>
            </select>
        </div>


        <div class="input-line">
            <label>שם המוסד</label>
            <input type="text" name="name" size="12" maxlength="12" required
                   value="{{{$institute->name}}}">
        </div>

        <div class="input-line">
            <label>עיר המוסד</label>
            <input type="text" name="city" size="12" maxlength="12" required
                   value="{{{$institute->city}}}">
        </div>

        <div class="input-line">
            <label>כתובת</label>
            <input type="text" name="address" size="35" maxlength="35" required
                   value="{{{$institute->address}}}">
        </div>

        <div class="input-line">
            <label>טלפון</label>
            <input type="text" name="phone" size="12" maxlength="12"
                   value="{{{$institute->phone}}}">
        </div>

        <div class="input-line">
            <label>דואר אלקטרוני</label>
            <input type="email" name="email" size="22" maxlength="22"
                   value="{{{$institute->email}}}">
        </div>

        <div class="input-line">
            <label>מנהל המוסד- שם פרטי</label>
            <input type="text" name="principal_first_name" size="7" maxlength="7"
                   value="{{{$institute->principal_first_name}}}">
        </div>

        <div class="input-line">
            <label>מנהל המוסד- שם משפחה</label>
            <input type="text" name="principal_last_name" size="11" maxlength="11"
                   value="{{{$institute->principal_last_name}}}">
        </div>

        <div class="input-line">
            <label>מספר כיתות</label>
            <input type="number" class="small" name="number_of_classes" size="2" maxlength="2" max="99" min="0"
                   value="{{{$institute->number_of_classes}}}">
        </div>

        <div class="input-line">
            <label>מספר כיתות מיוחדות</label>
            <input type="number" class="small" name="number_of_special_classes" size="2" maxlength="2" max="50" min="0"
                   value="{{{$institute->number_of_special_classes}}}">
        </div>

        <div class="input-line">
            <label>תלמידים בחינוך מיוחד</label>
            <input type="number" class="small" name="number_of_special_students" size="3" maxlength="3" max="2000"
                   min="0" value="{{{$institute->number_of_special_classes}}}">
        </div>

        <div class="input-line">
            <label>תלמידים בכיתות א</label>
            <input type="number" class="small" name="number_of_alef_students" size="3" maxlength="3" max="2000" min="0"
                   value="{{{$institute->number_of_alef_students}}}">
        </div>

        <div class="input-line">
            <label>תלמידים בכיתות ב-יב</label>
            <input type="number" class="small" name="number_of_non_alef_students" size="3" maxlength="3" max="2000"
                   min="0" value="{{{$institute->number_of_non_alef_students}}}">
        </div>

        <div class="input-line">
            <label>ילדי גן</label>
            <input type="number" class="small" name="number_of_kindergarten_children" size="3" maxlength="3" max="200"
                   min="0" value="{{{$institute->number_of_kindergarten_children}}}">
        </div>

        <div class="input-line clearfix">
            <select name="kindergaten_type" class="pull-right mult"
                    value="{{{$institute->kindergaten_type}}}">
                <option disabled="disabled" selected="selected">בחר סוג גן</option>
                <option>טרום טרום חובה</option>
                <option>טרום חובה</option>
                <option>חובה</option>
                <option>רב גילי</option>
                <option>חנוך מיוחד</option>
            </select>
        </div>


        <div class="input-line clearfix">
            <button type="submit" class="pull-left approve">שלח</button>
        </div>


    </form>

@stop
