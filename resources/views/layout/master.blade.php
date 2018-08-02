<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="_token" content="{{ csrf_token() }}"/>
    <link rel="shortcut icon" href="{{asset('ico/employee.ico')}}">

    <title>Тестовое​ ​задание​ ​на​ ​позицию​ ​Junior​ ​PHP​ ​Developer</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('css/app.css')}}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{asset('css/starter-template.css')}}" rel="stylesheet">

    {{-- Для отображения дерева --}}
    <link href="{{asset('css/treeview.css')}}" rel="stylesheet">

    @yield('css')
</head>

<body>

<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{asset('/')}}">Laravel</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="{{ Request::path() == 'tree-view' ? 'active' : '' }}">
                    <a href="{{asset('tree-view')}}">Иерархия сотрудников</a>
                </li>
                <li class="{{ Request::path() == 'employees' ? 'active' : '' }}">
                    <a href="{{asset('employees')}}">Список сотрудников</a>
                </li>
                <li class="{{ Request::path() == 'ajaxemployees' ? 'active' : '' }}">
                    <a href="{{asset('ajaxemployees')}}">Ajax CRUD</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ route('login') }}">Авторизация</a></li>
                    <li><a href="{{ route('register') }}">Регистрация</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <b class="glyphicon glyphicon-user">&nbsp;</b>{{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>

<div class="container">
    <div class="starter-template">

        @yield('content')

    </div>
</div><!-- /.container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('js/treeview.js')}}"></script>
@yield('js')
@yield('jsuploadimage')
</body>
</html>