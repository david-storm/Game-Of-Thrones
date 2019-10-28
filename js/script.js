const rexExpEmail = /[\w\.-_]+@[\w]+\.[A-Za-z]{2,3}$/;
const rexExpPassword = /.{8,}$/;
const rexExpNameAndHobbi = /[\w,\.-_]{3,}$/;
const inputEmail = document.getElementById("email");
const inputPassword = document.getElementById("password");
const formFirst = document.getElementById("formFirst");
const formSecond = document.getElementById("formSecond");
const inputName = document.getElementById("name");
const inputHouse = document.getElementById("house");
const inputHobbi = document.getElementById("hobbi");


//function for field validation
function validField(selector, regExp, event = "keyup") {
    selector.addEventListener("blur", () => {
        const value = selector.value;
        if (!regExp.test(value)) {
            selector.nextElementSibling.classList.add("error");
        }
        selector.addEventListener(event, () => {
            const value = selector.value;
            if (!regExp.test(value)) {
                selector.nextElementSibling.classList.add("error");
            } else {
                selector.nextElementSibling.classList.remove("error");
            }
        });

    });
    if (regExp.test(selector.value)) {
        return true;
    }
}

//call function to assign handler
validField(inputEmail, rexExpEmail);
validField(inputPassword, rexExpPassword);
let message = false;

formFirst.addEventListener("submit", (event) => {

    //call the function to get the validation result
    if (validField(inputEmail, rexExpEmail) === true &&
        validField(inputPassword, rexExpPassword) === true) {
        formFirst.classList.add("formHide");
        formSecond.classList.remove("formHide");
        message = false;
    } else {
        if (!message) {
            message = document.createElement('label');
            message.innerHTML = "Please fill in all fields correctly";
            message.classList.add("errorLogin");
            document.getElementById("login").after(message);
        }
    }
    event.preventDefault();
});

//call function to assign handler
validField(inputName, rexExpNameAndHobbi);
validField(inputHobbi, rexExpNameAndHobbi);

formSecond.addEventListener("submit", (event) => {
    event.preventDefault();
    //call the function to get the validation result
    if (validField(inputName, rexExpNameAndHobbi) &&
        validField(inputHouse, rexExpHouse, "change") &&
        validField(inputHobbi, rexExpNameAndHobbi)) {
        alert("The form is filled perfectly");
    } else {
        if (!message) {
            message = document.createElement('label');
            message.innerHTML = "Please fill in all fields correctly";
            message.classList.add("errorLogin");
            document.getElementById("save").after(message);
        }
    }
});

$('.slaider').slick({
    draggable: false,
    dots: false,
    infinite: true,
    arrows: false,
    autoplay: true,
    autoplaySpeed: 3000,
    waitForAnimate: false,
});

$('#house').niceSelect();

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

$('#house').change(() => {
        let house = $(".current").html();
    if (house === "Select House") {
        $('.slaider').slick('slickPlay');
        $('#house').next().next().addClass("error");
    } else {
        $('#house').next().next().removeClass("error");
        let index = allHouses[house];
        $('.slaider').slick('slickPause');
        $('.slaider').slick('slickGoTo', index);
    }
});
