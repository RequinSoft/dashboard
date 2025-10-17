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

        <nav class="navbar navbar-light navbar-vertical navbar-expand-xl">
          <script>
            var navbarStyle = localStorage.getItem("navbarStyle");
            if (navbarStyle && navbarStyle !== 'transparent') {
              document.querySelector('.navbar-vertical').classList.add(`navbar-${navbarStyle}`);
            }
          </script>
          <div class="d-flex align-items-center">
            <div class="toggle-icon-wrapper">

              <button class="btn navbar-toggler-humburger-icon navbar-vertical-toggle" data-bs-toggle="tooltip" data-bs-placement="left" title="Toggle Navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>

            </div><a class="navbar-brand" href="#">
              <div class="d-flex align-items-center py-3">
                  <span class="font-sans-serif">
                    Menú
                  </span>                
              </div>
            </a>
          </div>
          
          @include('layouts.sidebar')
        </nav>

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