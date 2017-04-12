<?php
    if($_GET['keyword'] && !empty($_GET['keyword']))
    {
        include 'phpscripts/connect.php';

        $keyword = $_GET['keyword'];
        $keyword="%$keyword%";
        $query = "SELECT movies_title from tbl_movies where movies_title like ?";
        $statement = $link->prepare($query);
        $statement->bind_param('s',$keyword);
        $statement->execute();
        $statement->store_result();
        if($statement->num_rows() == 0) // so if we have 0 records acc. to keyword display no records found
        {
            echo '<div id="item">Darn, we don\'t have that movie. No results found :(</div>';
            $statement->close();
            $link->close();

        }
        else {
            $statement->bind_result($name);
            while ($statement->fetch()) //outputs the records
            {
                echo "<div id='item'>$name</div>";
            };
            $statement->close();
            $link->close();
        };
    };
?>
