$('form').on('submit', function (e) {
    e.preventDefault();

    if (validate()) {
        send();
    }
    return false;
})


function send() {
    console.log("SENDING");
    $.ajax({
        type: "GET",
        url: "../src/php/index.php",
        dataType: "html",
        data: "x=" + controller.xValue +
            "&y=" + controller.yValue +
            "&r=" + controller.rValue,
        beforeSend: function () {
            $('submit').disabled = true;
        },
        success: function (data) {
            $('submit').disabled = false;
            addRow(data);
        },
    });
}