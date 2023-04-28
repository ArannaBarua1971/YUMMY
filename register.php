<?php
    // errors message pass from management.php
    session_start();
    include_once 'inc/login_register_header.php';
?>

<div class="wrapper bg-white">
    <div class="h2 text-center">Creativity</div>
    <div class="h4 text-muted text-center pt-2">Enter your login details</div>
    <form class="pt-3" action="./controller/management.php" method="Post">
        <div class="form-group py-2">
            <div class="input-field"> 
                 <input value="<?= isset($_SESSION['INFO']['name'])? $_SESSION['INFO']['name']: '';?>" type="text"placeholder="Enter your name" name="name"  class=""> 
            </div>
                <?php
                    if(isset($_SESSION['ERROR']['name_error'])){
                ?>
                    <span class="red-color"><?=$_SESSION['ERROR']['name_error'];?></span>
                <?php
                    };
                ?>
        </div>
        <div class="form-group py-2">
            <div class="input-field"> 
                 <input value="<?= isset($_SESSION['INFO']['email'])? $_SESSION['INFO']['email']: '';?>" type="email"placeholder="Enter your email" name="email"  class=""> 
            </div>
                <?php
                        if(isset($_SESSION['ERROR']['email_error'])){
                ?>
                        <span class="red-color"><?=$_SESSION['ERROR']['email_error'];?></span>
                <?php
                    };
                ?>
        </div>
        <div class="form-group py-2">
            <div class="input-field"> 
                 <input value="<?= isset($_SESSION['INFO']['phone'])? $_SESSION['INFO']['phone']: '';?>" type="number"placeholder="Enter your phone number" name="phone"  class=""> 
            </div>
                <?php
                        if(isset($_SESSION['ERROR']['phone_error'])){
                ?>
                        <span class="red-color"><?=$_SESSION['ERROR']['phone_error'];?></span>
                <?php
                    };
                ?>
        </div>
        <div class="form-group py-2">
            <div class="input-field"> 
                 <input value="<?= isset($_SESSION['INFO']['password'])? $_SESSION['INFO']['password']: '';?>" type="password"placeholder="Enter your password" name="password"  class=""> 
            </div>
                <?php
                        if(isset($_SESSION['ERROR']['password_error'])){
                ?>
                        <span class="red-color"><?=$_SESSION['ERROR']['password_error'];?></span>
                <?php
                    };
                ?>
        </div>
        <div class="form-group py-2">
            <div class="input-field"> 
                 <input value="<?= isset($_SESSION['INFO']['confirm_password'])? $_SESSION['INFO']['confirm_password']: '';?>" type="password"placeholder="confirm password" name="confirm_password"  class=""> 
            </div>
                <?php
                        if(isset($_SESSION['ERROR']['confirm_password_error'])){
                ?>
                        <span class="red-color"><?=$_SESSION['ERROR']['confirm_password_error'];?></span>
                <?php
                    };
                ?>
        </div>
        <div class="d-flex align-items-start">
        </div> <button class="btn btn-block text-center my-3">Log in</button>
    </form>
</div>

<?php
    include_once 'inc/login_register_footer.php';

    session_unset();
?>