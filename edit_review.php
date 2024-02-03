<?php $con = mysqli_connect("localhost", "root", "Anushka@25", "pr_exam");

if (!$con) {
    die('error in db' . mysqli_error($con));
}


// Variables to store form data
$review_id = $parent_id = $star = $desc = $status = '';

// Fetch data for editing when the page loads
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $check_query = "SELECT * FROM pr_vendor_reviews WHERE pr_vendor_review_id = $id";

    $check_query_sql = mysqli_query($con, $check_query);
    $count_check_query = mysqli_num_rows($check_query_sql);

    // $run = $db->query($qry);
    if ($count_check_query > 0) {
        $row = $check_query_sql->fetch_assoc();
        $review_id = $row['pr_vendor_review_id'];
        $parent_id = $row['pr_vendor_review_parent_id'];
        $star      = $row['pr_vendor_review_star'];
        $desc      = $row['pr_vendor_review_desc'];
        $status    = $row['pr_vendor_review_status'];
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Retrieve form fields
    $parent_id = $_POST['parent_id'];
    $star      = $_POST['star'];
    $desc      = $_POST['desc'];
    $status    = $_POST['status'];

    // Update data in the database
    $update_review_query = "UPDATE pr_vendor_reviews SET 
                                pr_vendor_review_parent_id = '$parent_id', 
                                pr_vendor_review_star      = '$star', 
                                pr_vendor_review_desc      = '$desc', 
                                pr_vendor_review_status    = '$status'
                                
                            WHERE pr_vendor_review_id = '$review_id'";

    
    if (mysqli_query($con, $update_review_query)) {
        echo'<script>alert("Review Updated Successfully");</script>';
        header('location: insert_review.php');
    } else {
        echo "Error: " . $update_review_query . "<br>" . mysqli_error($con);
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Review</title>
</head>
<body>
    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="review_id" value="<?php echo $review_id; ?>">
        
        <label>Parent Id</label>
        <input type="text" name="parent_id" value="<?php echo $parent_id ?>" >
        <br><br>

        <label>Star</label>
        <input type="text" name="star" value="<?php echo $star ?>" >
        <br><br>

        <label>Desc</label>
        <input type="text" name="desc" value="<?php echo $desc ?>" >
        <br><br>

        <label>Status</label>
        <input type="number" name="status" value="<?php echo $status ?>" >
        <br><br>

        <input type="submit" name="update" value="Update">
    </form>
</body>
</html>


