<?php 
session_start();

if (isset($_SESSION['cmuitaccount'])) {
  header('Location: home');
  exit();
}

?>



<?php include 'head.php' ?>



<style>

  .modal-content {
    border-radius: 20px; /* Adjust the value as needed */
  }
  .card {
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    transition: 0.3s;
    border-radius: 20px;
  }

/*  .card:hover {
    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
  }*/

  .owl-carousel .product-content {
    height: 200px; /* Adjust the height as needed */
    overflow: hidden; /* Hide overflowing content */
  }

  .shadow1{
    box-shadow: rgb(38, 57, 77) 0px 20px 30px -10px;
  }

  .product-img2 {
    position: relative;
/*    overflow: hidden;*/
z-index: 1;
border-radius: 2px 0px 0 0;
}
.product-img2 img {
  width: 100%;
  border-radius: 4px 4px 0 0;
  transform: translateZ(0);
  transition: all 2000ms cubic-bezier(.19,1,.22,1) 0ms;
}
.product-img2:hover img {
  -webkit-transform: scale(1.15);
  -moz-transform: scale(1.15);
  transform: scale(1.15);
}

.bg_A{ color: green;}
.bg_D{ color: yellowgreen;}
.bg_R{ color: gold;}
.bg_I{ color: orange;}
.bg_C{ color: orangered;}


.card {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  cursor: pointer;
}

.card:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}

</style>


</head>
<body class="body-home-one">
  <!-- Main Wrapper -->
  <div class="main-wrapper">

    <?php include 'header.php' ?>

    <!-- Home Banner -->
    <section class="home-slide d-flex align-items-center" style="margin-top: -50px; margin-bottom: -50px;">
      <div class="container-fluid">
        <div class="row ">
<!--           <div class="col-md-6 d-flex align-items-center px-1">
            <div class="home-slide-face aos" data-aos="fade-up">
              <div class="home-slide-text">
                <h1 class="fw-bold text-white" style="border-radius: 25px; text-shadow: darkblue 1px 0 10px; background-color: #007bff; display: inline-block; padding: 8px;">กิจกรรมเสริมความเป็นครู</h1>

                <h1 class="fw-bold text-white" style="text-shadow: deepskyblue 10px 0 15px;">เพื่อพัฒนาทักษะชีวิตและวิชาชีพ</h1>
                <p class="">(Soft Skill Of Pre-service Teacher)</p>
                <p class="">คณะศึกษาศาสตร์ มหาวิทยาลัยเชียงใหม่</p>
              </div>
            </div>
          </div> -->
          <div class="col-md-12 d-flex justify-content-center">
            <div class="girl-slide-img aos " data-aos="fade-up">
              <div id="img1"></div>
            </div>
          </div>
        </div>
        <div class="slide-background">
          <!-- <img src="assets/img/slide-bg.png" alt="" style="margin-top: -50px;"> -->
        </div>
      </div>
    </section>
    <!-- /Home Banner -->


    <!-- Most trending course -->
    <section class="section trending-courses trending-courses-five py-0">
      <div class="container">
        <div class="section-header section-head-left aos " data-aos="fade-up">
          <h2>กิจกรรม รวม</h2>
          <p class="sub-title">กิจกรรมอบรม</p>
