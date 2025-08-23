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
  #exampleModal {
    z-index: 10050; /* You can adjust this value based on your needs */
  }
  .modal-content {
    border-radius: 20px; /* Adjust the value as needed */
  }
  .card{
    border-radius: 20px;
  }

/* Set a fixed height for the carousel items */
.owl-carousel .product-content {
  height: 200px; /* Adjust the height as needed */
  overflow: hidden; /* Hide overflowing content */
}
.play-overlay {
  bottom: 50%;
  font-size: 20px;
  color: black;
  cursor: pointer;
  transition: opacity 0.2s;
}

.play-overlay:hover {
  opacity: 0.8;
}

.duration-overlay {
  position: absolute;
  top: 60px;
  right: 4px;
  background-color: rgba(0, 0, 0, 0.7);
  color: #fff;
  padding: 4px 8px;
  border-radius: 4px;
  font-size: 12px;
  font-weight: bold;
}
</style>


</head>
<body class="body-home-one">
  <!-- Main Wrapper -->
  <div class="main-wrapper">

    <?php include 'header.php' ?>

    <!-- Most popular Categories -->
    <section class="most-popular most-popular-five pt-3">
      <div class="container">
        <div class="section-header section-head-left aos " data-aos="fade-up">
          <h2>Edu e-activity</h2><h6><?= $_SESSION['academic_year']; ?> <?php echo $_SESSION['cmuitaccount']; ?></h6>
        </div>
        <div class="popular-categories aos " data-aos="fade-up">
          <div class="row">
            <div class="col-lg-4 col-md-6">
              <a href="">
                <div class="sub-categories d-flex align-items-center p-3">
                  <div class="categories-img">
                    <img src="assets/img/categories/cate-27.png" alt="">
                  </div>
                  <div class="categories-text ">
                    <h4>ข้อมูลนักศึกษา</h4>
                    <span></span>
                  </div>
                </div>
              </a>
            </div>
            <div class="col-lg-4 col-md-6">
              <a href="" id="course_purchase">
                <div class="sub-categories d-flex align-items-center p-3">
                  <div class="categories-img-sub">
                   <i class="bi bi-cart-check fa-4x text-primary"></i>
                 </div>
                 <div class="categories-text">
                  <h4>Activity ของฉัน</h4>
                  <span><b id="course_total"></b> Courses</span>
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-4 col-md-6">
            <a href="" class="btn_manual_modal">
              <div class="sub-categories d-flex align-items-center p-3">
                <div class="categories-img-sub">
                  <i class="bi bi-chat-left-text fa-4x text-primary"></i>
                </div>
                <div class="categories-text ">
                  <h4>คู่มือการใช้งาน</h4>
                  <span></span>
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- /Most popular Categories -->


  <!-- Most trending course -->
  <section class="section trending-courses trending-courses-five py-0">
    <div class="container">
      <div class="section-header section-head-left aos " data-aos="fade-up">
        <h2>กิจกรรม รวม</h2>
        <p class="sub-title">กิจกรรมอบรม</p>
        <div class="view-all ">
          <a href="">ดูทั้งหมด <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
        </div>
      </div>

      <div id="loader5" class="loader"></div>
      <div id="course_Swiper5"></div>


    </div>
  </section>
  <!-- /Most trending course -->


  <!-- Most trending course -->
  <section class="section trending-courses trending-courses-five py-0">
    <div class="container">
      <div class="section-header section-head-left aos " data-aos="fade-up">
        <h2>กิจกรรม ชั้นปีที่ 1</h2>
        <p class="sub-title">กิจกรรมอบรม</p>
        <div class="view-all ">
          <a href="">ดูทั้งหมด <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
        </div>
      </div>

      <div id="loader1" class="loader"></div>
      <div id="course_Swiper1"></div>


    </div>
  </section>
  <!-- /Most trending course -->


  <!-- Most trending course -->
  <section class="section trending-courses trending-courses-five py-0">
    <div class="container">
      <div class="section-header section-head-left aos " data-aos="fade-up">
        <h2>กิจกรรม ชั้นปีที่ 2</h2>
        <p class="sub-title">กิจกรรมอบรม</p>
        <div class="view-all ">
          <a href="">ดูทั้งหมด <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
        </div>
      </div>

      <div id="loader2" class="loader"></div>
      <div id="course_Swiper2"></div>

    </div>
  </section>
  <!-- /Most trending course -->

  <!-- Most trending course -->
  <section class="section trending-courses trending-courses-five py-0">
    <div class="container">
      <div class="section-header section-head-left aos " data-aos="fade-up">
        <h2>กิจกรรม ชั้นปีที่ 3</h2>
        <p class="sub-title">กิจกรรมอบรม</p>
        <div class="view-all ">
          <a href="">ดูทั้งหมด <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
        </div>
      </div>

      <div id="loader3" class="loader"></div>
      <div id="course_Swiper3"></div>

    </div>
  </section>
  <!-- /Most trending course -->



  <!-- Most trending course -->
  <section class="section trending-courses trending-courses-five py-0">
    <div class="container">
      <div class="section-header section-head-left aos " data-aos="fade-up">
        <h2>กิจกรรม ชั้นปีที่ 4</h2>
        <p class="sub-title">กิจกรรมอบรม</p>
        <div class="view-all ">
          <a href="">ดูทั้งหมด <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
        </div>
      </div>

      <div id="loader4" class="loader"></div>
      <div id="course_Swiper4"></div>

    </div>
  </section>
  <!-- /Most trending course -->



  <?php include 'footer.php' ?>
