<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- langyage -->
    <meta charset="UTF-8" />
    <!-- for screns -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>EVENTS</title>
    <!-- img title -->
    <link rel="icon" href="../Photos/GEM_Logo.png" type="image/x-icon" />
    <!-- css file -->
    <link rel="stylesheet" href="Estyle.css" />
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
        <h1><a href="display_articles.php">New events</a></h1>
        <a href="../HOME/index.php"><img src="../Photos/GEM_Logo.png" alt="logo"/></a>
        <ul>
          <li><a href="../HOME/index.php"><i class="fa-solid fa-house"></i>&nbsp;home</a></li>
          <li class="activ"><a href="display_articles.php"><i class="fa-regular fa-newspaper"></i>&nbsp;events</a></li>
          <li><a href="../RESERVATION/reservation.html"><i class="fa-solid fa-ticket"></i>&nbsp;reservations</a></li>
          <li><a href="../CONTACT-US/contact.html"><i class="fa-solid fa-headset"></i>&nbsp;contact us</a></li>
          <li><a href="../ABOUT-US/about.html"><i class="fa-solid fa-circle-info"></i>&nbsp;about us</a></li>
        </ul>
      </nav>
    </header>

    <div class="fixed-button">
      <button><a href="../RESERVATION/reservation.html">book now</a></button>
    </div>
      
    <section>

      <?php
      include "../db.php";

    // Fetch articles from the database
    $sql = "SELECT * FROM events ORDER BY created_at DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $files = explode(',', $row['file']);
            $image = $files[0];
            $video = $files[1];

            echo "<div class='post'";
            echo "<div class='animate__animated animate__backInLeft'>";
            if (!empty($image)) {
                echo "<img src='../uploads/" . htmlspecialchars($image) . "' alt='" . htmlspecialchars($row['title']) . "' style='max-width: 100%; height: auto;'><br><br>";
            }
          echo "<div class='vid'>";
            if (!empty($video)) {
                echo "<video controls loop'>
                        <source src='../uploads/" . htmlspecialchars($video) . "' type='video/mp4'>
                      
                      </video>";
            }
          echo "</div>";
            echo "<div class='animate__animated animate__backInRight'>";
            echo "<h2 class='omar'>" . htmlspecialchars($row['title']) . "</h2>";
            echo "<small>Posted on: " . $row['created_at'] . "</small><br>";
            echo "<p>" . nl2br(htmlspecialchars($row['content'])) . "</p>";
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "No articles found.";
    }

    $conn->close();
    ?>
    </section>

    <footer>
      <p><i class="fa-solid fa-phone"></i> call us-> 20235317344</p>
      <br>
      <p><i class="fa-solid fa-plus"></i> FOLLOW US -> </p>
        <a href="https://www.facebook.com/GrandEgyptianMuseum/"><i class="fa-brands fa-facebook"></i></a>&nbsp;
        <a href="https://www.instagram.com/grandegyptianmuseum/"><i class="fa-brands fa-instagram"></i></a>
        <a href="https://www.instagram.com/grandegyptianmuseum/"><i class="fa-brands fa-x-twitter"></i></a>
      <h3>&copy; 2024 Egyptian Museum</h3>
    </footer>

  </body>
</html>