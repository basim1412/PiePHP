const slide = ["/PiePHP/webroot/assets/cinema.jpg", "/PiePHP/webroot/assets/cinema2.jpg", "/PiePHP/webroot/assets/cinema3.jpg", "/PiePHP/webroot/assets/cinema4.jpg"];
let numero = 0;

function ChangeSlide(sens) {
    numero = numero + sens;
    if (numero < 0)
        numero = slide.length - 1;
    if (numero > slide.length - 1)
        numero = 0;
    document.getElementById("slide").src = slide[numero];
}
setInterval("ChangeSlide(1)", 4000);