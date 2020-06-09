<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- bootstrap core css -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <!-- local css -->
  <link href="/css/stylesheet.css" rel="stylesheet" />

  <!-- Custom fonts for this template -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css"
    rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet"
    type="text/css" />
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" />
</head>

<body>

  <!-- page container -->
  <div class="container-fluid">

    <!-- navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="/">Home</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/records/">My Info</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/consents/">My Consents</a>
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

