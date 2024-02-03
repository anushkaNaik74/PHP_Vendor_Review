<?php
$con = mysqli_connect("localhost", "root", "Anushka@25", "pr_exam");
if (!$con) {
    die('error in db' . mysqli_error($con));
}

$id = $_GET['id'];

$delete_review_query = "DELETE FROM pr_vendor_reviews WHERE pr_vendor_review_id = $id";

if (mysqli_query($con, $delete_review_query)) {
    echo '<script>alert("Review Deleted Successfully");</script>';
    header('location: insert_review.php');
} else {
    echo mysqli_error($con);
}
?>
