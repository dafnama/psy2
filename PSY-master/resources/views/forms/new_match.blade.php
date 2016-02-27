@extends('app')

@section('page-title')
       <h1>הזנת שיבוץ לשנת עבודה - פסיכולוג במוסד חינוכי</h1>
@stop

@section('content')

    <form class="psy-form" action="{{{route('match.update',$match->id)}}}" method="post">

        @if(isset($is_new) && !$is_new)
            <input type="hidden" name="_method" value="PUT">
        @endif
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <label>בחר פסיכולוג</label>
                    <div class="input-line clearfix">
                        <select name="psychologist_id" class="pull-right mult" required>
                            <option disabled="disabled" selected="selected" value="">בחר מרשימה</option>
                            @foreach ($psychologists as $psychologist)
                                <option value="{{{$psychologist->id}}}">{{{$psychologist->first_name.(' ').$psychologist->last_name}}}</option>
                            @endforeach
                        </select>
                         <span class="error"></span>
                    </div>

           <label>שנת שיבוץ</label>
                    <div class="input-line clearfix" >
                        <select name="match_year" class="pull-right mult"  required>
                            <option disabled="disabled" selected="selected"  value="">בחר שנה</option>
                            <option>התשע"ה</option>
                            <option>התשע"ו</option>
                            <option>התשע"ז</option>
                            <option>התשע"ח</option>
                            <option>התשע"ט</option>
                            <option>התש"ף</option>
                            <option>התשפ"א</option>
                        </select>
                    </div>


                <label>היקף משרה- שעות בשבוע</label>
                <div class="input-line">
                    <input type="number" name="match_hours" size="2" maxlength="3" max="60" min="1" value="{{{$match->match_hours}}}" required>
                </div>

                    <label>שם המוסד</label>
                    <div class="input-line">
                    <select name="institute_id" class="pull-right mult" required>
                        <option disabled="disabled" selected="selected" value="">בחר מוסד</option>
                        @foreach ($institutes as $institute)
                            <option value="{{{$institute->id}}}">{{{$institute->name}}}</option>
                        @endforeach
                    </select>
                    <span class="error"></span>
                </div>


                <div class="input-line">
                    <button type="submit" class="pull-left approve">שלח</button>
                </div>

            </form> <!-- /form -->
@stop
