<?php
include '../header.php';
include '../nav.php';
?>

<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Service Category</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Service Category</a></li>
              <li class="breadcrumb-item active">View</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <section class="content">
        <div class="container-fluid">
<?php
$db= dbConn();
$sql="SELECT * FROM tbl_personal_care_services_category LEFT JOIN tbl_personal_care_services_type ON tbl_personal_care_services_category.ServiceTypeId=tbl_personal_care_services_type.ServiceTypeId";
$result=$db->query($sql);

?>
            <table class="table table-striped" id="tbl_service_category">
                <thead class="bg bg-warning">
                    <tr>
                        <th>Service Category Id</th>
                        <th>Image</th>
                        <th>Service Type Name</th>
                        <th>Service Category Name</th>
                        <th>Description</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if($result->num_rows>0){
                        while ($row=$result->fetch_assoc()){
                            ?>
                    
                    <tr>
                        <td><?php echo $row['ServiceCategoryId']; ?></td>
                        <td><img class="img-fluid" width="80" src="<?php echo SITE_URL; ?>uploads/<?php echo $row['CategoryImage']; ?>"></td>
                        <td><?php echo $row['ServiceTypeName']; ?></td>
                        <td><?php echo $row['ServiceCategoryName']; ?></td>
                        <td><?php echo $row['Description']; ?></td>
                       
                    </tr>
                    
                    <?php
                    
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
</div>

<?php
include '../footer.php';
?>

<script>
     $(function () {

        $('#tbl_service_category').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
</script>
