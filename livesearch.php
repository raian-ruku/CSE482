<?php
include("database.php");
if (isset($_POST['input'])) {
    $input = $_POST['input'];

    $query = "SELECT * FROM addmovie where title LIKE '{$input}%' UNION SELECT * FROM shows where title LIKE '{$input}%'";
    $result = mysqli_query($con, $query);



    if (mysqli_num_rows($result) > 0) { ?>
        <!-- echo '<ul class="search-results">'; -->
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
            $category = $row['category'];
            $genre = $row['genre'];
            $title = $row['title'];
            $year = $row['year'];
            $rating = $row['rating'];
            $image = $row['poster'];
        ?>
            <li class="search-result">
                <div class="search-result-details">
                    <h3 style="color: #47E3FF"><?php echo $title; ?></h3>
                    <p style="color: #FF6347">Category: <?php echo $category; ?></p>
                    <p style="color: #FF6347">Genre: <?php echo $genre; ?></p>
                    <p style="color: #FF6347">Year: <?php echo $year; ?></p>
                    <p style="color: #FF6347">Rating: <?php echo $rating; ?></p>
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