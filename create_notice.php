<!DOCTYPE html>
<html>
<head>
  <title>Notice Board</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      margin: 0;
      padding: 20px;
    }

    h1 {
      text-align: center;
      color: #333;
    }

    .notice {
      background-color: #fff;
      border: 1px solid #ccc;
      border-radius: 4px;
      padding: 20px;
      margin-bottom: 20px;
    }

    .notice h2 {
      color: #333;
      margin-top: 0;
    }

    .notice p {
      color: #666;
    }

    .notice hr {
      border: none;
      border-top: 1px solid #ccc;
      margin: 10px 0;
    }

    .error {
      color: red;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <h1>Notice Board</h1>

  <?php
  // Check if the form is submitted
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if notice_title and notice_description are set in the POST data
    if (isset($_POST['notice_title']) && isset($_POST['notice_description'])) {
      $notice_title = $_POST['notice_title'];
      $notice_description = $_POST['notice_description'];

      // Connect to the database
      $conn = mysqli_connect('localhost', 'root', '', 'notice_board');

      // Check connection
      if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
      }

      // Insert notice into the database
      $sql = "INSERT INTO notices (notice_title, notice_description) VALUES ('$notice_title', '$notice_description')";
      if (mysqli_query($conn, $sql)) {
        echo '<div class="notice">
                <h2>'.$notice_title.'</h2>
                <p>'.$notice_description.'</p>
                <hr>
              </div>';
      } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }

      // Close the database connection
      mysqli_close($conn);
    } else {
      echo '<div class="error">Please provide a notice title and description.</div>';
    }
  }
  ?>
</body>
</html>
