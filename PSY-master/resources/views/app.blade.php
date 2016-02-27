<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">



<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<link href="{{asset('css/style.css')}}" rel="stylesheet">

  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script>
  $(function() {
    $( "#datepicker" ).datepicker();
  });
  </script>

    <title>שפ"י דרום</title>
    <link href='http://fonts.googleapis.com/css?family=Alef:400,700' rel='stylesheet' type='text/css'>



</head>

<body>
<div class="container">
    <header class="main-header">
        <h3><a href="/auth/logout"> <img src="{{{asset('images/icons/logout.png')}}}" height="20" width="20"  style="PADDING-TOP: 5px" title="התנתק מהמערכת">
                               </a>

            {{Auth::user()->first_name}}, ברוך הבא


                           </h3>

        <nav class="horizontal">
            <ul class="clearfix">
                <li>
                </li>
                <li>
                    <a href="/map">השפ"חים במחוז</a>
                </li>
                <li>
                    <a href="#">המוסדות בשפ"ח</a>
                    <ul>
                        <li><a href="{{route('institute.index')}}">רשימת המוסדות</a></li>
                        <li><a href="{{route('institute.create')}}">הוספת מוסד חדש</a></li>

                    </ul>
                </li>
                <li><a href="#">הפסיכולוגים במחוז</a>
                    <ul>
                        <li><a href="{{route('psychologist.index')}}">רשימת הפסיכולוגים</a></li>
                        <li><a href="{{route('psychologist.create')}}">הוספת פסיכולוג חדש</a></li>

                    </ul>
                </li>


                <li>
                    <a href="#">מפגשים ודיווח</a>
                    <ul>
                        <li><a href="{{route('visit.index')}}">רשימת מפגשים</a>
                        <li><a href="{{route('visit.create')}}">דיווח מפגש במוסד</a></li>
                    </ul>
                </li>
                @if(!Auth::user()->isUser())
                <li>
                    <a href="#">שיבוץ פסיכולוג במוסד</a>
                    <ul>
                        <li><a href="/calc">מחשבון לתקן שיבוץ</a></li>
                        <li><a href="{{route('match.index')}}">רשימת שיבוצים</a></li>
                        <li><a href="{{route('match.create')}}">שיבוץ פסיכולוג למוסד בשנת עבודה</a></li>
                    </ul>
                </li>
                @endif


            </ul>
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
        <li><a href="http://cms.education.gov.il/EducationCMS/Units/shefi">שפ"י נט</a>
            &nbsp
                </li>
        <li><a href="http://edu.gov.il/owlheb/Pages/default.aspx">משרד החינוך</a>
            &nbsp
                </li>
                <li><a href="http://www.apa.org/">American Psychological Association</a>
                &nbsp
                </li>
                <li> <a href="http://www.psychology.org.il/">הסתדרות הפסיכולוגים בישראל</a>&nbsp
                </li>
                <li><a href="http://www.hebpsy.net/">פסיכולוגיה עברית</a>
                </li>
            </ul>
        </nav>

    </footer>
</div>

<script src="{{asset('js/app.js')}}"></script>
</body>

</html>
