<?php require 'header.php'; require 'required/functions.php'; iNotConnected(); ?>

<div class="login">
    <div class="container" style="position: relative; top: 15%; height: 80%; z-index: 2; overflow-y: scroll;">
    	<?php
    	if (!empty($_POST) && isset($_POST['search']))
    	{
    		require 'required/database.php';
    		
    		/**-------------------------------search By interested filter */
    		if ($_POST['selectedfilter'] === "i")
    		{
		    	if (!isset($_POST['btninterest']))
		    	{
		    		$req = $pdo->query("SELECT * FROM users WHERE reported = 0 AND i1 LIKE '%" .addslashes($_POST['search']) ."%' OR i2 LIKE '%" .addslashes($_POST['search']) ."%' OR i3 LIKE '%" .addslashes($_POST['search']) ."%'");
		    	}
    		}
			$res = $req->fetchall();

			foreach ($res as $key) {
				$req = $pdo->prepare('SELECT * FROM users WHERE name = ?');
				$req->execute([$key->name]);
				$currentUser = $req->fetch();

				$number = getDistance($currentUser->lati, $currentUser->longi);
				$number = number_format($number, 2, ',', ' ');
				if ($number < 1.00)
					$local = "In your city";
				else
					$local = $number ." km away.";
				$blocked = 0;
				if (is_blocked($_SESSION['auth']->id, $currentUser->id))
                    $blocked = 1;
				?>
				<?php if (!$blocked) { ?>
				<a href="uprofile.php?id=<?php echo $currentUser->id; ?>">
		    		<div class="profile-box">
			    		<h1 class="profile-box-h1"><?php echo $currentUser->name; ?> - <span><?php echo $currentUser->age; ?></span></h1>
			    		<h2 class="profile-box-h2"><i class="fa fa-map-marker" aria-hidden="true"></i><?php echo $local; ?></h2>
			    		<h2 class="profile-box-h2-pts"><i class="fa fa-star" aria-hidden="true"></i><?php echo $currentUser->popscore; ?></h2>
			    		<img src="<?php echo $currentUser->profile_img; ?>" height="80%">
			    	</div>
			    	<br>
		    	</a><?php
		    }
			}
    	}
    	?>
    </div>
</div>
</div>