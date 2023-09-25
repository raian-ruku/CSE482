 <style>
   <?php include 'CSS/index.css'; ?>
 </style>

 <!DOCTYPE html>
 <html lang="en">

 <head>

   <meta charset="UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <link rel="stylesheet" href="/CSE482/CSS/index.css" />
 </head>

 <body>
   <div class="top-panel">
     <a href="/pages/index.html" data-value="FLIXDB" id="logo">FLIXDB</a>
     <ion-icon name="menu-outline" id="hb"></ion-icon>
     <form action="">
       <div class="search-bar">
         <input type="text" name="search" id="search" placeholder="search" />
         <button type="submit">
           <button type="submit">
             <ion-icon name="search-outline"></ion-icon>
           </button>
         </button>
       </div>
     </form>
     <div class="user-icons">
       <a href="/CSE482/pages/profile_landing.html"><ion-icon name="person-outline"></ion-icon></a>
       <ion-icon name="bookmark-outline"></ion-icon>
       <a href="/CSE482/pages/signin.php"><ion-icon name="log-in-outline"></ion-icon></a>
     </div>
   </div>
   <div class="trending">
     <div class="tn">
       <h2 class="horizontal-lines">Trending Now</h2>
       <button>View All</button>
     </div>
     <br />
     <div class="trendingcards" onclick="window.location.href='/pages/movie_details.html';">

       <div class="trending-card">

         <img src="/CSE482/CSS/IMG_20230427_183213.png" alt="trending movie" />
         <div class="trending-card-info">
           <h3> Movie Name</h3>
           <p>Actors</p>
           <p>Director</p>
           <p>Category</p>
           <p>Release Date</p>
           <p>Rating</p>
         </div>
       </div>

       <!-- <div class="trending-card">
        <img src="/CSS/IMG_20230427_183213.png" alt="trending movie" />
        <div class="trending-card-info">
          <h3>Movie Name</h3>
          <p>Actors</p>
          <p>Director</p>
          <p>Category</p>
          <p>Release Date</p>
          <p>Rating</p>
        </div>
      </div>
      <div class="trending-card">
        <img src="/CSS/IMG_20230427_183213.png" alt="trending movie" />
        <div class="trending-card-info">
          <h3>Movie Name</h3>
          <p>Actors</p>
          <p>Director</p>
          <p>Category</p>
          <p>Release Date</p>
          <p>Rating</p>
        </div>
      </div>
      <div class="trending-card">
        <img src="/CSS/IMG_20230427_183213.png" alt="trending movie" />
        <div class="trending-card-info">
          <h3>Movie Name</h3>
          <p>Actors</p>
          <p>Director</p>
          <p>Category</p>
          <p>Release Date</p>
          <p>Rating</p>
        </div>
      </div> -->
     </div>
   </div>
   <div class="vertical-line"></div>

   <script src="/CSE482/JS/logo.js"></script>
   <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
   <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
 </body>

 </html>