
   <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

        </div>

        <ul class="nav navbar-right top-nav">
            <li><a href="#" data-placement="bottom" data-toggle="tooltip" href="#" data-original-title="Stats"><i class="fa fa-bar-chart-o"></i>
                </a>
            </li>            
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Admin User <b class="fa fa-angle-down"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="dashboard.php?tab=profil"><i class="fa fa-fw fa-user"></i>Editare profil</a></li>
                    <li><a href="dashboard.php?tab=schimba_parola"><i class="fa fa-fw fa-cog"></i>Schimba parola</a></li>
                    <li class="divider"></li>
                    <li><a href="logout.php"><i class="fa fa-fw fa-power-off"></i>Logout</a></li>
                </ul>
            </li>
        </ul>
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li>
                    <a href="dashboard.php?tab=profil"><i class="fas fa-user-md fa-2x"></i> Profil</a>
                </li>
                <li>
                    <a href="dashboard.php?tab=pacienti" data-toggle="collapse" data-target="#submenu-1"><i class="far fa-hospital fa-2x"></i> Pacienti</a>
                    <ul id="submenu-1" class="collapse">
                        <li><a href="dashboard.php?tab=adauga"><i class="fas fa-user-injured fa-2x"></i> Adauga pacient</a></li>
                        <li><a href="dashboard.php?tab=istoric-medical"><i class="fas fa-file-medical fa-2x"></i> Adauga istoric medical</a></li>
                        <li><a href="dashboard.php?tab=afiseaza"><i class="fas fa-file-medical-alt fa-2x"></i> Afiseaza pacienti</a></li>
                    </ul>
                </li>
                <li>
                    <a href="dashboard.php?tab=istoric"><i class="fas fa-history fa-2x"></i> Istoric programari</a>
                </li>
                <li>
                    <a href="dashboard.php?tab=cauta"><i class="fas fa-search-plus fa-2x"></i> Cauta pacient</a>
                </li>
            </ul>
        </div>
    </nav>
