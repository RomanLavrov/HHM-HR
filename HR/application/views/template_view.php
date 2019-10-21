<!DOCTYPE html>
<html>

<head>
      <meta charset="UTF-8">
      <title>HR Mitarbeiter</title>

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

      <script lang="javascript" src="dist/xlsx.full.min.js"></script>

      <script src="/HR/js/bootstrap-datepicker.js"></script>
      <!--script src="/HR/js/bootstrap-datepicker.de.min.js"></script-->

      <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
      <link media="screen" rel="stylesheet" href="/HR/css/style.css">
      <link media="print" rel="stylesheet" href="/HR/css/print.css">

      <link rel="stylesheet" href="/HR/css/bootstrap-datepicker.css">

      <!--<script src="/HR/js/bootstrap-datepicker.de.min.js"></script>-->


</head>

<body>
      <div id="header-main" class="row">
            <div class="col-md-6">
                  <a id="title" href="/HR/main">HHM Mitarbeiter</a>
            </div>
            <div class="col-md-4">
                  <input class="searchbar" type="search" placeholder="Suche">
            </div>
            <div class="col-md-2">
                  <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <?php echo htmlspecialchars($_SESSION["username"]); ?>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left"
                              aria-labelledby="dropdownMenuButton">

                              <a class="dropdown-item" href="/HR/logout">Sign Out Account</a>
                        </div>
                  </div>
            </div>
      </div>
      <div class="row" style="width: 100%">
            <div>
                  <div id="nav-panel">

                        <div class="btn-nav-panel">
                              <a class="btn-nav-image" href="/HR/main">
                                    <img src="/HR/images/all_employee.svg" alt="">
                              </a>
                              <div class="btn-nav-text">Alle Mitarbeiter</div>
                        </div>

                        <div class="btn-nav-panel">
                              <a class="btn-nav-image" href="/HR/main/work">
                                    <img src="/HR/images/Work.svg" alt="">
                              </a>
                              <div class="btn-nav-text">Arbeitet</div>
                        </div>

                        <div class="btn-nav-panel">
                              <a class="btn-nav-image" href="/HR/main/retired">
                                    <img src="/HR/images/Retired.svg" alt="">
                              </a>
                              <div class="btn-nav-text">Ausgetreten</div>
                        </div>

                        <div class="btn-nav-panel">
                              <a class="btn-nav-image" href="/HR/main/maternity">
                                    <img src="/HR/images/Maternity.svg" alt="">
                              </a>
                              <div class="btn-nav-text">Mutterschaftsurlaub</div>
                        </div>

                        <div class="btn-nav-panel">
                              <a class="btn-nav-image" href="/HR/sicklist">
                                    <img src="/HR/images/SickList.svg" alt="">
                              </a>
                              <div class="btn-nav-text">Krankenstand</div>

                        </div>
                        <div class="btn-nav-panel">
                              <a class="btn-nav-image" href="/HR/vacations">
                                    <img src="/HR/images/Vacations.svg" alt="">
                              </a>
                              <div class="btn-nav-text">Ferien</div>
                        </div>

                        <div class="btn-nav-panel">
                              <a class="btn-nav-image" href="/HR/create">
                                    <img src="/HR/images/add_employee.svg" alt="" />
                              </a>
                              <div class="btn-nav-text">Hinzufügen</div>
                        </div>

                        <div class="btn-nav-panel" >
                              <a class="btn-nav-image" href="/HR/PDF">
                                    <img src="/HR/images/PDF.svg" style="height:50px">
                              </a>
                              <div class="btn-nav-text">Druck</div>
                        </div>

                        <div class="btn-nav-panel" >
                              <div class="btn-nav-image">
                              <input class="btn-nav-salary" type="file"  id="salaryFile" , name="Salary" style="position:absolute; opacity: 0.0; ">
                                    <img src="/HR/images/Salary.svg" style="width:42px;"></div>
                              <div class="btn-nav-text">Lohn</div>
                              <!-- <input type="file" hidden id="salaryFile" , name="Salary">-->
                        </div>


                  </div>
            </div>
            <div id="content">
                  <?php include 'application/views/' . $content_view; ?>
            </div>
      </div>

</body>

<script src="/HR/js/search.js"></script>
<script src="/HR/js/Salary.js"></script>

</html>