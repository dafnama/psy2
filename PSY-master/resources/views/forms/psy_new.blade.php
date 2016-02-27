@extends('app')

@section('page-title')
    <h1>טופס פסיכולוג</h1>
@stop

@section('content')
    <!--form-->
    @foreach($errors->all() as $msg)
        {{$msg}}
    @endforeach

    <form class="psy-form" action="{{{route($form_url, $psychologist->id)}}}" method="post">

        @if(!$is_new)
            <input type="hidden" name="_method" value="PUT">
        @endif
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="input-line" required>
            <label>מספר רשיון פסיכולוג</label>
            <input type="text" name="license_number" size="12" maxlength="12" required
                   value="{{{$psychologist->license_number}}}">
            <span class="error"></span>
        </div>

        <label>בחר שפ"ח</label>

        <div class="input-line clearfix">
            <select name="shapah_id" class="pull-right mult" required>
                <option disabled="disabled" selected="selected" value="">בחר שירות</option>
                @foreach ($shapahs as $shapah)
                    <option value="{{{$shapah->id}}}">{{{$shapah->shapah_name}}}</option>

                @endforeach
            </select>

            <span class="error">

                            @if(isset($is_new) && !$is_new)
  <input tabindex="1" type="checkbox"  name="add_shapah" id="{{$add_shapah}}">
           ריבוי שפ"ח לפסיכולוג
  @endif
</div>


        <div class="input-line clearfix">
            <label>מועד תחילת עבודה</label>
            <input type="text" id="datepicker" class="datepicker" name="start_working_date" size="10" value="{{{$psychologist->start_working_date}}}">
            <span class="error"></span>
        </div>
        <div class="input-line" required>
            <label>שם פרטי</label>
            <input type="text" name="first_name" size="10" maxlength="8" value="{{{$psychologist->first_name}}}"
                   required>
            <span class="error"></span>
        </div>
        <div class="input-line" required>
            <label>שם משפחה</label>
            <input type="text" name="last_name" size="12" maxlength="12" required value="{{{$psychologist->last_name}}}">
            <span class="error"></span>
        </div>

        <div class="input-line" required>
            <label>עיר מגורים</label>
            <input type="text" name="city_of_residence" size="10" maxlength="8" required value="{{$psychologist->city_of_residence}}">
            <span class="error"></span>
        </div>

        <div class="input-line">
            <label for="availability">היקף משרה- שעות בשבוע</label>
            <input type="number"
                   id="availability"
                   class="small"
                   name="availability"
                   size="2"
                   maxlength="2"
                   max="50"
                   min="1"
                   value="{{{$psychologist->availability}}}"
                    >
            <span class="error"></span>
        </div>

        <div class="input-line">
            <label>טלפון</label>
            <input type="tel" name="phone_number" size="10" maxlength="10" required
                   value="{{{$psychologist->phone_number}}}">
            <span class="error"></span>
        </div>

        <div class="input-line" required>
            <label>דוא"ל</label>
            <input type="email" name="email" size="22" maxlength="22" required
                   value="{{{$psychologist->email}}}">
            <span class="error"></span>
        </div>
        <div class="input-line" required>
            <label>סיסמה</label>
            <input type="text" name="password" size="14" maxlength="14" required
                    >
            <span class="error"></span>
        </div>

        <div class="dynamic-list clearfix" data-label="ססטוס מקצועי">
            <label>סטטוס מקצועי</label>

            <div class="input-line">
                <select name="professional_status_id" class="pull-right mult" required>
                    <option disabled="disabled" selected="selected" value="">בחר סטטוס</option>
                    @foreach ($professional_statuses as $professional_status)
                        <option value="{{{$professional_status->id}}}"

 {{$psychologist->professional_status_id == $professional_status->id ? 'selected' : ''}}>

                            {{{$professional_status->professional_status_description}}}
                        </option>
                    @endforeach

                </select>
                <span class="error"></span>
            </div>
        </div>
        <div class="dynamic-list" data-label="תפקיד">
            <label>תפקיד בשפ"ח</label>

            <div class="input-line clearfix">
                <select name="psychologist_role_id" class="pull-right mult" required>
                    <option disabled="disabled" selected="selected" value="">בחר תפקיד</option>
                    @foreach ($roles as $role)
                        <option value="{{{$role->id}}}" {{$psychologist->psychologist_role_id == $role->id ? 'selected' : ''}}>{{{$role->psychologist_roles_description}}}</option>

                    @endforeach
                </select>
                <span class="error"></span>
            </div>
        </div>
        <div class="input-line clearfix">
            <button type="submit" class="pull-left approve">שלח</button>
        </div>
    </form>
    <!-- /form -->

@stop
