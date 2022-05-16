<?php
include '../header.php';
include '../nav.php';
?>

<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Items</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Items</a></li>
              <li class="breadcrumb-item active">View</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
<?php
$db= dbConn();
$sql="SELECT * FROM tbl_items "
        . "LEFT JOIN tbl_items_title ON tbl_items.ItemTitleId=tbl_items_title.ItemTitleId "
        . "LEFT JOIN tbl_items_type ON tbl_items.ItemTypeId=tbl_items_type.ItemTypeId "
        . "LEFT JOIN tbl_items_category ON tbl_items.ItemCategoryId=tbl_items_category.ItemCategoryId "
        . "LEFT JOIN tbl_items_brand ON tbl_items.ItemBrandId=tbl_items_brand.ItemBrandId "
        . "LEFT JOIN tbl_items_color ON tbl_items.ItemColorId=tbl_items_color.ItemColorId" ;
$result=$db->query($sql);

?>
            <table class="table table-striped" id="tbl_item">
                <thead class="bg bg-warning">
                    <tr>
                        <th>Item Id</th>
                        <th>Item Image</th>
                        <th>Item Name</th>
                        <th>Item Title</th>
                        <th>Item Type</th>
                        <th>Item Category</th>
                        <th>Item Brand</th>
                        <th>Color</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Qty</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if($result->num_rows>0){
                        while ($row=$result->fetch_assoc()){
                            ?>
                    
                    <tr>
                        <td><?php echo $row['ItemId']; ?></td>
                        <td><?php echo $row['ItemImage']; ?></td>
                        <td><?php echo $row['ItemName']; ?></td>
                        <td><?php echo $row['ItemTitleName']; ?></td>
                        <td><?php echo $row['ItemTypeName']; ?></td>
                        <td><?php echo $row['ItemCategoryName']; ?></td>
                        <td><?php echo $row['ItemBrand']; ?></td>
                        <td><?php echo $row['ItemColor']; ?></td>
                        <td><?php echo $row['Price']; ?></td>
                        <td><?php echo $row['Description']; ?></td>
                        <td><?php echo $row['Qty']; ?></td>
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
//        $("#example1").DataTable({
//            "responsive": true, "lengthChange": false, "autoWidth": false,
//            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
//        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#tbl_item').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
</script>
