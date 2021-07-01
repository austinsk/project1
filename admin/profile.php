<?php

 require_once 'includes/header.php';
 require_once 'controllers/classes/profile.class.php';
 require_once '../controllers/classes/misc.php';
 require_once 'controllers/classes/notification.class.php';

  

 $notification = new Notification;

 $profile = new Profile; 


if(isset($_GET['id'])){

  $id = $_GET['id'];

   $profile->fetchCountry();
  $profile->fetchProfile($id);

  


   if($profile->profile->pic_set == 1){

          $image = '../'.$profile->profile->thumb;

  }else{
    $image = 'dist/img/avatar2.jpg';
  }



}

if(isset($_GET['notify_id']) && !empty($_GET['notify_id'])){

  $notify_id = $_GET['notify_id'];

  $notify_status = $notification->removeNotification($notify_id);

}


$sql = "SELECT name, id FROM categories WHERE active = 1 AND deleted = 0";
    $category = $database->query($sql);


?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User Profile
      </h1>
      <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        
        <li class="active">User profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="<?php echo $image; ?>" alt="User profile picture">

              <h3 class="profile-username text-center"><?php echo ucfirst($profile->profile->first_name); echo ' ';  echo ucfirst($profile->profile->last_name);  ?></h3>

              <p class="text-muted text-center"><?php echo $profile->profile->email; ?></p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Followers</b> <a class="pull-right">1,322</a>
                </li>
                <li class="list-group-item">
                  <b>Following</b> <a class="pull-right">543</a>
                </li>
                <li class="list-group-item">
                  <b>Friends</b> <a class="pull-right">13,287</a>
                </li>
              </ul>

              <?php

                if($profile->profile->verified == 1){
                  echo '<button type="button" class="btn btn-warning btn-block unverify" id="'.$id.'"><b>Unverify User</b></button>';
                }else{
                  echo '<button type="button" class="btn btn-success btn-block verify" id="'.$id.'"><b>Verify User</b></button>';
                }

               ?>

              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">About Me</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i> Education</strong>

              <p class="text-muted">
                B.S. in Computer Science from the University of Tennessee at Knoxville
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

              <p class="text-muted">Malibu, California</p>

              <hr>

              <strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>

              <p>
                <span class="label label-danger">UI Design</span>
                <span class="label label-success">Coding</span>
                <span class="label label-info">Javascript</span>
                <span class="label label-warning">PHP</span>
                <span class="label label-primary">Node.js</span>
              </p>

              <hr>

              <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>

              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#profile" data-toggle="tab">Profile</a></li>
              <li><a href="#contact" data-toggle="tab">Contact Info</a></li>
              <li><a href="#avatar" data-toggle="tab">Avatar</a></li>
              <li><a href="#servicer" data-toggle="tab">Services</a></li>
            </ul>
            <div class="tab-content">



           
              

              <div class="tab-pane active" id="profile">
                <form role="form" action="controllers/processors/update-profile.php" method="post">

                  <input type="hidden" value="<?php echo $id; ?>" name="user_id">

                 

                    <div class="form-group">
                        <label class="control-label">First Name</label>
                        <input value="<?php echo $profile->profile->first_name; ?>" type="text" name="first_name" placeholder="First Name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Last Name</label>
                        <input value="<?php echo $profile->profile->last_name; ?>" type="text" name="last_name" placeholder="Last Name" class="form-control">
                    </div>
                    <!-- <div class="form-group">
                        <label class="control-label">Nationality</label>
                        <select name="nationality" class="form-control">
                            <option value="" >Select Country</option>

                            <?php if($profile->country->rowcount() > 0){
                                            $country2 = '';
                                            
                                            while ($data = $profile->country->fetch(PDO::FETCH_OBJ)){
                                                $selected = '';
                                                if($profile->profile->nationality == $data->id){
                                                    $selected = ' selected="selected" ';
                                                }
                                                $selected2 = '';
                                                if ($profile->profile->country_of_residence == $data->id) {
                                                    $selected2 = ' selected="selected" ';
                                                }
                                                $country2 .= '<option ' .$selected2. ' value="'.$data->id.'">'.$data->name.'</option>';
                                                
                                                echo '<option ' .$selected. ' value="'.$data->id.'">'.$data->name.'</option>';
                                            };


                            }  ?>
                        </select> 
                        
                    </div> -->

                    <input type="hidden" name="type" value="personal">

                    <div class="form-group ">
                        <label class="control-label">Enter Bio</label>
                        <textarea  class="form-control" rows="3" name="bio" placeholder="Bio..."><?php echo $profile->profile->bio; ?></textarea>
                    </div>
                
                    <div class="margiv-top10">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Save Changes </button>
                    </div>
                </form>
              </div>
              <!-- /.tab-pane -->



                <div class="tab-pane " id="contact">
                <form class="form-hizontal" action="controllers/processors/update-profile.php" method="post">
                  <input type="hidden" value="<?php echo $id; ?>" name="user_id">

                  <input type="hidden" name="type" value="contact">

                   <div class="form-group col-md-6">
                      <label class="control-label">Email Address</label>
                      <input value="<?php echo $profile->profile->email;?>" disabled="disabled" type="email" placeholder="Email Address" class="form-control">
                  </div>
                  <div class="form-group col-md-6">
                      <label class="control-label">Phone Number</label>
                      <input value="<?php echo $profile->profile->phone1; ?>" type="text" name="phone1" placeholder="Phone Number" class="form-control">
                  </div>
                  <div class="form-group col-md-6">
                      <label class="control-label">Phone Number 2</label>
                      <input value="<?php echo $profile->profile->phone2; ?>" type="text" name="phone2" placeholder="Phone Number 2" class="form-control">
                  </div> 


                  <div class="map_canvas hidden"></div>

                    <div class="form-group col-md-6">
                        <label class="control-label">City of Residence</label>
                        <input  value="<?php echo $profile->profile->city_of_residence; ?>" id="geocomplete" type="text" name="city_of_residence" placeholder="City of Residence" class="form-control">
                    </div>

                    <input name="formatted_address" class="hidden" type="text" value="<?php echo $profile->profile->work_address2; ?>">
                    <input name="lat" class="hidden" type="text" value="<?php echo $profile->profile->work_lat; ?>">
                    <input name="lng" class="hidden" type="text" value="<?php echo $profile->profile->work_lng; ?>">
                  
                 
                  <!-- <div class="form-group col-md-6">
                      <label class="control-label">Country of Residence</label>
                      <select class="form-control" name="country_of_residence" id="country">
                          <option value="" >Select Country</option>
                          <?php echo $country2;
                          ?>
                      </select>
                      <input type="hidden" name="type" value="contact">
                  </div> -->

                  <!-- <div class="form-group col-md-6">
                    <label class="control-label">State of Residence</label>
                    <select class="form-control" name="state_of_residence" id="state1">
                        <option value="">Select State</option>

                        <?php 
                        if (!empty($profile->profile->country_of_residence) && !empty($profile->profile->state_of_residence)){

                             $state = Misc::fetchStates($profile->profile->country_of_residence);
                            while ($data = $state->fetch(PDO::FETCH_ASSOC)){
                                            $selected = '';
                                            if($profile->profile->state_of_residence == $data['id']){
                                                $selected = ' selected="selected" ';
                                            }
                                            echo '<option ' .$selected. ' value="'.$data['id'].'">'.$data['name'].'</option>';
                                        };
                        }
                       


                        ?>


                    </select>
                </div> -->
                 <!-- <div class="form-group col-md-6">
                      <label class="control-label">City of Residence</label>
                      <select class="form-control" name="city_of_residence" id="city1">
                          <option value="">Select City</option>

                          <?php 
                          if (!empty($profile->profile->state_of_residence) && !empty($result2['city_of_residence'])){

                               $state = Misc::fetchCity($result2['state']);
                              while ($data = $state->fetch(PDO::FETCH_ASSOC)){
                                              $selected = '';
                                              if($profile->profile->city_of_residence == $data['id']){
                                                  $selected = ' selected="selected" ';
                                              }
                                              echo '<option ' .$selected. ' value="'.$data['id'].'">'.$data['name'].'</option>';
                                          };
                          }
                         


                          ?>


                      </select>
                  </div> -->
                <div class="form-group col-md-12">
                    <label class="control-label">Home Address</label>
                    <textarea  class="form-control" rows="3" name="address" placeholder="Home Address..."><?php echo $profile->profile->address; ?></textarea>
                </div>
                <div class="clearfix"></div>
                  
                
               
                  
                  <div class="form-group">
                    <div class="" align="center">
                      <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i>Submit</button>
                    </div>
                  </div>
                  <div class="clearfix"></div>
                </form>
              </div>
              <!-- /.tab-pane -->


              <!-- AVATAR TAB -->
              <div class="tab-pane fade" id="avatar">

                <form class="clearfix" action="controllers/processors/update-profile" method="post" enctype="multipart/form-data">
                  <div class="form-group">

                    <div class="row">

                      <div class="col-md-3 col-sm-4">

                        <div class="thumbnail">
                          <img class="img-responsive" src="<?php echo $image; ?>" alt="" />
                        </div>

                      </div>

                      <div class="col-md-9 col-sm-8">

                        <div class="sky-form nomargin">
                          <label class="label">Select File</label>
                          <label for="file" class="input input-file">
                            <div class="button">
                              <input type="file" id="file" name="file" onchange="this.parentNode.nextSibling.value = this.value">Browse
                            </div>
                          </label>
                        </div>
                        <input type="hidden" value="<?php echo $id; ?>" name="user_id">
                        <input type="hidden" name="type" value="photo">
                      <!-- </ins> -->

                        

                        

                      </div>

                    </div>

                  </div>

                  <div class="margiv-top10">
                    <button type="submit" class="btn btn-primary">Save Changes </button>
                    <a href="#" class="btn btn-default">Cancel </a>
                  </div>

                </form>

              </div>
            <!-- /AVATAR TAB -->


            <div class="tab-pane fade" id="servicer">

                <form role="form" action="controllers/processors/add-user-service.php" method="post">

                 <div class="fancy-form fancy-form-select col-md-4"><!-- select2 -->
                  <select class="form-control " id="category" name="category">
                    <option value="">--- Select Category Type ---</option>
                    <?php if($category->rowcount() > 0){

                        $categories = '';
                      while($data1 = $category->fetch(PDO::FETCH_ASSOC)){

                        $categories .= '<option value="'.$data1['id'].'">'.$data1['name'].'</option>';


                      }

                      echo $categories;


                    } ?>
                    
                    
                    
                  </select>

                  <i class="fancy-arrow-double"></i>
                </div><!-- /select2 -->

                <input type="hidden" name="user_id" value="<?php echo $id; ?>">
               

                <div class="fancy-form fancy-form-select col-md-4" ><!-- select2 -->
                  <select class="form-control " name="service" id="service">
                    <option value="">--- Select Service ---</option>
                    
                    
                    
                  </select>

                  <i class="fancy-arrow-double"></i>
                </div><!-- /select2 -->

                

                <div class="fancy-form col-md-4"><!-- textarea -->
                  <textarea rows="2" name="description" class="form-control word-count" data-maxlength="200" data-info="textarea-words-info" placeholder="Briefly Describe Your Service..."></textarea>

                </div><!-- /textarea -->


                <div align="center">

                  <button class="btn btn-primary" type="submit">Add Service</button>
                  
                </div>

                <div class="clearfix"></div>

                </form>

                <hr>
                <div class="col-md-12">
                  <div class="box box-primary ">
                    <div class="box-header with-border">
                      

                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                      </div>
                      <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        

                        <?php $profile->displayUserServices($id); ?>
                        
                        
                      </div>
                    <!-- /.box-body -->
                  </div>
                  <!-- /.box -->
              </div>

              <div class="clearfix"></div>
              


              </div>
              <!-- SERVICE TAB -->



             



            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php require_once 'includes/footer.php'; ?>


  <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDdw262adSCagHNxfzDIi4UTKC1fI4cCE8&v=3&libraries=places"></script>
