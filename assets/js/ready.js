let initialSlide = 0;
let lastSlide = 0;
let startX;
let endX;

__openMenu = (elm) =>{
  let icon = elm.getElementsByTagName('i');
  icon[0].classList.toggle('fa-bars');
  icon[0].classList.toggle('fa-times');

  let navigation = document.getElementsByClassName('main-nav');
  navigation[0].classList.toggle('activeNav');
}

__cleanDots = function () {
  let dotsList = document.querySelectorAll('.dotsSlider > button');

  for (let i = 0; i < dotsList.length; i++) {
    dotsList[i].classList.remove('activeDot');
  }
}

_sliderHome = () =>{
  let sliderHome = document.getElementsByClassName('sliderHome')[0];
  let wrappItemsSlider = sliderHome.getElementsByClassName('wrappItemsSlider')[0];
  let itemsSlider = sliderHome.querySelectorAll('.wrappItemsSlider > .itemSlider');
  
  let anchoSliderWrapp = parseInt(itemsSlider.length) * 100;
  wrappItemsSlider.style.width = anchoSliderWrapp+'vw';

  let dotsSlider = document.getElementsByClassName('dotsSlider')[0];
  lastSlide = parseInt(itemsSlider.length) - 1;
  for (let i = 0; i < itemsSlider.length; i++) {
    let dotSlider = document.createElement('button');
    dotSlider.classList.add('dot');
    dotSlider.setAttribute('onclick', '_toSlide(this, '+i+')');
    if(i === 0){
      dotSlider.classList.add('activeDot');
    }
    dotsSlider.appendChild(dotSlider);
  }
}

_toSlide = (elm, number) =>{
  __cleanDots();
  elm.classList.add('activeDot');
  let contentSlider = document.getElementsByClassName('wrappItemsSlider');
  initialSlide = parseInt(number);
  let slideTo = parseInt(number) * -100;
  contentSlider[0].style.transform = 'translateX(' + slideTo +'vw)';

  // if (number == 0){
  //   document.getElementsByClassName('slideArrowLeft')[0].style.display = 'none';
  // }
  // else{
  //   document.getElementsByClassName('slideArrowLeft')[0].style.display = 'block';
  // }

  // if (number == lastSlide){
  //   document.getElementsByClassName('slideArrowRight')[0].style.display = 'none';
  // }
  // else{
  //   document.getElementsByClassName('slideArrowRight')[0].style.display = 'block';
  // }
}

_prevSlide = () => {
  let dotsActive = document.querySelectorAll('.dotsSlider > button');
  initialSlide = parseInt(initialSlide) - 1;
  let elm = dotsActive[initialSlide];
  _toSlide(elm, initialSlide);
}

_nextSlide = () => {
  let dotsActive = document.querySelectorAll('.dotsSlider > button');
  initialSlide = parseInt(initialSlide) + 1
  let elm = dotsActive[initialSlide];
  _toSlide(elm, initialSlide);
}

_handleTouch = (start, end, cbL, cbR) =>  {
  if (end - start < 0) {
    cbL();
  } else if (end - start > 0) {
    cbR();
  }
}

let left = () => {
  if (initialSlide != lastSlide) {
    _nextSlide();
  }
}
let right = () => {
  if (initialSlide != 0) {
    _prevSlide();
  }
}

let searchSliderHome = setInterval(() => {
  let wrappSlide = document.getElementsByClassName('sliderHome')[0];

  if (wrappSlide !== undefined || wrappSlide !== null){
    clearInterval(searchSliderHome);
    wrappSlide.ontouchstart = (event) =>{
      startX = event.touches[0].clientX;
    }

    wrappSlide.ontouchend = (event) => {
      endX = event.changedTouches[0].clientX;
      _handleTouch(startX, endX, left, right);
    }
  }
  
}, 400);

window.onload = () => {
  _sliderHome();
}