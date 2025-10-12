<body>

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
        <div class="container" data-layout="container">
            <script>
              var isFluid = JSON.parse(localStorage.getItem('isFluid'));
              if (isFluid) {
                  var container = document.querySelector('[data-layout]');
                  container.classList.remove('container');
                  container.classList.add('container-fluid');
              }
            </script>


            <div class="content">
                <!-- Menú dispositivos -->
                <nav class="navbar navbar-light navbar-glass navbar-top navbar-expand">

                    <a class="navbar-brand me-1 me-sm-3" >
                    </a>
                    <ul class="navbar-nav align-items-center d-none d-lg-block">
                    <li class="nav-item">

                    </li>
                    </ul>
                    <ul class="navbar-nav navbar-nav-icons ms-auto flex-row align-items-center">

                    <li class="nav-item dropdown"><a class="nav-link pe-0 ps-2" id="navbarDropdownUser" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="avatar avatar-xl">
                            <img class="rounded-circle" src="{{ asset('assets/img/icons/user1 h 256.png') }}" alt="" /> 
                        </div>
                        </a>
                        <div class="dropdown-menu dropdown-caret dropdown-caret dropdown-menu-end py-0" aria-labelledby="navbarDropdownUser">
                        <div class="bg-white dark__bg-1000 rounded-2 py-2">   
                            <a class="dropdown-item" href="">Ingresar</a>
                        </div>
                        </div>
                    </li>
                    </ul>
                </nav>
                <!-- Termina Menú dispositivos -->