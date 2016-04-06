@extends('app')
<?php use App\Models\Match;
use App\Models\Psychologist;
use App\Models\Institute;?>
@section('page-title')
    <h1>ביקורים</h1>
@stop

@section('content')
<?php $sum_hour=0;?>
    <form class="psy-form"  method="GET">
        <input type="hidden" name="_method" value="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <h4>סנן לפי:</h4>
        <span>פסיכולוג:</span>
                <span class="input-line">
                    <select name="filter_psy" class=" mult">
                        <option disabled="disabled" selected="selected" value="">בחר מרשימה</option>
                        <?php $psy_array=array();?>

                        @foreach ($visits as $visit)
                            <?php 
                            if($visit->match_id){
                                $psy=Psychologist::find(Match::find($visit->match_id)->psychologist_id);
                                if (!in_array($psy,$psy_array )){
                                    $psy_array[]=$psy;}
                            }
                            ?>
                        @endforeach
                        @foreach ($psy_array as $psy)
                            <option value="{{{$psy->id}}}">{{{$psy->last_name .(' ').$psy->first_name }}}</option>
                        @endforeach
                    </select>
                </span>
        
              <span>מוסד:</span>
                <span class="input-line">
                    <select name="filter_institute" class=" mult">
                        <option disabled="disabled" selected="selected" value="">בחר מרשימה</option>
                        <?php $inst_array=array();?>
                        @foreach ($visits as $visit)
                            <?php 
                            if($visit->match_id){
                                $inst=Institute::find(Match::find($visit->match_id)->institute_id);
                                if (!in_array($inst,$inst_array )){
                                    $inst_array[]=$inst;
                                }
                            }
                            ?>
                        @endforeach
                        @foreach ($inst_array as $insti)
                            <option value="{{{$insti->id}}}">{{{$insti->name }}}</option>
                        @endforeach
                    </select>
                </span>
        
  

         <span>פעילות:</span>
                <span class="input-line ">
                    <select name="filter_activity" class=" mult">
                        <option disabled="disabled" selected="selected" value="">בחר מרשימה</option>
                        <?php $kinds=array();?>
                        @foreach ($visits as $visit)
                            <?php if (!in_array($visit->activity, $kinds)){
                                $kinds[]=$visit->activity;
                            }
                            ?>
                        @endforeach
                        @foreach ($kinds as $kind)
                            <option value="{{{$kind}}}">{{{$kind}}}</option>
                        @endforeach
                    </select>
                </span>
         <br>
         <br>
        <span>מתאריך:</span>
                <span class="input-line">
                     <input type="date" id="datepicker" class="datepicker" size="10" name="filter_date" >
                </span>

        <span>עד תאריך:</span>
                <span class="input-line">
                     <input type="date" id="datepicker" class="datepicker" size="10" name="filter_to_date" >
                </span>

        <span>
                <button type="submit" class="pull-left approve">שלח</button>
        </span>
    </form> <!-- /form -->


    <table border="1">
         <thead>
        <tr>
            <td>ערוך</td>
            <td>מחק</td>
            <td>מזהה</td>
            <td>מוסד</td>
            <td>פסיכולוג</td>
            <td>תאריך</td>
            <td>פעילות</td>
            <td>משך הביקור</td>
            <td>תיאור מפגש</td>
        </tr>
        </thead>

        @foreach ($visits as $vis)
            <tr>
                <td>
                    <a href="{{{route('visit.edit', $vis->id)}}}">
                        <img src="{{{asset('images/icons/edit.png')}}}">
                    </a>
                </td>
                <td>
                    <form action="{{route('visit.destroy', $vis->id)}}" method="post">
                        <input type="hidden" name="_method" value="DELETE"/>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit">
                            <img src="{{{asset('images/icons/delete.png')}}}">
                        </button>
                    </form>

                </td>
                <td>{{$vis->id}}</td>
                <td>{{{$vis->intitute_name_const}}}</td>
               <?php if($vis->match_id){
                   $psychologist=Psychologist::find(Match::find($vis->match_id)->psychologist_id);
                   $psy=$psychologist->first_name.' ' .$psychologist->last_name;
               }
               else{
                   $psy=null;
               }
                ?>
                <td>{{{$psy }}}</td>
                <td>{{{$vis->date}}}</td>
                <td>{{{$vis->activity}}}</td>
                <td>{{{$vis->length}}}</td>
                <td>{{{$vis->comment}}}</td>
            </tr>
            <?php $sum_hour=$sum_hour+$vis->length ;?>
        @endforeach
    </table>
<div><?php if(isset($visits) && $visits){echo $visits->count() ." ";}?>רשומות
    ,
סה"כ שעות: 
<?php echo $sum_hour?></div>



@stop
