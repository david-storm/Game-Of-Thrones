const rexExpEmail = /[\w\.-_]+@[\w]+\.[A-Za-z]{2,3}$/; 
const rexExpPassword = /.{8,}$/
const inputEmail = document.getElementById("email");
const inputPassword = document.getElementById("password");
const inputLogin = document.getElementById("login");

inputEmail.addEventListener("blur", ()  => {
    const input = inputEmail.value;
    if(!rexExpEmail.test(input)){
        inputEmail.nextElementSibling.style.border="red 1px solid";
    } 
    inputEmail.addEventListener("keyup", ()  => {
        const input = inputEmail.value;
        if(!rexExpEmail.test(input)){
            inputEmail.nextElementSibling.style.border="red 1px solid";
        } else{
            inputEmail.nextElementSibling.style.border="";
        }
    });
});

inputEmail.addEventListener("blur", ()  => {
    const input = inputEmail.value;
    if(!rexExpEmail.test(input)){
        inputEmail.nextElementSibling.style.border="red 1px solid";
    } 
    inputEmail.addEventListener("keyup", ()  => {
        const input = inputEmail.value;
        if(!rexExpEmail.test(input)){
            inputEmail.nextElementSibling.style.border="red 1px solid";
        } else{
            inputEmail.nextElementSibling.style.border="";
        }
    });
});

