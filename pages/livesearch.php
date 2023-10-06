<?php
include("database.php");
if(isset($_POST['input'])){
    $input= $_POST['input'];

    $query= "SELECT * FROM addmovie where title LIKE '{$input}%'";
    $result = mysqli_query($con,$query);

    //<?php
// Your PHP code to fetch search results from the database

if (mysqli_num_rows($result) > 0) { ?>
    echo '<ul class="search-results">';
    <?php
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $category = $row['category'];
        $genre = $row['genre'];
        $title = $row['title'];
        $year = $row['year'];
        $rating = $row['rating'];
        $image = $row['image'];
        ?>
        <li class="search-result">
            <div class="search-result-details">
                <h3><?php echo $title; ?></h3>
                <p>Category: <?php echo $category; ?></p>
                <p>Genre: <?php echo $genre; ?></p>
                <p>Year: <?php echo $year; ?></p>
                <p>Rating: <?php echo $rating; ?></p>
            </div>
            <div class="search-result-image">
                <img src="<?php echo $image; ?>" alt="<?php echo $title; ?>" />
            </div>
        </li>
        <?php
    }
    echo '</ul>';
?>



    <?php
    } else {
        echo "<h6 class='text-danger text-center mt-3' > No Data Found </h6>";
      }
   }
?> 
