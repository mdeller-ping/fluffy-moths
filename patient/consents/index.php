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
          <a class="nav-link" href="/records/">My Information</a>
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

    <div class="container mt-5">
    <table class="table table-bordered">
      <thead>
        <tr>
          <td>Consent ID</td><td>Status</td><td>Date Created</td>
        </tr>
      </thead>
<?php

  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://int-docker.anyhealth-demo.ping-eng.com:1443/consent/v1/consents",
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

  foreach ($responseData->_embedded->consents as $item) {
    echo "<tr><td><a href='/consents/inspect/?consent=" . $item->id . "'>" . $item->id . "</a></td><td>" . $item->status . "</td><td>" . $item->createdDate . "</td></tr>\n";
  }

?>
      </table>

    </div>

    <!-- Footer -->
    <footer class="footer bg-light">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 h-100 text-center text-lg-left my-auto">
            <p class="text-muted small mb-4 mb-lg-0">&copy; Ping Identity 2020. All Rights Reserved.</p>
          </div>
        </div>
      </div>
    </footer>
    <!-- /Footer -->

  </div>
  <!-- /page container -->

  <!-- jquery and bootstrap js libraries -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>

  <!-- JavaScript Cookie plugin -->
  <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>

</body>

</html>

