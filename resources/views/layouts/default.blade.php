<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/default.css') }}" />

</head>

<body>
    <div class="containerAdmin">
        <div class="navAdmin">
            <ul>
                <a href="/users">
                    <li class="{{ 'users' == request()->path() ? 'activeAdmin' : '' }}">
                    <i class="fas fa-user"></i>
                    Users</li>
                </a>
                <a href="/formations">
                    <li class="{{ 'formations' == request()->path() ? 'activeAdmin' : '' }}">
                    <i class="fas fa-chalkboard-teacher"></i>
                     Formations</li>
                </a>
                <a href="/modules">
                    <li class="{{ 'modules' == request()->path() ? 'activeAdmin' : '' }}">
                    <i class="fas fa-book"></i>
                    Modules</li>
                </a>
                <a href="/chapitres">
                    <li class="{{ 'chapitres' == request()->path() ? 'activeAdmin' : '' }}">
                    <i class="fas fa-book-reader"></i>
                    Chapitres</li>
                </a>
                <a href="/quizzes">
                    <li class="{{ 'quizzes' == request()->path() ? 'activeAdmin' : '' }}">
                    <i class="fas fa-list"></i>
                    Quiz</li>
                </a>
                <a href="/questions">
                    <li class="{{ 'questions' == request()->path() ? 'activeAdmin' : '' }}">
                    <i class="far fa-question-circle"></i>
                    Questions</li>
                </a>
                <a href="/reponses">
                    <li class="{{ 'reponses' == request()->path() ? 'activeAdmin' : '' }}">
                    <i class="fas fa-check"></i>
                    Reponses</li>
                </a>
                </a>
                <a href="/faqs">
                    <li class="{{ 'faqs' == request()->path() ? 'activeAdmin' : '' }}">
                    <i class="fas fa-info"></i>
                    Questions essentielles</li>
                </a>
                <a href="/ressources">
                    <li class="{{ 'ressources' == request()->path() ? 'activeAdmin' : '' }}">
                    <i class="far fa-comment-dots"></i>
                    Ressources</li>
                </a>
                <a href="/dashboard">
                    <li class="{{ 'dashboard' == request()->path() ? 'activeAdmin' : '' }}">
                    <i class="fas fa-chart-line"></i>
                    Dashboard</li>
                </a>
                <a href="/">
                    <li class="{{ '/' == request()->path() ? 'activeAdmin' : '' }}">
                    <i class="fas fa-home"></i>
                    Accueil</li>
                </a>
            </ul>
        </div>

        @yield('content')

    </div>

</body>

</html>