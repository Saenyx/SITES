
<?php require_once 'inc/init.php';

$requete=executeRequete('SELECT picture FROM upload' );

$links=$requete->fetchAll(PDO::FETCH_ASSOC);

$array=[];
foreach($links as $key => $link ):
//  die(var_dump($link));
$array[]=["src"=>SITE.$link['picture']];

endforeach;

$jon=json_encode($array);

$jsoen=str_replace('\/', '/', $jon);

$json=str_replace('"src"', 'src', $jsoen);



echo $json;


 $filename=fopen('assets/script.js', "w");

 $content='const slider = document.querySelector(".slider");
 const btnLeft = document.getElementById("moveLeft");
 const btnRight = document.getElementById("moveRight");
 const indicators = document.querySelectorAll(".indicator");
 
 let baseSliderWidth = slider.offsetWidth;
 let activeIndex = 0;
 let movies ='.$json.';function populateSlider() {
    movies.forEach((image) => {
      // Clone the initial movie thats included in the html, then replace the image with a different one
      const newMovie = document.getElementById("movie0");
      let clone = newMovie.cloneNode(true);
      let img = clone.querySelector("img");
      img.src = image.src;
  
      slider.insertBefore(clone, slider.childNodes[slider.childNodes.length - 1]);
    });
  }
  
  populateSlider();
  populateSlider();
  

  
 
  function updateIndicators(index) {
    indicators.forEach((indicator) => {
      indicator.classList.remove("active");
    });
    let newActiveIndicator = indicators[index];
    newActiveIndicator.classList.add("active");
  }
  
  // Scroll Left button
  btnLeft.addEventListener("click", (e) => {
    let movieWidth = document.querySelector(".movie").getBoundingClientRect()
      .width;
    let scrollDistance = movieWidth * 6; // Scroll the length of 6 movies. TODO: make work for mobile because (4 movies/page instead of 6)
  
    slider.scrollBy({
      top: 0,
      left: -scrollDistance,
      behavior: "smooth",
    });
    activeIndex = (activeIndex - 1) % 3;
    console.log(activeIndex);
    updateIndicators(activeIndex);
  });
  
 
  btnRight.addEventListener("click", (e) => {
    let movieWidth = document.querySelector(".movie").getBoundingClientRect()
      .width;
    let scrollDistance = movieWidth * 6;
    console.log(`movieWidth = ${movieWidth}`);
    console.log(`scrolling right ${scrollDistance}`);
  
  
    if (activeIndex == 2) {
    
      populateSlider();
      slider.scrollBy({
        top: 0,
        left: +scrollDistance,
        behavior: "smooth",
      });
      activeIndex = 0;
      updateIndicators(activeIndex);
    } else {
      slider.scrollBy({
        top: 0,
        left: +scrollDistance,
        behavior: "smooth",
      });
      activeIndex = (activeIndex + 1) % 3;
      console.log(activeIndex);
      updateIndicators(activeIndex);
    }
  });';

 fwrite($filename, $content)

?>



