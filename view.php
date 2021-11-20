<?php include "db_conn.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Wallpapers</title>
	<link rel="stylesheet" href="fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
	<script type="text/javascript" src="fancybox/jquery.fancybox-1.3.4.pack.js""></script>

	<style>
		body {
  			align-items: center;
  			background-color: #000;
  			/* display: flex; */
  			justify-content: center;
  			/* height: 100vh; */
		}
		.gallery img {
    		width: 300px;
			height: 300px;
    		border-radius: 5px;
    		cursor: pointer;
    		transition: .3s;
			padding: 4px;
			border-radius: 5px;
		}
		a, figure {
    		display: inline-block;
		}
		figcaption {
    		margin: 10px 0 0 0;
    		font-variant: small-caps;
    		font-family: Arial;
    		font-weight: bold;
    		color: #bb3333;
			text-align: center;
		}
		figure {
    		padding: 5px;
		}
	</style>
</head>
<body>
     <a href="index.php">&#8592;</a>
	 <br>
	 <!-- <section id="portfolio"> -->
	 <div class="gallery">
     <?php 
          $sql = "SELECT * FROM images ORDER BY id DESC";
          $res = mysqli_query($conn,  $sql);

          if (mysqli_num_rows($res) > 0) {
          	while ($images = mysqli_fetch_assoc($res)) {  ?>
			
			<a href="uploads/<?=$images['image_url']?>" data-fancybox="gallery" data-caption="<?php echo $images['image_name']; ?>" >
			<figure>
            	<img src="uploads/<?=$images['image_url']?>" alt="" />
				<figcaption><?php echo $images['image_name']; ?></figcaption>
			</figure>	
            </a>
    <?php }
	 }
	 ?>
	 <!-- </section> -->
	</div>

<script>
$("[data-fancybox]").fancybox();
</script>
</body>
</html>