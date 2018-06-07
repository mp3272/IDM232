<?
include('includes/connect.php');
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



<div id="results">
  <h1>Here are your filter results:</h1> 
	<div class="grid">
		<?
		$page = $_GET['page'];
		if ($page == '') { $page = 1; }
		$limit = 12;
		$offset = $limit * ($page-1);
		$result = mysqli_query($link, "SELECT * FROM recipe WHERE category like '%".mysqli_real_escape_string($link, $_GET['category'])."%' ORDER BY recipeid DESC LIMIT $offset, $limit");
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
				<br>
						<nav aria-label="Page navigation">
							<ul class="pagination" style="text-align: center;">
							<?
							$show_first = false;
							$current = $_GET['page'];
							if ($page == '') { $page = 1; }
							$next = $current +1;
							$previous = $current -1;
							if ($previous <= 0)
							{
								$previous = 1;
							}
							$page = $current;
							$start = $page - 2;
							$end = $page + 1;
							if ($start <= 2)
							{
								$start = 1;
								$end = 5;
								$show_first = false;
							}
							if ($i < 12) {
								$end = $current;
							}
							?>
							<?
							if ($current > 1) {
								echo '
								<li>
									<a href="/category.php?category='.$_GET['category'].'&page='.$previous.'" aria-label="Previous">
									<span aria-hidden="true">&laquo;</span>
									</a>
								</li>';
							}
							else {
								echo '
								<li class="disabled">
									<a href="#" aria-label="Previous">
									<span aria-hidden="true">&laquo;</span>
									</a>
								</li>';
							}
							while ($start <= $end)
							{
								if ($start == $current)
								{
									if ($start=="1")
									{
										echo '<li class="active"><a href="/category.php?category='.$_GET['category'].'">1</a></li>';
									}
									else{
										echo '<li class="active"><a href="/category.php?category='.$_GET['category'].'&page='.$current.'">'.$current.'</a></li>';
									}
								}
								else
								{
									if ($start=="1")
									{
										echo '<li><a href="/category.php?category='.$_GET['category'].'">1</a></li>';
									}
									else{
										echo '<li><a href="/category.php?category='.$_GET['category'].'&page='.$start.'">'.$start.'</a></li>';
									}
								}
								$start ++;
							}
							if ($end != $current) {
								echo '
								<li>
									<a href="/category.php?category='.$_GET['category'].'&page='.$next.'" aria-label="Next">
									<span aria-hidden="true">&raquo;</span>
									</a>
								</li>';
							}
							?>
							</ul>
						</nav>	

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
