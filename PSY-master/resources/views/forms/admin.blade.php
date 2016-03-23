@extends('app')

@section('page-title')
    <h1>מסך הדרכות</h1>
@stop

@section('content')
<h4>שנים:</h4>
<table border="1">
        <thead>
            <tr>
                <td>מחק</td>
                <td>שנה עברית</td>
                <td>שנה לועזית</td>
            </tr>
         </thead>
    @foreach ($years as $year)
            <tr>
                <td>
                    <form action="{{route('admin.destroy', $year->id)}}" method="post">
                        <input type="hidden" name="_method" value="DELETE"/>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit">
                            <img src="{{{asset('images/icons/delete.png')}}}">
                        </button>
                    </form>

                </td>
                <td>{{$year->value }}</td>
                <td>{{$year->years_key}}</td>
            </tr>
        @endforeach</table>

<h4>הוספת שנים:</h4>
        <form class="psy-form" action="{{{route('admin.update',$new_year->id)}}}" method="post">

        @if(isset($is_new) && !$is_new)
            <input type="hidden" name="_method" value="PUT">
        @endif

        <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <span class="input-line" required>
                <span>שנה עברית:</span>
                <input type="text" name="value" size="10" name="date">
            </span>
            
            <span class="input-line" required>
                <span>שנה לועזית:</span>
                <input type="text" name="years_key" size="10">
            </span>

            <span class="input-line clearfix">
                <button type="submit" class="pull-left approve">שלח</button>
            </span>

        </form> <!-- /form -->
@stop