@extends('app')
<?php use App\Models\Institute;?>
@section('page-title')
        <h1> מחשבון לחישוב תקן</h1>
        <h2> ע"פ מפתח עבודה מומלץ בחוזר מנכ"ל משרד החינוך</h2>
        <h3>מתווה השירות הפסיכולוגי חינוכי" תש"ע 8/א 1212" </h3>
@stop

@section('content')
    <form class="psy-form" id="calcForm" STYLE="background-color: #E8E8E8;" >

<?php if( isset($_GET["inst"])){
            $id= $_GET["inst"];
            $filter_inst=Institute::find($id);
        }    
        $institute=Institute::all(); ?>
                <label>בחר מוסד</label>
                <div class="input-line clearfix">
                        <select id="institue" name="institue" class="pull-right mult">
                            <?php if (!isset($filter_inst)){?>
                            <option disabled="disabled" selected="selected" value="">בחר מרשימה</option>
                            <?php }?>
                            @foreach ($institute as $inst)
                                <option  <?php if(isset($filter_inst) && ($filter_inst->id==$inst->id)) {echo 'selected="selected"';}?> value="{{{$inst->id}}}">{{{$inst->name}}}</option>
                            @endforeach
                        </select>
                         <button onclick="calcInsitueFunction(); return false;" clearfix>בחר</button>
                </div>
                <div class="input-line clearfix">
                    <label>מספר הילדים בגיל הגן וכיתות א, גילאים 3-6</label>
                    <input type="number" <?php if(isset($filter_inst)){ $sum=$filter_inst->number_of_kindergarten_children+$filter_inst->number_of_alef_students; echo "value='$sum'";} ?> class= "small" id="ages3to6" size="4" maxlength="4" max="9999" min="1">
                </div>

                <div class="input-line clearfix">
                    <label>מספר התלמידים בכיתות ב-י"ב</label>
                    <input type="number" <?php if(isset($filter_inst)){ echo "value='$filter_inst->number_of_non_alef_students'";} ?> class= "small" id="agesbetybet" size="4" maxlength="4" max="9999" min="1">
                </div>

                <div class="input-line clearfix">
                    <label>מספר התלמידים בחינוך מיוחד</label>
                    <input type="number"  <?php if(isset($filter_inst)){ echo "value='$filter_inst->number_of_special_students'";} ?> class= "small" id="agesspecial" size="4" maxlength="4" max="9999" min="1">
                </div>



                <div class="input-line clearfix">
                    <label> (1-100) אחוז כיסוי</label>
                    <input type="number"   class= "small" id="cover" size="4" maxlength="4" max="100" min="1">
                </div>

        <br>
 <button onclick="calcFunction(); return false;" clearfix>חשב תקן פסיכולוג</button>
         <input type="button" onclick="resetFunction()" value="איפוס ערכים">
        <br>
        <br>
                <div class="input-line clearfix">
                    <label>מספר התקנים לפסיכולוג</label>
<input type="number" id="output" readonly class= "medium" size="5" STYLE="background-color: #B8B8B8;"></div>
                    <div class="input-line clearfix">
                     <label>מספר השעות</label>
<input type="number" id="output2" readonly class= "medium" size="5" STYLE="background-color: #B8B8B8;">
        </div>






    </form>

        <script>
function calcFunction() {


   document.getElementById('output').value = ((((document.getElementById('agesspecial').value/500)+(document.getElementById('agesbetybet').value/1000)+(document.getElementById('agesspecial').value/300))*(document.getElementById('cover').value/100)).toFixed(2));


               document.getElementById('output2').value = ((((document.getElementById('agesspecial').value/500)+(document.getElementById('agesbetybet').value/1000)+(document.getElementById('agesspecial').value/300))*(document.getElementById('cover').value/100)*42.5).toFixed(2));
}


            function resetFunction() {
    document.getElementById("calcForm").reset();
    var url= window.location.href.split('?')[0];
    location.href = url;
}

function calcInsitueFunction(){
    var id=document.getElementById('institue').value;
    var url= window.location.href.split('?')[0];
    location.href = url+'?inst='+id;
    //alert(window.location);
    //alert(id);
}
            </script>
@stop
