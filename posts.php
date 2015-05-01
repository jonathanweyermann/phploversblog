<?php include 'includes/header.php'; ?>
<?php 
	//Create db Object
	$db = new Database();
	//Check URL for category
	if(isset($_GET['category'])){
		$category = $_GET['category'];
		$query = "SELECT * FROM posts WHERE category = ".$category;
	} elseif(isset($_GET['author'])){
		$author = $_GET['author'];
		$query = "SELECT * FROM posts WHERE author = ".$author;
	} else {
		//Create Query
		$query = "SELECT * FROM posts ORDER BY id DESC";
	}
	
	

	
	//Run Query
	$posts = $db->select($query);
	
	//Create Query
	$query = "SELECT * FROM categories";
	
	//Run Query
	$categories = $db->select($query);
	//Create Query / Run Author Query
	$query = "SELECT * FROM authors";
	$authors = $db->select($query);
?>
<?php if ($posts) : ?>
	<?php $author = "Unknown Author" ; ?>
	<?php while ($row = $posts->fetch_assoc()) : ?>
		  <?php $authorRow = $db->select("SELECT name FROM authors WHERE id = ".$row['id']); ?>
		  <?php if($authorRow!=false) : ?>
			<?php $author = $authorRow->fetch_assoc()['name'] ; ?>
		  <?php endif; ?>
          <div class="blog-post">	
            <h2 class="blog-post-title"><?php echo $row['title'] ; ?></h2>
			
            <p class="blog-post-meta"><?php echo formatDate($row['date']); ?> by <a href="#"><?php echo $author ?></a></p>
				<?php echo shortenText($row['body']) ; ?>
           <a class="readmore" href="post.php?id=<?php echo urlencode($row['id']) ; ?>">Read More</a>
		   </div><!-- /.blog-post -->
	<?php endwhile; ?>
		   
       
<?php else : ?>
	<p>There are no posts yet</p>
<?php endif; ?>
<?php include 'includes/footer.php' ; ?>
        