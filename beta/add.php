<?
include('includes/connect.php');
if (isset($_POST['action'])) {
    if ($_POST['action'] == "submit") {
		$name = mysqli_real_escape_string($link, $_POST['name']);
		$category = mysqli_real_escape_string($link, $_POST['category']);
		$ingredients = mysqli_real_escape_string($link, $_POST['ingredients']);
		$garnish = mysqli_real_escape_string($link, $_POST['garnish']);
		$directions = mysqli_real_escape_string($link, $_POST['directions']);
		$image = mysqli_real_escape_string($link, $_POST['image']);
		mysqli_query($link, "INSERT INTO recipe (name, category, ingredients, garnish, directions, image)
			VALUES ('$name', '$category', '$ingredients', '$garnish', '$directions', '$image')");
		$recipe = mysqli_query($link, "SELECT recipeid FROM recipe WHERE image='$image'");
		$recipe = mysqli_fetch_assoc($recipe);
		header('Location: recipe.php?recipeid='.$recipe['recipeid']);
    }
}
?>
<!DOCTYPE html>
<html>
<title>Recipe Website</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="style.css">

<body>

<div class='navmenu'>
   <form id='search-form' action='search.php'>
<input placeholder='Search here...' size='15' type='text' name='q'/>
<input id='button-submit' type='submit' value='Search'/>
        </form>
    <span id='menu'><img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAC9JREFUeNpi/P//PwM1AQsQU9VEJgYqg8FvICgMGUeel0eTzWiyGU02Qz/ZAAQYAOPcBjEdYroKAAAAAElFTkSuQmCC'  /></span>
    <nav id='navbar'>
    <ul class='navbar'>
        <li><a href='index.php'>Home</span></a></li>
        <li><a href='add.php'>Add a Recipe</span></a></li>
        <li id='sub-menu'><a href="#">Filters</span>

                <ul class="sub-menu">
        <li><a href='category.php?category=Breakfast'>Breakfast</span></a></li>
        <li><a href='category.php?category=Lunch'>Lunch</span></a></li>
        <li><a href='category.php?category=Dinner'>Dinner</span></a></li>
      </ul>
    </li>
        
          <li><a href='#footer'>Contact Us</span></a></li>
             </ul>
</nav>
</div>

<div style='clear: both;'/>

  <div id="portfolio">
	<h2>Add a recipe</h2>
	<center>
	<form action="add.php" method="post" enctype="multipart/form-data">
		<input type="text" class="form-control" id="name" name="name" placeholder="Name" value="<?=$_POST['name']?>" style="width: 500px;" required autofocus>
		<br>
		<select class="form-control" id="category" name="category" style="width: 500px;" required>
			<option value="Breakfast" <? if($_POST['category']=='Breakfast') echo 'selected'; elseif($_POST['category']=='') echo 'selected';?>>Breakfast</option>
			<option value="Lunch" <? if($_POST['category']=='Lunch') echo 'selected';?>>Lunch</option>
			<option value="Dinner" <? if($_POST['category']=='Dinner') echo 'selected';?>>Dinner</option>
		</select>
		<br>
		<textarea class="form-control" id="ingredients" name="ingredients" rows="10" placeholder="Ingredients" style="width: 500px;"><?=$_POST['ingredients']?></textarea>
		<br>
		<textarea class="form-control" id="garnish" name="garnish" rows="10" placeholder="Garnish" style="width: 500px;"><?=$_POST['garnish']?></textarea>
		<br>
		<textarea class="form-control" id="directions" name="directions" rows="10" placeholder="Directions" style="width: 500px;"><?=$_POST['directions']?></textarea>
		<br>
		<input type="text" class="form-control" id="image" name="image" placeholder="Image" value="<?=$_POST['image']?>" style="width: 500px;" required autofocus>
		<br>
		<button type="submit" class="btn btn-primary" name="action" value="submit">Submit</button>
	</form>
	</center>
<br><br>
  

<footer id="footer">
  <a id="top" href="#home"><i class="fa fa-arrow-up" id="top"></i>To the top</a><br>
  <div class="soc">
     <a href="https://www.facebook.com/meet.palan.98" class="w3-bar-item w3-button"target="_blank"><i class="fa fa-facebook-official"></i></a>
  <a href="https://www.instagram.com/meet.p98/" class="w3-bar-item w3-button"target="_blank"><i class="fa fa-instagram"></i></a>
  <a href="https://www.linkedin.com/in/meet-palan-a0606912b/" class="w3-bar-item w3-button"target="_blank"><i class="fa fa-linkedin"></i></a>
</div>
  <p>Designed by Meet Palan</p>
</footer>


 


</body>
</html>
<script type="text/javascript"> //just one small script so no new js document
document.getElementById('menu').addEventListener('click', function () {
        var nav = document.getElementsByTagName('nav')[0];
        if (nav.style.display == 'block') {
            nav.style.display = 'none';
        } else {
            nav.style.display = 'block';
        }
    }, false);
</script>
