<?php
include_once "../controller/env.php";
$query = "SELECT * FROM menus WHERE status=1";
$response = mysqli_query($conn, $query);
$menus = mysqli_fetch_all($response, 1);
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
            <a class="nav-link" href="allbanner.php">
              <span data-feather="file" class="align-text-bottom"></span>
              all banner
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link " href="menu.php">
              <span data-feather="file" class="align-text-bottom"></span>
              add menu
            </a>
          </li>
          <li class="nav-item active">
            <a class="nav-link active" href="food.php">
              <span data-feather="file" class="align-text-bottom"></span>
              add food
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 ">
      <div class="card p-3 mx-auto col-lg-10 mt-5">
        <form action="../controller/fodeStore.php" enctype="multipart/form-data" class="form d-flex justify-content-between flex-wrap " method="POST">
          <div class="col-lg-3">
            <input name="foodImg" type="file" class="form-control bannerImg">
            <?php
            if (isset($_SESSION['food_errors']['file_error'])) {
            ?>
              <span class="red-color"><?= $_SESSION['food_errors']['file_error']; ?></span>
            <?php
            };
            ?>
            <img src="" class="img-fluid my-3 image" alt="">
          </div>
          <div class="description col-lg-8 col-sm-12">
            <input value="<?= isset($_SESSION['old_food_details']['title']) ? $_SESSION['old_food_details']['title'] : '' ?>" name="title" type="text" class="form-control w-100 my-2" placeholder="Enter banner title">
            <?php
            if (isset($_SESSION['food_errors']['title_error'])) {
            ?>
              <span class="red-color"><?= $_SESSION['food_errors']['title_error']; ?></span>
            <?php
            };
            ?>

            <textarea name="description" type="text" class="form-control w-100" style="height:300px" placeholder="Enter banner description">
                        <?= isset($_SESSION['old_food_details']['description']) ? $_SESSION['old_food_details']['description'] : '' ?>
                    </textarea>
            <?php
            if (isset($_SESSION['food_errors']['description_error'])) {
            ?>
              <span class="red-color"><?= $_SESSION['food_errors']['description_error']; ?></span>
            <?php
            };
            ?>

            <input value="<?= isset($_SESSION['old_food_details']['price']) ? $_SESSION['old_food_details']['price'] : '' ?>" name="price" type="text" class="form-control w-100 my-2" placeholder="Enter banner title">
            <?php
            if (isset($_SESSION['food_errors']['price_error'])) {
            ?>
              <span class="red-color"><?= $_SESSION['food_errors']['price_error']; ?></span>
            <?php
            };
            ?>

            <select name="catagory" id="" class="form-control">
              <option disabled selected>Select one</option>
              <?php
              foreach ($menus as $menu) {
              ?>
                <option value="<?= $menu['id'] ?>"><?= $menu['menu_name'] ?></option>
              <?php
              }
              ?>
            </select>
            <?php
            if (isset($_SESSION['food_errors']['catagory_error'])) {
            ?>
              <span class="red-color"><?= $_SESSION['food_errors']['catagory_error']; ?></span>
            <?php
            };
            ?>

          </div>

          <button class="col-lg-5 col-sm-10 btn btn-primary ms-auto my-3" type="submit">add food</button>
        </form>
      </div>
    </main>
  </div>
</div>

<?php
include_once 'inc/daseboard_footer.php';
unset($_SESSION['food_errors']);
?>