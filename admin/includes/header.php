<?php
    

    require_once 'init.php';

    $file = basename($_SERVER['PHP_SELF']);


    $sql = "SELECT a.id,a.staff_id, a.item_type, a.item_id, a.date_created, u.first_name, u.last_name FROM admin_notifications a, users u WHERE a.staff_id = u.id AND a.read_status = 0 ORDER BY a.id DESC";
    $result =  $database->query($sql);

    $notification_result = $result->rowCount();



switch($file){
    case 'index.php':
        $page_title= 'Home';
        break;
    default:
    $page_title=ucwords(str_replace('-',' ',str_replace('.php','',$file)));
    
    break;
    }


    if(!isset($_SESSION['userid'])){

      //go('index');

    }


    require_once 'controllers/classes/general.class.php';

    $general = new General;

    $general->dashCount();


 ?>
 <!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php  echo $page_title; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

  <link rel="stylesheet" href="bootstrap/css/custom.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="plugins/morris/morris.css">


    <!-- Sweet Alert Css -->
    <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" />
  <!-- jvectormap -->
  <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">



  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <!-- <span class="logo-mini"><b>Y</b>Man</span> -->
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Yoke</b>US</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 4 messages</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- start message -->
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Support Team
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <!-- end message -->
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        AdminLTE Design Team
                        <small><i class="fa fa-clock-o"></i> 2 hours</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Developers
                        <small><i class="fa fa-clock-o"></i> Today</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Sales Department
                        <small><i class="fa fa-clock-o"></i> Yesterday</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Reviewers
                        <small><i class="fa fa-clock-o"></i> 2 days</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning"><?php echo $notification_result; ?></span>
            </a>
            <ul class="dropdown-menu">
              <?php 

                  if($notification_result > 0){
                    echo '<li class="header">You have '.$notification_result.' notification(s)</li>';
                  }else{
                    echo '<li class="header">You have No notification</li>';
                  }


              ?>
              
              <li>
                <!-- inner menu: contains the actual data -->
                

                 
                 <?php

                    if($notification_result > 0){

                      $html = '<ul class="menu">';

                      while($data = $result->fetch(PDO::FETCH_ASSOC)){

                        $date = date('F j, Y',$data['date_created']);


                        $item_type = $data['item_type'];

                        switch ($item_type) {
                          case 'New User':

                          $link = 'profile.php?id='.$data['item_id'].'&&notify_id='.$data['id'];
                          $type = 'New User Registration';
                            
                            break;

                          case 'New Review':

                          $link = 'review-details.php?id='.$data['item_id'].'&&notify_id='.$data['id'];
                          $type = 'New User Review';
                            
                            break;

                          
                        }


                        $html .= '<li>

                                   <a href="'.$link.'">
                                    <div class="pull-left">
                                      <img src="dist/img/avatar2.jpg" class="img-circle" alt="User Image">
                                    </div>
                                    <h4>
                                     '.$data['first_name'].'  '.$data['last_name'].'
                                      <small><i class="fa fa-clock-o"></i> '.$date.'</small>
                                    </h4>
                                    <p>'.mb_strimwidth($type, 0, 30, "...").'</p>
                                  </a>

                                  </li>';


                      }

                      $html .= '</ul>';




                    }

                    echo $html;


                   ?>
                  



                
              </li>
                <?php
                    if($notification_result > 0){
                      echo '<li class="footer"><a href="#">'.$notification_result.' Notification(s)</a></li>';
                    }else{

                      echo '<li class="footer"><a href="#">No Notification</a></li>';
                    }

               ?>
              
            </ul>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
          <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">9</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 9 tasks</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Create a nice theme
                        <small class="pull-right">40%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">40% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Some task I need to do
                        <small class="pull-right">60%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Make beautiful transitions
                        <small class="pull-right">80%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">80% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                </ul>
              </li>
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="dist/img/avatar2.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs">Admin</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="dist/img/avatar2.jpg" class="img-circle" alt="User Image">

                <p>
                  Admin
                  <small>Member since Nov. 2012</small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="../controllers/processors/logout.php?id=admin" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar" style="background-color: white !important;">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar" >
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/avatar2.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p style="color: black !important;">Admin</p>
          <a style="color: black !important;" href="#"><i  class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <!-- <form action="#" method="get"  class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li style="background-color: white !important;" class="header">MAIN NAVIGATION</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Users</span>
            <span class="pull-right-container">
              <i class="label label-primary pull-right">34</i>
            </span>
          </a>
          <ul class="treeview-menu white-bg treeview" >
            <li><a href="add-users"><i class="fa fa-circle-o"></i> Add Users</a></li>
            <li><a href="approved-users"><i class="fa fa-circle-o"></i> Approved Users</a></li>
            <li><a href="unapproved-users"><i class="fa fa-circle-o"></i> Un-Approved Users</a></li>
            <li><a href="verified-users"><i class="fa fa-circle-o"></i> Verified Users</a></li>
            <li><a href="unverified-users"><i class="fa fa-circle-o"></i> UnVerified Users</a></li>
          </ul>
        </li>
        <li class="treeview ">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Companies</span>
            <span class="pull-right-container">
              <i class="label label-primary pull-right">34</i>
            </span>
          </a>
          <ul class="treeview-menu white-bg">
            <li><a href="verified-companies"><i class="fa fa-circle-o"></i> Verified Companies</a></li>
            <li><a href="unverified-companies"><i class="fa fa-circle-o"></i> UnVerified Companies</a></li>
          </ul>
        </li>
        <li class="treeview ">
          <a href="add_services.php">
            <i class="fa fa-files-o"></i>
            <span>Add Services</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">4</span>
            </span>
          </a>
         </li>
         <li class="treeview ">
          <a href="add_categories.php">
            <i class="fa fa-files-o"></i>
            <span>Add Categories</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">4</span>
            </span>
          </a>
         </li>
         <li class="treeview ">
          <a href="add_categories.php">
            <i class="fa fa-files-o"></i>
            <span>Reviews</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">4</span>
            </span>
          </a>
          <ul class="treeview-menu white-bg">
            <li><a href="pending-reviews"><i class="fa fa-circle-o"></i> Pending Reviews</a></li>
            <li><a href="approved-reviews"><i class="fa fa-circle-o"></i> Approved Reviews</a></li>
          </ul>
         </li>

         <li class="">
          <a href="subscribers.php">
            <i class="fa fa-dashboard"></i> <span>Subscribers</span>
            <span class="pull-right-container">
              <i class="label label-primary pull-right">34</i>
            </span>
          </a>
          
        </li>
         
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>