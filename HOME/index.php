<!DOCTYPE html>
<html lang="en">

  <head>
    <!-- langyage -->
    <meta charset="UTF-8" />
    <!-- for screns -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>GEM</title>
    <!-- img title -->
    <link rel="icon" href="../Photos/GEM_Logo.png" type="image/x-icon" />
    <!-- css file -->
    <link rel="stylesheet" href="home-style.css"/>
    <link rel="stylesheet" href="../style-all.css" />
    <!-- link font awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    />
    <!-- font file -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <!-- font file -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <!-- font file -->
    <link
      href="https://fonts.googleapis.com/css2?family=Briem+Hand:wght@600&family=Kaushan+Script&family=Lugrasimo&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
      rel="stylesheet"
    />
  </head>

  <body>
  <header>
    <nav>
      <h1><a href="index.php">the grand egyptian museum</a></h1>
      <a href="index.php"><img src="../Photos/GEM_Logo.png" alt="logo" /></a>
      <ul>
        <li class="activ"><a href="index.php"><i class="fa-solid fa-house"></i>&nbsp;home</a></li>
        <li><a href="../EVENTS/display_articles.php"><i class="fa-regular fa-newspaper"></i>&nbsp;events</a></li>
        <li><a href="../RESERVATION/reservation.html"><i class="fa-solid fa-ticket"></i>&nbsp;reservations</a></li>
        <li><a href="../CONTACT-US/contact.html"><i class="fa-solid fa-headset"></i>&nbsp;contact us</a></li>
        <li><a href="../ABOUT-US/about.html"><i class="fa-solid fa-circle-info"></i>&nbsp;about us</a></li>
      </ul>
    </nav>
  </header>
  <!-- fixed button -->
    <div class="fixed-button">
      <button><a href="../RESERVATION/reservation.html">book now</a></button>
    </div>

    <!-- section1 -->
    <section class="slidshow">
      <div class="slid"><img src="../Photos/slid1.jpg" /></div>
      <div class="slid"><img src="../Photos/slid2.jpg" /></div>
      <div class="slid"><img src="../Photos/slid3.jpg" /></div>
      <div class="slid"><img src="../Photos/slid4.jpg" /></div>
    </section>

    <!-- section2 -->
    <section class="data">
      <h2 id="drop1">about the museum</h2>
      <div class="structure">
        <p class="animate">
          Did you know that the Grand Egyptian Museum is geometrically aligned
          with the Pyramids of Giza? The northern and southern walls and the
          middle section of the building are aligned with the Pyramids of Khufu,
          Khafre and Menkaure. Another marvel of the GEM design concept
        </p>
        <video autoplay muted loop>
          <source src="../Photos/structure.mp4" />
        </video>
      </div>

      <div class="art">
        <img src="../Photos/art.png" alt="art">
        <p class="animate">
          At the Grand Egyptian Museum, diverse art exhibitions are organized,
          providing a fantastic opportunity for local 
          and international artists to showcase their artistic works and engage with the audience.
          Themuseum serves as a vibrant platform for art and culture.
        </p>
      </div>

      <div class="artifacts">
        <p class="animate">
          The Archaeological Collection in the museum contains more than one hundred thousand pieces,
          ranging from statues, everyday tools, jewelry, murals, and elements from daily life in ancient Egypt.
          Among the museum's most notable exhibits is the famous Tutankhamun collection, 
          which includes the renowned golden mask,the royal throne, and the war chariot.
        </p>
        <img src="../Photos/Ramses-II.jpg" alt="artifact">
      </div>
    </section>

    <!-- section3 -->
    <section class="gallery">
      <h2 id="drop2">gallery</h2>
      <div>
        <img src="../Photos/gallery1.png" alt="">
        <img src="../Photos/gallery2.png" alt="">
        <img src="../Photos/gallery3.png" alt="">
        <img src="../Photos/gallery4.png" alt="">
        <img src="../Photos/gallery5.png" alt="">
        <img src="../Photos/gallery6.png" alt="">
        <img src="../Photos/gallery7.png" alt="">
        <img src="../Photos/gallery8.png" alt="">
        <img src="../Photos/gallery9.png" alt="">
      </div>
    </section>

    <!-- section4 -->
    <section class="info">
      <h2 id="drop3">Current information</h2>
      <div>
        <h3>We look forward to welcoming you at the Grand Egyptian Museum :</h3>
        <p>
          The GEM Complex is now offering limited tours to test site readiness
          and the visitor experience ahead of the official opening. Access is
          currently limited to the Grand Hall, Grand Staircase, commercial area,
          and exterior gardens. All other interior spaces, including access to
          the galleries and collections, are restricted until the official
          opening.
        </p>
      </div>

      <div>
        <h3><i class="fa-regular fa-clock"></i>&nbsp;Opening Hours</h3>
        <p>
        Sunday to Thursday: 9 AM - 9 PM <br />
        Friday and Saturday: 9 AM - 10 PM
        </p>
      </div>
    </section>

    <footer>
      <?php
      // Include database connection
      include '../db.php';
      // Get visitor's IP address
      $ip_address = $_SERVER['REMOTE_ADDR'];
      // Query to get total number of unique visitors
      $sql = "SELECT COUNT(*) AS visitor_count FROM visitors";
      $result = $conn->query($sql); 
      $row = $result->fetch_assoc();
      $visitor_count = $row['visitor_count'];
      // Insert visitor's information into the database 
      $sql = "INSERT INTO visitors (ip_address) VALUES ('$ip_address')";
      $conn->query($sql);
      // Display visitor count 
      echo "<h3 class='visit'>total visitors -> " . $visitor_count ."</h3>"; 
      // Close database connection 
      $conn->close();
      ?>
      <br>
      <p><i class="fa-solid fa-phone"></i> call us-> 20235317344</p>
      <br>
      <p><i class="fa-solid fa-plus"></i> FOLLOW US -> </p>
        <a href="https://www.facebook.com/GrandEgyptianMuseum/"><i class="fa-brands fa-facebook"></i></a>&nbsp;
        <a href="https://www.instagram.com/grandegyptianmuseum/"><i class="fa-brands fa-instagram"></i></a>
        <a href="https://www.instagram.com/grandegyptianmuseum/"><i class="fa-brands fa-x-twitter"></i></a>
      <h3>&copy; 2024 Egyptian Museum</h3>
    </footer>

    <script src="script.js"></script>
  </body>
</html>
