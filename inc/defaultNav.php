<!--Navbar-->
 <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
        <a href="<?php echo base_url ?>index3.html" class="navbar-brand">
          <img src="<?php echo base_url ?>dist/img/AdminTELogo.png" alt="AdminTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">AdminTE 3</span>
       </a> 

       <button class="narbar-toggler-order-1" type="button" data-toggle="collapse" data-traget="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toogle navigation">
        <span class="navbar-toogler-icon"></span>
       </button>

     <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!--Left navBar links-->
        <ul class="navbar-nav">
           <li class="nav-item">
             <a href=index3.html class="nav-link">Home</a>
           </li> 
           <li class="nav-item">
             <a href="#" class="nav-link">Contact</a>
            </li>
           <li class="nav-item dropdown"> 
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Dropdown</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <li><a href="#" class="dropdown-item">Some action </a></li>
              <li><a href="#" class="dropdown-item">Some other action</a></li>
              <li class="dropdown-divider"></li>

              <!-- Level two dropdown-->
              <li class="dropdown-submenu dropdown-hover">
                <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Hover for action</a>
                <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                  <li>
                    <a tabindex="-1" href="#" class="dropdown-item">level 2</a>
                  </li>

                  <!-- Level three dropdown-->
                  <li class="dropdown-submenu">
                    <a id="dropdownSubMenu3" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">level 2</a>
                    <ul aria-labelledby="dropdownSubMenu3" class="dropdown-menu border-0 shadow">
                      <li><a href="#" class="dropdown-item">3rd level</a></li>
                      <li><a href="#" class="dropdown-item">3rd level</a></li>
                    </ul>
                  </li>
                  <!-- End Level three -->

                  <li><a href="#" class="dropdown-item">level 2</a></li>
                  <li><a href="#" class="dropdown-item">level 2</a></li>
                </ul>
              </li>
              <!-- End Level two -->
            </ul>
          </li>
        </ul>

        <!--Search form-->
        <form class="form-inline ml-0 ml-md-3">
            <div class="input-group input-group-sm">
             <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
               <div class="input-group-append">
               <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
              </button>
           </div>
         </div>
       </form>
    </div>