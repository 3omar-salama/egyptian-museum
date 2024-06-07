<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ADD EVENTS</title>
        <link rel="stylesheet" href="add.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Kaushan+Script&family=Lugrasimo&family=Reddit+Mono:wght@200..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
            rel="stylesheet">
    </head>

    <body>
        <header>
            <nav>
                <a href="../MESSAGE/user-message.php">messages</a>
                <a href="add-event.php" class="activ">add event</a>
                <a href="../REPORT/monthly_report.php">report</a>
            </nav>
        </header>

        <section>
            <form action="add_article.php" method="post" enctype="multipart/form-data">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required /><br /><br />

                <label for="content">Content:</label>
                <textarea id="content" name="content" required></textarea><br /><br />

                <div>
                    <label for="image">Image:</label>
                    <input
                        type="file"
                        id="image"
                        name="image"
                        accept="image/*"
                    /><br /><br />

                    <label for="video">Video:</label>
                    <input
                        type="file"
                        id="video"
                        name="video"
                        accept="video/*"
                    /><br /><br />
                </div>

                <input type="submit" value="Add Article" />
            </form>
        </section>
        <?php
        include "../../db.php";

        // Fetch articles from the database
        $sql = "SELECT * FROM events ORDER BY created_at DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            while($row = $result->fetch_assoc()) {
                $files = explode(',', $row['file']);
                $image = $files[0];
                $video = $files[1];

                echo "<div style='border: 1px solid #000; padding: 10px; margin-bottom: 10px;'>";
                echo "<h2>" . htmlspecialchars($row['title']) . "</h2>";
                echo "<p>" . nl2br(htmlspecialchars($row['content'])) . "</p>";
                if (!empty($image)) {
                    echo "<img src='../../uploads/" . htmlspecialchars($image) . "' alt='" . htmlspecialchars($row['title']) . "' style='max-width: 100%; height: auto;'><br><br>";
                }
                if (!empty($video)) {
                    echo "<video controls style='max-width: 100%; height: auto;'>
                            <source src='../../uploads/" . htmlspecialchars($video) . "' type='video/mp4'>
                            Your browser does not support the video tag.
                        </video><br><br>";
                }
                echo "<small>Posted on: " . $row['created_at'] . "</small><br><br>";
                echo "<a href='edit_article.php?id=" . $row['id'] . "'>Edit</a> | ";
                echo "<a href='delete_article.php?id=" . $row['id'] . "' onclick='return confirm(\"Are you sure you want to delete this article?\");'>Delete</a><br><br>";
                echo "</div>";
            }
        } else {
            echo "No articles found.";
        }

        $conn->close();
        ?>
    </body>

</html>