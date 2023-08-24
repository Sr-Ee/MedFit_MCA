<!DOCTYPE html>
<html>
<head>
    <title>Fitbit - Activity</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
    integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<style>
    table, th, td {
  border: 1px solid black;
}
.container{
    width: 32rem;
    margin-top: 5rem;
}
#dataTable{
    margin-top: 10px;
}
button{
    margin: 2px;
}
</style>
<body>
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
          <li class="nav-item">
            <a class="nav-link" href="activity.php">Activity</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="heart.php">Heart Rate</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="vo2.php">cardio Score</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container">
  <h1>Fitbit Activity</h1>
    <label for="startDate" class="form-label">Start Date:</label>
    <input type="date" class="form-control" id="startDate" required>
    <label for="endDate" class="form-label">End Date:</label>
    <input type="date" class="form-control" id="endDate" required>
    <button id="fetchData" class="btn btn-primary">Fetch Data</button>

    <table id="dataTable"  class="table table-striped-columns">
        <thead>
            <tr>
                <th>Date</th>
                <th>Steps</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
  </div>
   
    <script src="activity.js"></script>
</body>
</html>
