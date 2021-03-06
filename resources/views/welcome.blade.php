<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        @if (isset($redirect))
            <script type="text/javascript">
                window.open( "{{$redirect}}" )
            </script>
        @endif

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
                font-size: 14px;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            
            .popup {
                font-size: 16px;
                font-weight:700;
                color: #993333;
            }
            
            .accesses {
                font-size: 16px;
                font-weight:700;
                color: #339933;
            }
        </style>
    </head>
    <body>
        <div class="flex-center full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

            <div class="title">
                <div class="title m-b-md">
                    371 GROUP PROJECT
                </div>

                <div class="links">
                    <!-- 
                    <a href="#">Announcements</a>
                    <a href="#">Code Reviews</a>
                    <a href="#">Tutorials</a>
                    <a href="#">Demos</a>
                    <a href="#">About The Team</a>
                    -->
            </div>
                <br>
                <div class="content">
                    <table style="display: inline-block;">
                        <tr>
                            <td>
                        <form id="search" action="" method="get">
                            <input list="history" name="search">
                            <datalist id="history">
                                @if (isset($history_list))
                                    @foreach ($history_list as $history)
                                        <option value="{{$history->query}}">
                                    @endforeach
                                @endif
                            </datalist>
                            <input type="submit" value="Search">
                        </form>  
                        </td>
                        <td>
                        <!--
                        <form id="newResource" action="resource/create" method="get">
                            <input type="submit" value="Create new resource">
                        </form>
                        -->
                        <!-- 
                        <a href="resource/create">Create new resource</a>
                        -->
                        </td>
                        </tr>
                    </table
                    <table style="display: inline-block;"><tr>
                    <td> <div id="popup" class="popup" style="display: none">Search history is shared with everyone</div></td></tr></table>
                  
                   <script>
                        var e = document.getElementById('search');
                        e.onmouseover = function() {
                          document.getElementById('popup').style.display = 'block';
                        }
                        e.onmouseout = function() {
                          document.getElementById('popup').style.display = 'none';
                        }
                   </script>
                </div>
                @if (isset($accesses) && isset($redirect))
                    <div id='accesses' class='accesses'>
                        Opening new tab with {{$redirect}} <br>
                        This search was accessed {{$accesses}} times.
                    </div>
                @endif
            </div>
        </div>
        <div class="flex-center">
            <a href="resource/create">Create new resource</a>
        </div>
        <div>.</div><div>.</div>
    </body>
</html>
