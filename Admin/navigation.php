<div id="wrapper">

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="navbar-header">
        <a class="navbar-brand" href="#">Inventory System</a>
    </div>

    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>

    <ul class="nav navbar-right navbar-top-links">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i> <?php echo $db_full_name; ?> <b class="caret"></b>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                </li>
                <li class="divider"></li>
                <li><a href="logout.php">Logout</a>
                </li>
            </ul>
        </li>
    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li class="sidebar-search">
                    <div class="input-group custom-search-form">
                    <img src="../images/profile.jpg" width="100px" height="100px" style="margin-left:50px;" class="img-circle" alt="">
                        <!-- <input type="text" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                            <button class="btn btn-primary" type="button">
                                <i class="fa fa-search"></i>
                            </button>
                        </span> -->
                    </div>
                    <!-- /input-group -->
                </li>
                <li>
                    <a href="index" class="active"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                </li>     
                <li>
                    <a href="orders"><i class="fa fa-fw"></i> Orders</a>
                </li> 
                <li>
                    <a href="brands"><i class="fa fa-bookmark-o fa-fw"></i> Brand</a>
                </li>  
                <li>
                    <a href="categories"><i class="fa fa-barcode fa-fw"></i> Category</a>
                </li>                      
                <li>
                    <a href="products"><i class="fa fa-product-hunt fa-fw"></i> Products</a>
                </li>
                <!-- <li> -->
                    <!-- <a href="#"><i class="fa fa-wrench fa-fw"></i> Management<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="#"><i class="fa fa-shopping-cart fa-fw"></i>Sales Management</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-money fa-fw"></i>Expenses Management</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-copy fa-fw"></i>Reports</a>
                        </li>                        
                    </ul> -->
                    <!-- /.nav-second-level -->
                <!-- </li> -->
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>