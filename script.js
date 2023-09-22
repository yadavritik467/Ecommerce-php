const header = document.querySelector('header');
function fixedNavbar(){
    header.classList.toggle('scrolled',window.scrollY > 0)
}

fixedNavbar();
window.addEventListener('scroll',fixedNavbar);

// menu button

let menu = document.querySelector('#menu-btn');
let userBtn = document.querySelector('#user-btn');

menu.addEventListener('click',function(){
    let nav = document.querySelector('.navbar');
   nav.classList.toggle('active');
//    console.log(toggle);

});


userBtn.addEventListener('click',function(){
    let userBox = document.querySelector('.user-box');
   userBox.classList.toggle('active');
//    console.log(toggle);

})



// // for open update modal

// const openBtn = document.querySelector('#open-form');
// // console.log(openBtn, "it's working")

// openBtn.addEventListener('click', () => {
//     document.querySelector('.update-container').style.display = 'flex';
// });
// // for close update modal

// const closeBtn = document.querySelector('#close-form');
// // console.log(closeBtn, "it's working")

// closeBtn.addEventListener('click', () => {
//     document.querySelector('.update-container').style.display = 'none';
// });


// for image slider

document.addEventListener("DOMContentLoaded", function () {
    const slider = document.querySelector(".hero-slider");
    const sliderItems = document.querySelectorAll(".slider-item");
    // console.log(sliderItems.length);
    const prevBtn = document.querySelector(".prev");
    const nextBtn = document.querySelector(".next");
    let currentIndex = 0;

    function showSlide(index) {
        // console.log(index);
        sliderItems.forEach((item, i) => {
            // console.log(item,i,index)
            if (i === index) {
                item.classList.add("show-carousel");
                // console.log("class added")
            } 
            else {
                item.classList.remove("show-carousel");
                // console.log("class removed")
            }
        });
    }

    function nextSlide() {
        console.log('click')
        currentIndex = (currentIndex + 1) % sliderItems.length;
        console.log('click',currentIndex)
        
        showSlide(currentIndex);
    }

    function prevSlide() {
        currentIndex = (currentIndex - 1 +sliderItems.length ) % sliderItems.length;
        showSlide(currentIndex);
    }

    // Show the initial slide
    showSlide(currentIndex);

    // Event listeners for next and previous buttons
    nextBtn.addEventListener("click", nextSlide);
    prevBtn.addEventListener("click", prevSlide);
});



// for testimonial slider

document.addEventListener("DOMContentLoaded", function () {
    const slider = document.querySelector(".testimonial-slider");
    const sliderItems = document.querySelectorAll(".testimonial-item-hide");
    console.log(sliderItems.length);
    const prevBtn = document.querySelector(".prev1");
    const nextBtn = document.querySelector(".next1");
    let currentTestimonialIndex = 0;

    function showSlide(index) {
        // console.log(index);
        sliderItems.forEach((item, i) => {
            // console.log(item,i,index)
            if (i === index) {
                item.classList.replace("testimonial-item-hide","testimonial-item");
                // console.log("class added")
            } 
            else {
                item.classList.replace("testimonial-item","testimonial-item-hide");
                // console.log("class removed")
            }
        });
    }

    function nextSlide() {
        // console.log('click')
        currentTestimonialIndex = (currentTestimonialIndex + 1) % sliderItems.length;
        console.log('click',currentTestimonialIndex)
        
        showSlide(currentTestimonialIndex);
    }

    function prevSlide() {
        currentTestimonialIndex = (currentTestimonialIndex - 1 +sliderItems.length ) % sliderItems.length;
        showSlide(currentTestimonialIndex);
    }

    // Show the initial slide
    showSlide(currentTestimonialIndex);

    // Event listeners for next and previous buttons
    nextBtn.addEventListener("click", nextSlide);
    prevBtn.addEventListener("click", prevSlide);
});

