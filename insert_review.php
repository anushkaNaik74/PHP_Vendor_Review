<?php $con = mysqli_connect("localhost", "root", "Anushka@25", "pr_exam"); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reviews</title>
  </head>
  <body>
    <form method="post" enctype="multipart/form-data">
        <label>Parent Id</label>
        <input type="text" name="pr_vendor_review_parent_id" placeholder="Enter Parent Id" >
        <br><br>

        <label>Star</label>
        <input type="text" name="pr_vendor_review_star" placeholder="Enter Star" >
        <br><br>

        <label>Desc</label>
        <input type="text" name="pr_vendor_review_desc" placeholder="Enter Description" >
        <br><br>

        <label>Status</label>
        <input type="number" name="pr_vendor_review_status" placeholder="Enter Review Status" >
        <br><br>

        <input type="submit" name="submit" value="Submit">
    </form>
    <hr>
    <h3>Reviews</h3>
    <table style="width: 80%" border="1">
      <tr>
        <th>#s</th>
        <th>Parent Id</th>
        <th>Star</th>
        <th>Desc</th>
        <th>Status</th>
        <th>Operations</th>
  
      </tr>
      

      <?php
        
        $i = 1;
        $select_all_query = "SELECT * FROM pr_vendor_reviews";
        $select_all_query_sql = mysqli_query($con, $select_all_query);
        $count_select_all_query = mysqli_num_rows($select_all_query_sql);

        if($count_select_all_query  > 0){
          while ($row = $select_all_query_sql -> fetch_assoc()) {
            $id = $row['pr_vendor_review_id'];
      ?>

      <tr>
        <td><?php echo $i++ ?></td>
        <td><?php echo $row['pr_vendor_review_parent_id']?></td>
        <td><?php echo $row['pr_vendor_review_star']?></td>
        <td><?php echo $row['pr_vendor_review_desc']?></td>
        <td><?php echo $row['pr_vendor_review_status']?></td>
        <td>
          <a href="edit_review.php?id=<?php echo $id; ?>">Edit</a>
          <a href="delete_review.php?id=<?php echo $id; ?>" onclick = "return confirm('Are you sure?')">Delete</a>
        </td>

      </tr>

      <?php 
          }
        }
      ?>
      
    </table>
  </body>
</html>


<?php

    // Variables to store form data
    $parent_id = $star = $desc = $status = '';

    if(isset($_POST['submit'])){

        $parent_id = $_POST['pr_vendor_review_parent_id'];
        $star      = $_POST['pr_vendor_review_star'];
        $desc      = $_POST['pr_vendor_review_desc'];
        $status    = $_POST['pr_vendor_review_status'];

        
        // Insert data into the database
        $query = "INSERT INTO pr_vendor_reviews(
                                pr_vendor_review_parent_id, 
                                pr_vendor_review_star, 
                                pr_vendor_review_desc, 
                                pr_vendor_review_status
                            ) VALUES (
                                '$parent_id', 
                                '$star', 
                                '$desc', 
                                '$status'
                            )";



        if (mysqli_query($con, $query)) {
            echo'<script>alert("Review Uploaded Successfully");</script>';
            header('location: insert_review.php');
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($con);
        }
    
    }
?>
