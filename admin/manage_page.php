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

    <!-- Home Banner -->
    <section class="home-slide home-slide-five d-flex align-items-center">
      <div class="container">
        <div class="row ">
          <div class="col-md-6 d-flex align-items-center">
            <div class="home-slide-face aos" data-aos="fade-up">
              <div class="home-slide-text ">
                <a href="../dashboard.html" class="btn bg-stop-learn">Never Stop Learning</a>
                <h1><span>Online Courses</span><br>Enrichment-program <br>to Learn </h1>
                <p>Own your future learning new skills online</p>
              </div>
              <!-- Search -->
              <div class="search-box">

              </div>
              <!-- /Search -->
            </div>
          </div>
          <div class="col-md-6 d-flex align-items-end">
            <div class="girl-slide-img aos " data-aos="fade-up">
              <img src="../assets/img/object-6.png" alt="">
            </div>
          </div>
        </div>
        <div class="slide-background">
          <img src="../assets/img/slide-bg.png" alt="">
        </div>
      </div>
    </section>
    <!-- /Home Banner -->


    <div class="container mt-5">

      <div id="data1"></div>






    </div>




  </div>
  <?php //include '../footer.php' ?>

  <?php include 'script.php' ?>


  <script>
    $(document).ready(function() {

      function loadItems(targetElement, postData) {
        $.ajax({
          url: '../assets/php/action_manage_page.php',
          type: 'POST',
          data: postData,
          success: function(response) {
            //console.log(response);
            $(targetElement).html(response);
          }
        });
      }

      function refreshContent() {
        loadItems('#data1', { 'data1': true });
      }

      refreshContent();

      $(document).on('input', '.input_image_url', function () {
        var imageUrl = $(this).val();
        var code_page=$(this).attr("data-code_page");
        console.log(imageUrl);
        console.log(code_page);
        $('#' + code_page).attr('src', imageUrl);
        save_url(imageUrl,code_page);
      });

      function save_url(imageUrl,code_page) {
        $.ajax({
          type: 'POST',
          url: '../assets/php/action_manage_page.php',
          data: {
            'update_imageUrl': true,
            imageUrl: imageUrl,
            code_page: code_page
          },
          success: function(response) {
            console.log(response);
            $('#response').html(response);
          }
        });
      }
    });
  </script>










</body>
</html>