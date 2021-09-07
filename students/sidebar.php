<body>

<div id="wrapper">

    <nav class="navbar-default navbar-static-top" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <h1> <a class="navbar-brand" href="index.php">
                    <img src="../img/logo.png" class="img-responsive" style="width: 150px;">
                </a></h1>
        </div>
        <div class=" border-bottom">
            <div class="full-left">
                <section class="full-top">
                    <button id="toggle"><i class="fa fa-arrows-alt"></i></button>
                </section>
                <div class="clearfix"> </div>
            </div>

            <div class="drop-men" >
                <ul class=" nav_1" style="margin-right: 65px; padding-right: 20px; margin-top: 15px;">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle dropdown-at" data-toggle="dropdown"><span class=" name-caret"> <i class="fa fa-user"></i> FPE Portal <i class="caret"></i></span></a>
                        <ul class="dropdown-menu " role="menu">
                            <!-- <li><a href="account.php"></i>Profile</a></li> -->
                            <li><a href="logout.php"></i>Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>




            <div class="clearfix"></div>


        </div>

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">

                    <li>
                        <a href="index.php" class=" hvr-bounce-to-right"><i class="fa fa-dashboard nav_icon "></i><span class="nav-label">Dashboard</span> </a>
                    </li>
                    <?php
                        if(user('status') == 0){
                    ?>

                        <li>
                            <a href="fees.php" class=" hvr-bounce-to-right"><i class="fa fa-th nav_icon "></i><span class="nav-label">Fees Payment</span> </a>
                        </li>
                    
                    <?php
                        }
                        if(user('status') == 1){
                            ?>
                            <li>
                        <a href="course.php" class="hvr-bounce-to-right"><i class="fa fa-file-o nav_icon"></i> <span class="nav-label">Course Registration</span> </a>
                    </li>


                    <!-- <li>
                        <a href="olevel.php" class="hvr-bounce-to-right"><i class="fa fa-book nav_icon"></i> <span class="nav-label">Olevel Update</span> </a>
                    </li> -->




                    <li>
                        <a href="biodata.php" class="hvr-bounce-to-right"><i class="fa fa-user nav_icon"></i> <span class="nav-label">Biodata Update</span> </a>
                    </li>


                    <li>
                        <a href="result.php" class="hvr-bounce-to-right"><i class="fa fa-book nav_icon"></i> <span class="nav-label">Semester Result</span> </a>
                    </li>

                    <li>
                        <a href="print-biodata.php" target="_blank" class="hvr-bounce-to-right"><i class="fa fa-bookmark nav_icon"></i> <span class="nav-label">Print Biodata</span> </a>
                    </li>

                    <li>
                        <a href="print-course.php" class="hvr-bounce-to-right"><i class="fa fa-briefcase nav_icon"></i> <span class="nav-label">Print Course Form</span> </a>
                    </li>
                            <?php
                        }
                    ?>



                    


                    <li>
                        <a href="logout.php" class=" hvr-bounce-to-right"><i class="fa fa-sign-out nav_icon"></i> <span class="nav-label">Logout</span> </a>
                    </li>

                </ul>


                <?php
                    if(user('passport') != ""){
                        ?>
                        <img src="img/students/<?php echo user('passport'); ?>" class="img-responsive visible-md visible-lg">
                        <?php
                    }
                ?>
            </div>
        </div>
    </nav>
    <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="content-main">



            <div class="banner" style="margin-bottom:20px;">
                <h2>
                    <a href="index.php">Dashboard</a>
                    <i class="fa fa-angle-right"></i>
                    <span><?php echo $page_title;?></span>
                </h2>
            </div>

            <div class="banner" style="margin-bottom:20px;">
                <div class="row">
                    <div class="col-sm-6">
                        <i class="glyphicon glyphicon-book"></i> <?php echo settings("semester");?> Semester
                    </div>


                    <div class="col-sm-6">
                        <i class="glyphicon glyphicon-time"></i> <?php echo settings("session");?> Academic Session
                    </div>
                </div>
            </div>

            <div class="blank">
                <div class="blank-page">
