    @extends('app')

@section('page-title')
       <h1>הפסיכולוגים במחוז</h1>
@stop

@section('content')


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
