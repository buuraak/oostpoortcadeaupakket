require('./bootstrap');
require('./vueComponentRegistration');

const succes = document.getElementById('succesMessage');

function fade(element) {
    let op = 1;  // initial opacity
    let timer = setInterval(function () {
        if (op <= 0.1){
            clearInterval(timer);
            element.style.display = 'none';
        }
        element.style.opacity = op;
        element.style.filter = 'alpha(opacity=' + op * 100 + ")";
        op -= op * 0.1;
    }, 50);
}


if(succes) {
    setTimeout(function () {
        fade(succes)
    }, 6000)
}

