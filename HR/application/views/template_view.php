<!DOCTYPE html>
<html>

<head>
      <meta charset="UTF-8">
      <title>HR Mitarbeiter</title>
      <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="/HR/css/style.css">
</head>

<body>
      <div id="header-main" class="row">
            <div class="col-md-3">
                  <a id="title" href="/HR/main">HHM Mitarbeiter</a>
            </div>
            <div class="col-md-6">
                  <input class="searchbar" type="text" placeholder="Suche">
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
                        <button class="btn-nav">
                              <a class="reference-text" href="/HR/main">
                                    <img src="/HR/images/all_employee.png" alt="">
                                    <div>All workers</div>
                              </a>
                        </button>
                        <button class="btn-nav">
                              <a class="reference-text" href="/HR/sicklist">
                                    <img src="/HR/images/SickList.png" alt="">
                                    <div>Sick List</div>
                              </a>
                        </button>
                        <button class="btn-nav">
                              <a class="reference-text" href="/HR/vacations">
                                    <img src="/HR/images/Vacations.png" alt="">
                                    <div>Ferien</div>
                              </a>
                        </button>
                        <button class="btn-nav">
                              <a class="reference-text" href="/HR/create">
                                    <img src="/HR/images/add_employee.png" alt="">
                                    <div>Add Worker</div>
                              </a>
                        </button>
                  </div>
            </div>
            <div id="content">
                  <?php include 'application/views/' . $content_view;?>
            </div>
      </div>

</body>

</html>