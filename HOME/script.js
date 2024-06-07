// slidshow
let slideIndex = 0;
showSlides();
function showSlides() {
    let slides = document.querySelectorAll('.slid');
    for (let i=0; i < slides.length; i++) {
    slides[i].style.display = 'none';}
    
    slideIndex++;
    if (slideIndex > slides.length) {
    slideIndex =1;
    }
    slides [slideIndex - 1].style.display= 'block';
    setTimeout(showSlides, 2000);
}

// animation work when scrolled
document.addEventListener( 'DOMContentLoaded', function() {
    const animatedSections = document.querySelectorAll('.animate');
    const observer = new IntersectionObserver ((entries, observer) => {
    entries.forEach(entry => {
    if (entry.isIntersecting) {
    entry.target.style.animationPlayState ='running' ;
    observer.unobserve (entry.target);}
    });
    }, {
    threshold: 0.5
    });
    animatedSections.forEach(section => {
    observer.observe(section);
    });
});

// gallery_animation
document.addEventListener('DOMContentLoaded', () => {
    const images = document.querySelectorAll('.gallery img');
    
    images.forEach((image, index) => {
        image.addEventListener('mouseover', () => {
            images.forEach((img, i) => {
                if (i !== index) {
                    img.style.opacity = '0.3';
                }
            });
        });
        
        image.addEventListener('mouseout', () => {
            images.forEach(img => {
                img.style.opacity = '1';
            });
        });
    });
});
