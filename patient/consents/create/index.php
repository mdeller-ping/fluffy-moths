<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link type="image/x-icon" href="https://www.novanthealth.org/favicon.ico" rel="shortcut icon">
  <title>Novant Health</title>
</head>

<body>

  <!-- navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #512D6D;">
    <a class="navbar-brand mb-1" href="https://www.novant.demoenvi.com/">
      <img src="https://www.novanthealth.org/Portals/92/logo-large.png" height="50" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto mt-4">
        <li class="nav-item">
          <a class="nav-link" href="/">My Information</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/consents/">My Consents</a>
        </li>
      </ul>
      <ul class="navbar-nav text-right mt-4">
        <li class="nav-item mr-2">
          <a class="btn btn-outline-warning btn" href="https://pa.novant.demoenvi.com/pa/logout">Logout</a>
        </li>
      </ul>
    </div>
  </nav>
  <!-- /navigation -->

  <!-- hero banner -->
  <div class="jumbotron jumbotron-fluid mb-n1">
    <div class="container">
      <h1 class="display-4">Welcome to Novant Health</h1>
      <p class="lead">We are an integrated system of physician practices, hospitals, outpatient centers, and more – each element committed to delivering a remarkable healthcare experience for you and your family.</p>
    </div>
  </div>
  <!-- /hero banner -->

  <div class="container mt-5">

  <form method="POST">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="" id="inputProvider">
      <label class="form-check-label" for="inputProvider">
        Consent to Provider Access
      </label>
   </div>
   <div class="form-check">
      <input class="form-check-input" type="checkbox" value="" id="inputSpouse">
      <label class="form-check-label" for="inputSpouse">
        Consent to Spousal Access
      </label>
   </div>

   <br/>

<?php
$nextMonth  = date(DATE_ATOM, mktime(0, 0, 0, date("m")+1,   date("d"),   date("Y")));
?>

   <div class="form-group row">
    <label for="inputExpiration" class="col-sm-2 col-form-label">Expiration Date</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputExpiration" value="<?php echo $nextMonth ?>">
    </div>
  </div>

  <input type="submit" class="btn btn-primary" value="Submit">

</form>

  </div>

  <!-- footer -->
  <nav class="navbar navbar-light bg-light mt-5">
    <div class="container">
      <ul class="nav">
        <li class="nav-item">
          <a class="nav-link" href="https://patient.novant.demoenvi.com/registration/">Sign up</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="memberTools" href="https://patient.novant.demoenvi.com">Member login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact Center</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Patient Bill of Rights</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Privacy Statement</a>
        </li>
      </ul>
    </div>
  </nav>
  <!-- /footer -->

  <!-- jquery and bootstrap js libraries -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>

  <!-- JavaScript Cookie plugin -->
  <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>

  <script>
    function toggleRaw() {
      $('#rawDiv').toggle();
    }
  </script>

</body>

</html>

