<?php
    require_once 'includes/header.php';

    require_once 'controllers/classes/category.class.php';


    if(isset($_GET['id']) && !empty($_GET['id'])){

      $id = $_GET['id'];
      $sql1 = "SELECT id, name, path, description FROM categories WHERE id = $id";
      $result1 = $database->query($sql1)->fetch(PDO::FETCH_ASSOC);


    }else{
      error('An error occured. Please try again');
      go();
    }

    $category = new Category;



    $sql = "SELECT name, id, description FROM services WHERE active = 1 AND deleted = 0";
    $result = $database->query($sql);

?>




<!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/select2.min.css">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Categories
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit categories</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">


   


     
            

    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">
                
                    
              </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
              <div class="box-body">
                <form role="form" action="controllers/processors/add_category.php?type=edit" method="post" enctype="multipart/form-data">

                  <input type="hidden" name="service_id" value="<?php echo $id; ?>">

                <div class="form-group">
                              <label for="exampleInputEmail1">Name of Service</label>
                              <input type="text" value="<?php echo $result1['name']; ?>" class="form-control" id="exampleInputEmail1" placeholder="E.g Automobile" name="service">
                            </div>
                            
                            <div class="form-group">
                              <label>Descriprtion</label>
                            <textarea class="form-control" rows="3" placeholder="" name="description"><?php echo $result1['description'] ?></textarea>
                            </div>


                            <div class="form-group">
                            <label for="exampleInputEmail1">Add a Service Image</label>
                            <input type="file" class="form-control" id="exampleInputEmail1" placeholder="Select Image" name="file">
                          </div>

                          <div class="row margin-bottom" >
                            <div class="col-sm-6">
                              <img class="img-responsive" src="uploads/category/<?php echo $result1['path'] ?>" alt="Photo">
                            </div>
                          </div>
                

               

                        <div align="center">
                          <button class="btn btn-success" type="submit">Update</button>
                        </div>
                
                </form>
              </div>
              <!-- /.box-body -->

          </div>
          <!-- /.box -->

         

        </div>
        <!--/.col (left) -->
        
      </div>
      <!-- /.row -->
      

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php

    require_once 'includes/footer.php';
  
  ?>

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


  </body>
</html>