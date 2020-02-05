<?php
  // Create database connection
  $mysqli = mysqli_connect("localhost", "root", "", "edits");




  // Get the total number of records from our table "students".
$total_pages = $mysqli->query('SELECT * FROM image')->num_rows;

// Check if the page number is specified and check if it's a number, if not return the default page number which is 1.
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

// Number of results to show on each page.
$num_results_on_page = 10;

if ($stmt = $mysqli->prepare('SELECT * FROM image ORDER BY datum DESC LIMIT ?,?')) {
  // Calculate the page to get the results we need from our table.
  $calc_page = ($page - 1) * $num_results_on_page;

  //echo "fahsjkfhkashdkfj: " . $calc_page;

//echo "SELECT * FROM image ORDER BY datum LIMIT $calc_page,$num_results_on_page";


  $stmt->bind_param('ii', $calc_page, $num_results_on_page);
  $stmt->execute(); 
  // Get the results...
  $result = $stmt->get_result();

  // Initialize message variable
  $msg = "";

  // If upload button is clicked ...
  if (isset($_POST['upload'])) {
  	// Get image name
  	$image = $_FILES['image']['name'];
  	// Get text
  	$image_text = mysqli_real_escape_string($mysqli, $_POST['image_text']);
    $image_title = mysqli_real_escape_string($mysqli, $_POST['image_title']);
    $datum = mysqli_real_escape_string($mysqli, $_POST['datum']);
  	// image file directory
  	$target = "images/".basename($image);

  	$sql = "INSERT INTO image (image, image_text, datum, image_title) VALUES ('$image', '$image_text', '$datum', '$image_title')";
  	// execute query
  	mysqli_query($mysqli, $sql);

  	if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
  		$msg = "Image uploaded successfully";
  	}else{
  		$msg = "Failed to upload image";
  	}
  }

?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="style.css">
  <script src="https://kit.fontawesome.com/6662e2c3eb.js" crossorigin="anonymous"></script>
      <link href="https://fonts.googleapis.com/css?family=Supermercado+One%7CLobster%7CLakki+Reddy&display=swap" rel="stylesheet">
<title>Image Upload</title>
<style type="text/css">
   
   #content{
   	width: 50%;
   	margin: 170px auto;
   	border: 1px solid #cbcbcb;
    color: black;
    background-color: yellow;
   }

   #content p{
    font-size: 25px;
   }
 
   form{
   	width: 50%;
   	margin: 20px auto;
   }
   form div{
   	margin-top: 5px;
   }
   #img_div{
   	width: 80%;
   	padding: 5px;
   	margin: 15px auto;
   	border: 1px solid #cbcbcb;
   }
   #img_div:after{
   	content: "";
   	display: block;
   	clear: both;
   }
   img{
   	float: left;
   	margin: 5px;
   	width: 200px;
   	height: 200px;
   }
#balk {
position: absolute;
width: 80%;
height: 15%;
top: 5%;
left: 5%;
padding-right: 5%;
padding-left: 5%;
}

#balk div{
  float: left;
  background-color: yellow;
  border: 5px solid black;
  height: 60%;
  width: 15%;
  position: relative;
  top: 5%;
  margin-left: 5%;
  padding-left: 1%;
  padding-right: 1%;
  font-family: 'Lakki Reddy', cursive;
  transition: 0.3s;
}

#balk a{
  text-decoration: none;
  color: black;

  transition: 0.3s;
}


#balk div:hover{
  background-color: black;
  transition: 0.3s;

}

#balk div a:hover{
  color: yellow;
    scale: 1.2;
    transition: 0.3s;
}

#balk a{
position: relative;
display: flex;
justify-content: center;
top: 15%;
font-size: 50px;
}

#about{
    position: absolute;
  left: 364px;
  top: 160px;
  text-decoration: underline;
}
.Bravo{
  position: absolute;
  right: -680px;
  height: 450px;
  top: 14px;
 
}
#about_text{
  position: absolute;
  font-size: 22px;
  text-align: center;
  left: 51px;
  top: 220px;
}
.Vlag{
  position: absolute;
  top: -237px;
  right: -755px;
}
#logo{
  position: absolute;
  width: 100px;
  left: 60px;
  top: 25px;
  
}

