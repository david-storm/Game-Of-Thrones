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
    "Arryn of the Eyrie": 0,
    "Baratheon of Storm's End": 1,
    "Greyjoy of Pyke": 2,
    "Lannister of Casterly Rock": 3,
    "Martell of Sunspear": 4,
    "Stark of Winterfell": 5,
    "Targaryen of King's Landing": 6,
    "Tully of Riverrun": 7,
    "Tyrell of Highgarden": 8
};


if ($('#house')) {
    $('#house').niceSelect();
    const changeSlaider = () => {
        let house = $(".current").html();
        if (house === "Select House") {
            $('.slaider').slick('slickPlay');
        } else {
            let index = allHouses[house];
            $('.slaider').slick('slickPause');
            $('.slaider').slick('slickGoTo', index);
        }
    };
    $('#house').change(changeSlaider);

    let idHouse = $('#house').attr('value');
    if (idHouse) {
        idHouse--;
        for (house in allHouses) {
            if (allHouses[house] == idHouse) {
                $(".current").html(house);
            }
        }
        changeSlaider();
    }
}

if ($('#formSecond')) {
    $('#formSecond').submit(event => {
        event.preventDefault();
        $.ajax({
            method: "POST",
            url: "index.php",
            data: {house: $('#house').val(), name: $('#name').val(), hobbi: $('#hobbi').val(), submit: $('#save').val()}
        })
                .done(jsonMessages => {
                    $('.wrongField').html('');
                    let messages = JSON.parse(jsonMessages);
                    for (index in messages) {
                        $(`#${index}+.wrongField`).html(messages[index]);
                    }
                });
    });
}
