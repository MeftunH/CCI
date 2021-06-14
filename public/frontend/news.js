const swiper = new Swiper('.swiper-container', {
  // Optional parameters
  // direction: 'vertical',
  loop: true,
  autoplay: true,
  slidesPerView: 3,
  spaceBetween: 0,

  breakpoints : {
    320: {
      slidesPerView: 1,
      spaceBetween: 0
    },
    480: {
      slidesPerView: 2,
      spaceBetween: 0,
    },
    768:{
      slidesPerView: 3,
      spaceBetween: 0,
    }
  },

  // If we need pagination
  pagination: {
    el: '.swiper-pagination',
    type: 'bullets'
  },
  navigation: true,

  // Navigation arrows
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev'
  },
  scrollbar: {
    el: '.swiper-scrollbar',
  },
});


// const swiper1 = document.getElementById('')
const swiper1 = new Swiper('#swiper_container', {
  // Optional parameters
  // direction: 'vertical',
  loop: true,
  autoplay: true,
  slidesPerView: 1,
  spaceBetween: 0,

  breakpoints : {
    320: {
      slidesPerView: 1,
      spaceBetween: 0
    },
    480: {
      slidesPerView: 1,
      spaceBetween: 0,
    },
    768:{
      slidesPerView: 1,
      spaceBetween: 0,
    }
  },

  // If we need pagination
  pagination: {
    el: '.swiper-pagination',
    type: 'bullets'
  },
  navigation: true,

  // Navigation arrows
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev'
  },
  scrollbar: {
    el: '.swiper-scrollbar',
  },
});

const MenuIcon = document.querySelector('.hamburger-menu') 
const list = document.querySelector('.navbar')
const body = document.querySelector('body')
// const overlay = document.querySelector('.overlay')

MenuIcon.addEventListener('click', ()=>{
    list.classList.toggle('change')
})



window.addEventListener('scroll', function(){
  var header = document.querySelector('.header_nav')

  var burger = document.querySelector('.hamburger-menu ')
  if(window.scrollY>5){
      var img1 = document.querySelector('.logo_img')
      header.classList.add('header_fixed')
      burger.style.display = "none"
  }

  if (window.scrollY<10){
      var img1 = document.querySelector('.logo_img')
      header.classList.remove('header_fixed')
      img1.style.display = "block"
  }
})