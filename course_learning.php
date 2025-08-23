<?php require 'session.php' ?>
<?php include 'head.php' ?>

<?php $user = $_GET['user']; ?>
<style>

/*  @media (min-width: 1200px) {
    .container{
      max-width: 970px;
    }
  }*/
  
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
  .card {
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    transition: 0.3s;
    border-radius: 20px;
  }

  .card:hover {
    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
  }

  #videoPlayer {
    width: 100%;
  }
  input[type="radio"] {
    -ms-transform: scale(1.8); /* IE 9 */
    -webkit-transform: scale(1.8); /* Chrome, Safari, Opera */
    transform: scale(1.8);
    margin-right: 10px;
    margin-left: 5px;
  }

  a {
    text-decoration: none;
  }

  <?php if ($user != 'admin'): ?>
    #videoPlayer {
      pointer-events: none;
    }
  <?php endif ?>

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
    top: 40px;
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

    <?php
    $course_id = $_GET['course'];
    $video = $_GET['video'];

    if ($user == 'admin' && $_SESSION['user_type'] == 'admin') {
      $controls = 1;
    }else{
      $controls = 0;
    }

    $query = "SELECT * FROM course_video where id = '$video' ";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result=$stmt->get_result(); 
    $num_rows = mysqli_num_rows($result);               
    foreach ($result as $row){
      $video_url = $row['video_url'];
      $video_question_id = $row['video_question_id'];
      $question_submit_time = $row['question_submit_time'];
    }

    ?>


    <!-- Most popular Categories -->
    <section class="most-popular most-popular-five pt-0">
      <div class="container">


        <input type="text" id="course_id" class="form-control form-control-sm" value="<?= $course_id ?>" readonly hidden>
        <input type="text" id="video_question_id" class="form-control form-control-sm" value="<?= $video_question_id ?>" readonly hidden>
        <input type="text" id="video_url" class="form-control form-control-sm" value="<?= $video_url ?>" readonly hidden>
        <input type="text" id="submit_video" class="form-control form-control-sm" value="<?= $question_submit_time ?>" readonly hidden>


        <div class="row m-1">

          <div class="col-9 col-auto" id="column1">

            <?php if ($video != ''){ ?>

             <div id="videoPlayer" class="rounded-4"></div>

             <div class="d-flex justify-content-between">
              <div>
                <button id="restartBtn" class="btn btn btn-dark rounded-4">Restart <i class="bi bi-arrow-counterclockwise"></i></button>
                <button id="playPauseButton" class="btn btn btn-danger active rounded-4 shadow-lg">Play <i class="bi bi-play-fill"></i></button>

                <button id="rewind30Btn" class="btn btn-secondary rounded-4"><i class="bi bi-arrow-left-short"></i> 30 วินาที</button>
                <!-- <button id="rewind1MinBtn" class="btn btn-secondary rounded-4"><i class="bi bi-arrow-left-short"></i> 1 นาที</button> -->
                <span class="badge bg-secondary rounded-4 py-2" id="PlayQuality"></span>
              </div>

              <div>
                <span class="badge bg-white text-dark rounded-4 py-2" id="VideoTime">Time: 0:00 / 0:00</span>
                <button class="btn btn btn-secondary rounded-4" id="toggle_video" ><i class="bi bi-arrows-fullscreen"></i></button>

                <!-- <button class="btn btn btn-dark rounded-4" id="fullscreenButton" onclick="toggleFullscreen()"><i class="bi bi-arrows-fullscreen"></i>&nbsp;Full Screen</button> -->
              </div>

            </div>

          <?php }else { ?>

            <div class="row">
              <div class="col-md-12 d-flex justify-content-center">
                <div class="girl-slide-img aos " data-aos="fade-up">
                  <img src="https://webmaster.edu.cmu.ac.th/assets/upload/images/2024/02/27_20240214114515.jpg" alt="" style="width: 100%;">
                </div>
              </div>
            </div>



          <?php } ?>
        </div>

        <div class="col-3 col-auto" id="column2">
          <div id="check_pass"></div>

          <div id="list_video"></div>

        </div>

      </div>

      <div class="row m-2">
        <div class="col-lg-12">
          <label class="fw-bold h4 mt-2">Question</label>
          <!-- Quiz Container -->
          <div id="quizContainer"></div>
        </div>
      </div>












    </div>
  </section>
  <!-- /Most popular Categories -->




  <?php include 'footer.php' ?>
