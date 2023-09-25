<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="/CSE482/CSS/movie_details.css" />
</head>

<body>
  <div class="top-panel">
    <a href="/pages/index.html" data-value="FLIXDB" id="logo">FLIXDB</a>
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
      <ion-icon name="bookmark-outline"></ion-icon>
      <a href="/pages/signin.html"><ion-icon name="log-in-outline"></ion-icon></a>
    </div>
  </div>

  <div class="movie">
    <div class="sd">
      <p>Name</p>
      <div class="rp">
        <p>Rating</p>
        <p>Popularity</p>
      </div>
    </div>
    <p>Release Date</p>
    <img src="/CSS/IMG_20230427_183213.png" alt="images here with carousel" />
    <p>Category</p>
    <p>Stars</p>
    <p>Director</p>
    <p>Details</p>
  </div>

  <div class="reviews">
    <p>User Reviews</p>
    <div class="review">
      <div class="review-items">
        <img src="/CSS/IMG_20230427_183213.png" alt="user_image" />
      </div>
      <div class="review-items">
        <p>Name</p>
      </div>

      <div class="review-items">
        <p>Reputation</p>
      </div>
    </div>
  </div>

  <script src="/JS/logo.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>