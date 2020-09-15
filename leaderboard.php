<?php
session_start();
if($_SESSION['logged_in'] != 1 ){
        header("location: index.php");
}else
{
   ?>
 <!DOCTYPE html>
 <html>
 <body style="justify-content: center;">
 	<head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/profile.css" />
		<title>Leaderboard</title>
	</head>
<?php
include 'db.php';
$sql = "SELECT usernamesql,score FROM users ORDER BY score DESC";
$query = $conn->query($sql);
$num_rows = $query->num_rows;
$rank = 1;
        if ($num_rows>0) { 
            
           while ($row = $query->fetch_assoc()) {
                echo "<table border=1 cellspacing=0 style='text-align: center'> ";
     			echo "<tr><td width=200px>Rank #".$rank."</td>";
                echo "<td width=500px>".$row['usernamesql']."</td>";
                echo "<td width=100px> score: " .$row['score']."</tr></td>";
                echo '</table>';
                $rank++;
        }
        }
        else echo "Database is empty";
}?>
<body>
</html>
