
<?php require_once 'init.php'; ?>

<?php 
if(!connect()):
  header('location:'.SITE.'security/login.php');
  exit();
endif; 
?>


<!doctype html>
<html lang="en">
  
<head>

    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>STREAMLABS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.1.3/lux/bootstrap.min.css"
          integrity="sha512-B5sIrmt97CGoPUHgazLWO0fKVVbtXgGIOayWsbp9Z5aq4DJVATpOftE/sTTL27cu+QOqpI/jpt6tldZ4SwFDZw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" type="image/png" href="/Upload/image/streamlabs-obs.png" sizes="16x16" />
    <link rel="stylesheet" href=".<?= SITE ?>css/style.css">
</head>

<body >



<header>

  <div class="netflixLogo pt-2">
    <a id="logo" href="./index.php"><img src="<?= SITE ?>img/streamlabs-obs.png" alt="Logo Image"></a>
  </div>      
  <nav class="main-nav d-flex  align-items-center">                
    <a href="./index.php">Home</a>
    <a href="#tvShows">TV Shows</a>
    <a href="#movies">Movies</a>
    <a href="#originals">Originals</a>
  </nav>
  <nav class="sub-nav d-flex align-items-center">
    <a href="#"><i class="fas fa-search sub-nav-logo p-2"></i></a>
    <a href="#"><i class="fas fa-bell sub-nav-logo p-2"></i></a>
    <ul style="z-index:auto!important;" class="navbar-nav">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Account</a>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href='.inc/wishlist.php'>My List</a></li>
          <?php if(admin()): ?>
            <li><a class="dropdown-item" href='./admin/upload.php'>Admin</a></li> 
          <?php endif; ?>
          <?php if(connect()): ?>
            <li><a class="dropdown-item" href='./security/login.php?unset=1' >Log Out</a></li>
          <?php endif; ?>

        </ul>
      </li>
    </ul>
  </nav>

</header>

    
<?php if (isset($_SESSION['messages']) && !empty($_SESSION['messages'])):
  foreach ($_SESSION['messages'] as $type => $mess):
    foreach ($mess as $key => $message):?>
      <div class="alert alert-<?= $type; ?> text-center">
        <p><?= $message; ?></p>
      </div>
      <?php unset($_SESSION['messages'][$type][$key]); ?>
    <?php endforeach; 
  endforeach; 
endif; ?>


