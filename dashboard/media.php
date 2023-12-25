<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css" />

    <!-- Fontawesome -->
    <link rel="stylesheet" href="../css/all.min.css" />
    <link rel="stylesheet" href="../css/fontawesome.min.css" />

    <!-- FavIcon -->
    <link rel="shortcut icon" href="../img/company/favicon.png" type="image/x-icon" />

    <!-- Stylesheet -->
    <link rel="stylesheet" href="../css/admin.css" />
    <link rel="stylesheet" href="../css/styles.css" />

    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard - Digital Farm</title>
  </head>
  <body>
    <!-- dashboard Header -->
    <header class="header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-xl-6 col-sm-6">
            <div class="header_left">
              <button class="dashboard_burger">
                <i class="fas fa-bars"></i>
              </button>
              <a href="#">
                <img src="../img/company/favicon.png" alt="" />
              </a>
              <a href="../index.html">
                <i class="fas fa-home"></i>
                <span class="d-none d-md-inline-block">Digital Farm Nepal</span>
              </a>
            </div>
          </div>
          <div class="col-xl-6 col-sm-6">
            <div class="user-profile text-end">
              <button>
                <span>Arjun</span>
                <i class="fas fa-user"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- Dashboard Dashboard content -->
    <div class="dashboard-body-wrapper">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-2 p-0">
            <!-- Admin Menu -->
            <nav class="dash_menu">
              <ul class="dash_menu_items">
                <li class="dash_menu_items_item">
                  <a href="dashboard.html">
                    <i class="fa-solid fa-gauge"></i>
                    Dashboard
                  </a>
                </li>
                <li class="dash_menu_items_item dash_menu_dropdown">
                  <a href="#">
                    <i class="fa-solid fa-upload"></i>
                    Post
                  </a>
                  <ul class="dash_menu_dropdown_items">
                    <li>
                      <a href="post.html">All Post</a>
                    </li>
                    <li>
                      <a href="product-add.html">Add New Product</a>
                    </li>
                    <li>
                      <a href="blog-add.html">Add New Blog</a>
                    </li>
                    <li class="active">
                      <a href="plan.html">Add New Plan</a>
                    </li>
                  </ul>
                </li>
                <li class="dash_menu_items_item">
                  <a href="comments.html">
                    <i class="fas fa-comments"></i>
                    Comments
                  </a>
                </li>
                <li class="dash_menu_items_item active">
                  <a href="media.html">
                    <i class="fa-solid fa-image"></i>
                    Media
                  </a>
                </li>
                <li class="dash_menu_items_item">
                  <a href="user.html">
                    <i class="fas fa-people-group"></i>
                    Users
                  </a>
                </li>
              </ul>
            </nav>
          </div>
          <div class="col-lg-10 col-md-12 col-sm-12">
            <div class="container">
              <form class="form">
                <label class="form__container" id="upload-container"
                  >Choose or Drag & Drop Files
                  <input class="form__file" id="upload-files" type="file" accept="image/*" multiple="multiple" />
                </label>
                <div class="form__files-container" id="files-list-container"></div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/admin.js"></script>
  </body>
</html>
