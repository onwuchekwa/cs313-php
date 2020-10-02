<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Handling | PHP</title>
</head>
<body>
    <form action="confirmation.php" method="POST">
        <label for="forName">
            Name
            <input type="text" name="forName" id="forName">
        </label>
        <br><br>
        <label for="forEmail">
            Email
            <input type="text" name="forEmail" id="forEmail">
        </label>
        <br><br>
        <label for="forMajor">
            Major <br>
            <?php
                $major = array("Computer Science", "Web Design and Development", "Computer information Technology", "Computer Engineering");

                for($i = 0; $i < count($major); $i++){
                    echo '<input type="radio" name="forMajor" value="'.$major[$i].'">' . $major[$i];
                    echo '<br>';
                }                
            ?>
        </label>
        <br>
        <label for="forComment">
            Comment<br>
            <textarea name="forComment" id="forComment" column="30" rows="5"></textarea>
        </label>
        <br><br>
        <label for="continent">
        Which continent have you visited? <br>
            <input type="checkbox" name="continents[]" value="0">North America<br>
            <input type="checkbox" name="continents[]" value="1">South America<br>
            <input type="checkbox" name="continents[]" value="2">Europe<br>
            <input type="checkbox" name="continents[]" value="3">Asia<br>
            <input type="checkbox" name="continents[]" value="4">Australia<br>
            <input type="checkbox" name="continents[]" value="5">Africa<br>
            <input type="checkbox" name="continents[]" value="6">Antartica<br>
        </label>
        <br>
        <input type="submit" name="submit">
    </form>
</body>
</html>