const userBtn = document.querySelector('#user-btn');
userBtn.addEventListener('click', function(){
    const userBox = document.querySelector('.profile');
    userBox.classList.toggle('active');
})

const searchForm = document.querySelector('.header .flex .search-form');

document.querySelector('#search-btn').onclick = () => {
    searchForm.classList.toggle('active');
    profile.classList.remove('active');
}

const toggle = document.querySelector('#menu-btn');
toggle.addEventListener('click', function() {
    const navbar = document.querySelector('.navbar');
    navbar.classList.toggle('active');
})

let thumbnails = document.getElementsByClassName('Slider-thumbnail');
let activeImages = document.getElementsByClassName('active');

for (let i = 0; i < thumbnails.length; i++) {
    thumbnails[i].addEventListener('click', function(e){
        e.preventDefault()
        if(activeImages.length > 0) {
            activeImages[0].classList.remove('active');
        }
        this.classList.add('active');
        document.getElementById('featuredImage').src = this.href;
    })
    
}