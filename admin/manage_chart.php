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


    <div class="container mt-5 bg-light">



      <canvas id="line_chart" width="900" height="500"></canvas>
      <canvas id="purchaseChart" width="900" height="500"></canvas>
      <canvas id="myChart" width="900" height="500"></canvas>






    </div>




  </div>
  <?php //include '../footer.php' ?>

  <?php include 'script.php' ?>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>

  <script>
    $(document).ready(function(){



      $.ajax({
        url: '../assets/php/action_manage_chart.php',
        method: 'GET',
        data: {
          'getdata1': true
        },
        success: function(response) {
          var data = JSON.parse(response);

                    // Convert data to arrays for labels and data points
          var labels = data.map(function(item) {
            return item[0];
          });

          var counts = data.map(function(item) {
            return item[1];
          });

                    // Create line chart using Chart.js
          var ctx = document.getElementById('line_chart').getContext('2d');
          var myChart = new Chart(ctx, {
            type: 'line',
            data: {
              labels: labels,
              datasets: [{
                label: 'สถิติการใช้งานระบบ',
                data: counts,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
              }]
            },
            options: {
              scales: {
                y: {
                  beginAtZero: true
                }
              }
            }
          });
        }
      });





      $.ajax({
        url: '../assets/php/action_manage_chart.php',
        method: 'GET',
        data: {
          'getdata2': true
        },
        dataType: 'json',
        success: function(response) {

          const labels = response.map(item => item.course_name);
          const purchaseCounts = response.map(item => item.purchase_count);

          const ctx = document.getElementById('purchaseChart').getContext('2d');
          const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
              labels: labels,
              datasets: [{
                label: 'หลักสูตรที่นศ.เลือก',
                data: purchaseCounts,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
              }]
            },
            options: {
              scales: {
                y: {
                  beginAtZero: true
                }
              }
            }
          });
        },
        error: function(xhr, status, error) {
          console.error(error);
        }
      });



      $.ajax({
        url: '../assets/php/action_manage_chart.php',
        method: 'GET',
        data: {
          'getdata3': true
        },
        success: function(response){
          var data = JSON.parse(response);
          var passCountLevels = [];
          var passCountCounts = [];

          for(var i in data) {
            passCountLevels.push(data[i].pass_count);
            passCountCounts.push(data[i].count);
          }

          var ctx = document.getElementById('myChart').getContext('2d');
          var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
              labels: passCountLevels,
              datasets: [{
                label: 'จำนวนผู้ผ่าน Course',
                data: passCountCounts,
                backgroundColor: 'skyblue',
              }]
            },
            options: {
              scales: {
                y: {
                  beginAtZero: true
                }
              }
            }
          });
        }
      });








    });

  </script>










</body>
</html>