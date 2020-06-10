<?php
  $consentId = $_GET['consent'];
  if (! $consentId) {
    header ("Location: /");
  }
?><!doctype html>
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
          <a class="nav-link" href="/">Patient Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/debug/">Headers</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/chart/">My Chart</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/consents/">My Consents</a>
        </li>
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Actions
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/consents/revoke/?consent=<?php echo $consentId ?>">Revoke</a>
          <a class="dropdown-item" href="/consents/enable/?consent=<?php echo $consentId ?>">Enable</a>
        </div>
      </li>
      </ul>
      <ul class="navbar-nav text-right mt-4">
        <li class="nav-item mr-2">
          <a class="btn btn-outline-warning btn" href="https://pa.novant.demoenvi.com/pa/oidc/logout">Logout</a>
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

<?php

  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://int-docker.anyhealth-demo.ping-eng.com:1443/consent/v1/consents/" . $consentId,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_SSL_VERIFYHOST => false,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_HTTPHEADER => array(
      "Authorization: Bearer { \"iss\": \"PatientPortal\", \"aud\": \"ConsentAPI\", \"client_id\": \"PatientPortal\", \"sub\": \"ff99e13b-6ff8-40ef-9ce5-1cc5ef891d3e\", \"active\": true, \"scope\": \"pd:consents:unpriv\" }"
    ),
  ));

  $response = curl_exec($curl);
  $err = curl_error($curl);

  if($err) {
    echo "cURL Error #:" . $err . "\n";
  }

  curl_close($curl);
  
  $responseData = json_decode($response);
  $response = json_encode($responseData, JSON_PRETTY_PRINT);
?>

<div class="card">
  <div class="card-header">
    <?php echo $responseData->id ?>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item"><?php echo $responseData->status ?></li>
    <li class="list-group-item"><?php echo $responseData->createdDate ?></li>
    <li class="list-group-item"><?php echo $responseData->updatedDate ?></li>
    <li class="list-group-item">
      id: <?php echo $responseData->definition->id ?><br>
      version: <?php echo $responseData->definition->version ?><br>
      current version: <?php echo $responseData->definition->currentVersion ?><br>
      locale: <?php echo $responseData->definition->locale ?>
    </li>
    <li class="list-group-item"><?php echo $responseData->dataText ?></li>
    <li class="list-group-item"><?php echo $responseData->purposeText ?></li>
  </ul>
</div>

    </div>

    <div class="container">

<br />
<br />

<a href="#" onclick="toggleRaw();">Toggle Raw</a>

<br />
<br />

<div style="display:none" id="rawDiv">
  <pre class='alert alert-warning'>GET https://int-docker.anyhealth-demo.ping-eng.com:1443/consent/v1/consents/<?php echo $consentId ?></pre>
  <pre class='alert alert-primary' style="height: 500px;"><?php echo $response ?></pre>
</div>

<br />
<br />

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

  </div>
  <!-- /page container -->

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

