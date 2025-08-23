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

</style>

</head>

<body>
  <div class="content-wrapper">
    <?php include '../header.php' ?>


    <div class="container-fluid pt-4 m-1">



     <div class="row">
      <div class="col-md-6 p-1 m-0">

        <div class="card">
          <div class="card-body">

            <div class="d-flex mb-3">

              <input type="text" id="searchInput4" class="form-control me-1" placeholder="ปี..." list="year_id" value="<?= $_SESSION['academic_year']  ?>">
              <datalist id="year_id">
                <?php $sql_ye_id = $conn->query("SELECT distinct academic_year FROM course_purchase "); ?>
                <?php while($row_ye_id = $sql_ye_id->fetch_assoc()){ ?>
                  <option value="<?= $row_ye_id['academic_year'] ?>"><?= $row_ye_id['academic_year'] ?></option>

                <?php } ?>
              </datalist>

              <input type="text" id="searchInput2" class="form-control me-1" placeholder="สาขาวิชา..." list="student_id">
              <datalist id="student_id">
                <?php $sql_st_id = $conn->query("SELECT distinct user_major FROM users_cmu "); ?>
                <?php while($row_st_id = $sql_st_id->fetch_assoc()){ ?>
                  <option value="<?= $row_st_id['user_major'] ?>"><?= $row_st_id['user_major'] ?></option>

                <?php } ?>
              </datalist>
              
              <input type="text" id="searchInput1" class="form-control me-1" placeholder="รหัสนักศึกษา">
              <input type="text" id="searchInput3" class="form-control me-1" placeholder="ชื่อ-นามสกุล">

            </div>
            <div id="SearchResults"></div>

          </div>
        </div>

      </div>
      <div class="col-md-6 p-1 m-0">

        <div class="card">
          <div class="card-body">

            <div id="user_course_detail"></div>
            <div id="loader1" class="loader"></div>

          </div>
        </div>

      </div>
    </div>











  </div>




</div>
<?php //include '../footer.php' ?>



<?php include 'script.php' ?>



<script>
  $(document).ready(function() {
    // Trigger the initial data load when the page is ready
    loadInitialData();

    // Function to load data based on search inputs
    function loadInitialData() {
      // Initialize search inputs with empty values
      var searchText1 = '';
      var searchText2 = '';
      var searchText3 = '';
      var searchText4 = '';

      // Call the AJAX function to fetch data
      fetchData(searchText1, searchText2, searchText3, searchText4);
    }

    // Function to fetch data via AJAX
    function fetchData(searchText1, searchText2, searchText3, searchText4) {
      $.ajax({
        url: '../assets/php/action_manage_scholar.php',
        type: 'POST',
        data: {
          'search_scholar': true,
          search1: searchText1,
          search2: searchText2,
          search3: searchText3,
          search4: searchText4
        },
        success: function(data) {
          $('#SearchResults').html(data);
        },
        error: function(xhr, status, error) {
          console.error(xhr.responseText);
        }
      });
    }

    // Event listener for input changes in search fields
    $('#searchInput1, #searchInput2, #searchInput3, #searchInput4').on('input', function() {
      var searchText1 = $('#searchInput1').val();
      var searchText2 = $('#searchInput2').val();
      var searchText3 = $('#searchInput3').val();
      var searchText4 = $('#searchInput4').val();

      // Call the AJAX function with updated search inputs
      fetchData(searchText1, searchText2, searchText3, searchText4);
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

    $(document).on("click", ".admin_view", function (e) {
      e.preventDefault();

      var student_id = $(this).data('student_id');
      console.log(student_id);
      // console.log(name);
      // console.log(date);
      // console.log(code);

      window.open('../course_purchase?'+'student_id='+student_id, '_blank');

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

  function loadTable1(action, targetElement, id, loader, cmuitaccount, year) {

    showLoader(loader);

    $.ajax({
      url: '../assets/php/action_manage_scholar.php',
      type: 'POST',
      data: {
        [action]: true,
        id: id,
        cmuitaccount: cmuitaccount,
        year : year
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


  $(document).on("click", ".show_user", function (e) {
    e.preventDefault();

    var id = $(this).data('id');
    var cmuitaccount = $(this).data('cmuitaccount');
    var year = $(this).data('year');
    //console.log(year);
    //console.log(cmuitaccount);


    $.ajax({
      url: '../assets/php/action_manage_scholar.php',
      type: 'POST',
      data: { 
        '' : true,
        id: id,
        cmuitaccount: cmuitaccount,
        year : year
      },
      success: function (data) {

        loadTable1('get_user_course_detail', '#user_course_detail', id , '#loader2', cmuitaccount,year);

      }
    });
  });


























</script>














</body>
</html>