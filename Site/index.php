


<?php require_once 'inc/header.php';
header("Cache-Control: no-cache, must-revalidate");

$requete=executeRequete('SELECT * FROM upload' 
);
$uploads=$requete->fetchAll(PDO::FETCH_ASSOC);


$requete=executeRequete('SELECT * FROM upload WHERE highlight=:hi', array(
  ':hi'=>1
)
);
$upload=$requete->fetch(PDO::FETCH_ASSOC);


 
?>

<link rel="stylesheet" type="text/css" href="<?= SITE ?>testcss/slick-theme.css"/>
<link rel="stylesheet" type="text/css" href="<?= SITE ?>testcss/slick.css"/>
 
<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="<?= SITE ?>assets/main.js"></script>
<link rel="stylesheet" href="<?= SITE ?>css/Carouselxstyle.css">
  <link rel="stylesheet" href="<?= SITE ?>css/base.css">
  <script src="https://kit.fontawesome.com/a0043d9bc2.js" crossorigin="anonymous"></script>

<link rel="stylesheet" href="<?= SITE.'Site/css/style.css'; ?>"> <!-- BALISE SCSS POUR SLIDER -->

<!--Header video HIGHLIGHT-->
<section class="dheader">

<?php if($upload['highlight'] = 1):  ?>

            <div class="overlay"></div>
            <video control muted playsinline="playsinline" autoplay="autoplay"  id="myVideo">
              <source id="video" src="<?= $upload['video'] ?>" type="video/mp4">
            </video>

   

            <div class="container  w-100">
              <div class="d-flex  w-100">
                    <div class="">
                            <div class="maman">
                                    <h1 class="witcherclass"><?= $upload['name'] ; ?></h1>
                                    <p class="fonts title">Regardez la saison 1 <button type="button"  class="btn ml-1 bt1 ">18+</button> 
                                        <span style="font-size: 2em;" data-toggle="tooltip" data-placement="top" title="Audio Description is available for some episodes" class="mt-3">
                                                <i class="fas fa-ad ml-3 "></i>
                                              </span></button> 
                                    </p> 
                                      <p class="fonts"><?=  $upload['description'] ; ?> </p>
                                             <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                                  
                                                    <div class="btn-group" role="group" aria-label="Third group">
                                                        <button id="pause" type="button" class="btn  mr-3 bt"><i class="fas fa-play ic"></i> Lecture</button>
                                                      </a>
                                                      </div>
                                                    <div class="btn-group" role="group" aria-label="Third group">
                                                            <button type="button" class="btn y mr-3 bt"><i class="fas fa-plus ic"></i> Ajouter à ma liste</button>
                                                          </div>
                                                          <div class="btn-group" role="group" aria-label="Third group">
                                                                <button type="button" class="btn  mr-3 bt"><i class="fas fa-info-circle ic"></i> Plus d'info</button>
                                                              </div>
                                                              <div class="btn-group mt-2 " role="group" aria-label="Third group">
                                                        <button onclick="toggleMute();" type="button" onclick="enableMute()" class="btn  mr-20 bt"><i class="fas fa-volume-mute"></i></button>
                                                      </div>
                                                  </div>
                                                
                                                

                                        </div>
                                    
                          </div>
                        
              </div>
            
            </div>

 <?php endif; ?>           
</section>

<!--Header video HIGHLIGHT FIN -->

  
  
    
   

<!-- DEBUT NEWS ON STREAMLABS ET BALISES STYLE POUR SLIDERSLICK-->
<h1>NEW ON STREAMLABS</h1>

<style>.sliderslick {
        
        margin: 100px auto;
    }
</style>

<div class="center sliderslick">
  

  
   <?php     foreach($uploads as $upload):  ?>
    
                  <div>
                    
    <img 
                
                  src="<?= $upload['picture']; ?>"
                  alt="une image truc">
                  </div>
                  <?php  endforeach;  ?> 
    
                
    </div>
    

			


