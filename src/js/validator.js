
class InputController {
    xValue = document.getElementById("x_value").value;
    yValue = document.getElementById("y_value").value;
    rValue = $('input:checkbox:checked').val();

}
let controller;

function validate() {
    controller = new InputController();
    let xV = controller.xValue;
    let yV = controller.yValue;
    let rV = controller.rValue;
    if (isNaN(parseFloat(xV)) || !(-2 <= parseFloat(xV) && parseFloat(xV) <= 2)) {
        alert("Пожалуйста, выберите целое число в промежутке [-2;2] в качестве параметра X!");
        return false;
    } else if (isNaN(parseFloat(yV)) || !(-3 <= parseFloat(yV) && parseFloat(yV) <= 5)) {
        alert("Пожалуйста, введите целое число в промежутке [-3;5] в качестве параметра Y!");
        return false;
    } else if (isNaN(parseFloat(rV)) || !(1 <= parseFloat(rV) && parseFloat(rV) <= 3)) {
        alert("Пожалуйста, введите целое число в промежутке [1;3] в качестве параметра R!");
        return false;
    }
    return true;

}

function validateY() {
    let yValue = document.getElementById("y_value");
    if (isNaN(parseFloat(yValue.value)) || !(/^([-+]?\d*\.?\d+)(?:[e]([-+]?\d+))?$/.test(yValue.value)))
        yValue.value = '';
}