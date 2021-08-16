function getReservationList() {
    var data = new Object();

    data.type = "reservationList";

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

            for (var i = 0; i < data.length; i++) {
                var gym = data[i].gym;
                
                if (getCookie("dogoodhackaton7-user_type") == "gym") {
                    var state = ""
                    var isHidden = ""
                    switch(data[i].state) {
                        case "inquiry":
                            state = "예약대기"
                            break;
                        case "confirm":
                            state = "예약확정"
                            isHidden = "hidden"
                            break;
                        case "rejection":
                            state = "예약취소"
                            isHidden = "hidden"
                            break;
                    }
                    var html = "<div class=\"w-full border border-gray-300 p-3 rounded overflow-hidden shadow-lg\"" +
                        // "<img class=\"w-full\" src=\"../lib/img/facil_2_1.jpg\" alt=\"Mountain\">" +
                        "<div class=\"px-4 py-4\">" +
                            "<div class=\"flex flex-wrap -mx-3 mb-4\">" +
                                "<div class=\"w-full md:w-2/3 px-3 md:mb-0\">" +
                                    "<div class=\"font-bold text-xl mb-2\">" + data[i].client_name + " 님 <span class=\"font-normal text-sm\">("+data[i].phone_num+")</span></div>" +
                                "</div>" +
                                "<div class=\"w-full md:w-1/3 px-3 md:mb-0 justify-end\" "+isHidden+">" +
                                    "<div class=\"inline-flex ml-20\">" +
                                        "<button onclick=\"reservationConfirm("+data[i].id+",'rejection')\" class=\"inline-flex items-center h-10 px-4 text-white transition-colors duration-150 bg-red-700 rounded-l-lg focus:shadow-outline hover:bg-red-800\">" + 
                                            "<i class=\"fas fa-times\"></i>" + 
                                        "</button>" + 
                                        "<button onclick=\"reservationConfirm("+data[i].id+",'confirm')\" class=\"inline-flex items-center h-10 px-3 text-white transition-colors duration-150 bg-blue-700 rounded-r-lg focus:shadow-outline hover:bg-blue-800\">" + 
                                            "<i class=\"fas fa-check\"></i>" + 
                                        "</button>" + 
                                    "</div>" + 
                                "</div>" +
                            "</div>" +
                            "<p class=\"text-gray-700 text-base\">" +
                                "예약상태 : " + state +
                        "</div></p>" +
                        "</div>" +
                    "</div>";
                    $('.gym-grid').append(html);
                } else {
                    var state = ""
                    switch(data[i].state) {
                        case "inquiry":
                            state = "예약대기"
                            break;
                        case "confirm":
                            state = "예약확정"
                            break;
                        case "rejection":
                            state = "예약취소"
                            break;
                    }
                    var html = "<div class=\"w-full border border-gray-300 p-3 rounded overflow-hidden shadow-lg cursor-pointer\"" +
                        // "<img class=\"w-full\" src=\"../lib/img/facil_2_1.jpg\" alt=\"Mountain\">" +
                        "<div class=\"px-4 py-4\">" +
                            "<div class=\"font-bold text-xl mb-2\">" + gym.gym_name + "</div>" +
                            "<p class=\"text-gray-700 text-base\">" +
                                "예약상태 : " + state;
                    if (data[i].state == "rejection") {
                        html += "<br>취소사유 : " + data[i].reason
                    }
                    html += "</p>" +
                        "</div>" +
                    "</div>";
                    $('.gym-grid').append(html);
                }
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(jqXHR.responseText);
            alert("에러 발생\n" + jqXHR);
        }
    });
}

var closemodal = document.querySelectorAll('.modal-close')
for (var i = 0; i < closemodal.length; i++) {
    closemodal[i].addEventListener('click', toggleModal)
}

var submitmodal = document.querySelectorAll('.modal-submit')
for (var i = 0; i < submitmodal.length; i++) {
    submitmodal[i].addEventListener('click', reservationAction)
}

document.onkeydown = function (evt) {
    evt = evt || window.event
    var isEscape = false
    if ("key" in evt) {
        isEscape = (evt.key === "Escape" || evt.key === "Esc")
    } else {
        isEscape = (evt.keyCode === 27)
    }

    if (isEscape && document.body.classList.contains('modal-active')) {
        toggleModal()
    }
};

function toggleModal() {
    const body = document.querySelector('body')
    const modal = document.querySelector('.modal')
    modal.classList.toggle('opacity-0')
    modal.classList.toggle('pointer-events-none')
    body.classList.toggle('modal-active')
}

var _reservation_id, _state;
function reservationConfirm(reservation_id, state) {
    _reservation_id = reservation_id;
    _state = state;
    if (state == "rejection") {
        $('.modal-input-cancelreason').val('')
        toggleModal()
    } else {
        reservationAction()
    }
}

function reservationAction() {
    var reason = ""
    if (_state == "rejection") {
        reason = $('.modal-input-cancelreason').val()
    }

    var data = new Object();

    data.type = "reservationConfirm";
    data.reservation_id = _reservation_id;
    data.state = _state;
    data.reason = reason;

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
            if (data.detail == "success") {
                alert("요청 성공.")
                location.reload()
            } else {
                alert("예약 실패\n" + data)
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(jqXHR.responseText);
            alert("에러 발생\n" + jqXHR.responseText);
        }
    });
}

window.onload = function() {
    getReservationList();
}