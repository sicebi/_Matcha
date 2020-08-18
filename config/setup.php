<?php
	require_once 'database.php';
	
try{
    $DB = explode(';', $DB_DSN);
    $database = substr($DB[1], 7);
    $pdo = new PDO("$DB[0]", $DB_USER, $DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("CREATE DATABASE IF NOT EXISTS $database");
    echo "created database matcha successfully.<br>";
    $pdo->exec("use $database");
/*create tables and insert data */
/* -------------------------------------------------------------*/
    $pdo->exec("CREATE TABLE IF NOT EXISTS `blocked` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `blocker` int(11) NOT NULL,
        `blocked` int(11) NOT NULL,
        PRIMARY KEY (`id`))");
      echo "Table 'blocked' created successfully.<br>";
/* */
/* -------------------------------------------------------------*/
      $pdo->exec("CREATE TABLE IF NOT EXISTS `likes` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `emitter` int(11) NOT NULL,
        `receiver` int(11) NOT NULL,
        PRIMARY KEY (`id`)
      )");

    $pdo->exec("INSERT INTO `likes` (`id`, `emitter`, `receiver`) VALUES
    (1, 1, 2),
    (2, 2, 1)");
    echo "Table 'Like' created successfully.<br>";
/* */
/* -------------------------------------------------------------
example (advo( user id = 1) matches Ccebi (user id = 2)) `matches`
-- user advo like Ccebi and Ccebi like Advo*/

    $pdo->exec("CREATE TABLE IF NOT EXISTS `matches` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `A` int(11) NOT NULL,
        `B` int(11) NOT NULL,
        PRIMARY KEY (`id`)
      )");
      
    $pdo->exec("INSERT INTO `matches` (`id`, `A`, `B`) VALUES
        (1, 1, 2)");
    echo "Table 'Matches' created successfully.<br>";
/* */  
/* -------------------------------------------------------------
example (advo( user id = 1) SEnd and  Ccebi (user id = 2)) receive `messages`
--example (advo( user id = 1) Receive and  Ccebi (user id = 2)) SEnd `messages`*/

    $pdo->exec("CREATE TABLE IF NOT EXISTS `messages` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `sender` int(11) NOT NULL,
        `receiver` int(11) NOT NULL,
        `text` varchar(255) NOT NULL,
        PRIMARY KEY (`id`)
        )");

/* example (advo( user id = 1) SEnd and  Ccebi (user id = 2)) receive `messages`
--example (advo( user id = 1) Receive and  Ccebi (user id = 2)) SEnd `messages`*/

    $pdo->exec("INSERT INTO `messages` (`id`, `sender`, `receiver`, `text`) VALUES
        (1, 1, 2, 'hey'),
        (2, 2, 1, 'how are you')");
        echo "Table 'massages' created successfully.<br>";
/* -------------------------------------------------------------*/
/*-- example (advo( user id = 1) view Ccebi page notify (user id = 2))  `messages`
--example (advo( user id = 1) LIKE Ccebi page notify (user id = 2))  `messages`
--example  Ccebi view page (user id = 2)) (advo( user id = 1) view and LIKE `messages`
-- example (advo( user id = 1) MATCHES AND CHAT  Ccebi page notify (user id = 2))  `messages`
*/
    $pdo->exec("CREATE TABLE IF NOT EXISTS `notifications` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `emitter` int(11) NOT NULL,
        `receiver` int(11) NOT NULL,
        `text` varchar(255) NOT NULL,
        `seen` int(11) NOT NULL DEFAULT '0',
        PRIMARY KEY (`id`)
        )");

    $pdo->exec("INSERT INTO `notifications` (`id`, `emitter`, `receiver`, `text`, `seen`) VALUES
        (1, 1, 2, 'visited your profile.', 1),
        (2, 2, 2, 'visited your profile.', 1),
        (3, 1, 2, 'Liked your profile.', 1),
        (4, 2, 1, 'Liked your profile.', 1),
        (5, 1, 2, 'You have a new match.', 1),
        (6, 2, 1, 'You have a new match.', 1),
        (7, 1, 2, 'Sent you a message.', 1),
        (8, 2, 1, 'Sent you a message.', 1)");
        echo "Table 'Notifications' created successfully.<br>";
    
  /* -------------------------------------------------------------*/

/* */
    $pdo->exec("CREATE TABLE IF NOT EXISTS `users` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `username` varchar(20) NOT NULL,
        `mail` varchar(255) NOT NULL,
        `password` varchar(255) NOT NULL,
        `state` varchar(255) NOT NULL,
        `name` varchar(255) NOT NULL DEFAULT 'Unknown',
        `age` int(11) NOT NULL DEFAULT '0',
        `gender` varchar(3) NOT NULL DEFAULT 'N/A',
        `orientation` varchar(3) NOT NULL DEFAULT 'M/F',
        `bio` varchar(255) NOT NULL DEFAULT 'No bio set yet.',
        `profile_img` varchar(255) NOT NULL DEFAULT 'img/profile.jpg',
        `i1` varchar(255) NOT NULL DEFAULT 'Example',
        `i2` varchar(255) NOT NULL DEFAULT 'Example',
        `i3` varchar(255) NOT NULL DEFAULT 'Example',
        `popscore` int(11) NOT NULL DEFAULT '0',
        `location` varchar(255) NOT NULL DEFAULT 'Unknown',
        `lati` float NOT NULL DEFAULT '0',
        `longi` float NOT NULL DEFAULT '0',
        `lastonline` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `reported` int(11) NOT NULL DEFAULT '0',
        PRIMARY KEY (`id`)
        )");
        

    $pdo->exec("INSERT INTO `users` (`id`, `username`, `mail`, `password`, `state`, `name`, `age`, `gender`, `orientation`, `bio`, `profile_img`, `i1`, `i2`, `i3`, `popscore`, `location`, `lati`, `longi`, `lastonline`, `reported`) VALUES
        (1, 'advo', 'advo.ntini@gmail.com', '$2y$10$McTTU/7A.GdPA2.7e.NvZec7.2/C0b2WX4g1xz5zWUMv.Jyf0hgzq', 0, 'advo', 24, 'M', 'F', 'programming, gaming, and flying racing drones. I also made this website.', 'img/user/1/profile.jpg', 'Programming', 'Gaming', 'RacingDrones', 48, 'johannesburg', 48.9333, 2.3667, '2018-02-03 16:57:05', 0),
        (2, 'Ccebi', 'ccebi.ntini@gmail.com', '$2y$10$McTTU/7A.GdPA2.7e.NvZec7.2/C0b2WX4g1xz5zWUMv.Jyf0hgzq', 0, 'ccebi', 25, 'F', 'M', '\"We are all stories at the end, just make it a good ones.\" The Doctor.', 'img/user/2/profile.jpg', 'Reading', 'Gaming', 'Programming', 204, 'johannesburg', 48.9367, 2.3394, '2018-02-03 16:53:50', 0)");
        echo "Table 'Users' created successfully.<br>";
/* -------------------------------------------------------------*/
/* */
/* -------------------------------------------------------------*/
/* */ 
/* -------------------------------------------------------------*/
/* */

}
catch (Exception $e)
{
    echo $sql.'<br>'.$e->getMessage();
}
	if (session_status() == PHP_SESSION_NONE) { session_start(); } 
	if (isset($_SESSION['auth']))
		unset($_SESSION['auth']);
	$_SESSION['flash']['success'] = "Database set.";
	header('Location: ../index.php');
?>