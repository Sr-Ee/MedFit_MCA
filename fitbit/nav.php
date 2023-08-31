<nav class="navbar navbar-dark bg-dark navbar-expand-lg fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="/MedFit_MCA/welcome.php">MedFit</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="fitbit_data.php">Home</a>
          </li>
          <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Activity Report
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="activity.php">Activity Data by Date</a></li>
          </ul>
        </li>
          <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Heart Rate Report
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="heart_date.php">Heart Rate By Date</a></li>
            <!-- <li><a class="dropdown-item" href="heart.php">Heart Rate by Interval</a></li> -->
          </ul>
        </li>
          <li class="nav-item">
            <a class="nav-link" href="vo2.php">Cardio Score</a>
          </li>
        </ul>
      </div>
    </div>
</nav>