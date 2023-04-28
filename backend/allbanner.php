<?php  
  require_once "../controller/env.php";
  $query="SELECT * FROM banners";
  $response=mysqli_query($conn,$query);
  $datas=mysqli_fetch_all($response,1);
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
          <li class="nav-item">
            <a class="nav-link" href="banner.php">
              <span data-feather="file" class="align-text-bottom"></span>
              banner
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="allbanner.php">
              <span data-feather="file" class="align-text-bottom"></span>
              all banner
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="card my-4 text-center p-3">
            <h1>all banner details</h1>
      </div>

        <?php
            foreach($datas as $ind=>$data){
        ?>
            <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="col-lg-9 p-4 d-flex flex-column position-static">
                    <strong class="d-inline-block mb-2 text-primary"><?=++$ind?></strong>
                    <h3 class="mb-0"><?=$data['title']?></h3>
                    <p class="card-text mb-auto"><?= strlen($data['description']) >30? substr($data['description'],0,28)."....":$data['description']?></p>
                    <ul class="list-group my-3">
                        <li class="list-group-item"><strong>Call to Action text :</strong> <?=$data['call_to_action_text']?></li>
                        <li class="list-group-item"><strong>Call to Action url :</strong> <?=$data['call_to_action_link']?></li>
                        <li class="list-group-item"><strong>Vedio Link :</strong> <?=$data['video_link']?></li>
                        <li class="list-group-item"><strong>status :</strong> <button class="btn btn-<?=$data['status']==1? "success":"warning"?> mx-2 btn-sm"><?=$data['status']==1? "Active":"Deactive"?></button></li>
                    </ul>
                    <div class="button d-flex">
                        <a href="../controller/bannerActive.php?id=<?=$data['id']?>" class="btn btn-<?=$data['status']==0? "success":"warning"?> mx-2"><?=$data['status']==0? "Active":"Deactive"?></a>
                        <a href="#" class="btn btn-primary mx-2">Edit</a>
                        <a href="../controller/bannerDelete.php?id=<?=$data['id']?>" class="btn btn-danger mx-2">Delete</a>
                    </div>
                </div>
                <div class="col-lg-3 d-none d-lg-block">
                    <img class="bd-placeholder-img" width="100%" height="100%" src="../uploads/<?=$data['banner_img']?>"></img>
                </div>
            </div>
        <?php
            }
        ?>
    </main>
  </div>
</div>

<?php
  include_once 'inc/daseboard_footer.php';
  unset($_SESSION['Banner_errors']);
?>