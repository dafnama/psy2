@extends('app')
<?php 
use App\Models\Training;
use App\Models\Psychologist;?>
@section('page-title')
    <h1>הדרכות</h1>
@stop

@section('content')
<?php $sum_hour=0;?>
<form class="psy-form"  method="GET">
    <input type="hidden" name="_method" value="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <h4>סנן לפי:</h4>
    <span>מדריך:</span>
            <span class="input-line">
                <select name="filter_guid" class=" mult">
                    <option disabled="disabled" selected="selected" value="">בחר מרשימה</option>
                    <?php $psy_array=array();?>
                    
                    @foreach ($sessions as $ses)
                        <?php 
                        $psy=Psychologist::find(Training::find($ses->trining_id)->guide_id);
                        if (!in_array($psy,$psy_array )){$psy_array[]=$psy;}?>
                    @endforeach
                    @foreach ($psy_array as $psy)
                        <option value="{{{$psy->id}}}">{{{$psy->last_name .(' ').$psy->first_name }}}</option>
                    @endforeach
                </select>
            </span>
    
    <span>מתאריך:</span>
            <span class="input-line">
                 <input type="text" id="datepicker" class="datepicker" size="10" name="filter_date" data-format="YYYY-MM-DD" value="<?php echo date("d M Y", strtotime("-1 year"));?>">
            </span>
    &nbsp
     <span>סוג:</span>
            <span class="input-line ">
                <select name="filter_kind" class=" mult">
                    <option disabled="disabled" selected="selected" value="">בחר מרשימה</option>
                    <?php $kinds=array();?>
                    @foreach ($sessions as $ses)
                        <?php if (!in_array($ses->kind, $kinds)){
                            $kinds[]=$ses->kind;
                        }
                        ?>
                    @endforeach
                    @foreach ($kinds as $kind)
                        <option value="{{{$kind}}}">{{{$kind}}}</option>
                    @endforeach
                </select>
            </span>


    <span>
            <button type="submit" class="pull-left approve">שלח</button>
    </span>
</form> <!-- /form -->
<br>
<br>
<table border="1">
         <thead>
        <tr>
            <td>מחק</td>
            <td>מזהה</td>
            <td>מדריך</td>
            <td>תאריך</td>
            <td>שעות</td>
            <td>סוג</td>
            <td>מקרים</td>
        </tr>
         </thead>

@foreach ($sessions as $ses)
            <tr>
                <td>
                    <form action="{{route('session.destroy', $ses->id)}}" method="post">
                        <input type="hidden" name="_method" value="DELETE"/>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit">
                            <img src="{{{asset('images/icons/delete.png')}}}">
                        </button>
                    </form>

                </td>
                <td>{{$ses->id}}</td>
                <?php $guid=Psychologist::find(Training::find($ses->trining_id)->guide_id)?>
                <td>{{$guid->first_name.' ' .$guid->last_name  }}</td>
                <td>{{$ses->training_date }}</td>
                <td>{{$ses->training_hours }}</td>
                <td>{{$ses->kind }}</td>
                <td>{{$ses->comment}}</td>
            </tr>
            <?php $sum_hour=$sum_hour+$ses->training_hours ;?>
        @endforeach</table>
<br>
<div><?php echo $sessions->count() ." ";?>רשומות
    ,
סה"כ שעות: 
<?php echo $sum_hour?></div>

@stop