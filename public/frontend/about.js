const MenuIcon = document.querySelector('.hamburger-menu') 
const list = document.querySelector('.navbar')
const body = document.querySelector('body')
const overlay = document.querySelector('.overlay')

MenuIcon.addEventListener('click', ()=>{
    list.classList.toggle('change')
    // list.classList.toggle('overlay')
})

//286
//   window.addEventListener('scroll', function(){
//       console.log(window.scrollY)
//   })


// console.log(header_nav)

window.addEventListener('scroll', function(){
    var header = document.querySelector('.header_nav')
    // var img = document.querySelector('.logo-img')
 
    var burger = document.querySelector('.hamburger-menu ')
    if(window.scrollY>20){
        var img1 = document.querySelector('.logo_img')
        header.classList.add('header_fixed')
        img.style.display = "block"
        img.style.width = "37px"
        img.style.height = "100px"
        // img1.style.display = "none"
        burger.style.display = "none"
    }

    if (window.scrollY<286){
        var img = document.querySelector('.logo-img')
        var img1 = document.querySelector('.logo_img')
        var line = document.querySelector('line')
        header.classList.remove('header_fixed')
        // header.classList.add('header_top')
        // header.classList.remove('header_top')
        // line.style.color = "black"
        img1.style.display = "block"
        img.style.display = "none"

        // document.querySelector('.header_nav').style.backgroundColor = "transparent"
        // document.querySelector('.nav_link').style.color = "white"
        // document.querySelector('.nav_links').style.color = "white"
    }
})