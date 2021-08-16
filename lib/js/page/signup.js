function signUpInfoSendRequest() {
    var data = new Object();

    data.type = "signup";
    data.email = $('.input-email').val();
    data.password = $('.input-password').val();

    if (data.password != $('.input-password2').val()) {
        alert("비밀번호가 맞지 않습니다.");
        return;
    }

    var jsonData = JSON.stringify(data);
    console.log(jsonData);

    $.ajax({
        type: "POST",
        crossOrigin: true,
        url: "../../core/req/",
        dataType: "JSON",
        data: jsonData,
        success: function (data, status, xhr) {
            console.log("response data : ")
            console.log(data);
            alert("회원가입에 성공하셨습니다.")
            setCookie('dogoodhackaton7', data.token, 365)
            location.replace("./check")
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(jqXHR);
            alert("에러 발생\n" + jqXHR.responseText);
        }
    });
}

window.onload = function () {

}