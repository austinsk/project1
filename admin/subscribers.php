<?php require_once 'includes/header.php'; 
      require_once 'controllers/classes/user.class.php';

      $user = new User;
?>

 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Users
        <small>subscribers users</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="dashoard"><i class="fa fa-dashboard"></i> Home</a></li>
        
        <li class="active">subscribed users</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">All subscribed Users</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             <?php echo $user->viewSubscribers(); ?>
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

    $('.unverify').click(function(e){

        id = $(this).attr('id');

        swal({
        title: "Are you sure?",
        text: "Are you sure you want to Cancel this Users Verification",
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


</body>
</html>

