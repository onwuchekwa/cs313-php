<?php
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $major = filter_input(INPUT_POST, 'major', FILTER_SANITIZE_STRING);
    $comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_STRING);
    $continents = filter_input(INPUT_POST, 'continents', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY); 
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Results </title>
    </head>
    <body>
       Name: <?php echo $name ?><br>
       Email: <?php echo '<a href="mailto:'. $email .'">' . $email . '</a><br>' ?>
       Major: <?php echo $major; ?><br>
       Comment: <?php echo $comment ?><br>
       Continents Visited: 
    <?php
        $map_continent = array("North America", "South America", "Europe", "Asia", "Australia", "Africa", "Antartica");
        if (!empty($continents)) {
           $continentName = array();
            foreach ($continents as $continent) { 
                array_push($continentName, $map_continent[$continent]);  
            }                        
            echo implode(", ", $continentName);
        }
    ?>
    </body>
</html>

