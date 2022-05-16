<?php
//extract($_POST);
//print_r($Subject);
include 'system/function.php';
extract($_POST);
if (!isset($category)) {
    global $category;
//    $category=array('1','4','5','10','11','12','13');
}
if (!isset($color)) {
    global $color;
//    $color=array('1','2','3','4','5');
}
$where = null;
if (!isset($size)) {
    global $size;
//    $size=array('1','2','3');
}


//print_r($s);
if (!empty($category)) {
    $s = "'" . implode("','", $category) . "'";
    $where .= " ItemCategoryId IN($s) AND";
}
if (!empty($color)) {
    $i = "'" . implode("','", $color) . "'";
    $where .= " ItemColorId IN($i) AND";
}
if (!empty($size)) {
    $t = "'" . implode("','", $size) . "'";
    $where .= " ItemSizeId IN($t) AND";
}
if (!empty($where)) {
    $where = substr($where, 0, -3);
    $where = " WHERE $where";
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "add_item") {
    $db= dbConn();
    $sql="SELECT * FROM tbl_items INNER JOIN tbl_stock ON tbl_items.ItemId=tbl_stock.ItemId WHERE ItemId='$ItemId'";
            $result=$db->query($sql);
            while($row=$result->fetch_assoc()){
                
          
            
            $ItemId=$row['ItemId'];
            $ItemName=$row['ItemName'];
            $Price=$row['Price'];
            $ItemImage=$row['ItemImage'];
            $qty=1;
            
            $cart=array($ItemId=>array("ItemId"=>$ItemId,"ItemName"=>$ItemName,"Price"=>$Price,"ItemImage"=>$ItemImage,"qty"=>$qty));
            
            if(!isset($_SESSION['shopping_cart'])){
               $_SESSION['shopping_cart']=$cart;
            } else {
                //array eke keys variable ekata.index array ekak out karanawa indexed array ekak widiyata
                $array_keys = array_keys($_SESSION["shopping_cart"]);
                if(in_array($ItemId, $array_keys)){
                  echo "Product is already exist..!";
              } else {
                  //array merge...increment wage..i++
                  $_SESSION['shopping_cart']+=$cart;
                  echo 'Product added to cart';
                   
              }


            }
            }
}

//print_r($i);

$db = dbConn();
echo $sql = "SELECT * FROM tbl_items LEFT JOIN tbl_stock ON tbl_items.ItemId=tbl_stock.ItemId $where";

$result = $db->query($sql);

//echo "Found" . $result->num_rows;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        ?>
        <div class="col mb-3">
            <div class="card" style="width: 18rem;">
                <img class="img-fluid" src="system/uploads/<?php echo $row['ItemImage']; ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $row['ItemName']; ?></h5>
                    <a href="clothesMoreInformation.php" class="btn btn-warning">View More..</a>

                </div>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <input type="text" name="ItemId" value="<?php echo $row['ItemId']; ?>">
                    <button type="submit" name="action" value="add_item" class="btn btn-default bg-warning">Buy Now</button>
                </form>
            </div>
        </div>


        <?php
    }
}
?>
 


