<?php require '../session.php' ?>
<?php include '../head.php' ?>

<style>
  body{
    background-color: gray;
  }

  .loader {
    border: 8px solid #f3f3f3;
    border-top: 8px solid #3498db;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    animation: spin 1s linear infinite;
    display: none; /* Initially hide the loader */
    margin-left: 40%;
  }

  @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }

  .modal-content {
    border-radius: 20px; /* Adjust the value as needed */
  }

  .card {
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    transition: 0.3s;
    border-radius: 20px;
  }

  .card:hover {
    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
  }
  
</style>

</head>

<body>
  <div class="content-wrapper">
    <?php include '../header.php' ?>


    <div class="container mt-5">



      <form id="uploadForm" enctype="multipart/form-data">
        Select file to upload:
        <input type="file" name="file" id="file">
        <input type="text" id="name" name="name" value="test">
        <input type="text" id="code" name="code" value="test">
        <!-- Remove the upload button -->
      </form>

      <div id="uploadStatus"></div>






    </div>




  </div>
  <?php //include '../footer.php' ?>

  <?php include 'script.php' ?>


  <script>
    $(document).ready(function(){
      $('#file').change(function(){
        var file = this.files[0];
        var name = $('#name').val();
        var code = $('#code').val();

        if (file) {
          var formData = new FormData();
          formData.append('file', file);
          formData.append('name', name);
          formData.append('code', code);
          formData.append('upload_file', 'true');

          $.ajax({
            url: '../assets/php/action_manage_upload.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
              $('#uploadStatus').html(response);
              $('#file').val('');

              setTimeout(function() {
                $('#uploadStatus').html('');
              }, 3000);
            },
            error: function(xhr, status, error) {
              $('#uploadStatus').html('Error uploading file: ' + error);
            }
          });
        }
      });
    });

  </script>










</body>
</html>