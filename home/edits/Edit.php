<?php

include "dbConn.php"; // Using database connection file here

$id = $_GET['id']; // get id through query string


$qry = mysqli_query($mysqli,"select * from image where id='$id'"); // select query


$data = mysqli_fetch_array($qry); // fetch data

if(isset($_POST['update'])) // when click on Update button
{
    $datum = $_POST['datum'];
    $image_text = $_POST['image_text'];
    $image_title = $_POST['image_title'];


    
    $edit = mysqli_query($mysqli,"update image set datum='$datum', image_text='$image_text', image_title= '$image_title' where id='$id'");
    
    if($edit)
    {
        mysqli_close($mysqli); // Close connection
        header("location:index.php"); // redirects to all records page
        exit;
    }
    else
    {
        echo mysqli_error();
    }       
}

?>

<h3>Update Data</h3>

<form method="POST" action="index.php">
    <input type="text" name="id" value="<?php echo($id)  ?> "> 
  <input type="text" name="datum" value="<?php echo $data['datum'] ?>" placeholder="YYYY-MM-DD" Required>
  <input type="text" name="image_text" value="<?php echo $data['image_text'] ?>" placeholder="Enter image text" Required>
    <input type="text" name="image_title" value="<?php echo $data['image_title'] ?>" placeholder="Enter image title" Required>
  <input type="submit" name="update" value="Update">
</form>