</div>

<input type="text" id="cmuitaccount" value="<?= $_SESSION['cmuitaccount'] ?>" readonly hidden>
<input type="text" id="academic_year" value="<?= $_SESSION['academic_year'] ?>" readonly hidden>
<input type="text" id="controls" value="<?= $controls ?>" readonly hidden>

<!-- /Main Wrapper -->
<?php include 'script.php' ?>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


<script>
  var cmuitaccount = document.getElementById('cmuitaccount').value;
  var academic_year = document.getElementById('academic_year').value;

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

  $(document).on("click", ".view_admin", function (e) {
    e.preventDefault();

    var href = $(this).data('href');
    var course = $(this).data('course');
    var video = $(this).data('video');
    var user = $(this).data('user');

    console.log(href);
    console.log(course);
    console.log(video);
    console.log(user);

    window.location.href = href+'?'+'course='+course+'&video='+video+'&user='+user;
  });


  $("#toggle_video").click(function(){
    $("#column1").toggleClass("col-md-12");
    $("#column2").toggleClass("collapse");
  });


</script>


<script>
  var tag = document.createElement('script');

  tag.src = "https://www.youtube.com/iframe_api";
  var firstScriptTag = document.getElementsByTagName('script')[0];
  firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

  var course_id = document.getElementById('course_id').value;
  var video_question_id = document.getElementById('video_question_id').value;
  var video_url = document.getElementById('video_url').value;
  var submit_video = document.getElementById('submit_video').value;
  var cmuitaccount = document.getElementById('cmuitaccount').value;
  var controls = document.getElementById('controls').value;
  // console.log(course_id);
  //console.log(cmuitaccount);
  // console.log(video_url);
  // console.log(submit_video);

        // AJAX request to fetch quiz data from the server
  $.ajax({
    url: 'assets/php/action_course_learning.php',
    method: 'POST',
    data: {
      'get_question': true,
      video_question_id : video_question_id
    },
    dataType: 'json',
    success: function (response) {
      quizData = response;
      //console.log(quizData);
    },
    error: function (error) {
      console.error('Error fetching quiz data:', error);
    },
    complete: function () {
        // Additional actions to be performed whether the request is successful or not
    }
  });

  function loadTable1(action, targetElement) {
    $.ajax({
      url: 'assets/php/action_course_learning.php',
      type: 'POST',
      data: { [action]: true, 'course_id': course_id, 'video_url': video_url, 'cmuitaccount': cmuitaccount},
      success: function (data) {
        $(targetElement).html(data);
      },
      error: function (xhr, status, error) {
        console.error(xhr.responseText);
      }
    });
  }
  loadTable1('get_video', '#list_video');



  var player;
  var quizContainer = $("#quizContainer");
  var currentQuestionIndex = 0;
  var quizCompleted = false;

  function onYouTubeIframeAPIReady() {
    player = new YT.Player('videoPlayer', {
      height: '550',
      width: '100%',
                videoId: video_url, // Replace with your YouTube video ID
                playerVars: {
                  'controls': controls,
                  'disablekb': 1,
                  'fs': 0,
                  'rel': 0,
                  'iv_load_policy': 3,
                  'modestbranding': 1,
                  'showinfo': 0
                },
                events: {
                  'onReady': onPlayerReady,
                  'onStateChange': onPlayerStateChange
                }
              });
    var fullscreenButton = document.getElementById('fullscreenButton');
    fullscreenButton.addEventListener('click', toggleFullscreen);
  }

  function toggleFullscreen() {
    if (document.fullscreenElement) {
      document.exitFullscreen();
    } else {
      player.getIframe().requestFullscreen();
    }

            // Toggle pointer-events style
    var videoPlayer = document.getElementById('videoPlayer');
    videoPlayer.style.pointerEvents = document.fullscreenElement ? 'auto' : 'none';
  }
  function onPlayerReady(event) {

    restartVideo();
    player.setVolume(100);
    event.target.setPlaybackRate(1.00);
    event.target.playVideo();
    setInterval(checkQuizQuestions, 1000);
    setInterval(updateVideoTime, 1000);

    var playPauseButton = document.getElementById('playPauseButton');
    playPauseButton.addEventListener('click', function () {
      togglePlayPause();
    });
  }


  var restartBtn = document.getElementById('restartBtn');
  var intervalCount = 0;
  var maxIntervalCount = 2;


  restartBtn.addEventListener('click', function () {
    showConfirmationModal();
  });

  function showConfirmationModal() {
    Swal.fire({
      title: 'Restart Video?',
      text: 'Are you sure you want to restart the video?',
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#16537e',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, Restart!',
      cancelButtonText: 'Cancel'
    }).then((result) => {
      if (result.isConfirmed) {
                // User clicked 'Yes, restart!'
        restartVideo();
      }
    });
  }

  var intervalId = setInterval(function() {
    //restartBtn.click();
    restartVideo();
    intervalCount++;

    if (intervalCount >= maxIntervalCount) {
      clearInterval(intervalId);
    }
  }, 1000);


  var rewind30Btn = document.getElementById('rewind30Btn');
  rewind30Btn.addEventListener('click', function () {
    rewindVideo(30);
  });

  var rewind1MinBtn = document.getElementById('rewind1MinBtn');
  rewind1MinBtn.addEventListener('click', function () {
            rewindVideo(60); // Rewind by 1 minute (60 seconds)
          });

        // Function to rewind the video by a specified number of seconds
  function rewindVideo(seconds) {
    if (player) {
      var currentTime = player.getCurrentTime();
      var newTime = Math.max(0, currentTime - seconds);
      player.seekTo(newTime);
    }
  }

  function togglePlayPause() {
    if (player.getPlayerState() == YT.PlayerState.PLAYING) {
      player.pauseVideo();
      document.getElementById('playPauseButton').innerHTML = 'Play <i class="bi bi-play-fill"></i>';
    } else {
      player.playVideo();
      document.getElementById('playPauseButton').innerHTML = 'Pause <i class="bi bi-pause"></i>';
    }
  }

  function restartVideo() {
    player.seekTo(0);
    player.playVideo();
  }

  function onPlayerStateChange(event) {
    if (event.data === YT.PlayerState.PLAYING) {
                // Video is playing, you can add your logic here
      updateQualitySpan();
      updateVideoTime();
    }
  }

  function updateQualitySpan() {
            // Get the current video quality
    var currentQuality = player.getPlaybackQuality();
            // Update the quality span
    $('#PlayQuality').text('' + currentQuality);
  }

  function updateVideoTime() {
            // Get the current video time in seconds
    var currentTime = player.getCurrentTime();
            // Get the total duration of the video
    var duration = player.getDuration();
            // Format the times as mm:ss
    var formattedCurrentTime = formatTime(currentTime);
    var formattedDuration = formatTime(duration);
            // Update the time span
    $('#VideoTime').text('Time: ' + formattedCurrentTime + ' / ' + formattedDuration);
  }

  function formatTime(timeInSeconds) {
    var minutes = Math.floor(timeInSeconds / 60);
    var seconds = Math.floor(timeInSeconds % 60);
    return minutes + ':' + (seconds < 10 ? '0' : '') + seconds;
  }

  function checkQuizQuestions() {
    var currentTimestamp = Math.floor(player.getCurrentTime());

    if (!quizCompleted && currentQuestionIndex < quizData.length) {
      var currentQuestion = quizData[currentQuestionIndex];

      if (currentTimestamp >= currentQuestion.time_show) {
        displayQuestions(currentQuestion);
        currentQuestionIndex++;
      }
    } else if (!quizCompleted && currentTimestamp >= submit_video) {
      showSubmitButton();
      quizCompleted = true;
    }
  }

  function displayQuestions(question) {
    var questionHTML = "<div>";
    questionHTML += "<span>" + question.question + "</span><br>";

    if (question.options && Array.isArray(question.options)) {
      question.options.forEach(function (option) {
        var optionData = option.split(',');
        if (optionData.length === 2) {
          var optionNum = optionData[0].trim();
          var optionText = optionData[1].trim();
          questionHTML += "<input type='radio' class='my-2' name='question" + question.question_num + "' value='" + optionNum + "'> " + optionText + "<br>";
        } else {
          console.error("Invalid option format:", option);
        }
      });
    } else {
      console.error("Invalid options array:", question.options);
    }

    questionHTML += "</div><br>";

    quizContainer.append(questionHTML);
  }



  function showSubmitButton() {
    var submitButtonHTML = "<div class='text-center'><button onclick='showSubmitConfirmation()' class='btn btn-lg btn-outline-success mb-5'>Submit Answers</button></div>";
    quizContainer.append(submitButtonHTML);
  }

  function showSubmitConfirmation() {
    Swal.fire({
      title: 'Submit Answers?',
      text: 'Are you sure you want to submit your answers?',
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, submit!',
      cancelButtonText: 'Cancel'
    }).then((result) => {
      if (result.isConfirmed) {
            submitAnswers(); // Call the actual submit function if the user clicks 'Yes, submit!'
          }
        });
  }

  function submitAnswers() {
    var selectedAnswers = [];

    // Iterate over each question and get the selected answer
    var allQuestionsAnswered = true;
    quizData.forEach(function (question, index) {
      var selectedAnswer = $("input[name='question" + question.question_num + "']:checked").val();
       var answerIndex = index + 1; // Add 1 to match the question number

      // var correct_Answer = question.correct_Answer;
      // console.log(correct_Answer);


       if (selectedAnswer) {
         var optionText = question.options[selectedAnswer - 1].split(',')[1].trim();
         selectedAnswers.push({
          question_num: question.question_num,
          correctAnswer: question.correct_Answer,
          question_id: question.question_id,
          index_num: index + 1,
          selectedAnswer: selectedAnswer,
          optionText: optionText
        });

       } else {
            // If any question is not answered, set the flag to false
        allQuestionsAnswered = false;
            // Optionally, you can highlight the unanswered question or display an error message
            //alert("Please answer all questions before submitting. ข้อที่ "+question.question_num);
        Swal.fire({
          title: 'Error',
          text: 'Please answer all questions before submitting. ข้อที่ ' + question.question_num,
          icon: 'error'
        });
            return false; // Stop further processing
          }

        });

    // AJAX request to submit the answers to the server
    if (allQuestionsAnswered) {
      $.ajax({
        url: 'assets/php/action_course_learning.php',
        method: 'POST',
        data: {
          'submitAnswers': true,
          'course_id': course_id,
          'video_question_id': video_question_id,
          'cmuitaccount': cmuitaccount,
          'selectedAnswers': JSON.stringify(selectedAnswers)
        },
        dataType: 'json',
        success: function (response) {
          //console.log(response);
          if (response.status === 'success') {
            Swal.fire({
              title: 'Success',
              text: 'Answers submitted successfully!\nYour Answers\n' + response.message,
              icon: 'success'
            });

            //console.log(response.course);
            window.location.href = 'course_learning?course=' + response.course;


          } else {
            Swal.fire({
              title: 'Error',
              text: 'Failed to submit answers. Please try again.',
              icon: 'error'
            });
          }
        },
        error: function (error) {
          console.error('Error submitting answers:', error);
        }
      });
    }
  }






</script>








</body>
</html>