</div>




<div id="purchase_modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="myModalLabel" >
  <div class="modal-dialog modal-xl">
    <div class="modal-content">

    </div>
  </div>
</div>

<div id="show_course_modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content modal-dialog-centered">

    </div>
  </div>
</div>

<div id="manual_modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

    </div>
  </div>
</div>


<input type="text" id="cmuitaccount" value="<?= $_SESSION['cmuitaccount'] ?>" readonly hidden>
<input type="text" id="student_id" value="<?= $_SESSION['student_id'] ?>" readonly hidden>
<input type="text" id="academic_year" value="<?= $_SESSION['academic_year'] ?>" readonly hidden>

<!-- /Main Wrapper -->
<?php include 'script.php' ?>


<script>
  $(document).ready(function() {

    var year1 = 1;
    var year2 = 2;
    var year3 = 3;
    var year4 = 4;
    var notyear = 5;
    var cmuitaccount = $('#cmuitaccount').val();
    var student_id = $('#student_id').val();
    var academic_year = $('#academic_year').val();

    function showLoader(loader) {
      $(loader).show();
    }

    function hideLoader(loader) {
        // Hide the specified loader
      $(loader).hide();
    }

    function loadTable2(action, targetElement, loader, year , cmuitaccount) {
      showLoader(loader);

      $.ajax({
        url: 'assets/php/action_home.php',
        type: 'POST',
        data: {
          [action]: true,
          year: year,
          cmuitaccount: cmuitaccount
        },
        success: function (data) {
          hideLoader(loader);
          $(targetElement).html(data);
          //console.log(data);

          $(".owl-carousel").owlCarousel({
            items: 3,
            loop: false,
            margin: 10,
            autoplay: false,
            autoplayTimeout: 3000,
            responsiveClass: true,
            responsive: {
              0: {
                items: 1
              },
              600: {
                items: 3
              },
              1000: {
                items: 4
              }
            }
          });

        },
        error: function (xhr, status, error) {
          console.error(xhr.responseText);
          hideLoader(loader);
        }
      });
    }

    loadTable2('get_course_Swiper', '#course_Swiper1', '#loader1', year1, cmuitaccount);
    loadTable2('get_course_Swiper', '#course_Swiper2', '#loader2', year2, cmuitaccount);
    loadTable2('get_course_Swiper', '#course_Swiper3', '#loader3', year3, cmuitaccount);
    loadTable2('get_course_Swiper', '#course_Swiper4', '#loader4', year4, cmuitaccount);
    loadTable2('get_course_Swiper', '#course_Swiper5', '#loader5', notyear, cmuitaccount);

    $(document).on("click", ".btn_purchase", function (e) {
      e.preventDefault();

      var course_id = $(this).data('course_id');
      // console.log(course_id);
      // console.log(cmuitaccount);
      // console.log(student_id);

      $.ajax({
        url: 'assets/php/action_home.php',
        type: 'POST',
        data: { 
          'purchase_modal' : true,
          course_id: course_id,
          cmuitaccount:cmuitaccount,
          student_id:student_id,
          academic_year:academic_year
        },
        success: function (data) {
          $("#purchase_modal .modal-content").html(data);
          $('#purchase_modal').modal('show');
        }
      });
    });



    $(document).on('click', '.btn_free', function (e) {
      e.preventDefault();


      $(this).prop('disabled', true);

      var course_id = $(this).data('course_id');
      var cmuitaccount = $(this).data('cmuitaccount');
      var student_id = $(this).data('student_id');
      var academic_year = $(this).data('academic_year');

      // console.log(course_id);
      // console.log(cmuitaccount);
      // console.log(student_id);

      Swal.fire({
        title: 'คุณต้องการเพิ่ม course <br> ใช่หรือไม่?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'ใช่ ตกลง',
        confirmButtonColor: '#',
        cancelButtonText: 'ไม่',
        cancelButtonColor: '#',
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            type: "POST",
            url: 'assets/php/action_home.php',
            data: {
              'course_purchase': true,
              course_id: course_id,
              cmuitaccount: cmuitaccount,
              student_id: student_id,
              academic_year: academic_year
            },
            success: function (response) {
              var res = jQuery.parseJSON(response);
              if (res.status == 500) {
                Swal.fire('Error', res.message, 'error');
              } else {

                Swal.fire({
                  title: 'Success',
                  text: 'Course added successfully',
                  icon: 'success',
                  showCancelButton: false,
                  confirmButtonText: 'OK',
                }).then((result) => {
              // Navigate to a specific URL after confirming
                  if (result.isConfirmed) {
                    window.location.href = 'course_purchase';
                  }
                });

                loadTable2('get_course_Swiper', '#course_Swiper1', '#loader1', year1, cmuitaccount);
                loadTable2('get_course_Swiper', '#course_Swiper2', '#loader2', year2, cmuitaccount);
                loadTable2('get_course_Swiper', '#course_Swiper3', '#loader3', year3, cmuitaccount);
                loadTable2('get_course_Swiper', '#course_Swiper4', '#loader4', year4, cmuitaccount);
                loadTable2('get_course_Swiper', '#course_Swiper5', '#loader5', notyear, cmuitaccount);

                $('#purchase_modal').modal('hide');

              }
            },
            error: function () {
          // Error message if AJAX request fails
              Swal.fire('Error', 'Failed to add course', 'error');
            },
            complete: function () {
          // Re-enable the button after the AJAX request completes
              $('.btn_free').prop('disabled', false);
            }
          });
        } else {
      // Re-enable the button if the user cancels the action
          $('.btn_free').prop('disabled', false);
        }
      });
    });

    function load_course_total(action, targetElement, cmuitaccount) {

      $.ajax({
        url: 'assets/php/action_home.php',
        type: 'POST',
        data: {
          [action]: true,
          cmuitaccount: cmuitaccount
        },
        success: function (data) {
          $(targetElement).html(data);

        },
        error: function (xhr, status, error) {
          console.error(xhr.responseText);
        }
      });
    }

    load_course_total('get_course_total', '#course_total', cmuitaccount);

    $('#course_purchase').click(function() {
      $('#course_purchase').attr('href', 'course_purchase');
    });



    $(document).on("click", ".btn_view", function (e) {
      e.preventDefault();

      var id = $(this).data('id');
      //console.log(id);

      $.ajax({
        url: 'assets/php/action_home.php',
        type: 'POST',
        data: { 
          'show_course_modal' : true,
          id: id,
        },
        success: function (data) {
          $("#show_course_modal .modal-content").html(data);
          $('#show_course_modal').modal('show');
        }
      });
    });



    $(document).on("click", ".btn_manual_modal", function (e) {
      e.preventDefault();

      //var id = $(this).data('id');
      //console.log(id);

      $.ajax({
        url: 'assets/php/action_home.php',
        type: 'POST',
        data: { 
          'manual_modal' : true,
          //id: id,
        },
        success: function (data) {
          $("#manual_modal .modal-content").html(data);
          $('#manual_modal').modal('show');
        }
      });
    });













  });
</script>








</body>
</html>