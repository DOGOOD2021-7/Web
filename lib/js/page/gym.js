var gym_name = "";

function getGymInfo() {
    var data = new Object();

    data.type = "gym";
    data.id = getFindParameter("id");

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

            gym_name = data.gym_name;
            $('.gym-title').text(data.gym_name);
            $('.gym-address').text(data.address + " " + data.address_detail);
            $('.tabs-content-detail-price_desc').text('');
            $('.tabs-content-detail-price_desc').html("<img src=\"https://dogood7.s3.ap-northeast-2.amazonaws.com/"+data.price_desc+"\">")
            if (data.profile1.length > 10) {
                var url = "url('https://dogood7.s3.ap-northeast-2.amazonaws.com/"+data.profile1+"')";
                console.log(url)
                $('.slider-image-one').css("background-image", url)
            }
            if (data.profile2.length > 10) {
                var url = "url('https://dogood7.s3.ap-northeast-2.amazonaws.com/"+data.profile2+"')";
                console.log(url)
                $('.slider-image-two').css("background-image", url)
            }

            // 주소-좌표 변환 객체를 생성합니다
            var geocoder = new kakao.maps.services.Geocoder();

            // 주소로 좌표를 검색합니다
            geocoder.addressSearch(data.address, function (result, status) {

                // 정상적으로 검색이 완료됐으면 
                if (status === kakao.maps.services.Status.OK) {

                    var coords = new kakao.maps.LatLng(result[0].y, result[0].x);

                    // 결과값으로 받은 위치를 마커로 표시합니다
                    var marker = new kakao.maps.Marker({
                        map: map,
                        position: coords
                    });

                    // 인포윈도우로 장소에 대한 설명을 표시합니다
                    var infowindow = new kakao.maps.InfoWindow({
                        content: '<div style="width:150px;text-align:center;padding:6px 0;">' + data.gym_name + '</div>'
                    });
                    infowindow.open(map, marker);

                    // 지도의 중심을 결과값으로 받은 위치로 이동시킵니다
                    map.setCenter(coords);
                }
            });
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(jqXHR.responseText);
            alert("에러 발생\n" + jqXHR);
        }
    });
}

function tabsClick(type) {
    switch (type) {
        case 1: // 상세정보
            $(".tabs-content-reservation").hide();
            $(".tabs-content-detail").show();

            $("#tabs-tab-reservation").addClass("border-transparent");
            $("#tabs-tab-detail").removeClass("border-transparent");
            break;
        case 2: // 예약하기
            $(".tabs-content-reservation").show();
            $(".tabs-content-detail").hide();

            $("#tabs-tab-reservation").removeClass("border-transparent");
            $("#tabs-tab-detail").addClass("border-transparent");
            break;
    }
}

var openmodal = document.querySelectorAll('.modal-open')
for (var i = 0; i < openmodal.length; i++) {
    openmodal[i].addEventListener('click', function (event) {
        event.preventDefault()
        toggleModal()
    })
}

//const overlay = document.querySelector('.modal-overlay')
//overlay.addEventListener('click', toggleModal)

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

function reservationAction() {
    if ($('.modal-input-name').val().length < 1) {
        alert("이름을 입력하여 주세요.")
        return
    }
    if ($('.modal-input-phoneNumber').val().length < 6) {
        alert("휴대폰 번호를 입력하여 주세요.")
        return
    }

    var data = new Object();
    data.type = "reservationRequest";
    data.id = getFindParameter("id");
    data.datetime = _date + " " + _time + ":00:00.0";
    data.client_name = $('.modal-input-name').val();
    data.phone_num = $('.modal-input-phoneNumber').val();

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
            if (data.detail == "success") {
                alert("예약에 성공하였습니다.")
                location.reload()
            } else {
                alert("예약 실패\n" + data)
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(jqXHR.responseText);
            alert("에러 발생\n" + jqXHR);
        }
    });
}

var _date, _time;
function reservationDate(date, time) {
    _date = date;
    _time = time;
    toggleModal();
    $('.modal-input-phoneNumber').val("")
    $('.modal-input-name').val("")
    $('.modal-title').text(gym_name + " ─ " + date + " " + time + ":00 예약")
}

function toggleModal() {
    const body = document.querySelector('body')
    const modal = document.querySelector('.modal')
    modal.classList.toggle('opacity-0')
    modal.classList.toggle('pointer-events-none')
    body.classList.toggle('modal-active')
}

