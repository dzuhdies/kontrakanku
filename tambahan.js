let slideIndex = 0;
let slides = document.getElementsByClassName("mySlides");

function showSlides() {
    for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
        slides[i].classList.remove("fade");
    }
    slideIndex++;
    if (slideIndex > slides.length) { slideIndex = 1 }
    slides[slideIndex - 1].style.display = "block";
    slides[slideIndex - 1].classList.add("fade");
    setTimeout(showSlides, 3000); // Change image every 3 seconds
}

showSlides();

function plusSlides(n) {
    showSlides(slideIndex += n);
}

document.querySelector('.prev').addEventListener('click', function() {
    plusSlides(-1);
});

document.querySelector('.next').addEventListener('click', function() {
    plusSlides(1);
});