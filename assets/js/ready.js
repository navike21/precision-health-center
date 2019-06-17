openMenu = (elm) =>{
  let icon = elm.getElementsByTagName('i');
  icon[0].classList.toggle('fa-bars');
  icon[0].classList.toggle('fa-times');

  let navigation = document.getElementsByClassName('main-nav');
  navigation[0].classList.toggle('activeNav');
}

sliderHome = () =>{
  var sliderHome = document.getElementsByClassName('sliderHome')[0];
  var wrappItemsSlider = sliderHome.getElementsByClassName('wrappItemsSlider')[0];
  var itemsSlider = sliderHome.querySelectorAll('.wrappItemsSlider > .itemSlider');
  
  var anchoSliderWrapp = parseInt(itemsSlider.length) * 100;
  wrappItemsSlider.style.width = anchoSliderWrapp+'vw';

  var dotsSlider = document.getElementsByClassName('dotsSlider')[0];
  for (let i = 0; i < itemsSlider.length; i++) {
    var dotSlider = document.createElement('button');
    dotSlider.classList.add('dot');
    if(i === 0){
      dotSlider.classList.add('activeDot');
    }
    dotsSlider.appendChild(dotSlider);
  }
}

window.onload = ()=>{
  sliderHome();
}