    @extends('app')

@section('page-title')
       <h1>הפסיכולוגים במחוז</h1>
@stop

@section('content')


<form class="psy-form"  method="GET">
    <input type="hidden" name="_method" value="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <h4>סנן לפי:</h4>
    
     <span>שפ"ח:</span>
            <span class="input-line ">
                <select name="filter_shaph" class=" mult">
                    <option disabled="disabled" selected="selected" value="">בחר מרשימה</option>
                    <option value="">הכל</option>
                    <?php $shaphs_psy_array=array();?>
                    @foreach ($psychologists as $psy)
                        <?php $shaphs_psy_array[]=$psy->shapahs;
                        $shaph_arr=array();?>
                    @endforeach
                    @foreach ($shaphs_psy_array as $shaph_psy)
                        @foreach ($shaph_psy as $shaph)
                        <?php if (!in_array($shaph, $shaph_arr)){
                            $shaph_arr[]=$shaph;
                        }?>
                        @endforeach
                    @endforeach
                    @foreach($shaph_arr as $shap)
                    <option value="{{{$shap->id}}}">{{{$shap->shapah_name}}}</option>
                    @endforeach
                </select>
            </span>
    
    
    <span>סטאטוס מקצועי:</span>
            <span class="input-line ">
                <select name="filter_status" class=" mult">
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
                <select name="filter_role" class=" mult">
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
    
     <span>
            <button type="submit" class="pull-left approve">שלח</button>
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
		<td>מספר רישיון</td>
		<td>שם פרטי</td>
		<td>שם משפחה</td>
		<td>טלפון</td>
        <td>דואר אלקטרוני</td>
        <td>סטטוס מקצועי</td>
        <td>תפקיד בשפ"ח</td>

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
        <td>{{{$psy->license_number}}}</td>
		<td>{{{$psy->first_name}}}</td>
		<td>{{{$psy->last_name}}}</td>

		<td>{{{$psy->phone_number}}}</td>
		<td>{{{$psy->email}}}</td>

        <td>{{$psy->status['professional_status_description']}}</td>
        <td>{{$psy->role['psychologist_roles_description']}}</td>

	</tr>
	@endforeach

</table>
{!! $psychologists->render() !!}


      

@stop
