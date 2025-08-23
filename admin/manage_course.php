<?php require '../session.php' ?>
<?php include '../head.php' ?>



<style>
  body{
    background-color: gray;
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

  #modal_video_detail {
    z-index: 9998;
  }
  #modal_question {
    z-index: 10000;
  }
  .your-custom-class {
    z-index: 9999;
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

  @media (min-width: 1400px) {
    .container{
      max-width: 1400px;
    }
  }

  .button-36 {
    padding: 12px 26px;
    padding-bottom: 18px;
    border: 0;
    font-size: 16px;
    transition: all 150ms ease-in-out;

    border-radius: 20px;

    color: #071432;
    font-weight: bold;
    background: #fff;
    box-shadow: rgba(99, 99, 99, 0.2) 0 2px 8px 0, inset 0px -6px 0px rgba(0, 0, 0, 0.1), inset 0px -2px 0px rgba(0, 0, 0, 0.15);
  }

  .button-36:hover {
    filter: brightness(0.98);
  }

  .button-36:active {
    filter: brightness(0.97);
    padding-top: 15px;
    padding-bottom: 15px;
    box-shadow: rgba(99, 99, 99, 0.2) 0 2px 6px 0, inset 0px -1px 0px rgba(0, 0, 0, 0.15);
  }

  .button-37 {
    padding: 12px 26px;
    padding-bottom: 18px;
    border: 0;
    font-size: 16px;
    transition: all 150ms ease-in-out;

    border-radius: 20px;

    color: white;
    font-weight: bold;
    background: gray;
    box-shadow: rgba(99, 99, 99, 0.2) 0 2px 8px 0, inset 0px -6px 0px rgba(0, 0, 0, 0.1), inset 0px -2px 0px rgba(0, 0, 0, 0.15);
  }

  .button-37:hover {
    filter: brightness(0.98);
  }

  .button-37:active {
    filter: brightness(0.97);
    padding-top: 15px;
    padding-bottom: 15px;
    box-shadow: rgba(99, 99, 99, 0.2) 0 2px 6px 0, inset 0px -1px 0px rgba(0, 0, 0, 0.15);
  }

</style>

</head>

<body class="">

  <?php include '../header.php' ?>

  <div class="container pb-5">

    <div class="card my-5">
      <div class="card-body">
       <div class="row">
        <div class="col-md-0">

          <div id="course_modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="myModalLabel">
            <div class="modal-dialog">
              <div class="modal-content">

              </div>
            </div>
          </div>

          <div id="course_modal_trash" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-xl">
              <div class="modal-content">

              </div>
            </div>
          </div>

          <div id="course_modal_video" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-xl">
              <div class="modal-content">

              </div>
            </div>
          </div>

          <div id="modal_video_detail" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-xl">
              <div class="modal-content">

              </div>
            </div>
          </div>

          <div id="modal_question" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="myModalLabel" >
            <div class="modal-dialog modal-xl">
              <div class="modal-content">

              </div>
            </div>
          </div>

          <div id="modal_certificate" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="myModalLabel" >
            <div class="modal-dialog modal-xl">
              <div class="modal-content">

              </div>
            </div>
          </div>


        </div>
        <div class="col-md-12">
         <label>หลักสูตร</label>
         <section class="section trending-courses trending-courses-five py-0">
          <div class="container">

            <div id="loader1" class="loader"></div>
            <div id="loader2" class="loader"></div>
            <div id="loader3" class="loader"></div>
            <div id="loader4" class="loader"></div>
            <div id="loader2" class="loader"></div>

            
            <div id="table_notyear"></div>
            <div id="table_course1"></div>
            <div id="table_course2"></div>
            <div id="table_course3"></div>
            <div id="table_course4"></div>

          </div>
        </section>


      </div>
    </div>
  </div>
</div>

<div class="btn-group fixed-bottom mx-5">
  <button type="button" data-email="<?= $email ?>" data-method="insert" 
    class="btn_course_add btn button-36 w-100 mb-2">
    <i class="bi bi-plus-lg fa-lg"></i>&nbsp;เพิ่มหลักสูตรใหม่
  </button>

  <button type="button" data-email="<?= $email ?>" data-method="update" 
    class="btn_course_bin btn button-37 w-100 mb-2">
    <i class="bi bi-trash3-fill fa-lg"></i>&nbsp;หลักสูตรที่ลบ
  </button>
</div>


</div>


<?php //include '../footer.php' ?>


<?php include '../script.php' ?>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->

<script>
  $(document).ready(function () {

    var year1 = 1;
    var year2 = 2;
    var year3 = 3;
    var year4 = 4;
    var notyear = 5;

    function showLoader(loader) {
      $(loader).show();
    }

    function hideLoader(loader) {
        // Hide the specified loader
      $(loader).hide();
    }

    function loadTable(action, targetElement, loader, year) {
      showLoader(loader);
      
      $.ajax({
        url: '../assets/php/admin_manage_course.php',
        type: 'POST',
        data: {
          [action]: true,
          year: year
        },
        success: function (data) {
          $(targetElement).html(data);
          hideLoader(loader);
        },
        error: function (xhr, status, error) {
          console.error(xhr.responseText);
        }
      });
    }

    loadTable('get_table_course', '#table_course1', '#loader1', year1);
    loadTable('get_table_course', '#table_course2', '#loader2', year2);
    loadTable('get_table_course', '#table_course3', '#loader3', year3);
    loadTable('get_table_course', '#table_course4', '#loader4', year4);
    loadTable('get_table_course', '#table_notyear', '#loader5', notyear);


    $(document).on("click", ".btn_course_add", function (e) {
      e.preventDefault();

      var email = $(this).data('email');
      var method = $(this).data('method');
      //console.log(email);
      //console.log(method);

      $.ajax({
        url: '../assets/php/admin_manage_course.php',
        type: 'POST',
        data: { 
          'course_add_modal' : true,
          email: email,
          method: method
        },
        success: function (data) {
          $("#course_modal .modal-content").html(data);
          $('#course_modal').modal('show');
        }
      });
    });


    $(document).on("click", "#save_course", function (e) {
      e.preventDefault();
      var formData = $("#course_Form").serialize();


      var post_course_code = getExtractedValue(formData, 'course_code');
      var post_course_name = getExtractedValue(formData, 'course_name');
      var post_course_level = getExtractedValue(formData, 'course_level');
      var post_course_type = getExtractedValue(formData, 'course_type');
      var post_course_status = getExtractedValue(formData, 'course_status');
      var post_course_pass_percent = getExtractedValue(formData, 'course_pass_percent');

      // console.log(post_course_code);
      // console.log(post_course_name);
      // console.log(post_course_level);
      // console.log(post_course_type);
      // console.log(post_course_status);
      // console.log(post_course_pass_percent);

      function getExtractedValue(serializedData, fieldName) {
        var pattern = new RegExp(fieldName + "=([^&]+)");
        var match = pattern.exec(serializedData);
        return match ? decodeURIComponent(match[1]) : null;
      }

      function validateAndAlert(field1, field2, message) {
        if ($.trim(field1) == "") {
          Swal.fire({
            icon: 'warning', title: 'Warning!', text: message, timer: 2000, timerProgressBar: true, showConfirmButton: false
          });
          $(field2).focus();
          return true;
        }
        return false;
      }

      if (validateAndAlert(post_course_code,course_code, 'กรุณากรอกรหัสหลักสูตร')) return;
      if (validateAndAlert(post_course_name,course_name, 'กรุณากรอกชื่อหลักสูตร')) return;
      if (validateAndAlert(post_course_level,course_level, 'กรุณาเลือกชั้นปี')) return;
      if (validateAndAlert(post_course_type,course_type, 'กรุณาเลือกประเภทหลักสูตร')) return;
      if (validateAndAlert(post_course_status,course_status, 'กรุณาเลือกสถานะหลักสูตร')) return;
      if (validateAndAlert(post_course_pass_percent,course_pass_percent, 'กรุณากรอก %การผ่านหลักสูตร')) return;
      //console.log(formData);

      $(this).prop('disabled', true);

      formData += '&save_course=true';

      $.ajax({
        url: '../assets/php/admin_manage_course.php',
        type: 'POST',
        data: formData,
        success: function (response) {

          $("#course_modal").modal('hide');
          $(this).prop('disabled', false);

          var res = jQuery.parseJSON(response);

          Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: 'บันทึกสำเร็จ',
            timer: 2000,
            timerProgressBar: true,
            showConfirmButton: false
          });

          loadTable('get_table_course', '#table_course1', '#loader1', year1);
          loadTable('get_table_course', '#table_course2', '#loader2', year2);
          loadTable('get_table_course', '#table_course3', '#loader3', year3);
          loadTable('get_table_course', '#table_course4', '#loader4', year4);
          loadTable('get_table_course', '#table_notyear', '#loader5', notyear);

        },
        error: function () {

          Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'ไม่สามารถทำรายการได้',
            timer: 2000,
            timerProgressBar: true,
            showConfirmButton: false
          });
        }

      });
    });



    $(document).on("click", ".btn_course_update", function (e) {
      e.preventDefault();

      var email = $(this).data('email');
      var method = $(this).data('method');
      var id = $(this).data('id');
      // console.log(email);
      // console.log(method);

      $.ajax({
        url: '../assets/php/admin_manage_course.php',
        type: 'POST',
        data: { 
          'course_add_modal' : true,
          email: email,
          method: method,
          id: id
        },
        success: function (data) {
          $("#course_modal .modal-content").html(data);
          $('#course_modal').modal('show');
        }
      });
    });



    $(document).on("click", "#update_course", function (e) {
      e.preventDefault();
      var formData = $("#course_Form").serialize();

      var post_course_code = getExtractedValue(formData, 'course_code');
      var post_course_name = getExtractedValue(formData, 'course_name');
      var post_course_level = getExtractedValue(formData, 'course_level');
      var post_course_type = getExtractedValue(formData, 'course_type');
      var post_course_status = getExtractedValue(formData, 'course_status');

      // console.log(post_course_code);
      // console.log(post_course_name);
      // console.log(post_course_level);
      // console.log(post_course_type);
      // console.log(post_course_status);

      function getExtractedValue(serializedData, fieldName) {
        var pattern = new RegExp(fieldName + "=([^&]+)");
        var match = pattern.exec(serializedData);
        return match ? decodeURIComponent(match[1]) : null;
      }

      function validateAndAlert(field1, field2, message) {
        if ($.trim(field1) == "") {
          Swal.fire({
            icon: 'warning', title: 'Warning!', text: message, timer: 2000, timerProgressBar: true, showConfirmButton: false
          });
          $(field2).focus();
          return true;
        }
        return false;
      }

      if (validateAndAlert(post_course_code,course_code, 'กรุณากรอกรหัสหลักสูตร')) return;
      if (validateAndAlert(post_course_name,course_name, 'กรุณากรอกชื่อหลักสูตร')) return;
      if (validateAndAlert(post_course_level,course_level, 'กรุณาเลือกชั้นปี')) return;
      if (validateAndAlert(post_course_type,course_type, 'กรุณาเลือกประเภทหลักสูตร')) return;
      if (validateAndAlert(post_course_status,course_status, 'กรุณาเลือกสถานะหลักสูตร')) return;

      //console.log(formData);

      $(this).prop('disabled', true);

      formData += '&update_course=true';

      $.ajax({
        url: '../assets/php/admin_manage_course.php',
        type: 'POST',
        data: formData,
        success: function (response) {

          $("#course_modal").modal('hide');
          $(this).prop('disabled', false);

          var res = jQuery.parseJSON(response);
          //console.log(res.id);

          loadTable('get_table_course', '#table_course1', '#loader1', year1);
          loadTable('get_table_course', '#table_course2', '#loader2', year2);
          loadTable('get_table_course', '#table_course3', '#loader3', year3);
          loadTable('get_table_course', '#table_course4', '#loader4', year4);
          loadTable('get_table_course', '#table_notyear', '#loader5', notyear);

          Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: 'บันทึกสำเร็จ',
            timer: 2000,
            timerProgressBar: true,
            showConfirmButton: false
          });

        },
        error: function () {

          Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'ไม่สามารถทำรายการได้',
            timer: 2000,
            timerProgressBar: true,
            showConfirmButton: false
          });
        }

      });
    });


    $(document).on("click", ".btn_course_bin", function (e) {
      e.preventDefault();

      $.ajax({
        url: '../assets/php/admin_manage_course.php',
        type: 'POST',
        data: { 
          'course_modal_trash' : true,
        },
        success: function (data) {
          $("#course_modal_trash .modal-content").html(data);
          $('#course_modal_trash').modal('show');
          loadTable('get_table_course_trash', '#table_course_trash');
        }
      });
    });

    
    $(document).on('click', '.btn_course_delete', function (e) {
      e.preventDefault();

      var id = $(this).data('id');

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
            url: '../assets/php/admin_manage_course.php',
            data: {
              'delete_course': true,
              'id': id
            },
            success: function (response) {
              var res = jQuery.parseJSON(response);
              if (res.status == 500) {
                Swal.fire('Error', res.message, 'error');
              } else {

                loadTable('get_table_course', '#table_course1', '#loader1', year1);
                loadTable('get_table_course', '#table_course2', '#loader2', year2);
                loadTable('get_table_course', '#table_course3', '#loader3', year3);
                loadTable('get_table_course', '#table_course4', '#loader4', year4);
                loadTable('get_table_course', '#table_notyear', '#loader5', notyear);
                loadTable('get_table_course_trash', '#table_course_trash');

              }
            }
          });
        }
      });
    });

    $(document).on('click', '.btn_course_trash', function (e) {
      e.preventDefault();

      var id = $(this).data('id');
      var method = $(this).data('method');

      Swal.fire({
        title: 'คุณต้องการย้าย ใช่หรือไม่?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'ใช่',
        cancelButtonText: 'ไม่',
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            type: "POST",
            url: '../assets/php/admin_manage_course.php',
            data: {
              'trash_course': true,
              'id': id,
              'method': method
            },
            success: function (response) {
              var res = jQuery.parseJSON(response);
              if (res.status == 500) {
                Swal.fire('Error', res.message, 'error');
              } else {
                loadTable('get_table_course', '#table_course1', '#loader1', year1);
                loadTable('get_table_course', '#table_course2', '#loader2', year2);
                loadTable('get_table_course', '#table_course3', '#loader3', year3);
                loadTable('get_table_course', '#table_course4', '#loader4', year4);
                loadTable('get_table_course', '#table_notyear', '#loader5', notyear);
                loadTable('get_table_course_trash', '#table_course_trash');

              }
            }
          });
        }
      });
    });



    $(document).on("click", ".btn_course_video", function (e) {
      e.preventDefault();

      var id = $(this).data('id');
      var course_id = $(this).data('course_id');
      // console.log(id);
      // console.log(course_id);

      $.ajax({
        url: '../assets/php/admin_manage_course.php',
        type: 'POST',
        data: { 
          'course_modal_video' : true,
          id : id,
          course_id : course_id
        },
        success: function (data) {
          $("#course_modal_video .modal-content").html(data);
          $('#course_modal_video').modal('show');

          loadTable2('get_course_video', '#course_video', id, course_id , '#loader1');
        },
        error: function (xhr, status, error) {
          console.error(xhr.responseText);
            // Handle the error, e.g., show an error message to the user
        }
      });
    });


    function showLoader(loader) {
            // Show the specified loader
      $(loader).show();
    }

    function hideLoader(loader) {
            // Hide the specified loader
      $(loader).hide();
    }

    function loadTable2(action, targetElement, id, course_id, loader, video_question_id) {

      showLoader(loader);

      $.ajax({
        url: '../assets/php/admin_manage_course.php',
        type: 'POST',
        data: {
          [action]: true,
          id: id,
          course_id: course_id,
          video_question_id : video_question_id
        },
        success: function (data) {
          hideLoader(loader);
          $(targetElement).html(data);
        },
        error: function (xhr, status, error) {
          console.error(xhr.responseText);
          hideLoader(loader);
        }
      });
    }


    $(document).on("click", ".btn_video_add", function (e) {
      e.preventDefault();

      var course_id = $(this).data('course_id');
      var method = $(this).data('method');
      // console.log(course_id);
      // console.log(method);

      $.ajax({
        url: '../assets/php/admin_manage_course.php',
        type: 'POST',
        data: { 
          'modal_video_detail' : true,
          course_id: course_id,
          method: method
        },
        success: function (data) {
          $("#modal_video_detail .modal-content").html(data);
          $('#modal_video_detail').modal('show');
        }
      });
    });



    $(document).on("click", "#save_video", function (e) {
      e.preventDefault();
      var formData = $("#video_Form").serialize();
      var id = '';

      var course_id = getExtractedValue(formData, 'course_id');
      var post_video_url = getExtractedValue(formData, 'video_url');
      var post_video_name = getExtractedValue(formData, 'video_name');
      var post_video_head = getExtractedValue(formData, 'video_head');

      // console.log(post_video_url);
      // console.log(post_video_name);
      // console.log(post_video_head);
      // console.log(post_question_submit_time);

      function getExtractedValue(serializedData, fieldName) {
        var pattern = new RegExp(fieldName + "=([^&]+)");
        var match = pattern.exec(serializedData);
        return match ? decodeURIComponent(match[1]) : null;
      }

      function validateAndAlert(field1, field2, message) {
        if ($.trim(field1) == "") {
          Swal.fire({
            icon: 'warning', title: 'Warning!', text: message, timer: 2000, timerProgressBar: true, showConfirmButton: false
          });
          $(field2).focus();
          return true;
        }
        return false;
      }

      if (validateAndAlert(post_video_url,video_url, 'กรุณากรอก video_url')) return;
      if (validateAndAlert(post_video_name,video_name, 'กรุณากรอกชื่อ video')) return;
      if (validateAndAlert(post_video_head,video_head, 'กรุณากรอกลำดับ EP.')) return;

      //console.log(formData);

      $(this).prop('disabled', true);

      formData += '&save_video=true';

      $.ajax({
        url: '../assets/php/admin_manage_course.php',
        type: 'POST',
        data: formData,
        success: function (response) {

          $("#modal_video_detail").modal('hide');
          $(this).prop('disabled', false);

          loadTable2('get_course_video', '#course_video', id, course_id , '#loader1');
          $("#video_question").empty();

          var res = jQuery.parseJSON(response);

          Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: 'บันทึกสำเร็จ',
            timer: 2000,
            timerProgressBar: true,
            showConfirmButton: false,
            customClass: {
              popup: 'your-custom-class',
            },
          });

          loadTable('get_table_course', '#table_course1', '#loader1', year1);
          loadTable('get_table_course', '#table_course2', '#loader2', year2);
          loadTable('get_table_course', '#table_course3', '#loader3', year3);
          loadTable('get_table_course', '#table_course4', '#loader4', year4);
          loadTable('get_table_course', '#table_notyear', '#loader5', notyear);

        },
        error: function () {

          Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'ไม่สามารถทำรายการได้',
            timer: 2000,
            timerProgressBar: true,
            showConfirmButton: false
          });
        }

      });
    });



    $(document).on("click", ".btn_video_edit", function (e) {
      e.preventDefault();

      var id = $(this).data('id');
      var course_id = $(this).data('course_id');
      var method = $(this).data('method');
      // console.log(id);
      // console.log(course_id);
      // console.log(method);

      $.ajax({
        url: '../assets/php/admin_manage_course.php',
        type: 'POST',
        data: { 
          'modal_video_detail' : true,
          course_id: course_id,
          method: method,
          id: id
        },
        success: function (data) {
          $("#modal_video_detail .modal-content").html(data);
          $('#modal_video_detail').modal('show');
        }
      });
    });



    $(document).on("click", "#update_video", function (e) {
      e.preventDefault();
      var formData = $("#video_Form").serialize();
      var id = '';

      var course_id = getExtractedValue(formData, 'course_id');
      var post_video_url = getExtractedValue(formData, 'video_url');
      var post_video_name = getExtractedValue(formData, 'video_name');
      var post_video_head = getExtractedValue(formData, 'video_head');
      var post_question_submit_time = getExtractedValue(formData, 'question_submit_time');

      // console.log(post_video_url);
      // console.log(post_video_name);
      // console.log(post_video_head);
      // console.log(post_question_submit_time);

      function getExtractedValue(serializedData, fieldName) {
        var pattern = new RegExp(fieldName + "=([^&]+)");
        var match = pattern.exec(serializedData);
        return match ? decodeURIComponent(match[1]) : null;
      }

      function validateAndAlert(field1, field2, message) {
        if ($.trim(field1) == "") {
          Swal.fire({
            icon: 'warning', title: 'Warning!', text: message, timer: 2000, timerProgressBar: true, showConfirmButton: false
          });
          $(field2).focus();
          return true;
        }
        return false;
      }

      if (validateAndAlert(post_video_url,video_url, 'กรุณากรอก video_url')) return;
      if (validateAndAlert(post_video_name,video_name, 'กรุณากรอกชื่อ video')) return;
      if (validateAndAlert(post_video_head,video_head, 'กรุณากรอกลำดับ EP.')) return;
      if (validateAndAlert(post_question_submit_time,question_submit_time, 'กรุณากรอกเวลาสิ้นสุด')) return;

      //console.log(formData);

      $(this).prop('disabled', true);

      formData += '&update_video=true';

      $.ajax({
        url: '../assets/php/admin_manage_course.php',
        type: 'POST',
        data: formData,
        success: function (response) {

          $("#modal_video_detail").modal('hide');
          $(this).prop('disabled', false);

          loadTable2('get_course_video', '#course_video', id, course_id , '#loader1');
          $("#video_question").empty();

          var res = jQuery.parseJSON(response);

          Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: 'แก้ไขสำเร็จ',
            timer: 2000,
            timerProgressBar: true,
            showConfirmButton: false,
            customClass: {
              popup: 'your-custom-class',
            },
          });

          loadTable('get_table_course', '#table_course1', '#loader1', year1);
          loadTable('get_table_course', '#table_course2', '#loader2', year2);
          loadTable('get_table_course', '#table_course3', '#loader3', year3);
          loadTable('get_table_course', '#table_course4', '#loader4', year4);
          loadTable('get_table_course', '#table_notyear', '#loader5', notyear);

        },
        error: function () {

          Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'ไม่สามารถทำรายการได้',
            timer: 2000,
            timerProgressBar: true,
            showConfirmButton: false
          });
        }

      });
    });



    $(document).on('click', '.btn_video_delete', function (e) {
      e.preventDefault();

      var id = $(this).data('id');
      var course_id = $(this).data('course_id');
      // console.log(id);
      // console.log(course_id);


      Swal.fire({
        title: 'คุณต้องการลบ video ใช่หรือไม่?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'ใช่',
        cancelButtonText: 'ไม่',
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            type: "POST",
            url: '../assets/php/admin_manage_course.php',
            data: {
              'delete_video': true,
              id: id
            },
            success: function (response) {
              var res = jQuery.parseJSON(response);
              if (res.status == 500) {
                Swal.fire('Error', res.message, 'error');
              } else {

                loadTable('get_table_course', '#table_course1', '#loader1', year1);
                loadTable('get_table_course', '#table_course2', '#loader2', year2);
                loadTable('get_table_course', '#table_course3', '#loader3', year3);
                loadTable('get_table_course', '#table_course4', '#loader4', year4);
                loadTable('get_table_course', '#table_notyear', '#loader5', notyear);
                loadTable2('get_course_video', '#course_video', id, course_id , '#loader1');
                $("#video_question").empty();
              }
            }
          });
        }
      });
    });



    $(document).on("click", ".btn_video_question", function (e) {
      e.preventDefault();

      var id = $(this).data('id');
      var course_id = $(this).data('course_id');
      var video_question_id = $(this).data('video_question_id');
      // console.log(id);
      // console.log(course_id);
      // console.log(video_question_id);

      $.ajax({
        url: '../assets/php/admin_manage_course.php',
        type: 'POST',
        data: { 
          '' : true,
          id: id,
          course_id: course_id,
          video_question_id: video_question_id
        },
        success: function (data) {

          loadTable2('get_video_question', '#video_question', id, course_id , '#loader2', video_question_id);
        }
      });
    });


    $(document).on("click", ".btn_question_add", function (e) {
      e.preventDefault();

      var id = $(this).data('id');
      var course_id = $(this).data('course_id');
      var video_question_id = $(this).data('video_question_id');
      var method = $(this).data('method');

      // console.log(id);
      // console.log(course_id);
      // console.log(method);
      // console.log(video_question_id);

      $.ajax({
        url: '../assets/php/admin_manage_course.php',
        type: 'POST',
        data: { 
          'modal_question' : true,
          id: id,
          course_id: course_id,
          method: method,
          video_question_id: video_question_id
        },
        success: function (data) {
          $("#modal_question .modal-content").html(data);
          $('#modal_question').modal('show');
        }
      });
    });


    $(document).on("click", "#save_question", function (e) {
      e.preventDefault();
      var formData = $("#question_Form").serialize();

      var id = getExtractedValue(formData, 'id');
      var course_id = getExtractedValue(formData, 'course_id');
      var video_question_id = getExtractedValue(formData, 'video_question_id');

      var post_question_num = getExtractedValue(formData, 'question_num');
      var post_question = getExtractedValue(formData, 'question');
      var post_option1 = getExtractedValue(formData, 'option1');
      var post_option2 = getExtractedValue(formData, 'option2');
      var post_option3 = getExtractedValue(formData, 'option3');
      var post_option4 = getExtractedValue(formData, 'option4');
      var post_correctAnswer = getExtractedValue(formData, 'correctAnswer');
      var post_time_show = getExtractedValue(formData, 'time_show');

      // console.log(post_question_num);
      // console.log(post_question);
      // console.log(post_option1);
      // console.log(post_option2);
      // console.log(post_option3);
      // console.log(post_option4);
      // console.log(post_correctAnswer);
      // console.log(post_time_show);

      function getExtractedValue(serializedData, fieldName) {
        var pattern = new RegExp(fieldName + "=([^&]+)");
        var match = pattern.exec(serializedData);
        return match ? decodeURIComponent(match[1]) : null;
      }

      function validateAndAlert(field1, field2, message) {
        if ($.trim(field1) == "") {
          Swal.fire({
            icon: 'warning', title: 'Warning!', text: message, timer: 2000, timerProgressBar: true, showConfirmButton: false
          });
          $(field2).focus();
          return true;
        }
        return false;
      }

      if (validateAndAlert(post_question_num,question_num, 'กรุณากรอก question_num')) return;
      if (validateAndAlert(post_question,question, 'กรุณากรอก question')) return;
      if (validateAndAlert(post_option1,option1, 'กรุณากรอก option1')) return;
      if (validateAndAlert(post_option2,option2, 'กรุณากรอก option2')) return;
      if (validateAndAlert(post_option3,option3, 'กรุณากรอก option3')) return;
      if (validateAndAlert(post_option4,option4, 'กรุณากรอก option4')) return;
      if (validateAndAlert(post_correctAnswer,correctAnswer, 'กรุณากรอก correctAnswer')) return;
      if (validateAndAlert(post_time_show,time_show, 'กรุณากรอก time_show')) return;

      //console.log(formData);

      $(this).prop('disabled', true);

      formData += '&save_question=true';

      $.ajax({
        url: '../assets/php/admin_manage_course.php',
        type: 'POST',
        data: formData,
        success: function (response) {

          $("#modal_question").modal('hide');
          $(this).prop('disabled', false);

          loadTable2('get_video_question', '#video_question', id, course_id , '#loader2', video_question_id);

          var res = jQuery.parseJSON(response);

          Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: 'บันทึกสำเร็จ',
            timer: 2000,
            timerProgressBar: true,
            showConfirmButton: false,
            customClass: {
              popup: 'your-custom-class',
            },
          });

          loadTable('get_table_course', '#table_course1', '#loader1', year1);
          loadTable('get_table_course', '#table_course2', '#loader2', year2);
          loadTable('get_table_course', '#table_course3', '#loader3', year3);
          loadTable('get_table_course', '#table_course4', '#loader4', year4);
          loadTable('get_table_course', '#table_notyear', '#loader5', notyear);

        },
        error: function () {

          Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'ไม่สามารถทำรายการได้',
            timer: 2000,
            timerProgressBar: true,
            showConfirmButton: false
          });
        }

      });
    });



    $(document).on("click", ".btn_question_edit", function (e) {
      e.preventDefault();

      var id = $(this).data('id');
      var course_id = $(this).data('course_id');
      var method = $(this).data('method');
      var question_id = $(this).data('question_id');
      var video_question_id = $(this).data('video_question_id');

      // console.log(id);
      // console.log(course_id);
      // console.log(method);
      // console.log(question_id);
      // console.log(video_question_id);
      

      $.ajax({
        url: '../assets/php/admin_manage_course.php',
        type: 'POST',
        data: { 
          'modal_question' : true,
          id: id,
          course_id: course_id,
          method: method,
          video_question_id: video_question_id
        },
        success: function (data) {
          $("#modal_question .modal-content").html(data);
          $('#modal_question').modal('show');
        }
      });
    });



    $(document).on("click", "#update_question", function (e) {
      e.preventDefault();
      var formData = $("#question_Form").serialize();

      var id = getExtractedValue(formData, 'id');
      var course_id = getExtractedValue(formData, 'course_id');
      var video_question_id = getExtractedValue(formData, 'video_question_id');

      var post_question_num = getExtractedValue(formData, 'question_num');
      var post_question = getExtractedValue(formData, 'question');
      var post_option1 = getExtractedValue(formData, 'option1');
      var post_option2 = getExtractedValue(formData, 'option2');
      var post_option3 = getExtractedValue(formData, 'option3');
      var post_option4 = getExtractedValue(formData, 'option4');
      var post_correctAnswer = getExtractedValue(formData, 'correctAnswer');
      var post_time_show = getExtractedValue(formData, 'time_show');

      // console.log(post_question_num);
      // console.log(post_question);
      // console.log(post_option1);
      // console.log(post_option2);
      // console.log(post_option3);
      // console.log(post_option4);
      // console.log(post_correctAnswer);
      // console.log(post_time_show);

      function getExtractedValue(serializedData, fieldName) {
        var pattern = new RegExp(fieldName + "=([^&]+)");
        var match = pattern.exec(serializedData);
        return match ? decodeURIComponent(match[1]) : null;
      }

      function validateAndAlert(field1, field2, message) {
        if ($.trim(field1) == "") {
          Swal.fire({
            icon: 'warning', title: 'Warning!', text: message, timer: 2000, timerProgressBar: true, showConfirmButton: false
          });
          $(field2).focus();
          return true;
        }
        return false;
      }

      if (validateAndAlert(post_question_num,question_num, 'กรุณากรอก question_num')) return;
      if (validateAndAlert(post_question,question, 'กรุณากรอก question')) return;
      if (validateAndAlert(post_option1,option1, 'กรุณากรอก option1')) return;
      if (validateAndAlert(post_option2,option2, 'กรุณากรอก option2')) return;
      if (validateAndAlert(post_option3,option3, 'กรุณากรอก option3')) return;
      if (validateAndAlert(post_option4,option4, 'กรุณากรอก option4')) return;
      if (validateAndAlert(post_correctAnswer,correctAnswer, 'กรุณากรอก correctAnswer')) return;
      if (validateAndAlert(post_time_show,time_show, 'กรุณากรอก time_show')) return;

      //console.log(formData);

      $(this).prop('disabled', true);

      formData += '&update_question=true';

      $.ajax({
        url: '../assets/php/admin_manage_course.php',
        type: 'POST',
        data: formData,
        success: function (response) {

          $("#modal_question").modal('hide');
          $(this).prop('disabled', false);

          loadTable2('get_video_question', '#video_question', id, course_id , '#loader2', video_question_id);

          var res = jQuery.parseJSON(response);

          Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: 'บันทึกสำเร็จ',
            timer: 2000,
            timerProgressBar: true,
            showConfirmButton: false,
            customClass: {
              popup: 'your-custom-class',
            },
          });

          loadTable('get_table_course', '#table_course1', '#loader1', year1);
          loadTable('get_table_course', '#table_course2', '#loader2', year2);
          loadTable('get_table_course', '#table_course3', '#loader3', year3);
          loadTable('get_table_course', '#table_course4', '#loader4', year4);
          loadTable('get_table_course', '#table_notyear', '#loader5', notyear);

        },
        error: function () {

          Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'ไม่สามารถทำรายการได้',
            timer: 2000,
            timerProgressBar: true,
            showConfirmButton: false
          });
        }

      });
    });






    $(document).on('click', '.btn_question_delete', function (e) {
      e.preventDefault();

      var id = $(this).data('id');
      var course_id = $(this).data('course_id');
      var method = $(this).data('method');
      var question_id = $(this).data('question_id');
      var video_question_id = $(this).data('video_question_id');

      // console.log(id);
      // console.log(course_id);
      // console.log(method);
      // console.log(question_id);
      // console.log(video_question_id);

      Swal.fire({
        title: 'คุณต้องการลบ คำถาม ใช่หรือไม่?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'ใช่',
        cancelButtonText: 'ไม่',
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            type: "POST",
            url: '../assets/php/admin_manage_course.php',
            data: {
              'delete_question': true,
              id: id
            },
            success: function (response) {
              var res = jQuery.parseJSON(response);
              if (res.status == 500) {
                Swal.fire('Error', res.message, 'error');
              } else {

                loadTable2('get_video_question', '#video_question', id, course_id , '#loader2', video_question_id);
              }
            }
          });
        }
      });
    });


    $(document).on('click', '.btn_question_copy', function (e) {
      e.preventDefault();

      var id = $(this).data('id');
      var course_id = $(this).data('course_id');
      var method = $(this).data('method');
      var question_id = $(this).data('question_id');
      var video_question_id = $(this).data('video_question_id');

      // console.log(id);
      // console.log(course_id);
      // console.log(method);
      // console.log(question_id);
      // console.log(video_question_id);

      Swal.fire({
        title: 'คุณต้องการCopy คำถาม ใช่หรือไม่?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'ใช่',
        cancelButtonText: 'ไม่',
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            type: "POST",
            url: '../assets/php/admin_manage_course.php',
            data: {
              'copy_question': true,
              id: id,
              course_id: course_id,
              method: method,
              video_question_id: video_question_id
            },
            success: function (response) {
              var res = jQuery.parseJSON(response);
              if (res.status == 500) {
                Swal.fire('Error', res.message, 'error');
              } else {

                loadTable2('get_video_question', '#video_question', id, course_id , '#loader2', video_question_id);
              }
            }
          });
        }
      });
    });


    $(document).on("click", ".btn_course_certificate", function (e) {
      e.preventDefault();

      var id = $(this).data('id');
      var course_id = $(this).data('course_id');

      // console.log(id);
      // console.log(course_id);
      
      $.ajax({
        url: '../assets/php/admin_manage_course.php',
        type: 'POST',
        data: { 
          'modal_certificate' : true,
          id: id,
          course_id: course_id,
        },
        success: function (data) {
          $("#modal_certificate .modal-content").html(data);
          $('#modal_certificate').modal('show');
          
          load_certificate_img('#certificate_img', {'certificate_img': true, course_id : course_id });

        }
      });
    });



    $(document).on("change", ".file", function (e) {
      e.preventDefault();

      var file = this.files[0];
      var course_id = $('#course_id').val();

      // console.log(file);
      // console.log(course_id);

      if (file) {
        var formData = new FormData();
        formData.append('file', file);
        formData.append('course_id', course_id);
        formData.append('upload_file', 'true');

        $.ajax({
          url: '../assets/php/admin_manage_course.php',
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

            load_certificate_img('#certificate_img', {'certificate_img': true, course_id : course_id });
          },
          error: function(xhr, status, error) {
            $('#uploadStatus').html('Error uploading file: ' + error);
          }
        });
      }
    });


    $(document).on("click", ".btn_certificate", function (e) {
      e.preventDefault();

      var course_id = $(this).data('course_id');
      //console.log(course_id);

      var formData = $("#form_certificate").serialize();
      var name = getExtractedValue(formData, 'name');
      var date = getExtractedValue(formData, 'certificate_date');
      var code = getExtractedValue(formData, 'code');

      function getExtractedValue(serializedData, fieldName) {
        var pattern = new RegExp(fieldName + "=([^&]+)");
        var match = pattern.exec(serializedData);
        return match ? decodeURIComponent(match[1]) : null;
      }

      // console.log(name);
      // console.log(date);
      // console.log(code);

      window.open('../certificate?'+'course_id='+course_id+'&name='+name+'&date='+date+'&code='+code, '_blank');

    });





    function edit_certificate(id, value, column_name, db) {
      //console.log(id);
      console.log(value);
      //console.log(column_name);
      //console.log(db);
      $.ajax({
        url: '../assets/php/admin_manage_course.php',
        method: "POST",
        data: {
          'edit_certificate': true,
          'id': id,
          'value': value,
          'column_name': column_name,
          'db': db,
        },
        dataType: "text",
        success: function (data) {


        },
        error: function(xhr, status, error) {
            // Handle error
          console.error(xhr.responseText);
        }
      });
    }

    $(document).on('input', '.edit_certificate', function () {
      var id = $(this).data("course_id");
      var db = 'course';
      var column_name = $(this).attr('id');
      var data_edit = $(this).val();
      edit_certificate(id, data_edit, column_name, db);
    });


    function load_certificate_img(targetElement, postData,course_id) {
      $.ajax({
        url: '../assets/php/admin_manage_course.php',
        type: 'POST',
        data: postData,
        success: function(response) {
          $(targetElement).html(response);
        }
      });
    }








  });
</script>






</body>

</html>