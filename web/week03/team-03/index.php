<!DOCTYPE html>
<html>
    <head>
        <title>test</title>
    </head>
    <body>
        <form action="result.php" method="POST">
            Name: 
            <input type="text" name="name" >
            <br>
            <br>
            E-mail: 
            <input type="text" name="email" >
            <br>
            <br>
            Major: <br>
            <?php
                $major = array("Computer Science", "Web Design and Development", "Computer information Technology", "Computer Engineering");

                for($i = 0; $i < count($major); $i++){
                    echo '<input type="radio" name="major" value="'.$major[$i].'">' . $major[$i];
                    echo '<br>';
                } 
            ?>            
            <br>
            <br>
            Comments: 
            <br>
            <textarea name="comment" rows="5" cols="40"></textarea>
            <br>
            <br>
            Which continents have you visited? <br>
            <?php
                $continents = array("North America", "South America", "Europe", "Asia", "Australia", "Africa", "Antarctica");

                for($i = 0; $i < count($continents); $i++){
                    echo '<input type="checkbox" name="continents[]" value="'.$i.'">' . $continents[$i];
                    echo '<br>';
                } 
            ?> 
            <br>
            <br>
            <button type="submit">Submit</button>
        </form>
    </body>
</html>
