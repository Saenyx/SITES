const slider = document.querySelector(".slider");
 const btnLeft = document.getElementById("moveLeft");
 const btnRight = document.getElementById("moveRight");
 const indicators = document.querySelectorAll(".indicator");
 
 let baseSliderWidth = slider.offsetWidth;
 let activeIndex = 0;
 let movies =[{src:"/01-Cours/Site/upload/picture/240220221825326217bf8c81e70ALIVE.jpg"},{src:"/01-Cours/Site/upload/picture/2402202211083962175927bbba2AlteredCover.jpg"},{src:"/01-Cours/Site/upload/picture/240220221753056217b7f1f0c57TheWITCHER.jpg"},{src:"/01-Cours/Site/upload/picture/240220221820266217be5acb44aBAKI.jpg"},{src:"/01-Cours/Site/upload/picture/240220221821116217be876d0daALLOFUS.jpg"},{src:"/01-Cours/Site/upload/picture/240220221824386217bf56c6889ARCANE.jpg"}];function populateSlider() {
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
  });