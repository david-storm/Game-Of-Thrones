const rexExpEmail = /[\w\.-_]+@[\w]+\.[A-Za-z]{2,3}$/; 
const rexExpPassword = /.{8,}$/;
const rexExpNameAndHobbi = /[\w,\.-_]{3,}$/;
const rexExpHouse = /[12]$/;
const inputEmail = document.getElementById("email");
const inputPassword = document.getElementById("password");
const formFirst = document.getElementById("formFirst");
const formSecond = document.getElementById("formSecond");
const inputName = document.getElementById("name");
const inputHouse = document.getElementById("house");
const inputHobbi = document.getElementById("hobbi");

//function for field validation
function validField(selector, regExp, event="keyup"){
    selector.addEventListener("blur", ()  => {
        const value = selector.value;
        if(!regExp.test(value)){
            selector.nextElementSibling.classList.add("error");  
        } 
        selector.addEventListener(event, ()  => {
            const value = selector.value;
            if(!regExp.test(value)){
                selector.nextElementSibling.classList.add("error");         
            } else{
                selector.nextElementSibling.classList.remove("error");   
            }
        });
        
    });
    if(regExp.test(selector.value)){
        return true;
    }
}

//call function to assign handler
validField(inputEmail, rexExpEmail);
validField(inputPassword,rexExpPassword);
let message = false;

formFirst.addEventListener("submit" ,() =>{
   
    //call the function to get the validation result
    if(validField(inputEmail, rexExpEmail) === true && 
        validField(inputPassword,rexExpPassword) === true){
        formFirst.classList.add("formHide");
        formSecond.classList.remove("formHide");
        message = false;
    } else {
        if(!message){
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
validField(inputHouse, rexExpHouse, "change");
validField(inputHobbi, rexExpNameAndHobbi);

formSecond.addEventListener("submit" ,() =>{
   event.preventDefault();
    //call the function to get the validation result
    if(validField(inputName, rexExpNameAndHobbi) === true && 
    validField(inputHouse, rexExpHouse, "change") === true &&
    validField(inputHobbi, rexExpNameAndHobbi) === true){
        alert("The form is filled perfectly");
    }else {
        if(!message){
            message = document.createElement('label');
            message.innerHTML = "Please fill in all fields correctly";
            message.classList.add("errorLogin");
            document.getElementById("save").after(message);
        }
    }
});