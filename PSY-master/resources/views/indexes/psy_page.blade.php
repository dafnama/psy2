    @extends('app')
<?php use App\Models\Match;
use App\Models\Training;
use App\Models\Years;
?>
    
@section('page-title')
       <h1>הפסיכולוגים במחוז</h1>
@stop

@section('content')

<?php $array_years=Years::get();?>

<form class="psy-form"  method="GET">
    <input type="hidden" name="_method" value="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
     <?php if (isset($error)){ echo '<span style="color:red">'.$error."</span><br><br>"; }?>
    
    <h4>סנן לפי:</h4>
    <br>
     <span>שפ"ח:</span>
            <span class="input-line ">
                <select name="filter_shaph" class=" mult">
                    <option disabled="disabled" selected="selected" value="">בחר מרשימה</option>
                    <option value="">הכל</option>
                    <?php $shaphs_psy_array=array();$shaph_arr=array(); $shaph_view_arr=array();?>
                    @foreach ($psychologists as $psy)
                        <?php $shaphs_psy_array[]=$psy->shapahs;?>
                    @endforeach
                    @foreach ($shaphs_psy_array as $shaph_psy)
                        @foreach ($shaph_psy as $shaph)
                            <?php if (!in_array($shaph, $shaph_arr)){
                                $shaph_arr[]=$shaph;
                            }?>
                        @endforeach
                    @endforeach
                    <?php if (isset($shaph_arr)){?>
                        @foreach($shaph_arr as $shap)
                            <?php if(!in_array($shap->id,$shaph_view_arr)){
                                $shaph_view_arr[$shap->id]=$shap->shapah_name;
                            }?>
                        @endforeach
                        @foreach($shaph_view_arr as $key=>$val)
                            <option value="{{{$key}}}">{{{$val}}}</option>
                        @endforeach
                    <?php }?>
                </select>
            </span>
    
    
    <span>סטטוס מקצועי:</span>
            <span class="input-line ">
                <select name="filter_status" class=" mult" style="width: 120px">
                    <option disabled="disabled" selected="selected" value="">בחר מרשימה</option>
                    <?php $status_array=array();?>
                    @foreach ($psychologists as $psy)
                        <?php if (!in_array($psy->status, $status_array)){
                            $status_array[]=$psy->status;
                        }
                        ?>
                    @endforeach
                    @foreach ($status_array as $status)
                        <option value="{{{$status['id']}}}">{{{$status['professional_status_description']}}}</option>
                    @endforeach
                </select>
            </span>
    
    <span>תפקיד בשפ"ח:</span>
            <span class="input-line ">
                <select name="filter_role" class=" mult" style="width: 120px">
                    <option disabled="disabled" selected="selected" value="">בחר מרשימה</option>
                    <?php $status_array=array();?>
                    @foreach ($psychologists as $psy)
                        <?php if (!in_array($psy->role, $status_array)){
                            $status_array[]=$psy->role;
                        }
                        ?>
                    @endforeach
                    @foreach ($status_array as $status)
                        <option value="{{{$status['id']}}}">{{{$status['psychologist_roles_description']}}}</option>
                    @endforeach
                </select>
            </span>
    
    <span>נותרו לשבץ:</span>
            <span class="input-line ">
                <select name="filter_year" class=" mult" style="width: 120px">
                    <option disabled="disabled" selected="selected" value="">בחר שנה</option>
                    @foreach ($array_years as $year)
                        <option value="{{{$year->value}}}">{{{$year->value}}}</option>
                    @endforeach
                </select>
            </span>
    <br>
    <br>
     <span>
            <button type="submit" class=" approve">שלח</button>
    </span>
    </form> <!-- /form -->
    <br>
<table border="1">
      <thead>
	<tr>
		<td>ערוך</td>
		<td>מחק</td>
		<td>צפיה</td>
        <td>שפ"ח</td>
		<td>שם פרטי</td>
		<td>שם משפחה</td>
		<td>טלפון</td>
        <td>דואר אלקטרוני</td>
        <td>סטטוס מקצועי</td>
        <td>תפקיד בשפ"ח</td>
        <td>שיבוצים למוסדות</td>
        <td>שיבוצים להדרכות</td>
	</tr>
    </thead>

	@foreach ($psychologists as $psy)
	<tr>
		<td>
			<a href="{{{route('psychologist.edit', $psy->id)}}}">
				<img src="{{{asset('images/icons/edit.png')}}} ">
			</a>
		</td>
		<td>
            <form action="{{route('psychologist.destroy', $psy->id)}}" method="post">
                <input type="hidden" name="_method" value="DELETE"/>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit">
                    <img src="{{{asset('images/icons/delete.png')}}}">
                </button>
            </form>

		</td>
		<td>
            <a href="{{route('psychologist.show', $psy->id)}}">
                <img src="{{{asset('images/icons/view.png')}}}" height="20" width="20">
            </a>
        </td>
        <td>
            @foreach($psy->shapahs as $shapah)
                {{$shapah->shapah_name}}<br/>
            @endforeach
        </td>
		<td>{{{$psy->first_name}}}</td>
		<td>{{{$psy->last_name}}}</td>

		<td>{{{$psy->phone_number}}}</td>
		<td>{{{$psy->email}}}</td>

        <td>{{$psy->status['professional_status_description']}}</td>
        <td>{{$psy->role['psychologist_roles_description']}}</td>
        <?php  $count_match=Match::where('psychologist_id', '=',$psy->id)->count();?>
        <td> <?php echo $count_match;?></td>
        <?php  $count_training=Training::where('guided_id', '=',$psy->id)->count();?>
        <td> <?php echo $count_training;?></td>
	</tr>
	@endforeach

</table>

<div>סה"כ <?php if(isset($psychologists) && $psychologists){
                    echo $psychologists->count() ." ";}?>רשומות </div>

      

@stop
