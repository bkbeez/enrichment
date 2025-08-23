<?php require 'session.php' ?>
<?php include 'head.php' ?>


<style>
  .loader {
    border: 8px solid #f3f3f3;
    border-top: 8px solid #3498db;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    animation: spin 1s linear infinite;
    display: none; /* Initially hide the loader */
    margin-left: 50%;
    position: absolute;
  }

  @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }
  
  .modal-content {
    border-radius: 20px; /* Adjust the value as needed */
  }

  .img{
    border-radius: 20px;
  }

  .card {
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    transition: 0.3s;
    border-radius: 20px;
  }

  .card:hover {
    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
  }
  .position-fixed {
    position: fixed;
/*    top: 0;
    bottom: 0;*/
    overflow-y: auto;
  }

  .left-sidebar {
    left: 0;
    z-index: 10;
  }

  .right-sidebar {
    right: 0;
  }
</style>


</head>
<body class="body-home-one">
  <!-- Main Wrapper -->
  <div class="main-wrapper">

    <?php include 'header.php' ?>


    <?php 
    if ($_SESSION['user_type'] == 'admin') {
      $get_student_id = $_GET['student_id'];
    }else{
      $get_student_id = '';
    }

    ?>

    <!-- Breadcrumb -->
    <div class="breadcrumb-bar">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-12 col-12">
            <nav aria-label="breadcrumb" class="page-breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">course</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
    <!-- /Breadcrumb -->


    <section class="most-popular most-popular-five py-4">
      <div class="container" style="margin-bottom: 400px;">

        <div class="row">
          <div class="col-md-4 position-fixed left-sidebar">
            <div id="loader1" class="loader"></div>
            <div id="user_detail"></div>

          </div>
          <div class="col-md-8 offset-md-4">
            <div id="check_pass"></div>
            <div id="loader2" class="loader"></div>
            <div id="course_purchase"></div>
          </div>
        </div>



      </div>
    </section>




    <?php include 'footer.php' ?>
  </div>

  <input type="text" id="cmuitaccount" value="<?= $_SESSION['cmuitaccount'] ?>" readonly hidden>
  <input type="text" id="academic_year" value="<?= $_SESSION['academic_year'] ?>" readonly hidden>
  <input type="text" id="get_student_id" value="<?= $get_student_id ?>" readonly hidden>


  <!-- /Main Wrapper -->
  <?php include 'script.php' ?>


  <script>
    $(document).ready(function() {

      var cmuitaccount = $('#cmuitaccount').val();
      var academic_year = $('#academic_year').val();
      var get_student_id = $('#get_student_id').val();

      console.log(cmuitaccount);
      function load_check_pass(action, targetElement) {
        $.ajax({
          url: 'assets/php/action_check_pass.php',
          type: 'POST',
          data: { [action]: true, 'cmuitaccount': cmuitaccount,'academic_year': academic_year},
          success: function (data) {
            $(targetElement).html(data);
          },
          error: function (xhr, status, error) {
            console.error(xhr.responseText);
          }
        });
      }
      load_check_pass('check_pass', '#check_pass');


      function showLoader(loader) {
        $(loader).show();
      }

      function hideLoader(loader) {
        $(loader).hide();
      }
      function load_course_purchase(action, targetElement, loader, cmuitaccount, get_student_id) {
        showLoader(loader);

        $.ajax({
          url: 'assets/php/action_course_purchase.php',
          type: 'POST',
          data: {
            [action]: true,
            cmuitaccount: cmuitaccount,
            get_student_id: get_student_id
          },
          success: function (data) {
            hideLoader(loader);
            $(targetElement).html(data);
          },
          error: function (xhr, status, error) {
            console.error(xhr.responseText);
          }
        });
      }

      load_course_purchase('get_course_purchase', '#course_purchase', '#loader2', cmuitaccount, get_student_id);
      load_course_purchase('get_user_detail', '#user_detail', '#loader1', cmuitaccount, get_student_id );



      $(document).on('click', '.delete_purchase', function (e) {
        e.preventDefault();

        var id = $(this).data('id');
        var cmuitaccount = $(this).data('cmuitaccount');
        // console.log(id);
        // console.log(cmuitaccount);

        Swal.fire({
          title: 'คุณต้องการลบ course ใช่หรือไม่?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'ใช่',
          cancelButtonText: 'ไม่',
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              type: "POST",
              url: 'assets/php/action_course_purchase.php',
              data: {
                'delete_purchase': true,
                'id': id,
                'cmuitaccount': cmuitaccount
              },
              success: function (response) {
                var res = jQuery.parseJSON(response);
                if (res.status == 500) {
                  Swal.fire('Error', res.message, 'error');
                } else {

                  load_course_purchase('get_course_purchase', '#course_purchase', '#loader2', cmuitaccount);
                  load_course_purchase('get_user_detail', '#user_detail', '#loader1', cmuitaccount);
                }
              }
            });
          }
        });
      });


      $(document).on('click', '.course_learning', function (e) {
        e.preventDefault();
        var course_uid = $(this).data('course_uid');
        var url = 'course_learning?course=' + course_uid;
        window.location.href = url;
      });


      $(document).on("click", ".certificate_export", function (e) {
        e.preventDefault();

        var purchase_id = $(this).data('purchase_id');
        console.log(purchase_id);
      // console.log(name);
      // console.log(date);
      // console.log(code);

        window.open('../certificate_export?'+'purchase='+purchase_id, '_blank');

      });








    });
  </script>








</body>
</html>