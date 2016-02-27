<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>שפ"י מחוז דרום</title>
    <link href='http://fonts.googleapis.com/css?family=Alef:400,700' rel='stylesheet' type='text/css'>
    <link href="{{ asset('lib/Pikaday-master/css/pikaday.css') }}" rel="stylesheet">

    <link href="{{asset('css/style.css')}}" rel="stylesheet">

</head>

<body>
<div class="container">
    <header class="main-header">
        <nav class="horizontal">

        </nav>
    </header>
    <article class="main-content">
        @section('page-title')
        @show
        @yield('content')
    </article>
    <footer>
        <nav class="horizontal centered">
            <ul class="clearfix">
                <li>לקבלת פרטי התחברות - פנה לפסיכולוג המחוז אילן וירצברגר: ilanvi@education.gov.il , 08-6263278</a>
                </li>

            </ul>
        </nav>

    </footer>
</div>
<script src="{{asset('lib/moment/min/moment.min.js')}}"></script>
<script src="{{asset('lib/Pikaday-master/pikaday.js')}}"></script>
<script src="{{asset('js/app.js')}}"></script>
</body>

</html>
