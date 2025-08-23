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



    <div class="container">



    </div>




  </div>
  <?php //include '../footer.php' ?>



  <script src=".././assets/js/plugins.js"></script>
  <script src=".././assets/js/theme.js"></script>
</body>

</html>