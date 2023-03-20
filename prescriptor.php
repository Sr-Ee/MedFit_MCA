<?php  include('C:/xampp/htdocs/MedFit_MCA/doctor/includes/doc_header.php'); ?>
<?php  include('C:/xampp/htdocs/MedFit_MCA/doctor/includes/sidebar.php'); ?>
<?php $count = 0;
 
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Prescription</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.1/css/bootstrap.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body class="bg-dark">
  <div class="container">
    <div class="row my-4">
      <div class="col-lg-20 mx-auto">
        <div class="card shadow">
          <div class="cardheader">
            <h4>Add medicines</h4>
          </div>
          <div class="cardBody p-4">
            <div id="show_alert"></div>
            <form action="#" method="POST" id="add_medicine">
              <div id="show_medicines">
                <div class="row">
                  <div class="col-md-3 mb-2">
                    <input type="text" name="Medicine_Name[]" class="form-control" placeholder="Medicine_Name" required>
                  </div>

                  <div class="col-md-2 mb-2">
                    <input type="text" name="dosage[]" class="form-control" placeholder="Dosage" required>
                  </div>

                  <div class="col-md-1 mb-1 ">
                    Morning<input type="checkbox" name="morning[]" placeholder="m_dose" value="Y">
                  </div>

                  <div class="col-md-1 mb-1 ">
                    Aftrnoon<input type="checkbox" name="aftrnoon[]" placeholder="a_dose" value="Y">
                  </div>

                  <div class="col-md-1 mb-1" >
                    Evening<input type="checkbox" name="evening[]" placeholder="e_dose" value="Y">
                  </div>

                  <!-- <div class="col-md-1 md-1 d-grid p-1">
                    <button class="btn btn-success add_item_btn">+</button>
                  </div> -->
                </div>
              </div>
              <div>
                <input type="submit" value="Done" class="btn btn-primary w-25" id="done_btn">

                <a href="generate_pdf.php" class="btn btn-danger" target="_blank">Generate PDF</a>
                
              </div>
            </form>
            <a href="/MedFit_MCA/doctor/index.php"> Back</a>  
          </div>
        </div>
      </div>
    </div>
  </div>

  
  <script>
    $(document).ready(function(){
      $(".add_item_btn").click(function(e){
        <?php $count = $count + 1; 
            
           
        ?>
        e.preventDefault();
        $("#show_medicines").prepend(`<div class="row append_item">
                  <div class="col-md-3 mb-3">
                    <input type="text" name="Medicine_Name[]" class="form-control" placeholder="Medicine_Name" required>
                  </div>

                  <div class="col-md-2 mb-3">
                    <input type="text" name="dosage[]" class="form-control" placeholder="dosage" required>
                  </div>

                  <div class="col-md-1 mb-3 ">
                    Morning<input type="checkbox" name="morning[]" placeholder="m_dose">
                  </div>

                  <div class="col-md-1 mb-3 ">
                    Aftrnoon<input type="checkbox" name="aftrnoon[]" placeholder="a_dose">
                  </div>

                  <div class="col-md-1 mb-3" >
                    Evening<input type="checkbox" name="evening[]" placeholder="e_dose">
                  </div>

                  <div class="col-md-1 md-3 d-grid p-1">
                    <button class="btn btn-danger remove_item_btn">-</button>
                  </div>
                </div>`);
            });
            $(document).on('click', '.remove_item_btn', function(e){
              
              <?php $count = $count - 1; ?>

              e.preventDefault();
              let row_item = $(this).parent().parent(); 
              $(row_item).remove();
            });
          
            //ajax request to insert all form data 
            $("#add_medicine").submit(function(e){
           
              e.preventDefault();
              $("#done_btn").val('Added');
              $.ajax({
                url: 'presc_action.php',
                method: 'post',
                data: $(this).serialize(),
                success:function(response){
                  $("#add_btn").val('Add');
                  $("#add_medicine")[0].reset();
                  $(".append_item").remove();
                  $("#show_alert").html(`<div class="alert alert-success" role="alert">${response}</div>`);
                }
              })
            }); 
    });
  </script>
</body>
</html>
