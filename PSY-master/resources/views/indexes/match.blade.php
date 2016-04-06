@extends('app')

@section('page-title')
    <h1>שיבוצים</h1>
@stop

@section('content')
<?php 
use App\Models\Institute;
?>
<?php $sum_hour=0;?>
<form class="psy-form">

<div class="input-line clearfix">
    <label>סה"כ שעות</label>
    <input type="number" id="output" readonly class= "medium" size="5" STYLE="background-color: #B8B8B8;" value="{{{$hours_for_matches}}}">
</div>
<br>
<div class="input-line clearfix">
    <label>בחר אחוז כיסוי</label>
    %<input type="decimal" id="percent" size="2" maxlength="5" max="100" min="0" value="100">
    <button onclick="updateFunction(); return false;" clearfix>עדכן</button>
</div>
<br>
<div class="input-line clearfix">
    <label>כמות שעות לשיבוץ</label>
    <input type="number" id="output2" readonly class= "medium" size="5" maxlength="3" STYLE="background-color: #B8B8B8;" value="{{{$hours_for_matches}}}">
</div>
<br>
<div class="input-line clearfix">
    <label>שעות שנותרו לשיבוץ</label>
    <input type="number" id="output3" readonly class= "medium" size="5" maxlength="3" STYLE="background-color: #B8B8B8;" value="{{{$hours_for_matches-$used_hours}}}">
</div>
<br>
</form>


 <h4>סנן לפי:</h4>
    
    <form class="psy-form"  method="GET">
    <input type="hidden" name="_method" value="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <span>פסיכולוג:</span>
            <span  class="input-line">
                <select name="filter_psy"  style="width: 130px" class=" mult">
                    <option disabled="disabled" selected="selected" value="">בחר מרשימה</option>
                    <?php $psy_array=array();?>
                    @foreach ($matches as $mat)
                        <?php 
                        $psy=$mat->psychologist;
                        if (!in_array($psy,$psy_array )){$psy_array[]=$psy;}?>
                    @endforeach
                    @foreach ($psy_array as $psy)
                        <option value="{{{$psy->id}}}">{{{$psy->last_name .(' ').$psy->first_name }}}</option>
                    @endforeach
                </select>
            </span>
    
    
    <span>מוסד:</span>
            <span class="input-line">
                <select name="filter_inst" style="width: 130px" class=" mult">
                    <option disabled="disabled" selected="selected" value="">בחר מרשימה</option>
                    <?php $inst_array=array();?>
                    @foreach ($matches as $mat)
                        <?php $ins=$mat->institute;
                        if (!in_array($ins,$inst_array )){$inst_array[]=$ins;}?>
                    @endforeach
                    @foreach ($inst_array as $ins)
                        <option value="{{{$ins->id}}}">{{{$ins->name }}}</option>
                    @endforeach
                </select>
            </span>
    
    <span>סוג מוסד:</span>
            <span class="input-line">
                <select name="filter_inst_type" style="width: 130px" class=" mult">
                    <option disabled="disabled" selected="selected" value="">בחר מרשימה</option>
                    <?php $inst_array=array();?>
                    @foreach ($matches as $mat)
                        <?php $ins=$mat->institute;
                         $ins_type=Institute::find($ins->id)->type;
                        if (!in_array($ins_type,$inst_array )){$inst_array[]=$ins_type;}?>
                    @endforeach
                    @foreach ($inst_array as $ins)
                        <option value="{{{$ins}}}">{{{$ins}}}</option>
                    @endforeach
                </select>
            </span>

    
    <span>שנה:</span>
            <span class="input-line ">
                <select name="filter_year" class=" mult">
                    <option disabled="disabled" selected="selected" value="">בחר מרשימה</option>
                    <?php $years=array();?>
                    @foreach ($matches as $mat)
                        <?php if (!in_array($mat->match_year , $years)){
                            $years[]=$mat->match_year ;
                        }
                        ?>
                    @endforeach
                    @foreach ($years as $year)
                        <option value="{{{$year}}}">{{{$year}}}</option>
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
            <td>פסיכולוג</td>
            <td>מוסד</td>
            <td>שעות במוסד</td>
            <td>שנת שיבוץ</td>
            @if ($psy->permission == 3)
                <td>שפ"ח</td>
            @endif
        </tr>
            </thead>

        @foreach ($matches as $mat)
            <tr>
                <td>
                    <form action="{{route('match.destroy', $mat->id)}}" method="post">
                        <input type="hidden" name="_method" value="DELETE"/>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit">
                            <img src="{{{asset('images/icons/delete.png')}}}">
                        </button>
                    </form>
                </td>

                <td>{{$mat->id}}</td>
                <td>{{$mat->psychologist['first_name'].(' ').$mat->psychologist['last_name']}}</td>
                <td>{{{$mat->institute['name']}}}</td>
                <td>{{{$mat->match_hours}}}</td>
                <td>{{{$mat->match_year}}}</td>
                @if ($psy->permission == 3)
                    <td>{{{$mat->institute->shapah['shapah_name']}}}</td>
                @endif
            </tr>
             <?php $sum_hour=$sum_hour+$mat->match_hours ;?>
        @endforeach
    </table>

    <script>
        function updateFunction() {
       document.getElementById('output2').value = ((document.getElementById('output').value)*             (document.getElementById('percent').value)/100).toFixed(2);
        document.getElementById('output3').value = ((document.getElementById('output2').value)-{{{$used_hours}}}).toFixed(2);
    }
    </script>
<br>
<div><?php if(isset($matches) && $matches){
                echo $matches->count() ." ";
            }
            else {
                echo "0 ";
            }
    ?>רשומות
    ,
סה"כ שעות: 
<?php echo $sum_hour?></div>


@stop
