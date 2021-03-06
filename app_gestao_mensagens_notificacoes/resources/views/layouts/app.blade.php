<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Gestão de Mensagens e Notificações') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link rel="shortcut icon" href="{{ asset('img/logo.png') }}" type="image/x-icon">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
   
    <!-- Font Awesome -->
    <link href="{{ asset('css/fontawesome-free-6.1.1-web/css/all.min.css') }}" rel="stylesheet">

    <!-- Data Tables -->
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">

                <!-- Check if user is logged in -->
                @guest
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Gestão de Mensagens e Notificações') }}
                    </a>
                @else
                    <a class="navbar-brand" href="{{ url('/home') }}">
                        {{ config('app.name', 'Gestão de Mensagens e Notificações') }}
                    </a>
                @endguest
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registar') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                                    <!-- Editar Perfil -->
                                    <a class="dropdown-item" href="{{ route('user.edit') }}">
                                        {{ __('Editar Perfil') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @include('sweetalert::alert')
</body>
</html>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

<script>

    $(document).ready(function() {


        /**
         * DataTables
         */

        $('#table-list-messages').DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json"
            },

            /**
             * search only in the first column , second column , third column
             * First column not sortable
             */ 
            "columnDefs": [
                { "targets": [5], "searchable": false },
                { "bSortable": false, "aTargets": [ 0,5 ] }
            ],

            /* active column position */
            "order": [[3, "asc" ]]

        });

        /**
         * Sortable
         */

        $('#table-list-messages-body').sortable({
            items: 'tr',
            opacity: 0.6,
            cursor: 'move',
            update: function() {
                var token = $('meta[name="csrf-token"]').attr('content');
                var posArr = [];

                $('#table-list-messages-body').find('tr').each(function() {
                        
                    var id = $(this).attr('id').replace('message-', '');
                    console.log(id);
                    posArr.push(id);
                    
                });

                if (posArr.length > 0) {

                    url = '{{ url('mensagens/updatepos') }}';
                    console.log(posArr);
                        
                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: {
                            _token: token,
                            position: posArr
                        },
                        success: function(data) {
                            // sweet alert toast success
                            Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000
                            }).fire({
                                title: 'Ordenação atualizada!',
                                icon: 'success'
                            });
                        }
                    });
                }
            }
        });

        $('#table-list-messages-body').disableSelection();

        /**
         * Show Password
         */
        
         $('#show_new_password').on('click', function() {
            var password = $('#new_password');
            var icon = $(this).find('i');

            if (password.attr('type') == 'password') {
                password.attr('type', 'text');
                icon.removeClass('fa-eye-slash');
                icon.addClass('fa-eye');
            } else {
                password.attr('type', 'password');
                icon.removeClass('fa-eye');
                icon.addClass('fa-eye-slash');
            }
        });

        $('#show_password_confirm').on('click', function() {
            var password = $('#password_confirmation');
            var icon = $(this).find('i');

            if (password.attr('type') == 'password') {
                password.attr('type', 'text');
                icon.removeClass('fa-eye-slash');
                icon.addClass('fa-eye');
            } else {
                password.attr('type', 'password');
                icon.removeClass('fa-eye');
                icon.addClass('fa-eye-slash');
            }
        }); 
    });
</script>
