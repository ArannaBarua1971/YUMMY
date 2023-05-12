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
          <li class="nav-item ">
            <a class="nav-link " href="banner.php">
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
          <li class="nav-item active">
            <a class="nav-link active" href="menu.php">
              <span data-feather="file" class="align-text-bottom"></span>
              add menu
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link " href="food.php">
              <span data-feather="file" class="align-text-bottom"></span>
              add food
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 ">
      <div class="card p-3 mx-auto col-lg-10 mt-5">
      <h5 class="card-title">add menu</h5>
        <form action="../controller/menuStore.php" class="form d-flex justify-content-between flex-wrap " method="POST">
          <div class="description col-sm-12">
            <input name="menu" type="text" class="form-control w-100" placeholder="Enter menu title">

            <?php
            if (isset($_SESSION['menu_error'])) {
            ?>
              <span class="red-color"><?= $_SESSION['menu_error'] ?></span>
            <?php
            };
            ?>
          </div>

          <button class="col-lg-5 col-sm-10 btn btn-primary ms-auto my-3" type="submit">add menu</button>
        </form>
        <div>
        <h5 class="card-title">menu list</h5>
          <ul class="list-group">
            <?php
            foreach ($menus as $menu) {
            ?>
              <li class="list-group-item"><?=$menu['menu_name']?></li>
            <?php
            }
            ?>
          </ul>
        </div>
      </div>
    </main>
  </div>
</div>

<?php
include_once 'inc/daseboard_footer.php';
unset($_SESSION['menu_error']);
?>