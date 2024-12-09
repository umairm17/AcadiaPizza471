<!DOCTYPE html>
<html>
<head>
    <title>Acadia Pizza</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
    /* Dropdown Styles */
    .dropdown {
      position: relative;
      display: inline-block;
    }

    .dropdown-title {
      font-size: 1em;
      cursor: pointer;
      color: white;
      font-weight: bold;
      background-color: #e65c00;
      padding: 10px 15px;
      border-radius: 5px;
      display: inline-block;
      transition: background-color 0.3s ease;
    }

    .dropdown-title:hover {
      background-color: #555;
    }

    .dropdown-menu {
      display: none; /* Hidden by default */
      position: absolute;
      right: 0;
      margin-top: 10px;
      background-color: white;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      border-radius: 5px;
      overflow: hidden;
      z-index: 100;
      min-width: 150px;
    }

    .dropdown-menu a {
      display: block;
      padding: 10px 15px;
      text-decoration: none;
      color: #333;
      font-size: 1em;
      transition: background-color 0.3s ease;
    }

    .dropdown-menu a:hover {
      background-color: #f9f9f9;
      color: #ff6600;
    }

    /* Keep dropdown visible when focused */
    .dropdown:focus-within .dropdown-menu {
      display: block;
    }
    </style>
</head>
<body>
    <header class="header">
      <div class="header-left">
        <h2>Welcome</h2>
      </div>
      <div class="logo">
        <span>🍕</span>
        <h2>Acadia Pizza</h2>
      </div>
      <nav>
        <div class="dropdown">
          <span class="dropdown-title" tabindex="0">My Profile</span>
          <div class="dropdown-menu">
            <a href="index.php">Log Out</a>
          </div>
        </div>
      </nav>
    </header>
</body>
</html>
