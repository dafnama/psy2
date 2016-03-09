@extends('app')

@section('page-title')
       <h1>הזנת שיבוץ לשנת עבודה - פסיכולוג בהדרכה</h1>
@stop

@section('content')

    <form class="psy-form" action="{{{route('training.update',$training->id)}}}" method="post">

        @if(isset($is_new) && !$is_new)
            <input type="hidden" name="_method" value="PUT">
        @endif
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <label>בחר פסיכולוג</label>
                    <div class="input-line clearfix">
                        <select name="guided_id" class="pull-right mult" required>
                            <option disabled="disabled" selected="selected" value="">בחר מרשימה</option>
                            @foreach ($psychologists as $psychologist)
                                <option value="{{{$psychologist->id}}}">{{{$psychologist->first_name.(' ').$psychologist->last_name}}}</option>
                            @endforeach
                        </select>
                         <span class="error"></span>
                    </div>
                    
                    
                    <label>בחר מדריך</label>
                    <div class="input-line clearfix">
                        <select name="guide_id" class="pull-right mult" required>
                            <option disabled="disabled" selected="selected" onchange="changeFunc();return false;" value="">בחר מרשימה</option>
                            @foreach ($psychologists as $psychologist)
                                <option value="{{{$psychologist->id}}}">{{{$psychologist->first_name.(' ').$psychologist->last_name}}}</option>
                            @endforeach
                        </select>
                         <span class="error"></span>
                    </div>

           <label>שנת שיבוץ</label>
                    <div class="input-line clearfix" >
                        <select name="training_year" class="pull-right mult"  required>
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


                <label>מספר שעות שבועיות</label>
                <div class="input-line">
                    <input type="number" name="training_hours" size="2" maxlength="3" max="60" min="1" required>
                </div>
                
                <label>סוג הדרכה</label>
                    <div class="input-line clearfix" >
                        <select name="kind" class="pull-right mult"  required>
                            <option disabled="disabled" selected="selected"  value="">בחר סוג</option>
                            <option>הדרכה בתהליך התמחות</option>
                            <option>הגרכה בהסמכה להדרכה</option>
                            <option>הדרכה לפרה מתמחה/סטודנט</option>
                            <option>הדרכה כללית</option>
                        </select>
                    </div>

                <div class="input-line">
                    <button type="submit" class="pull-left approve">שלח</button>
                </div>
            </form> <!-- /form -->
    
    
    
@stop
