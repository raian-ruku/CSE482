<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="/CSE482/CSS/add.css" />
</head>

<body>
  <div class="top-panel">
    <a href="/CSE482/index.php" data-value="FLIXDB" id="logo">FLIXDB</a>
    <ion-icon name="menu-outline" id="hb"></ion-icon>
    <form action="">
      <div class="search-bar">
        <input type="text" name="search" id="search" placeholder="search" />
        <button type="submit">
          <ion-icon name="search-outline"></ion-icon>
        </button>
      </div>
    </form>
    <div class="user-icons">
      <a href="/CSE482/pages/profile_landing.html"><ion-icon name="person-outline"></ion-icon></a>

      <a href="/pages/signin.html"><ion-icon name="log-in-outline"></ion-icon></a>
    </div>
  </div>
  <div class="add">

    <h1>Add Movies/Shows</h1><br>
    <form action="" id="add">
      <label for="category">Category</label>
      <select name="category" id="category">
        <option value="" disabled selected>Choose category</option>
        <option value="movie">Movie</option>
        <option value="show">Show</option>
      </select>
      <label for="title">Title</label>
      <input type="text" name="title" id="title" placeholder="Title" />
      <label for="genre">Genre</label>
      <select name="genre" id="genre">
        <option value="" disabled selected>Choose genre</option>
        <option value="action">Action</option>
        <option value="comedy">Comedy</option>
        <option value="drama">Drama</option>
        <option value="horror">Horror</option>
        <option value="romance">Romance</option>
        <option value="thriller">Thriller</option>
      </select>
      <label for="year">Year</label>
      <input type="text" name="year" id="year" placeholder="Year" />
      <label for="rating">Rating</label>
      <input type="text" name="rating" id="rating" placeholder="Rating" />
      <label for="description">Description</label>
      <textarea name="description" id="description" cols="30" rows="10" placeholder="Description"></textarea>
      <label for="image" id="drop">
        <input type="file" name="image" accept="image/*" id="image" placeholder="Image" hidden />
        <div id="image-viewer">
          <ion-icon name="cloud-upload-outline"></ion-icon>
          <p>Drag & drop here to upload image or click here to upload</p>
        </div>
      </label>
      <input type="submit" value="Add" />
    </form>
  </div>

  </div>



  <script src="/JS/logo.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <script src="/JS/drop.js"></script>
</body>

</html>