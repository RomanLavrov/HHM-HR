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

   <link rel="stylesheet" href="/HR/css/bootstrap-datepicker.css">
   <script src="/HR/js/bootstrap-datepicker.js"></script>
   
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
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo htmlspecialchars($_SESSION["username"]); ?>
                </button>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left" aria-labelledby="dropdownMenuButton">

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
                        <img src="/HR/images/all_employee.png" alt="">
                    </a>
                    <div class="btn-nav-text">Alle Mitarbeiter</div>

                </div>
                <div class="btn-nav-panel">
                    <a class="btn-nav-image" href="/HR/sicklist">
                        <img src="/HR/images/SickList.png" alt="">
                    </a>
                    <div class="btn-nav-text">Krankenstand</div>

                </div>
                <div class="btn-nav-panel">
                    <a class="btn-nav-image" href="/HR/vacations">
                        <img src="/HR/images/Vacations.png" alt="">
                    </a>
                    <div class="btn-nav-text">Ferien</div>

                </div>
                <div class="btn-nav-panel">
                    <a class="btn-nav-image" href="/HR/create">
                        <img src="/HR/images/add_employee.png" alt="" />
                    </a>
                    <div class="btn-nav-text">Add Worker</div>

                </div>

            </div>
        </div>
        <div id="content">
            <?php include 'application/views/' . $content_view; ?>
        </div>
    </div>

</body>
<script src="/HR/js/search.js"></script>
</html> 