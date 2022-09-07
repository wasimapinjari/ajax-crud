<!-------------------------------------------------------------------------------

ajax-crud: index.php
Licensed under MIT (https://github.com/wasimapinjari/ajax-crud/blob/main/LICENSE)

-------------------------------------------------------------------------------->

<?php include './database.php'; ?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Wasim A Pinjari">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>WAP | User Information</title>
    <style>
      .btn:focus{
        outline: none;
        box-shadow: none;
      }
      .spacing{
      letter-spacing: 0.5px; 
      }
    </style>
  </head>

  <body id="body">

    <nav class="navbar navbar-expand-sm navbar-light bg-light mb-4" id="nav-bar">
      <div class="container">
        <a class="navbar-brand spacing" href="#">Wasim A Pinjari</a>
        <i class="bi" id="icon" style="font-weight: 1rem; font-size: 1.5rem;"></i>
      </div>
    </nav>

    <main>
      <div class="container d-flex flex-column align-items-center">
        <h2 class="mt-4">User Information</h2>

        <form class="mt-4 w-75" id="myform">

          <div class="mb-3">
            <input type="hidden" style="display:none;" class="form-control" id="uid">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" placeholder="Enter your name" minlength="3" required>
            <div class="invalid-feedback" id="messageName"></div>
          </div>

          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" placeholder="Enter your email" required>
            <div class="invalid-feedback" id="messageEmail"></div>
          </div>

          <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <textarea class="form-control" id="address" placeholder="Enter your address" minlength="5" required></textarea>
            <div class="invalid-feedback" id="messageAddress"></div>
          </div>

          <div class='btn-group mb-3 w-100 flex-wrap' role='group' aria-label='Basic example'>
            <button type='submit' id='submit' class='btn btn-outline-dark btn-update'>Add</button>
            <button type='reset' id='reset' class='btn btn-outline-dark btn-delete'>Reset</button>
          </div>
      
          <div class="mb-3" id="msg"></div>

        </form>

        <h2 class="mt-4 text-center">Current Users</h2><br>

        <form class="mt-4 w-75">
          <input class="form-control mb-3" id="search" placeholder="Search"></input>
        </form>

        <div id="user" class="row justify-content-center w-100"></div>

      </div>
    <main>

    <footer class="text-center mt-4">
      Wasim A Pinjari &copy; <span id="copyright">2022</span><br><br>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="ajax.js"></script>
    
  </body>
  
</html>