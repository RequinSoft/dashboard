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
                </nav>
                <!-- Termina Menú dispositivos -->