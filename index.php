<?php

use Tournament;

echo 'The king\'s tournament';
echo '<br>';
echo '<br>';

if(count($_POST) == 0){
    echo 'Insert the number of contenders:';
    echo '<form action="index.php" method="POST">';
    echo '<input type="text" name="num_knights">';
    echo '<br>';
    echo '<br>';
    echo '<input type="submit" value="Let the games begin">';
    echo '</form>';
} else {
    $num_knights = $_POST['num_knights'];
    $obj_tournament = new Tournament($num_knights);
    echo '<pre>';
    print_r($obj_tournament->getWinner());
}