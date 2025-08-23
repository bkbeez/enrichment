    <?php 
    // echo  $_SERVER['SERVER_NAME'];
    // echo '<br>';
    // echo  $_SERVER['REQUEST_URI'];
    // echo '<br>';
    // echo  $_SERVER['SCRIPT_NAME'];
    // echo '<br>';
    // echo  $_SERVER['HTTP_HOST'];
    // echo '<br>';
    // echo  dirname(__FILE__);
    // echo '<br>';
    // echo  dirname($_SERVER['PHP_SELF']);
    // echo '<br>';
    // echo  basename(dirname($_SERVER['PHP_SELF']));
    // echo '<br>';
    // echo  dirname(dirname($_SERVER['PHP_SELF']));
    // echo '<br>';
    // echo  basename(__FILE__);
    // echo '<br>';
    // echo  basename(__DIR__);
    // echo '<br>';
    // echo substr(basename(__FILE__),0,-4);
    // echo '<br>';
    // echo substr(basename($_SERVER['PHP_SELF']),0,-4);
    // echo '<br>';
    // echo basename(dirname($_SERVER['PHP_SELF']));
    // echo '<br>';

    // $basename_dirname_PHP_SELF =  basename(dirname($_SERVER['PHP_SELF']));
    // $dirname_dirname_PHP_SELF = dirname(dirname($_SERVER['PHP_SELF']));
    // $basename_FILE = basename(__FILE__);
    // $basename_DIR = basename(__DIR__);
    // $substr_FILE = substr(basename(__FILE__),0,-4);
    // $basename_PHP_SELF = basename(dirname($_SERVER['PHP_SELF']));

    $basename_dirname_PHP_SELF =  basename(dirname($_SERVER['PHP_SELF']));
    $substr_FILE = substr(basename(__FILE__),0,-4);
    ?>

    <?php if ($basename_dirname_PHP_SELF == 'admin'){
      $subadmin = '../';
    }?>

    <style>
      .header-five .header-nav{
        height: 50px;
      }
    </style>
    <input type="text" id="subadmin" value="<?= $subadmin ?>" hidden>

    <header class="header header-five">
      <div class="header-fixed">
        <nav class="navbar navbar-expand-lg header-nav">
          <div class="container">
            <div class="navbar-header">
              <a id="mobile_btn" href="javascript:void(0);">
                <span class="bar-icon">
                  <span></span>
                  <span></span>
                  <span></span>
                </span>
              </a>
              <a href="<?= $subadmin ?>index" class="navbar-brand logo">
                <div id="imgheader1"></div>
              </a>
            </div>
            <div class="main-menu-wrapper">
              <div class="menu-header">
                <a href="index.html" class="menu-logo">
                  <div id="imgheader2"></div>
                </a>
                <a id="menu_close" class="menu-close" href="javascript:void(0);">
                  <i class="fas fa-times"></i>
                </a>
              </div>
              <ul class="main-nav">

                <li class="active">
                  <a href="<?= $subadmin ?>home" class="text-primary"><i class="bi bi-house" style="font-size: 18px;"></i> Home</a>
                </li>


                <li>
                  <a href="<?= $subadmin ?>home"><i class="bi bi-cart4" style="font-size: 18px;"></i> Couse</a>
                </li>

                <?php if (isset($_SESSION['cmuitaccount'])): ?>

                  <li>
                    <a href="<?= $subadmin ?>course_purchase"><i class="bi bi-cart-check" style="font-size: 18px;"></i> My Couse</a>
                  </li>

                <?php endif ?>

                <?php if ($_SESSION['user_type'] == 'admin'): ?>

                  <li class="has-submenu">
                    <a href="">Pages <i class="fas fa-chevron-down"></i></a>
                    <ul class="submenu">
                      <li><a href="<?= $subadmin ?>home2">Home 1</a></li>
                      <li><a href="">Page2</a></li>
                      <li class="has-submenu">
                        <a href="invoices.html">Invoices</a>
                        <ul class="submenu">
                          <li><a href="">View 1</a></li>
                          <li><a href="">View 2</a></li>
                        </ul>
                      </li>
                    </ul>
                  </li>

                  <li class="has-submenu">
                    <a href="">Admin <i class="fas fa-chevron-down"></i></a>
                    <ul class="submenu">
                      <li><a href="<?= $subadmin ?>admin/manage_course"><b>จัดการหลักสูตร</b></a></li>
                      <li><a href="<?= $subadmin ?>admin/manage_scholar"><b>ดูการเข้าเรียน</b></a></li>
                      <li><a href="<?= $subadmin ?>admin/manage_chart"><b>สถิติการเข้าใช้งาน</b></a></li>

                      <?php if ($_SESSION['cmuitaccount'] == 'atthaphan.j@cmu.ac.th'): ?>
                        <li><a href="<?= $subadmin ?>info">info</a></li>
                        <li><a href="<?= $subadmin ?>pdf">pdf</a></li>
                        <li><a href="<?= $subadmin ?>admin/manage_api_educmu">api_educmu</a></li>
                        <li><a href="<?= $subadmin ?>admin/manage_page">manage_page</a></li>
                        <li><a href="<?= $subadmin ?>admin/manage_upload">manage_upload</a></li>
                        <li><a href="<?= $subadmin ?>admin/manage_scholar">manage_scholar</a></li>
                        <li><a href="<?= $subadmin ?>admin/manage_user">manage_user</a></li>
                        <li><a href="<?= $subadmin ?>admin/manage_chart">manage_chart</a></li>
                        
                      <?php endif ?>
                    </ul>
                  </li>
                <?php endif ?>
                
                <li></li>
              </ul>    
            </div>     
            <ul class="nav">
              <li class="nav-item">
              </li>
              <li class="nav-item">
                <?php if (isset($_SESSION['cmuitaccount'])) { ?>
                  <a class="btn btn btn-outline-danger btn-rounded p-2 cmulogout" href="#" data-basename_admin="<?= $basename_dirname_PHP_SELF ?>"><i class="bi bi-power"></i>logout</a>
                <?php }else { ?>
                  <a class="btn btn-lg btn-primary btn-rounded p-2 active" href="#" id="cmulogin"><i class="bi bi-person-fill-lock"></i>CMU login</a>
                <?php } ?>

              </li>
            </ul>
          </div>    
        </nav>
      </div>
    </header>

