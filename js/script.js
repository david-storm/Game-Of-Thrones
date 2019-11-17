const rexExpEmail = /[\w\.-_]+@[\w]+\.[A-Za-z]{2,3}$/;
const rexExpPassword = /.{8,}$/;
const rexExpNameAndHobbi = /[\w,\.-_]{3,}$/;
const inputEmail = document.getElementById("email");
const inputPassword = document.getElementById("password");


$('.slaider').slick({
    draggable: true,
    dots: false,
    infinite: true,
    arrows: false,
    autoplay: true,
    autoplaySpeed: 3000,
    waitForAnimate: false
});

const allHouses = {
    "Lannister of Casterly Rock": 0,
    "Greyjoy of Pyke": 1,
    "Arryn of the Eyrie": 2,
    "Baratheon of Storm's End": 3,
    "Martell of Sunspear": 4,
    "Stark of Winterfell": 5,
    "Targaryen of King's Landing": 6,
    "Tully of Riverrun": 7,
    "Tyrell of Highgarden": 8
};

if ($('#house')) {
    $('#house').niceSelect();

    $('#house').change(() => {
        let house = $(".current").html();
        if (house === "Select House") {
            $('.slaider').slick('slickPlay');
        } else {
            let index = allHouses[house];
            $('.slaider').slick('slickPause');
            $('.slaider').slick('slickGoTo', index);
        }
    });
}