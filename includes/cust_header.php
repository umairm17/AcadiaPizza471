<!DOCTYPE html>
<html>
<head>
    <title>Acadia Pizza</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
    /* General Reset */
    body, html {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
    }

    /* Header Styles */
    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #333;
      padding: 10px 20px;
      color: white;
      position: fixed; /* Makes the header fixed */
      top: 0; /* Anchors the header to the top */
      left: 0; /* Anchors the header to the left */
      width: 100%; /* Makes the header span the full width */
      z-index: 1000; /* Ensures the header is above other content */
    }

    .logo {
      display: flex;
      align-items: center;
    }

    .logo h2 {
      margin-left: 10px;
    }

    nav {
      display: flex;
      align-items: center;
      gap: 20px;
    }

    .secondary {
      background-color: #ff6600;
      color: white;
      border: none;
      padding: 10px 15px;
      border-radius: 5px;
      cursor: pointer;
      font-size: 1em;
    }

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

    /* To prevent content from being hidden under the fixed header */
    body {
      padding-top: 60px; /* Adjust this value to match the height of your header */
    }
    </style>
</head>
<body>
    <header class="header">
      <a href="index.php" style="text-decoration: none; color: inherit;">
        <div class="logo">
          <span>🍕</span>
          <h2>Acadia Pizza</h2>
        </div>
      </a>
      <nav>
      <button class="secondary" onclick="window.location.href='checkout.php'">Checkout</button>
      <div class="dropdown">
          <span class="dropdown-title" tabindex="0">My account</span>
          <div class="dropdown-menu">
            <a href="index.php">Sign Out</a>
          </div>
        </div>
      </nav>
    </header>
</body>
</html>
