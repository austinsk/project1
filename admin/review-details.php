<?php

   require_once 'includes/header.php';
   require_once 'controllers/classes/user.class.php';

   $user = new User;

   if(isset($_GET['id'])){

      $id = $_GET['id'];

      $sql = "SELECT r.review FROM reviews r WHERE id =".$id;

      $result = $database->query($sql)->fetch(PDO::FETCH_ASSOC);
   }




?>

 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Review
        <small>Review Details</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
       
        <li class="active">Review Details</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          

          <div class="box">
            <div class="box-header">
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-6">
                <div class="panel panel-primary ">

                <div class="panel-heading">
                 <h3 class="panel-title">Details</h3>
                </div>

                <div class="panel-body">
                  <div class="table-responsive">
                    <table class="table table-responsive table-bordered" >

                    <tr>


                    <td>adf</td>

                    <td>adf</td>


                    </tr>



                     <tr>


                    <td>adf</td>

                    <td>adf</td>


                    </tr>

                    

                    
                  </table>
                  </div>
                  
                </div>
                
              </div>
              </div>
              
              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php require_once 'includes/footer.php'; ?>

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


</body>
</html>