body {
 background-image: url("johnnybravo.jpg");
 background-repeat: repeat;
  
}






.pagination {
        list-style-type: none;
        padding: 10px 0;
        display: inline-flex;
        justify-content: space-between;
        box-sizing: border-box;
      }
      .pagination li {
        box-sizing: border-box;
        padding-right: 10px;
      }
      .pagination li a {
        box-sizing: border-box;
        background-color: #e2e6e6;
        padding: 8px;
        text-decoration: none;
        font-size: 12px;
        font-weight: bold;
        color: #616872;
        border-radius: 4px;
      }
      .pagination li a:hover {
        background-color: #d4dada;
      }
      .pagination .next a, .pagination .prev a {
        text-transform: uppercase;
        font-size: 12px;
      }
      .pagination .currentpage a {
        background-color: #518acb;
        color: #fff;
      }
      .pagination .currentpage a:hover {
        background-color: #518acb;
      }

      .post{
        background-color: yellow;
      }

</style>
</head>
<body>
<div id="content">


    <?php 

  $mysqli = mysqli_connect("localhost", "root", "", "edits");

  // If upload button is clicked ...
  if (isset($_POST['upload'])) {
    // Get image name
    $image = $_FILES['image']['name'];
    // Get text
    $image_text = mysqli_real_escape_string($mysqli, $_POST['image_text']);
    $image_title = mysqli_real_escape_string($mysqli, $_POST['image_title']);
    $datum = $_POST['datum'];

    // image file directory
    $target = "images/".basename($image);

    $sql = "INSERT INTO (datum, image_text, image_title) VALUES ($datum, '$image_text', '$image_title')";
    // execute query
    mysqli_query($mysqli, $sql);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
      $msg = "Image uploaded successfully";
    }else{
      $msg = "Failed to upload image";
    }
  }
 // $result = mysqli_query($mysqli, "SELECT * FROM image");

  include "dbConn.php"; // Using database connection file here

function updateemployee() {
  global $mysqli;
  $image = $_FILES['image']['name'];
  $datum = $_POST['datum'];
  $image_text = $_POST['image_text']; 
  $id = $_POST['id'];
  $image_title = $_POST['image_title'];
  $query = "UPDATE image SET datum = '$datum', image_text = '$image_text', image_title = '$image_title'  WHERE id = '$id'";
  mysqli_query($mysqli, $query);
  header('location:http://localhost/home/edits/ ');
}

