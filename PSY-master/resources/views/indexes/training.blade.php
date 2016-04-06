@extends('app')
<?php 
use App\Models\Training;
use App\Models\Psychologist;
?>
@section('page-title')
    <h1>הדרכות</h1>
@stop

@section('content')
<?php $sum_hour=0;?>
<form class="psy-form"  method="GET">
    <input type="hidden" name="_method" value="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <?php if (isset($error)){ echo '<span style="color:red">'.$error."</span><br>"; }?>
    
    <h4>סנן לפי:</h4>
    
        
    <span>מודרך:</span>
            <span  class="input-line">
                <select name="filter_guided"  style="width: 130px" class=" mult">
                    <option disabled="disabled" selected="selected" value="">בחר מרשימה</option>
                    <?php $psy_array=array();?>
                    @foreach ($trainings as $train)
                        <?php 
                        $psy=Psychologist::find($train->guided_id);
                        if (!in_array($psy,$psy_array )){$psy_array[]=$psy;}?>
                    @endforeach
                    @foreach ($psy_array as $psy)
                        <option value="{{{$psy->id}}}">{{{$psy->last_name .(' ').$psy->first_name }}}</option>
                    @endforeach
                </select>
            </span>
    
    
    <span>מדריך:</span>
            <span class="input-line">
                <select name="filter_guid" style="width: 130px" class=" mult">
                    <option disabled="disabled" selected="selected" value="">בחר מרשימה</option>
                    <?php $psy_array=array();?>
                    @foreach ($trainings as $train)
                        <?php $psy=Psychologist::find($train->guide_id);
                        if (!in_array($psy,$psy_array )){$psy_array[]=$psy;}?>
                    @endforeach
                    @foreach ($psy_array as $psy)
                        <option value="{{{$psy->id}}}">{{{$psy->last_name .(' ').$psy->first_name }}}</option>
                    @endforeach
                </select>
            </span>

    
    <span>שנה:</span>
            <span class="input-line ">
                <select name="filter_year" class=" mult">
                    <option disabled="disabled" selected="selected" value="">בחר מרשימה</option>
                    <?php $years=array();?>
                    @foreach ($trainings as $train)
                        <?php if (!in_array($train->training_year , $years)){
                            $years[]=$train->training_year ;
                        }
                        ?>
                    @endforeach
                    @foreach ($years as $year)
                        <option value="{{{$year}}}">{{{$year}}}</option>
                    @endforeach
                </select>
            </span>

     <span>שעות:</span>
            <span class="input-line ">
                <select  name="filter_hours" class=" mult">
                    <option  disabled="disabled" selected="selected" value="">בחר מרשימה</option>
                    <?php $hours=array();?>
                    @foreach ($trainings as $train)
                        <?php if (!in_array($train->training_hours , $hours)){
                            $hours[]=$train->training_hours;
                        }
                        ?>
                    @endforeach
                    @foreach ($hours as $hour)
                        <option value="{{{$hour}}}">{{{$hour}}}</option>
                    @endforeach
                </select>
            </span>
    <span>
            <button type="submit" class="pull-left approve">שלח</button>
    </span>
</form> <!-- /form -->
<br>
<table border="1">
         <thead>
        <tr>
            <td>מחק</td>
            <td>ערוך</td>
            <td>מזהה</td>
            <td>מודרך</td>
            <td>מדריך</td>
            <td>שנה</td>
            <td>שעות</td>
            <td>סוג</td>
        </tr>
         </thead>

@foreach ($trainings as $train)
            <tr>
                <td>
                    <form action="{{route('training.destroy', $train->id)}}" method="post">
                        <input type="hidden" name="_method" value="DELETE"/>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit">
                            <img src="{{{asset('images/icons/delete.png')}}}">
                        </button>
                    </form>

                </td>
                <td>
                <a href="{{route('training.edit', $train->id)}}">
                <img src="{{{asset('images/icons/edit.png')}}}" height="20" width="20">
            </a>
        </td>
                <?php $guid=Psychologist::find($train->guide_id)?>
                <?php $guided=Psychologist::find($train->guided_id)?>
                <td>{{$train->id}}</td>
                <td>{{$guided->last_name. ' ' .$guided->first_name}}</td>
                <td>{{$guid->last_name.' ' .$guid->first_name}}</td>
                <td>{{{$train->training_year}}}</td>
                <td>{{{$train->training_hours}}}</td>
                <td>{{{$train->kind}}}</td>
            </tr>
            <?php $sum_hour=$sum_hour+$train->training_hours ;?>
        @endforeach</table>
<br>
<div><?php if(isset($trainings) && $trainings){echo $trainings->count() ." ";}?>רשומות
    ,
סה"כ שעות: 
<?php echo $sum_hour?></div>

@stop
