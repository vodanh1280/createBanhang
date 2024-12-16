$('.hero-slider').slick({
    autoplay: true,
    infinite: false,
    speed: 200,
    nextArrow: $('.next'),
    prevArrow: $('.prev'),
})

$('.con').slick({
    autoplay: true,
    lazyLoad: 'ondeman',
    slidesToShow: 3,
    slideToScrool: 1,
    nextArrow: $('.left'),
    prevArrow: $('.right'),
    responsive: [
        {
            breakpoint: 1024,
            settings: {
                slidesToShow: 2,
                slideToScrool: 1,
                infinite: true,
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 2,
                slideToScrool: 1,
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slideToScrool: 1,
            }
        },
    ]
})


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



(function () {
    const second = 1000,
            minute = second * 60,
            hours = minute * 60,
            days = hours * 24;
    let today = new Date(),
        dd = String(today.getDate()).padStart(2, "0"),
        mm = String(today.getMonth() + 1).padStart(2, "0"),
        yyyy = today.getFullYear(),
        nextYear = yyyy + 1,
        dayMonth = "03/24/",
        birthday = dayMonth + yyyy;

        today = mm + "/" + dd + "/" + yyyy;
        if (today > birthday) {
            birthday = dayMonth + nextYear;
        }

        const countDown = new Date(birthday).getTime(),
                x = setInterval(function() {
                    const now = new Date().getTime(),
                        distance = countDown - now;
                    document.getElementById("days").innerText = Math.floor(distance / (days)),
                    document.getElementById("hours").innerText = Math.floor((distance % (days)) / (hours)),
                    document.getElementById("minutes").innerText = Math.floor((distance % (hours)) / (minute)),
                    document.getElementById("seconds").innerText = Math.floor((distance % (minute)) / (second))

                    if(distance < 0) {
                        clearInterval(x);
                    }
                }, 0)
}())