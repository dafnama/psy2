@extends('app')
<?php use App\Models\Training_kinds; ?>
@section('page-title')
       <h1>הזנת שיבוץ לשנת עבודה - פסיכולוג בהדרכה</h1>
@stop

@section('content')

<?php $array_kind=Training_kinds::get();?>
<?php if (isset($error)){ echo '<span style="color:red">'.$error."</span><br>"; }?>
    <form class="psy-form" action="{{{route($form_url,$training->id)}}}" method="post">
        @if(isset($is_new) && !$is_new)
            <input type="hidden" name="_method" value="PUT">
        @endif
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <label>בחר פסיכולוג</label>
                    <div class="input-line clearfix">
                        <select name="guided_id" class="pull-right mult" required>
                            <?php if(!isset($training->guided_id)){?>
                            <option disabled="disabled" selected="selected" value="">בחר מרשימה</option>
                            <?php } ?>
                            @foreach ($psychologists as $psychologist)
                                <option <?php if ($training->guided_id==$psychologist->id){echo 'selected="selected"';}?> value="{{{$psychologist->id}}}">{{{$psychologist->first_name.(' ').$psychologist->last_name}}}</option>
                            @endforeach
                        </select>
                         <span class="error"></span>
                    </div>
                    
                    
                    <label>בחר מדריך</label>
                    <div class="input-line clearfix">
                        <select name="guide_id" class="pull-right mult" required>
                            <option disabled="disabled" selected="selected" value="">בחר מרשימה</option>
                            @foreach ($psychologists as $psychologist)
                                <option <?php if ($training->guide_id==$psychologist->id){echo 'selected="selected"';}?> value="{{{$psychologist->id}}}">{{{$psychologist->first_name.(' ').$psychologist->last_name}}}</option>
                            @endforeach
                        </select>
                         <span class="error"></span>
                    </div>

           <label>שנת שיבוץ</label>
                    <div class="input-line clearfix" >
                        <select name="training_year" class="pull-right mult"  value="{{ $training->training_year }}" required>
                            <option disabled="disabled" selected="selected"  value="">בחר שנה</option>
                            <?php foreach($array_years as $year){?>
                            <option <?php if($year->value==$training->training_year){echo 'selected="selected"';}?>><?php echo $year->value; ?></option>
                            <?php }?>
                        </select>
                    </div>


                <label>מספר שעות שבועיות</label>
                <div class="input-line">
                    <input type="number" name="training_hours" value="{{ $training->training_hours}}" size="4" maxlength="3" max="60" min="1" step="0.1" required>
                </div>
                
                <label>סוג הדרכה</label>
                    <div class="input-line clearfix" >
                        <select name="kind" class="pull-right mult"  required>
                            <option disabled="disabled" selected="selected"  value="">בחר סוג</option>
                            <?php foreach($array_kind as $kind){?>
                            <option <?php if($kind->kind==$training->kind){echo 'selected="selected"';}?>><?php echo $kind->kind; ?></option>
                            <?php }?>
                        </select>
                    </div>

                <div class="input-line">
                    <button type="submit" class="pull-left approve">שלח</button>
                </div>
            </form> <!-- /form -->
    
    
    
@stop