<!--           <div class="view-all ">
            <a href="">ดูทั้งหมด <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
          </div> -->
        </div>

        <div class="row">
          <div class="col-6">
            <div class="form-floating mb-3">
              <input type="text" id="searchInput" class="form-control">
              <label for="">ค้นหา รหัสกิจกรรม หรือ ชื่อกิจกรรม</label>
            </div>
          </div>
          <div class="col-6">

            <div class="form-floating mb-3">
              <div class="form-floating">
                <select class="form-select" id="searchInput_ADRIC" style="text-align: center;">
                  <option value="" selected>ทั้งหมด ADRIC</option>
                  <option value="A">A</option>
                  <option value="D">D</option>
                  <option value="R">R</option>
                  <option value="I">I</option>
                  <option value="C">C</option>
                </select>
                <label>ค้นหา ADRIC</label>
              </div>
            </div>

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

        <div class="h1 pt-3">สมรรถนะขั้นสูง <b class="bg_A">A</b><b class="bg_D">D</b><b class="bg_R">R</b><b class="bg_I">I</b><b class="bg_C">C</b></div>

        <div class="section-header section-head-left aos " data-aos="fade-up">
          <img src="https://webmaster.edu.cmu.ac.th/assets/upload/images/2024/07/27_20240711115001.png" width="100%">
        </div>

        <div class="row d-flex justify-content-center text-center" style="font-size: 80px;">
          <div class="col-md-2">
            <div class="card btn_choose_adric" data-value="A" style="background-color: WhiteSmoke;">
              <div class="card-body">
                <span class="bg_A">A</span>
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <div class="card btn_choose_adric" data-value="D" style="background-color: WhiteSmoke;">
              <div class="card-body">
                <span class="bg_D">D</span>
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <div class="card btn_choose_adric" data-value="R" style="background-color: WhiteSmoke;">
              <div class="card-body">
                <span class="bg_R">R</span>
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <div class="card btn_choose_adric" data-value="I" style="background-color: WhiteSmoke;">
              <div class="card-body">
                <span class="bg_I">I</span>
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <div class="card btn_choose_adric" data-value="C" style="background-color: WhiteSmoke;">
              <div class="card-body">
                <span class="bg_C">C</span>
              </div>
            </div>
          </div>
        </div>


      </div>
    </section>



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




    <!-- Latest blog five -->
    <section class="trending-courses rating-instructor-four rating-instructor-five blog-latest p-0 m-0">
      <div class="container">
        <div class="instructor-four-face aos " data-aos="fade-up">

          <div id="img2"></div>

        </div>
      </div>
    </section>
    <!-- /Latest blog five -->



    <?php include 'footer.php' ?>
  </div>


  <div id="show_course_modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg">
      <div class="modal-content modal-dialog-centered">

      </div>
    </div>
  </div>





  <!-- /Main Wrapper -->
  <?php include 'script.php' ?>


  <script>
    $(document).ready(function() {
      $('#cmulogin').click(function(event) {
        event.preventDefault();
        window.location.href = 'cmu_oauth/callback.php';
      });
    });
  </script>



  <script>
    $(document).ready(function() {

     function loadimg(targetElement, postData) {
      $.ajax({
        url: 'assets/php/action_index.php',
        type: 'POST',
        data: postData,
        success: function(response) {
          $(targetElement).html(response);
        }
      });
    }

    function loadimgContent() {
      loadimg('#img1', { 'img1': true });
      loadimg('#img2', { 'img2': true });
    }
    loadimgContent();

    var year1 = 1;
    var year2 = 2;
    var year3 = 3;
    var year4 = 4;
    var year5 = 5;

    loadTable2('get_course_Swiper', '#course_Swiper5', '#loader5', year5, '', '');

    $('#searchInput, #searchInput_ADRIC').on('input', function() {
      var searchQuery = $('#searchInput').val();
      var searchADRIC = $('#searchInput_ADRIC').val();
      loadTable2('get_course_Swiper', '#course_Swiper5', '#loader5', year5, searchQuery, searchADRIC);
        //console.log(searchQuery);
    });


    $('.btn_choose_adric').on('click', function() {
      var value = $(this).data('value');
      $('#searchInput_ADRIC').val(value).trigger('change');
      var searchQuery = $('#searchInput').val();
      var searchADRIC = $('#searchInput_ADRIC').val();
      loadTable2('get_course_Swiper', '#course_Swiper5', '#loader5', year5, searchQuery, searchADRIC);
    });













    function showLoader(loader) {
      $(loader).show();
    }

    function hideLoader(loader) {
  // Hide the specified loader
      $(loader).hide();
    }

    function loadTable2(action, targetElement, loader, year, searchQuery = '', searchADRIC = '') {
      showLoader(loader);

      $.ajax({
        url: 'assets/php/action_index.php',
        type: 'POST',
        data: {
          [action]: true,
          year: year,
          searchQuery: searchQuery,
          searchADRIC: searchADRIC
        },
        success: function(data) {
          hideLoader(loader);
          $(targetElement).html(data);

          $(".owl-carousel").owlCarousel({
            items: 4,
            loop: false,
            margin: 10,
            autoplay: true,
            autoplayTimeout: 3000,
            responsiveClass: true,
            responsive: {
              0: {
                items: 1
              },
              600: {
                items: 2
              },
              1000: {
                items: 4
              }
            }
          });
        },
        error: function(xhr, status, error) {
          console.error(xhr.responseText);
          hideLoader(loader);
        }
      });
    }

      // loadTable2('get_course_Swiper', '#course_Swiper1', '#loader1', year1);
      // loadTable2('get_course_Swiper', '#course_Swiper2', '#loader2', year2);
      // loadTable2('get_course_Swiper', '#course_Swiper3', '#loader3', year3);
      // loadTable2('get_course_Swiper', '#course_Swiper4', '#loader4', year4);
      //loadTable2('get_course_Swiper', '#course_Swiper5', '#loader5', notyear);




    $(document).on("click", ".btn_view", function (e) {
      e.preventDefault();

      var id = $(this).data('id');
      //console.log(id);

      $.ajax({
        url: 'assets/php/action_index.php',
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










  });
</script>













</body>
</html>