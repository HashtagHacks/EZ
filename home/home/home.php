<?php  
 $connect = mysqli_connect("localhost", "root", "", "demo");  
 if(isset($_POST["insert"]))  
 {  
      $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));  
      $query = "INSERT INTO tbl_images(name) VALUES ('$file')";  
      if(mysqli_query($connect, $query))
      {  
           echo '<script>alert("Image Inserted into Database")</script>';  
      }  
 }  
 ?> 
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Home Page</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		<link href="https://fonts.googleapis.com/css?family=Supermercado+One|Lobster|Lakki+Reddy&display=swap" rel="stylesheet">

	</head>
	<body>

        <div id="wallpaper">
      <img src="images/comic3.jpg">
    </div>
		<div id="balk">
			<div id="homeknop"><a><a href="">home</a></div>
			<div id="feedknop"><a href="http://localhost/home/edits/">Feed</a></div>
			<div id="aboutknop"><a><a href="../about2.html">About</a></div>
			<div id="newknop"><a><a href="../news2.html">News</a></div>
		</div>
    <div>
      <form id="forum"  method="post" enctype="multipart/form-data">  
         <input type="file" name="image" id="image" />  
         <br />  
        <input type="submit" name="insert" id="insert" value="Insert" class="button" onclick="oof.play();" />  
      </form>  
        <br />  
       <br />  
       </div> 

  <div class="s-m">
   <a href="https://www.facebook.com/johnny.bravo.771"><i class="fab fa-facebook-f"></i></a>
   <a href="https://twitter.com/BravoUltimate"><i class="fab fa-twitter"></i></a>
    <a href="https://www.instagram.com/aidannn95/"><i class="fab fa-instagram"></i></a>   
   </div>

<?php  
  $query = "SELECT * FROM tbl_images ORDER BY id DESC";  
  $result = mysqli_query($connect, $query);  
  while($row = mysqli_fetch_array($result))  
    {  
      echo '  
        <tr>  
          <td>
            <div id="slideshow">
              <div class="slideshow-container">
                <div class="mySlides fade">  
                  <img class="johnfoto" src="data:image/jpeg;base64,'.base64_encode($row['name'] ).'" height="200" width="200" class="img-thumnail" /> 
                </div>
               </div> 
             </div>
           </td>  
          </tr>';}  
?> 

<script>  
 $(document).ready(function(){  
      $('#insert').click(function(){  
           var image_name = $('#image').val();  
           if(image_name == '')  
           {  
                alert("Please Select Image");  
                return false;  
           }  
           else  
           {  
                var extension = $('#image').val().split('.').pop().toLowerCase();  
                if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)  
                {  
                     alert('Invalid Image File');  
                     $('#image').val('');  
                     return false;  
                }  
           }  
      });  
 });  
 </script>                 
  
 <script>  

var slideIndex = 0;
showSlides();

function showSlides() {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("johnfoto");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
  setTimeout(showSlides, 1000); // Change image every 2 seconds
}

var oof = new Audio();
    oof.src = "./sounds/ow mama.mp3";
</script>

	</body>
	</html>