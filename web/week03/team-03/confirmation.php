<?php
    $name = filter_input(INPUT_POST, 'forName', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'forEmail', FILTER_SANITIZE_STRING);
    $major = filter_input(INPUT_POST, 'forMajor', FILTER_SANITIZE_STRING);
    $comment = filter_input(INPUT_POST, 'forComment', FILTER_SANITIZE_STRING);
    $continent = filter_input(INPUT_POST, 'continents', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation</title>
</head>
<body>
    Name: <?php echo $name; ?><br>
    Email: <?php echo '<a href="mailto:'. $email .'">' . $email . '</a><br>' ?>
    Major: <?php if(isset($major)) echo $major; ?><br>
    Comment: <?php echo $comment; ?><br>
    Continents Visited: 
    <?php
        $map = array("North America", "South America", "Europe", "Asia", "Australia", "Africa", "Antartica");
        if (!empty($continent)) {
            $continentName = array();
            foreach ($continent as $cont) { 
                array_push($continentName, $map[$cont]);  
            }                        
            echo implode(", ", $continentName);
        }
    ?>
</body>
</html>