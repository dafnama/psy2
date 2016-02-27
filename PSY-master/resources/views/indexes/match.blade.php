@extends('app')

@section('page-title')
    <h1>שיבוצים</h1>
@stop

@section('content')

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
        @endforeach
    </table>

    <script>
        function updateFunction() {
       document.getElementById('output2').value = ((document.getElementById('output').value)*             (document.getElementById('percent').value)/100).toFixed(2);
        document.getElementById('output3').value = ((document.getElementById('output2').value)-{{{$used_hours}}}).toFixed(2);
    }
    </script>



@stop
