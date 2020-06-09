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

<?php

$now = date(DATE_ATOM);
$nextMonth  = date(DATE_ATOM, mktime(0, 0, 0, date("m")+1,   date("d"),   date("Y")));

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://int-docker.anyhealth-demo.ping-eng.com:1443/consent/v1/consents",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_SSL_VERIFYHOST => false,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_POSTFIELDS =>"{\n  \"status\": \"accepted\",\n  \"audience\": \"AnyHealth-EMR\",\n  \"definition\": {\n    \"id\": \"EMR-Access\",\n    \"version\": \"1.8\",\n    \"locale\": \"en\"\n  },\n  \"dataText\": \"Individuals and Roles requesting access to your medical records\",\n  \"purposeText\": \"Used to allow Roles and Individuals to have access to all or specific elements of your medical record\",\n  \"data\": {\n     \"implicit\": [ \n     \t{ \n     \t\t\"relationship\": \"physician\", \n     \t\t\"provider\": \"EpicFHIR\", \n     \t\t\"identifier\":\"1eaed605-c824-477a-a2ce-9c2a160c170c\", \n     \t\t\"timestamp\": \"$now\",\n     \t\t\"expires\": \"$nextMonth\"\n \t\t} ]\n  },\n  \"consentContext\": {\n\t  \"captureMethod\": \"PatientPortal Web\",\n\t  \"subject\": {\n\t    \"userAgent\": \"Mozilla/5.0 (iPad; U; CPU OS 3_2 like Mac OS X; en-us) AppleWebKit/531.21.10 (KHTML, like Gecko) Version/4.0.4 Mobile/7B367 Safari/531.21.10\",\n\t    \"ipAddress\": \"10.1.0.89\"\n\t  },\n\t  \"authorizationService\": {\n\t    \"name\": \"anyHealth\",\n\t    \"client_id\": \"PatientPortal\"\n\t  }\n\t}\n}",
    CURLOPT_HTTPHEADER => array(
      "Content-Type: application/json",
      "Authorization: Bearer { \"iss\": \"PatientPortal\", \"aud\": \"ConsentAPI\", \"client_id\": \"PatientPortal\", \"sub\": \"ff99e13b-6ff8-40ef-9ce5-1cc5ef891d3e\", \"active\": true, \"scope\": \"pd:consents:unpriv\" }"
    ),
  ));
  
  $response = curl_exec($curl);
  $responseData = json_decode($response);
  $response = json_encode($responseData, JSON_PRETTY_PRINT);
  
  $err = curl_error($curl);

  if($err) {
    echo "cURL Error #:" . $err . "\n";
  }

  curl_close($curl);

} else {

?>

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

   <div class="form-group row">
    <label for="inputExpiration" class="col-sm-2 col-form-label">Expiration Date</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputExpiration" value="<?php echo $nextMonth ?>">
    </div>
  </div>

  <button type="submit" class="btn btn-primary mb-2">Confirm identity</button>
</form>

<?php } ?>


  <a href="#" onclick="toggleRaw();">Toggle Raw</a>

  <br />
  <br />

  <div style="display:none" id="rawDiv">
    <pre class='alert alert-warning'>POST https://int-docker.anyhealth-demo.ping-eng.com:1443/consent/v1/consents</pre>
    <pre class='alert alert-primary' style="height: 500px;"><?php echo $response ?></pre>
  </div>

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