<script src="../geocomplete-master/examples/jquery.geocomplete.js"></script>

 <script>
      $(function(){
        $("#geocomplete").geocomplete({
          map: ".map_canvas",
          details: "form",
          types: ["geocode", "establishment"],
        });

        // $("#find").click(function(){
        //   $("#geocomplete").trigger("geocode");
        // });
      });
    </script>

  <!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>


<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>
<!-- Select2 -->
<script src="plugins/select2/select2.full.min.js"></script>
<script type="text/javascript">
  
  $(".select2").select2();
</script>

  <script type="text/javascript">
    $(document).ready(function() {
        


         $('#category').change(function(){
            var value = $(this).val();

       
                                $.ajax({
                                   url: '../controllers/ajax/fetch-service.php',
                                   data: {
                                      category_id:value
                                   },
                                   type: 'POST', 
                                  // dataType: 'json',
                                   
                                   success: function(data) {
                                  
                                     $('#service').html(data);
                                   },
                                   
                                });

                     })



           $('#country').change(function(){
            var value = $(this).val();
       
                                $.ajax({
                                   url: '../controllers/ajax/fetch-states.php',
                                   data: {
                                      country_id:value
                                   },
                                   type: 'POST', 
                                  // dataType: 'json',
                                   
                                   success: function(data) {
                                     $('#state1').html(data);
                                   },
                                   
                                });

                     })




          $('#state1').change(function(){
            var value = $(this).val();

      // alert(value);
                                $.ajax({
                                   url: '../controllers/ajax/fetch-city.php',
                                   data: {
                                      state_id:value
                                   },
                                   type: 'POST', 
                                  // dataType: 'json',
                                   
                                   success: function(data) {
                                    //alert(data);
                                    $('#city1').html(data);
                                   },
                                   
                                });

                     })

})


        

</script>

  <script type="text/javascript">

    $('.verify').click(function(e){

        id = $(this).attr('id');

        swal({
        title: "Are you sure?",
        text: "Are you sure you want to Verify this User",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, Verify user!",
        closeOnConfirm: false
    }, function () {
       window.location = 'controllers/processors/verify_user.php?id='+id;
    });

    })


     $('.unverify').click(function(e){

        id = $(this).attr('id');

        swal({
        title: "Are you sure?",
        text: "Are you sure you want to Unverify this User",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, Unverify user!",
        closeOnConfirm: false
    }, function () {
       window.location = 'controllers/processors/unverify_user.php?id='+id;
    });

    })


  

    $('.delete').click(function(e){

        id = $(this).attr('id');

        swal({
        title: "Are you sure?",
        text: "Are you sure you want to delete this Title",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false
    }, function () {
       window.location = '../controllers/processors/delete-job-title.php?id='+id;
    });

    })


  
   
    

</script>


