<!DOCTYPE html>
<html>
 <head>
  <title>CSV File Editing and Importing in PHP</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <style>
  .box
  {
   max-width:600px;
   width:100%;
   margin: 0 auto;;
  }
  </style>
 </head>
 <body>
  <div align="center" class="container">
   <br />
   <h3 align="center">CSV File Editing and Importing in PHP</h3>
   <br />
   <form id="upload_csv" method="post" enctype="multipart/form-data">
    <div class="col-md-3">
     <br />
     <label>Select CSV File</label>
    </div>  
                <div class="col-md-4">  
                    <input type="file" name="csv_file" id="csv_file" accept=".csv" style="margin-top:15px;" />
                </div>  
                <div class="col-md-5">  
                    <input type="submit" name="upload" id="upload" value="Upload" style="margin-top:10px;" class="btn btn-info" />
                </div>  
                <div style="clear:both"></div>
                <div align="center">
                    <br>
                    <button><a href="./form.php">Use Previously Imported Data</a></button>
                </div>
                
   </form>
   <br />
   <br />
   <div id="csv_file_data"></div>
   
  </div>
 </body>
</html>

<script>

$(document).ready(function(){
 $('#upload_csv').on('submit', function(event){
  event.preventDefault();
  $.ajax({
   url:"./includes/fetch.php",
   method:"POST",
   data:new FormData(this),
   dataType:'json',
   contentType:false,
   cache:false,
   processData:false,
   success:function(data)
   {
    var html = '<table class="table table-striped table-bordered">';
    if(data.column)
    {
     html += '<tr>';
     for(var count = 0; count < data.column.length; count++)
     {
      html += '<th>'+data.column[count]+'</th>';
     }
     html += '</tr>';
    }

    if(data.row_data)
    {
     for(var count = 0; count < data.row_data.length; count++)
     {
      html += '<tr>';
      html += '<td class="user_name" contenteditable>'+data.row_data[count].user_name+'</td>';
      html += '<td class="user_email" contenteditable>'+data.row_data[count].user_email+'</td></tr>';
     }
    }
    html += '<table>';
    html += '<div align="center"><button type="button" id="import_data" class="btn btn-success">Import</button></div>';

    $('#csv_file_data').html(html);
    $('#upload_csv')[0].reset();
   }
  })
 });

 $(document).on('click', '#import_data', function(){
  var user_name = [];
  var user_email = [];
  $('.user_name').each(function(){
   user_name.push($(this).text());
  });
  $('.user_email').each(function(){
   user_email.push($(this).text());
  });
  $.ajax({
   url:"./includes/import.php",
   method:"post",
   data:{user_name:user_name, user_email:user_email},
   success:function(data)
   {
    $('#csv_file_data').html('<div class="alert alert-success">Data Imported Successfully</div>');
    
        window.location.assign("./form.php")
    
   }
  })
 });
});

</script>