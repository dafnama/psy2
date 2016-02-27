@extends('app_login')

@section('page-title')

@stop

@section('content')

    @foreach($errors->all() as $msg)
        {{$msg}}<br>
    @endforeach
    <div class="container2">
        <section id="content">
            <form action="{{route('login')}}" method="post">
                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                <h1>הזדהות לחיבור למערכת</h1>

                <div>
                    <input type="text" name="email" placeholder="שם משתמש" required id="username"/>
                </div>
                <div>
                    <input type="password" name="password" placeholder="סיסמה" required id="password"/>
                </div>
                <div>
                    <input type="submit" value="התחבר"/>


                </div>
            </form>
            <!-- form -->
            <div class="button">

            </div>
            <!-- button -->
        </section>
        <!-- content -->
    </div><!-- container -->




@stop