<!--<div class="nowrapper">

  <section id="section1">
  <a href="#item11" class="arrow__btn"><</a>
    <?php   foreach($uploads as $upload):  ?>
    <div id="<?= 'item'.$upload['id'] ?>" class="item">
    <img src="<?= $upload['picture']; ?>" alt="Describe Image">
    <div class="description">
      <p class="descriptiontexte"><?=  $upload['description'] ; ?></p>
    </div>
   
  </div>
  <?php  endforeach;  ?>
  <a href="#section3" class="arrow__btn">></a>
  </section>

</div>  -->


<!-- Seconde SECTION TEST CAROUSEL ACTUEL -->


 <div class="tamer">
    <button type="button" id="moveLeft" class="btn-nav">
      ᐊ
    </button>
    <div class="tamer-indicators">
      <div class="indicator active" data-index=0></div>
      <div class="indicator" data-index=1></div>
      <div class="indicator" data-index=2></div>
    </div>
    <div class="slider" id="mySlider">
      <div class="movie" id="movie0">
        <img
          src="<?= $upload['picture']; ?>"
          alt="" srcset=""  id="img">
        <div class="letest">
          <div class="description__buttons-tamer">
            <div class="description__button"><i class="fas fa-play"></i></div>
            <div class="description__button"><i class="fas fa-plus"></i></div>
            <div class="description__button"><i class="fas fa-thumbs-up"></i></div>
            <div class="description__button"><i class="fas fa-thumbs-down"></i></div>
            <div class="description__button"><i class="fas fa-chevron-down"></i></div>
          </div>
          <div class="description__text-tamer">
            <span class="description__match"><?= $upload['avis pourcentage'] ?> </span>
            <span class="description__rating">TV-14</span>
            <span class="description__length">2h 11m</span>
            <br><br>
            <span><?= $upload['type1'] ?></span>
            <span>&middot;</span>
            <span><?= $upload['type2'] ?></span>
            <span>&middot;</span>
            <span><?= $upload['type3'] ?></span>
          </div>
        </div>
      </div>
    </div>
    <button type="button" id="moveRight" class="btn-nav">
      ᐅ
    </button>
  </div> 


  



 <script src="<?= SITE ?>assets/script.js"></script> 








<!-- FOOTER  -->

<script type="text/javascript" src="<?= SITE ?>assets/slick.js"></script>
  
<script>

//Commande ne pas enlever in cas 
// $(document).ready(function () {
//     $('.sliderSlick').slick({
//         arrows: true,
//         autoplay: false,
//         autoplaySpeed: 15000,

//     });
//   });

// $('.responsive').slick({
//   arrows:true,
//   infinite: false,
//   speed: 300,
//   slidesToShow: 2,
//   slidesToScroll: 2,
//   responsive: [
//     {
//       breakpoint: 1024,
//       settings: {
//         slidesToShow: 3,
//         slidesToScroll: 3,
//         infinite: true,
//         arrows:true,
//       }
//     },
//     {
//       breakpoint: 600,
//       settings: {
//         slidesToShow: 2,
//         slidesToScroll: 2
//       }
//     },
//     {
//       breakpoint: 480,
//       settings: {
//         slidesToShow: 1,
//         slidesToScroll: 1
//       }
//     }
   
//   ]
// });
//$('.multiple-items').slick({
  //infinite: true,
  //slidesToShow: 5,
  //slidesToScroll: 3,
  //arrows:true
//});

//Requête carrousel pour modif = SlideToShow et SlidesToScroll les arrow en false
$(".center").slick({
        dots: false,
        infinite: true,
        centerMode: true,
        slidesToShow: 5,
        slidesToScroll: 7,
        arrows:true,
      });

// </script>
 





<?php require_once 'inc/footer.php' ?>




<!-- Pour charger des informations en get  on déclare avec ? le chargement de $_GET suivie de l'indice (le name à appelé sur $_GET) et on lui affecte sa valeur avec =savaleur. ex: ?prenom='cesaire'&nom='desaulle'; le debug de $_GET nous renvoie 'nom'=>'desaulle',-->
<!--   'prenom'=>'cesaire'. Pour y accéder on appelle $_GET['nom'] nous retourne 'desaulle'-->










