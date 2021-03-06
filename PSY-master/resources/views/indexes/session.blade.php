@extends('app')
<?php 
use App\Models\Training;
use App\Models\Psychologist;?>
@section('page-title')
    <h1>הדרכות</h1>
@stop

@section('content')
<?php $sum_hour=0;
      $sum_private=0;
      $sum_treatment_and_family=0;
      $sum_education_system=0;
      $sum_other=0;
      $guided_array=array();?>
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
     
    <span>מתאריך:</span>
            <span class="input-line">
                 <input type="date" id="datepicker" class="datepicker" size="10" name="filter_date"  style="width: 117px;">
            </span>
    
    <span>עד תאריך:</span>
            <span class="input-line">
                 <input type="date" id="datepicker" class="datepicker" size="10" name="filter_to_date"  style="width: 117px; " >
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
            <td>מודרך</td>
            <td>מדריך</td>
            <td>תאריך</td>
            <td>שעות</td>
            <td>סוג</td>
            <td>נושא</td>
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
                <?php $guided=Psychologist::find(Training::find($ses->trining_id)->guided_id)?>
                <td>{{$guided->first_name.' ' .$guided->last_name  }}</td>
                <td>{{$guid->first_name.' ' .$guid->last_name  }}</td>
                <td>{{$ses->training_date }}</td>
                <td>{{$ses->training_hours }}</td>
                <td>{{$ses->kind }}</td>
                <td>{{$ses->subject }}</td>
                <td>{{$ses->comment}}</td>
            </tr>
            <?php 
            if (!in_array($guided,$guided_array)){
                $guided_array[]=$guided;
            }
            $sum_hour=$sum_hour+$ses->training_hours;
            if ($ses->subject=="אבחון והערכה פרטניים"){
                $sum_private=$sum_private+$ses->training_hours;
            }
            else if($ses->subject=="טיפול בילדים ובני משפחתם"){
                $sum_treatment_and_family=$sum_treatment_and_family+$ses->training_hours;
            }
            else if($ses->subject=="אבחון, הערכה והתערבות במערכת החינוך"){
                $sum_education_system=$sum_education_system+$ses->training_hours;
            }
            else {
                $sum_other=$sum_other+$ses->training_hours;
            }
            ?>
        @endforeach</table>
<br>
<div><?php echo $sessions->count() ." ";?>רשומות
    ,
סה"כ שעות: 
<?php echo $sum_hour;
      echo "<br>";?>
    <h4>אחוזי השלמה: </h4>
    <?php $count_psy=( count($guided_array));
            if($count_psy==0){
                $count_psy=1;
            }
      ?></div>

<link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.4.3.min.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="http://cdn.oesmith.co.uk/morris-0.4.3.min.js"></script>

<div id="chart" style="height: 250px;"></div>

<script>
Morris.Bar({
  element: 'chart',
  data: [
    { subject: 'אבחון והערכה פרטניים', value: <?php echo 100*$sum_private/($count_psy*60);?> },
    { subject: 'טיפול בילדים ובני משפחתם', value: <?php echo 100*$sum_treatment_and_family/($count_psy*100);?> },
    { subject: 'אבחון, הערכה והתערבות במערכת החינוך', value: <?php echo 100*$sum_education_system/($count_psy*100);?> },
    { subject: 'אחר', value: <?php echo 100*$sum_other/($count_psy*100);?> }
  ],
  xkey: 'subject',
  ykeys: ['value'],
  ymax: 100,
  labels: ['הושלמו']
});
</script>


@stop