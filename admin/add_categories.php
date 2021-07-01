<?php
    require_once 'includes/header.php';

    require_once 'controllers/classes/category.class.php';

    $category = new Category;
    




?>
<!-- Default Size -->
            <div class="modal fade" id="basicExample" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <form role="form" action="controllers/processors/add_categories.php?type=add" method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Add Category</h4>
                        </div>
                        <div class="modal-body">
                            

                        
            
            
                        <!-- form start -->
                        
                          <div class="box-body">
                          <div class="form-group">
                              <label for="exampleInputEmail1">Name of Category</label>
                              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="E.g Automobile" name="category">
                            </div>
                            <div class="form-group">
                              <label>Descriprtion</label>
                              <textarea class="form-control" rows="3" placeholder="Enter ..." name="description"></textarea>
                            </div>


                            <div class="form-group">
                            <label for="exampleInputEmail1">Add a Category Image</label>
                            <input type="file" class="form-control" id="exampleInputEmail1" placeholder="Select Image" name="file">
                          </div>

                           <div class="form-group">
                            <label for="exampleInputEmail1">Add a Mobile Image</label>
                            <input type="file" class="form-control" id="exampleInputEmail1" placeholder="Select Image" name="file1">
                          </div>



                            </div>



                           
                

                


                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-info waves-effect">SUBMIT</button>
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>




            


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add Category
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Add Category</li>
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
                
                     <!-- Button trigger modal -->
                      <div align="right" class="pull-right">
                          <button type="button" class="btn btn-primary waves-effect m-r-20" data-toggle="modal" data-target="#basicExample"><span class="fa fa-plus"></span>&nbsp; Add Category</button>
                      </div>
              </h3>
          
            </div>
            <!-- /.box-header -->
            



           
           

          
          <div class="box-body">
          <?php echo $category->displayCategories(); ?>
        </div>


                            
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


<script type="text/javascript">

    $('.activate').click(function(e){

        id = $(this).attr('id');

        swal({
        title: "Are you sure?",
        text: "Are you sure you want to Activate this Category",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, Activate Category!",
        closeOnConfirm: false
    }, function () {
       window.location = 'controllers/processors/Category_status.php?type=activate&id='+id;
    });

    })


     $('.deactivate').click(function(e){

        id = $(this).attr('id');

        swal({
        title: "Are you sure?",
        text: "Are you sure you want to Deactivate this Category",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, Deactivate Category!",
        closeOnConfirm: false
    }, function () {
       window.location = 'controllers/processors/Category_status.php?type=deactivate&id='+id;
    });

    })


  

    $('.delete').click(function(e){

        id = $(this).attr('id');

        swal({
        title: "Are you sure?",
        text: "Are you sure you want to delete this Category",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false
    }, function () {
       window.location = 'controllers/processors/Category_status.php?type=delete&id='+id;
    });

    })


  
   
    

</script>







  </body>
</html>