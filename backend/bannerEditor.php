<?php
    include_once "../controller/env.php";

    if(!empty($_REQUEST['id'])){

      $id=$_REQUEST['id'];
  
      $query="SELECT * FROM banners WHERE id='$id'";
      $resonse=mysqli_query($conn,$query);
      $banner=mysqli_fetch_assoc($resonse);
    }
  include_once 'inc/daseboard_header.php';
?>
<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-body-tertiary sidebar collapse">
      <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="daseboard.php">
              <span data-feather="home" class="align-text-bottom"></span>
              Dashboard
            </a>
          </li>
          <li class="nav-item active">
            <a class="nav-link active" href="banner.php">
              <span data-feather="file" class="align-text-bottom"></span>
              banner
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="allbanner.php">
              <span data-feather="file" class="align-text-bottom"></span>
              all banner
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 ">
      <div class="card p-3 mx-auto col-lg-10 mt-5">
            <form action="../controller/bannerEdit.php" enctype="multipart/form-data" class="form d-flex justify-content-between flex-wrap " method="POST">
                <div class="col-lg-3">
                    <input name="bannerImg" type="file" class="form-control bannerImg">
                    <input type="text" name="id" hidden value="<?=$banner['id']?>">
                    <?php
                    if(isset($_SESSION['Banner_errors']['file_error'])){
                    ?>
                        <span class="red-color"><?=$_SESSION['Banner_errors']['file_error'];?></span>
                    <?php
                        };
                    ?>
                    <img src="<?='../uploads/'.$banner['banner_img']?>" class="img-fluid my-3 image" alt="">
                </div>
                <div class="description col-lg-8 col-sm-12">
                    <input value="<?= isset($banner['title'])? $banner['title']:''?>" name="title" type="text" class="form-control w-100" placeholder="Enter banner title">
                    <?php
                    if(isset($_SESSION['Banner_errors']['title_error'])){
                    ?>
                        <span class="red-color"><?=$_SESSION['Banner_errors']['title_error'];?></span>
                    <?php
                        };
                    ?>

                    <textarea name="description" type="text" class="form-control  w-100" style="height:300px" placeholder="Enter banner description">
                        <?= isset($banner['description'])? $banner['description']:''?>
                    </textarea>
                    <?php
                    if(isset($_SESSION['Banner_errors']['description_error'])){
                    ?>
                    <span class="red-color"><?=$_SESSION['Banner_errors']['description_error'];?></span>
                    <?php
                        };
                    ?>
                    
                    <input value="<?= isset($banner['call_to_action_text'])? $banner['call_to_action_text']:''?>" name="callToAction" type="text" class="form-control my-2 w-100" placeholder="Enter a text for book a call to action button">
                    <?php
                    if(isset($_SESSION['Banner_errors']['callToAction_error'])){
                    ?>
                        <span class="red-color"><?=$_SESSION['Banner_errors']['callToAction_error'];?></span>
                    <?php
                        };
                    ?>
                    <input value="<?= isset($banner['call_to_action_link'])? $banner['call_to_action_link']:''?>" name="callToActionUrl" type="text" class="form-control my-2 w-100" placeholder="Enter a Link for book a table button">



                    <input value="<?= isset($banner['video_link'])? $banner['video_link']:''?>" name="videoLink" type="text" class="form-control my-2 w-100" placeholder="Enter a banner video Link">
                </div>

                <button class="col-lg-5 col-sm-10 btn btn-primary ms-auto my-3" type="submit">Update Changes</button>
            </form>
      </div>
    </main>
  </div>
</div>

<?php
  include_once 'inc/daseboard_footer.php';
  unset($_SESSION['Banner_errors']);
?>