var map
window.onload = function () {
    getGymInfo();
    // $("#slider-2").hide();
    // $("#sButton1").addClass("bg-gray-800");
    // loopSlider();
    var mapContainer = document.getElementById('map'), // 지도를 표시할 div 
        mapOption = {
            center: new kakao.maps.LatLng(37.24052997977369, 131.8667634040424), // 지도의 중심좌표
            level: 3 // 지도의 확대 레벨
        };

    // 지도를 생성합니다    
    map = new kakao.maps.Map(mapContainer, mapOption);

    $('.t-datepicker').tDatePicker({
        autoClose: true,
        formatDate: 'yyyy-mm-dd',
        numCalendar: 1,
        iconDate: '<i class="fa fa-calendar"></i>',
        titleDays: ['월', '화', '수', '목', '금', '토', '일'],
        titleMonths: ['1월', '2월', '3월', '4월', '5월', '6월', '7일', '8월', '9월', '10월', '11월', '12월'],
        showDateTheme: 'yyyy-mm-dd',
        nextDayHighlighted: false,
    }).on('eventClickDay', function (e, dataDate) {
        var date = String(dataDate[0]);
        date = date.substring(0, date.length - 3);

        var data = new Object();
        data.type = "gymFindIDReservationDate";
        data.id = getFindParameter("id");
        data.date = date;

        var jsonData = JSON.stringify(data);
        console.log(jsonData);

        //$('.tabs-content-reservation-one').clear()
        $.ajax({
            type: "POST",
            crossOrigin: true,
            url: "../../core/req/",
            dataType: "JSON",
            data: jsonData,
            success: function (data, status, xhr) {
                console.log("response data : ")
                console.log(data);
                if (data.length == 0) {
                    $('.tabs-content-reservation-one').text("해당 날짜에는 예약 가능한 시간이 없습니다.")
                } else {
                    var html = "<br><br><br><div class=\"grid grid-cols-7 gap-4 gym-grid\">"

                    for (var i = 0; i < data.length; i++) {
                        if (data[i].taken == true) {
                            html += "<label class=\"bg-gray-200 text-center text-black text-sm p-2 cursor-not-allowed\">" +
                                data[i].time + ":00" +
                                "</label>"
                        } else {
                            html += "<label class=\"bg-gray-100 text-center text-black text-sm p-2 cursor-pointer hover:bg-gray-300\" onclick=\"reservationDate('" +data[i].date+ "', '"+data[i].time+"')\">" +
                                data[i].time + ":00" +
                                "</label>"
                        }
                    }

                    html += "</div>"
                    $('.tabs-content-reservation-one').html(html)
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(jqXHR.responseText);
                alert("에러 발생\n" + jqXHR);
            }
        });
    })

    $(document).on("keyup", ".modal-input-phoneNumber", function () {
        $(this).val($(this).val().replace(/[^0-9]/g, "").replace(/(^02|^0505|^1[0-9]{3}|^0[0-9]{2})([0-9]+)?([0-9]{4})$/, "$1-$2-$3").replace("--", "-"));
    });

}
// var cont = 0;

// function loopSlider() {
//     var xx = setInterval(function () {
//         switch (cont) {
//             case 0: {
//                 $("#slider-1").fadeOut(400);
//                 $("#slider-2").delay(400).fadeIn(400);
//                 $("#sButton1").removeClass("bg-gray-800");
//                 $("#sButton2").addClass("bg-gray-800");
//                 cont = 1;
//                 break;
//             }
//             case 1: {
//                 $("#slider-2").fadeOut(400);
//                 $("#slider-1").delay(400).fadeIn(400);
//                 $("#sButton2").removeClass("bg-gray-800");
//                 $("#sButton1").addClass("bg-gray-800");
//                 cont = 0;
//                 break;
//             }
//         }
//     }, 8000);
// }

// function reinitLoop(time) {
//     clearInterval(xx);
//     setTimeout(loopSlider(), time);
// }

// function sliderButton1() {
//     $("#slider-2").fadeOut(400);
//     $("#slider-1").delay(400).fadeIn(400);
//     $("#sButton2").removeClass("bg-gray-800");
//     $("#sButton1").addClass("bg-gray-800");
//     reinitLoop(4000);
//     cont = 0
// }

// function sliderButton2() {
//     $("#slider-1").fadeOut(400);
//     $("#slider-2").delay(400).fadeIn(400);
//     $("#sButton1").removeClass("bg-gray-800");
//     $("#sButton2").addClass("bg-gray-800");
//     reinitLoop(4000);
//     cont = 1
// }