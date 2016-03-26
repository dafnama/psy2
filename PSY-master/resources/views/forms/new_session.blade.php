@extends('app')
<?php 
use App\Models\Training;
use App\Models\Psychologist;
?>
@section('page-title')
       <h1>דיווח מפגש הדרכה</h1>
@stop

@section('content')

 <!--form-->
    <form class="psy-form" action="{{{route('session.update',$session->id)}}}" method="post">

        @if(isset($is_new) && !$is_new)
            <input type="hidden" name="_method" value="PUT">
        @endif

        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="input-line clearfix">
            <label>תאריך פגישה</label>
            <input type="text" id="datepicker" class="datepicker" size="10" name="training_date"
                   data-format="YYYY-MM-DD" required value="{{{$session->training_date}}}">
        </div>
        <?php $trains=Training::where('guided_id','=',(Auth::user()->id))->get(); ?>
        <label>מדריך</label>
                    <div class="input-line clearfix">
                        <select name="trining_id" class="pull-right mult" required>
                            <option disabled="disabled" selected="selected" value="">בחר מרשימה</option>
                            @foreach ($trains as $train)
                                <?php $psy=Psychologist::find($train->guide_id)?>
                                <option value="{{{$train->id}}}">{{{$psy->last_name .(' ').$psy->first_name }}}</option>
                            @endforeach
                        </select>
                         <span class="error"></span>
                    </div>

        <div class="input-line" required>
            <label>אורך המפגש בשעות</label>
            <input type="number" name="training_hours" size="1" maxlength="1" min="1" max="8" name="date" required
                   value="{{{$session->training_hours}}}">
        </div>

        <div class="dynamic-list" data-label="סוגי פעילויות">
            <label>סוג הדרכה</label>

            <div class="input-line">
                <select name="kind" class="pull-right mult" title="דווח פעילות" required>
                    <option disabled="disabled" selected="selected" value="{{{$session->kind}}}">סוג הדרכה</option>
                        <option>קבוצתי</option>
                        <option>פרטני</option>
                </select>
            </div>
        </div>
    
        <div class="input-line">
                <label>מקרים שנידונו בהדרכה</label>
                <textarea name="comment" maxlength="100" placeholder="תאר את הפעילות - עד 100 תווים " cols="40"
                        >{{{$session->comment}}}</textarea>
        </div>
        
        <div class="input-line clearfix">
            <button type="submit" class="pull-left approve">שלח</button>
        </div>


    </form> <!-- /form -->
    
@stop
