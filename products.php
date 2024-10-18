<?php 
// Connect to the Database
// INSERT INTO `productdetails` (`productName`, `productCode`, `quantity`, `availability`) VALUES ('Computer', '23', '1', 'yes');
$insert = false;
$update = false;
$delete = false;

$servername = "localhost";
$username = "root";
$password = "";
$database = "products";

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Die if connection was not successful
if (!$conn){
    die("Sorry we failed to connect: ". mysqli_connect_error());
}

if(isset($_GET['delete'])){
  $productCode = $_GET['delete'];
  $delete = true;
  // echo $productCode;
  $sql = "DELETE FROM `productDetails` WHERE `productName` = '$productCode'";
  $result = mysqli_query($conn, $sql);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  if (isset( $_POST['productNameEdit'])){
    // Update the record
      $productName = $_POST["productNameEdit"];
      $productCode = $_POST["codeEdit"];
      $quantity = $_POST["quantityEdit"];
      $availability = $_POST["availEdit"];
      
  
    // Sql query to be executed
    $sql = "UPDATE `productDetails` SET `productName` = '$productName' , `productCode` = '$productCode',`quantity` = '$quantity', `availability` = '$availability' WHERE `productCode` = $productCode";
    $result = mysqli_query($conn, $sql);
    if($result){
      $update = true;
  }
  else{
      echo "We could not update the record successfully";
  }
}
else{
  $productName = $_POST["productName"];
    $productCode = $_POST["code"];
    $quantity = $_POST["quantity"];
    $avail = $_POST["avail"];

    // Sql query to be executed
    $sql = "INSERT INTO `productDetails` (`productName`, `productCode`,`quantity`, `availability`) VALUES ('$productName', '$productCode', '$quantity', '$avail')";
    $result = mysqli_query($conn, $sql);

  
    if($result){ 
        $insert = true;
    }
    else{
        echo "The record was not inserted successfully because of this error ---> ". mysqli_error($conn);
    } 
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SyncTrac Warehouse</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="style5.css">

</head>
<body>
<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit this Value</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="/product/products.php" method="POST">
        <div class="modal-body">
            <!-- <input type="hidden" name="productNameEdit" id="productNameEdit"> -->

            <div class="form-group">
            <label for="productName">Product Name</label>
            <input type="text" class="form-control" id="productNameEdit" name="productNameEdit" aria-describedby="emailHelp">
          </div>
    
          <div class="form-group">
            <label for="code">Product Code</label>
            <input type="text" class="form-control" id="codeEdit" name="codeEdit" aria-describedby="emailHelp">
          </div>

          <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="text" class="form-control" id="quantityEdit" name="quantityEdit" aria-describedby="emailHelp">
          </div>

          <div class="form-group">
            <label for="avail">Availability</label>
            <input type="text" class="form-control" id="availEdit" name="availEdit" aria-describedby="emailHelp">
          </div>
        </div>  
          <!-- <div class="form-group">
            <label for="desc">Note Description</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
          </div> -->
          <button type="submit" class="btn btn-primary">Add Value</button>
        
          <div class="modal-footer d-block mr-auto">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>



<?php
  if($insert){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> The Value has been inserted successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>

<?php
  if($delete){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> The record has been deleted successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
  <?php
  if($update){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> The record has been updated successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>

    <div class="container my-4">
        <h2>Products</h2>
        <form action="/product/products.php" method="POST">
          <div class="form-group">
            <label for="productName">Product Name</label>
            <input type="text" class="form-control" id="productName" name="productName" aria-describedby="emailHelp">
          </div>
    
          <div class="form-group">
            <label for="code">Product Code</label>
            <input type="text" class="form-control" id="code" name="code" aria-describedby="emailHelp">
          </div>

          <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="text" class="form-control" id="quantity" name="quantity" aria-describedby="emailHelp">
          </div>

          <div class="form-group">
            <label for="avail">Availability</label>
            <input type="text" class="form-control" id="avail" name="avail" aria-describedby="emailHelp">
          </div>
          <!-- <div class="form-group">
            <label for="desc">Note Description</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
          </div> -->
          <button type="submit" class="btn btn-primary">Add Value</button>
        </form>
      </div>

      <div class="container my-4">


<table class="table" id="myTable">
  <thead>
    <tr>
      <th scope="col">Product Name</th>
      <th scope="col">Product Title</th>
      <th scope="col">Quantity</th>
      <th scope="col">Availability</th>
      <th scope="col">Action</th>

    </tr>
  </thead>
  <tbody>
    <?php 
      $sql = "SELECT * FROM `productDetails`";
      $result = mysqli_query($conn, $sql);
  
      while($row = mysqli_fetch_assoc($result)){
        echo "<tr>
        <td>". $row['productName'] . "</td>
        <td>". $row['productCode'] . "</td>
        <td>". $row['quantity'] . "</td>
        <td>". $row['availability'] . "</td>

        <td> <button class='edit btn btn-sm btn-primary' id=".$row['productName'].">Edit</button> 
        <button class='delete btn btn-sm btn-primary' id=d".$row['productName'].">Delete</button>  </td>
      </tr>";
    } 
      ?>


  </tbody>
</table>
</div>

<div class="printBtn">
  <button onclick="printSpecificContent()">Print Report</button>
</div>

     <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#myTable').DataTable();

    });
  </script>

<script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");

        tr = e.target.parentNode.parentNode;
        productName = tr.getElementsByTagName("td")[0].innerText;
        code = tr.getElementsByTagName("td")[1].innerText;
        quantity = tr.getElementsByTagName("td")[2].innerText;
        avail = tr.getElementsByTagName("td")[3].innerText;

        console.log(productName, code, quantity, avail);
        productNameEdit.value = productName;
        codeEdit.value = code;
        quantityEdit.value = quantity;
        availEdit.value = avail;
        productNameEdit.value = e.target.id;
        console.log(e.target.id)
        $('#editModal').modal('toggle');
      })
    })

    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        productCode = e.target.id.substr(1,);

        if (confirm("Are you sure you want to delete this record!")) {
          console.log("yes");
          window.location = `/product/products.php?delete=${productCode}`;
          // TODO: Create a form and use post request to submit a form
        }
        else {
          console.log("no");
        }
      })
    })
  </script>  

  <!-- JavaScript function to trigger the print function for specific content -->
  <script>
        function printSpecificContent() {
            var contentToPrint = document.getElementById('myTable_wrapper').innerHTML;
            var originalContent = document.body.innerHTML;

            // Replace the entire content with the specific content
            document.body.innerHTML = contentToPrint;

            // Print the specific content
            window.print();

            // Restore the original content
            document.body.innerHTML = originalContent;
        }
    </script>
</body>
</html>