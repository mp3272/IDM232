<?
include('includes/connect.php');
$recipeid = mysqli_real_escape_string($link, $_GET['recipeid']);
$recipe = mysqli_query($link,"SELECT * FROM recipe WHERE recipeid = '$recipeid' LIMIT 1");
$recipe = mysqli_fetch_array($recipe);
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

<style>
.parallaxBurger{
 background-image: url("images/<?=$recipe['image']?>");

    
    min-height: 500px; 

    /*to create the parallax scrolling effect */
    background-attachment: fixed;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    width: 100%;
    height: auto;
}



}

.parallaxBurger>img{
  width: 100%;
}
</style>
<div class="parallaxBurger" id="home">
</div>
  <div>
    <h1><?=$recipe['name']?></h1>
  </div>
<div class="recipe">
  <div class="ingredients">
<h4>Ingredients</h4>
<div class="ingredients-content">
<div class="recipe-component" data-serving-size="6">
<ul>
<?
if ($recipe['ingredients'] !== '')
{
	$i = 0;
	$ingredients = explode('<br />', nl2br($recipe['ingredients']));
	foreach ($ingredients as $ingredient)
	{
		if ($ingredient !== '') {
			$i ++;
			echo '<li><span class="ingredient-system"><span class="ingredient-quantity"></span><span class="ingredient-quantity-unit"></span></span><span class="ingredient-label">'.$ingredient.'</span></li>';
		}
	}
} 
?>
</ul>
</div>
<div class="garnish">
<h4 class="component-title">To garnish</h4>
<ul>
<?
if ($recipe['garnish'] !== '')
{
	$i = 0;
	$garnishes = explode('<br />', nl2br($recipe['garnish']));
	foreach ($garnishes as $garnish)
	{
		if ($garnish !== '') {
			$i ++;
			echo '<li><span class="ingredient-label">'.$garnish.'</span></li>';
		}
	}
} 
?>
</ul>
</div>
</div>
</div>
<div class="directions">
<h4>Directions</h4>
<?=$recipe['directions']?>
</div>

</div>
 
 <h3>You might also like:</h3> 
	<div id="portfolio">
		<div class="grid">
				<?
				$page = $_GET['page'];
				if ($page == '') { $page = 1; }
				$limit = 6;
				$offset = $limit * ($page-1);
				$result = mysqli_query($link, "SELECT * FROM recipe WHERE recipeid != $recipeid ORDER BY recipeid DESC LIMIT $offset, $limit");
				$i = 0;
				$r = 0;
				while ($row = mysqli_fetch_array($result))
				{
					$i ++;
					$r ++;
					$d_name = $row['name'];

					if (strlen($d_name) > 30)
						$d_name = substr($d_name, 0, 27) . '...';
				?>
			  <div class="card">
				  <img src="images/<?=$row['image']?>" alt="<?=$row['name']?>" style="width:100%">
				  <h4><?=$row['name']?></h4>
				  <button><a href="recipe.php?recipeid=<?=$row['recipeid']?>">Read more</button></a>
			  </div>
				<?
				}
				?>
		</div>
	</div>
  
<!-- w3 classes used only for icons -->
<!-- Footer -->
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