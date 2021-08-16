function loginInfoSendRequest() {
    var data = new Object();

    data.type = "login";
    data.email = $('.input-email').val();
    data.password = $('.input-password').val();

    var jsonData = JSON.stringify(data);

    console.log(jsonData);
    $.ajax({
        type: "POST",
        url: "../../core/req/",
        dataType: "JSON",
        data: jsonData,
        success: function (data, status, xhr) {
            console.log("response data : ")
            console.log(data);
            setCookie('dogoodhackaton7', data.token, 365)
            setCookie('dogoodhackaton7-user_type', data.user_type, 365)
            location.replace("./")
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(jqXHR.responseText);
            alert("에러 발생\n" + jqXHR.responseText);
        }
    });
}

window.onload = function () {

}