if (isset($_POST['update'])) {
 updateemployee();
}
// echo "<script>console.log('dit lukt: 292');</script>";


 if (ceil($total_pages / $num_results_on_page) > 0): ?>
      <ul class="pagination">
        <?php if ($page > 1): ?>
        <li class="prev"><a href="index.php?page=<?php echo $page-1 ?>">Prev</a></li>
        <?php endif; ?>

        <?php if ($page > 3): ?>
        <li class="start"><a href="index.php?page=1">1</a></li>
        <li class="dots">...</li>
        <?php endif; ?>

        <?php if ($page-2 > 0): ?><li class="page"><a href="index.php?page=<?php echo $page-2 ?>"><?php echo $page-2 ?></a></li><?php endif; ?>
        <?php if ($page-1 > 0): ?><li class="page"><a href="index.php?page=<?php echo $page-1 ?>"><?php echo $page-1 ?></a></li><?php endif; ?>

        <li class="currentpage"><a href="index.php?page=<?php echo $page ?>"><?php echo $page ?></a></li>

        <?php if ($page+1 < ceil($total_pages / $num_results_on_page)+1): ?><li class="page"><a href="index.php?page=<?php echo $page+1 ?>"><?php echo $page+1 ?></a></li><?php endif; ?>
        <?php if ($page+2 < ceil($total_pages / $num_results_on_page)+1): ?><li class="page"><a href="index.php?page=<?php echo $page+2 ?>"><?php echo $page+2 ?></a></li><?php endif; ?>

        <?php if ($page < ceil($total_pages / $num_results_on_page)-2): ?>
        <li class="dots">...</li>
        <li class="end"><a href="index.php?page=<?php echo ceil($total_pages / $num_results_on_page) ?>"><?php echo ceil($total_pages / $num_results_on_page) ?></a></li>
        <?php endif; ?>

        <?php if ($page < ceil($total_pages / $num_results_on_page)): ?>
        <li class="next"><a href="index.php?page=<?php echo $page+1 ?>">Next</a></li>
        <?php endif; ?>
      </ul>
      <?php endif; ?>
    </body>
  </html>
  <?php
  $stmt->close();
}
?>
 

  <form method="post" action="index.php" enctype="multipart/form-data">
  	<input type="hidden" name="size" value="1000000">
  	<div>
  	  <input type="file" name="image">
  	</div>
  	<div>
      <textarea 
        id="datum" 
        cols="10" 
        rows="1" 
        name="datum" 
        placeholder="YYYY-MM-DD"></textarea>

      <textarea 
        id="title" 
        cols="20" 
        rows="1" 
        name="image_title" 
        placeholder="Title"></textarea>
    </div>
      <textarea 
      	id="text" 
      	cols="40" 
      	rows="4" 
      	name="image_text" 
      	placeholder="Say something about this image..."></textarea>

  	<div>
  		<button type="submit" name="upload">POST</button>
    </div>
  	</div>
  </div>
  </form>
</div>
      <div>      
            <div id="balk">
            <div id="homeknop"><a href="http://localhost/home/home/home.php">Home</a></div>
            <div id="feedknop"><a href="http://localhost/home/edits/">Feed</a></div>
            <div id="aboutknop"><a href="http://localhost/home/about2.html">About</a></div>
            <div id="newsknop"><a href="http://localhost/home/news2.html">News</a></div>
      </div>

<?php include('server.php'); ?>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="stylesheet" href="main.css">
<?php $posts = $result  ?>
   <?php foreach ($posts as $post): ?>
    <div class="posts-wrapper">
            

            <?php 

           $strImage = "<img src='images/".$post['image']."' >";
          if ($post['image']<>""){ echo $strImage;}

            

            //echo "<img src='images/".$post['image']."' >"; 


            ?>
    <div class="post">
    
      <?php echo "<h1>"  .$post['datum']; "</h1>" ?>
      <?php echo "<h2>" .$post['image_title']; "</h2>" ?>
      <?php echo "<h3>" .$post['image_text']; "</h3>" ?>

      <div class="post-info">
        <a href="edit.php?id=<?php echo $post['id']; ?>">Edit</a>
        <a href="delete.php?id=<?php echo $post['id']; ?>" onclick="return confirm('are you sure?')">Delete</a>
      <!-- if user likes post, style button differently -->
        <i <?php if (userLiked($post['id'])): ?>
            class="fa fa-thumbs-up like-btn"
          <?php else: ?>
            class="fa fa-thumbs-o-up like-btn"
          <?php endif ?>
          data-id="<?php echo $post['id'] ?>"></i>
        <span class="likes"><?php echo getLikes($post['id']); ?></span>
        
        &nbsp;&nbsp;&nbsp;&nbsp;

      <!-- if user dislikes post, style button differently -->
        <i 
          <?php if (userDisliked($post['id'])): ?>
            class="fa fa-thumbs-down dislike-btn"
          <?php else: ?>
            class="fa fa-thumbs-o-down dislike-btn"
          <?php endif ?>
          data-id="<?php echo $post['id'] ?>"></i>
        <span class="dislikes"><?php echo getDislikes($post['id']); ?></span>

      </div>
    </div>
    </div>
   <?php endforeach ?>
  </div>
  <script src="scripts.js"></script>


</body>
</html>