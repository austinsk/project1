<?php
    require_once 'includes/header.php';

    require_once 'controllers/classes/service.class.php';

    $service = new Service;



    $sql = "SELECT name, id FROM categories WHERE active = 1 AND deleted = 0";
    $result = $database->query($sql);

?>

<!-- Default Size -->
            <div class="modal fade" id="basicExample" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <form role="form" action="controllers/processors/add_service.php?type=add" method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Add Service</h4>
                        </div>
                        <div class="modal-body">
                            

                        
            
            
                        <!-- form start -->
                        
                          <div class="box-body">

                          <div class="form-group">
                            <label for="exampleInputEmail1">Add Your Service</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Service" name="service">
                          </div>


                           <div class="form-group">
                            <label>Choose Category</label>
                            <select name="category" class="form-control select2" style="width: 100%">
                              <option>-- Select Category --</option>

                              <?php

                                  $categories = '';
                                while($data = $result->fetch(PDO::FETCH_ASSOC)){

                                  $categories  .= '<option value="'.$data['id'].'">'.$data['name'].'</option>';

                                }

                                echo $categories;
                              
                              
                              ?>
                              
                            </select>
                          </div>

                           <div class="form-group">
                              <label>Descriprtion</label>
                            <textarea class="form-control" rows="3" placeholder="" name="description"></textarea>
                            </div>

                          <div class="form-group">
                            <label for="exampleInputEmail1">Add a Service Image</label>
                            <input type="file" class="form-control" id="exampleInputEmail1" placeholder="Select Image" name="file">
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


<!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/select2.min.css">

   <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Blank page
        <small>it all starts here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Title</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">

         <form role="form" action="controllers/processors/test.php" method="post" enctype="multipart/form-data">
<div class="form-group">
                            <label for="exampleInputEmail1">Add a Service Image</label>
                            <input type="file" class="form-control" id="exampleInputEmail1" placeholder="Select Image" name="file">
                          </div>

                          <button type="submit">Save</button>
 </form>


        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          Footer
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

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


<script type="text/javascript">

    $('.activate').click(function(e){

        id = $(this).attr('id');

        swal({
        title: "Are you sure?",
        text: "Are you sure you want to Activate this Service",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, Activate Service!",
        closeOnConfirm: false
    }, function () {
       window.location = 'controllers/processors/service_status.php?type=activate&id='+id;
    });

    })


     $('.deactivate').click(function(e){

        id = $(this).attr('id');

        swal({
        title: "Are you sure?",
        text: "Are you sure you want to Deactivate this Service",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, Deactivate Service!",
        closeOnConfirm: false
    }, function () {
       window.location = 'controllers/processors/service_status.php?type=deactivate&id='+id;
    });

    })


  

    $('.delete').click(function(e){

        id = $(this).attr('id');

        swal({
        title: "Are you sure?",
        text: "Are you sure you want to delete this Service",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false
    }, function () {
       window.location = 'controllers/processors/service_status.php?type=delete&id='+id;
    });

    })


  
   
    

</script>


  </body>
</html>