<?php require_once($_SERVER["DOCUMENT_ROOT"].'/login/lib/app.php'); ?>
<?php require_once($_SERVER["DOCUMENT_ROOT"].'/login/lib/azure.class.php'); ?>
<?php require_once($_SERVER["DOCUMENT_ROOT"].'/login/lib/azureinfo.class.php'); ?>
<?php
    date_default_timezone_set('Asia/bangkok'); 
    $signin = new Azure();
    $signin->setCallbackUri(APP_HOME.'/login/signin.php');
    $signin->setScope('api://cmu/Mis.Account.Read.Me.Basicinfo api://cmu/Mis.Hr.Read.Me.Personalinfo');
    if( isset($_GET['error']) ){
        if (isset($_SESSION['login'])) { unset($_SESSION['login']); }
        if (isset($_SESSION['oauth2state'])) { unset($_SESSION['oauth2state']); }
        $_SESSION['loginmsg']['title'] = $_GET['error'];
        $_SESSION['loginmsg']['text'] = ( (isset($_GET['error_description'])&&$_GET['error_description']) ? $_GET['error_description'] : null );
        header('location: '.APP_HOME.'/login/deny.php');
        exit();
    }else if( !isset($_GET['code']) ){
        $_SESSION['oauth2state'] = $signin->setState();
        $signin->initAzure();
    }else if( empty($_GET['state'])||(isset($_SESSION['oauth2state'])&&$_GET['state']!==$_SESSION['oauth2state']) ){
        if (isset($_SESSION['login'])) { unset($_SESSION['login']); }
        if (isset($_SESSION['oauth2state'])) { unset($_SESSION['oauth2state']); }
        $_SESSION['loginmsg']['title'] = 'Invalid';
        $_SESSION['loginmsg']['text'] = 'Invalid State.';
        header('location: '.APP_HOME.'/login/deny.php');
        exit();
    }else{
        $code = $_GET['code'];
        $accessToken = $signin->getAccessTokenAuthCode($code);
        $azure = new Azureinfo();
        $basic = $azure->getBasicinfo($accessToken->access_token);
        $log_action = 'login';
        if( isset($basic->student_id)&&$basic->student_id ){
            $cmuitaccount_name = $basic->cmuitaccount_name;
            $cmuitaccount = $basic->cmuitaccount;
            $student_id = $basic->student_id;
            $organization_name_EN = $basic->organization_name_EN;
            // Users
            $users = array();
            $users['cmuitaccount_name'] = $basic->cmuitaccount_name;
            $users['cmuitaccount'] = $basic->cmuitaccount;
            $users['student_id'] = $basic->student_id;
            $users['prename_id'] = $basic->prename_id;
            $users['prename_TH'] = $basic->prename_TH;
            $users['prename_EN'] = $basic->prename_EN;
            $users['firstname_TH'] = $basic->firstname_TH;
            $users['firstname_EN'] = $basic->firstname_EN;
            $users['lastname_TH'] = $basic->lastname_TH;
            $users['lastname_EN'] = $basic->lastname_EN;
            $users['organization_code'] = $basic->organization_code;
            $users['organization_name_TH'] = $basic->organization_name_TH;
            $users['organization_name_EN'] = $basic->organization_name_EN;
            $users['itaccounttype_id'] = $basic->itaccounttype_id;
            $users['itaccounttype_TH'] = $basic->itaccounttype_TH;
            $users['itaccounttype_EN'] = $basic->itaccounttype_EN;
            // Checking
            $check = Site::one("SELECT * FROM users_cmu WHERE student_id=:student_id LIMIT 1;", array('student_id'=>$student_id));
            if( isset($check['id'])&&$check['id'] ){
                // Old User
                $datas  = '`cmu_timestamp`';
                $datas .= "=NOW()";
                foreach($users as $key => $value ){
                    $datas .= ',`'.$key.'`';
                    $datas .= "=:".$key;
                }
                $users['id'] = $check['id'];
                Site::update("UPDATE `users_cmu` SET $datas WHERE id=:id;", $users);
                $signed = true;
            }else{
                // New User
                $fields = "`cmu_date_add`";
                $values = "NOW()";
                $users['user_type'] = 'user';
                foreach($users as $key => $value ){
                    $fields .= ',`'.$key.'`';
                    $values .= ",:".$key;
                }
                if( Site::create("INSERT INTO `users_cmu` ($fields) VALUES ($values);", $users) ){
                    $log_action = 'new_user';
                    $signed = true;
                }
            }
            if( isset($signed) ){
                $currentMonth = date('m');
                $currentYear = date('Y');
                $currentDay = date('d');
                if ($currentMonth == '01') {
                    $academic_year = (int)$currentYear + 542;
                } elseif ($currentMonth == '02') {
                    $academic_year = (int)$currentYear + 542;
                } elseif ($currentMonth == '03') {
                    $academic_year = (int)$currentYear + 542;
                } elseif ($currentMonth == '04') {
                    $academic_year = (int)$currentYear + 542;
                } elseif ($currentMonth == '05') {
                    $academic_year = (int)$currentYear + 542;
                } elseif ($currentMonth == '06') {
                    $academic_year = (int)$currentYear + 542;
                } elseif ($currentMonth == '07' && $currentDay < 15) {
                    $academic_year = (int)$currentYear + 542;
                } elseif ($currentMonth == '07' && $currentDay >= 15) {
                    $academic_year = (int)$currentYear + 543;
                } elseif ($currentMonth == '08') {
                    $academic_year = (int)$currentYear + 543;
                } elseif ($currentMonth == '09') {
                    $academic_year = (int)$currentYear + 543;
                } elseif ($currentMonth == '10') {
                    $academic_year = (int)$currentYear + 543;
                } elseif ($currentMonth == '11') {
                    $academic_year = (int)$currentYear + 543;
                } elseif ($currentMonth == '12') {
                    $academic_year = (int)$currentYear + 543;
                } else {
                    $academic_year = "Unknown";
                }
                // Major
                $checkmajor = Site::one("SELECT major FROM student WHERE student_id=:student_id LIMIT 1;", array('student_id'=>$student_id));
                if( isset($checkmajor['major'])&&$checkmajor['major'] ){
                    Site::update("UPDATE `users_cmu` SET `user_major`=:user_major WHERE id=:id;", array('id'=>$users['id'], 'user_major'=>$checkmajor['major']));
                }
                // Logs
                $logs = array();
                $logs['cmuitaccount_name'] = $cmuitaccount_name;
                $logs['cmuitaccount'] = $cmuitaccount;
                $logs['student_id'] = $student_id;
                $logs['action'] = $log_action;
                $log_id = Site::createLastInsertId("INSERT INTO `users_cmu_log` (`cmuitaccount_name`,`cmuitaccount`,`student_id`,`action`,`timestamp`) VALUES (:cmuitaccount_name,:cmuitaccount,:student_id,:action,NOW());", $logs);
                if( $log_id ){
                    Site::update("UPDATE `users_cmu_log` SET `log_id`=:log_id WHERE id=:id;", array('id'=>$log_id, 'log_id'=>'log_'.$log_id));
                }
                $_SESSION['cmuitaccount_name'] = $cmuitaccount_name;
                $_SESSION['cmuitaccount'] = $cmuitaccount;
                $_SESSION['organization_name_EN'] = $organization_name_EN;
                $_SESSION['student_id'] = $student_id;
                $_SESSION['academic_year'] = $academic_year;
                header('location: '.APP_HOME);
                exit();
            }
        }
        $_SESSION['loginmsg']['title'] = 'Login Fail !!!';
        $_SESSION['loginmsg']['text'] = 'ไม่พบบัญชีผู้ใช้นี้, <i>โปรดตรวจสอบบัญชีของท่าน</i>';
        header('location: '.APP_HOME.'/login/deny.php');
        exit();
    }
?>