<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Meta tags for character encoding and viewport settings -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom CSS -->
  <style>
    /* Custom styles */
    .navbar-custom {
      background-color: #3B82F6; /* Customize the navbar background color */
    }

    .navbar-brand img {
      margin-right: 10px; /* Add space between the brand logo and text */
    }

    .navbar-toggler {
      border-color: white; /* Customize the toggler button color */
    }

    .navbar-nav .nav-link {
      color: white !important; /* Customize the navigation links color */
    }

    .navbar-nav .nav-link:hover {
      color: #f1f1f1 !important; /* Customize the navigation links hover color */
    }

    .btn-primary {
      background-color: #173677; /* Customize the logout button background color */
      border-color: #173677; /* Customize the logout button border color */
    }

    .btn-primary:hover {
      background-color: #455e92; /* Customize the logout button hover background color */
      border-color: #455e92; /* Customize the logout button hover border color */
    }

    .download2 p.bold {
      font-size: 15px; /* Customize the font size of the download text */
    }
  </style>

  <title>Your Project Title</title>

  <!-- Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>

  <!-- Navigation bar -->
  <nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container-fluid">
      

      <!-- Toggler button for collapsing navbar on small screens -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Collapsible part of the navbar -->
      <div class="collapse navbar-collapse" id="navbarNav">
        <!-- Left-aligned navigation links -->
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <!-- Home link -->
          <li class="nav-item">
            <a class="nav-link" href="farm_dashboard.php">Home</a>
          </li>
          <!-- Admissions link -->
          <li class="nav-item">
            <a class="nav-link" href="#">...</a>
          </li>
        </ul>

        <!-- Right-aligned navigation links -->
        <ul class="navbar-nav ms-auto">
          <!-- Logout button -->
          <li class="nav-item">
            <form method="post" action="logout.php">
              <button type="submit" class="btn btn-primary">Logout</button>
            </form>
          </li>
        </ul>
      </div>
    </div>
  </nav>

</body>

</html>
