function getGymListRequest() {
    var data = new Object();

    data.type = "gyms";

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
            var myAddress = data.user_address;
            var myCoords = new Object();
            var geocoder = new kakao.maps.services.Geocoder();
            geocoder.addressSearch(myAddress, function(result, status) {
                if (status === kakao.maps.services.Status.OK) {
                    myCoords.x = result[0].x;
                    myCoords.y = result[0].y;
                }
            });

            console.log(myCoords)
            for (var i = 0; i < data.data.length; i++) {
                var gym = data.data[i];
                
                var coords = new Object();
                geocoder = new kakao.maps.services.Geocoder();
                geocoder.addressSearch(gym.address, function(result, status) {
                    if (status === kakao.maps.services.Status.OK) {
                        coords.x = result[0].x;
                        coords.y = result[0].y;
                    }
                });

                var distance = "ERROR"
                if (coords.x === undefined || coords.y === undefined) {
                } else {
                    distance = getDistanceFromLatLonInKm(myCoords.x, myCoords.y, coords.x, coords.y);
                }
                
                console.log(coords)
                var html = "<div class=\"max-w-sm rounded overflow-hidden shadow-lg transform transition duration-500 hover:scale-105 cursor-pointer\"" +
                    "onclick=\"location.href=\'./gym?id="+gym.id+"\'\">" +
                    "<img class=\"w-full h-40\" src=\"https://dogood7.s3.ap-northeast-2.amazonaws.com/"+gym.profile1+"\" alt=\"profile1\">" +
                    "<div class=\"px-4 py-4\">" +
                        "<div class=\"font-bold text-xl mb-2\">" + gym.gym_name + "</div>" +
                        "<p class=\"text-gray-700 text-base\">" + gym.address +
                            // "<br>거리 : " + distance + "m" +
                        "</p>" +
                    "</div>" +
                "</div>";
                $('.gym-grid').append(html);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(jqXHR.responseText);
            alert("에러 발생\n" + jqXHR);
        }
    });
}

function getDistanceFromLatLonInKm(lat1, lng1, lat2, lng2) {
    function deg2rad(deg) {
        return deg * (Math.PI / 180)
    }
    var R = 6371; // Radius of the earth in km 
    var dLat = deg2rad(lat2-lat1); // deg2rad below 
    var dLon = deg2rad(lng2 - lng1);
    var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) + Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) * Math.sin(dLon / 2) * Math.sin(dLon / 2);
    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    var d = R * c; // Distance in km 
    console.log(lat1 + ", " + lng1 + " <---> " + lat2 + ", " + lng2 + " = " + d)
    return d;
}


window.onload = function() {
    getGymListRequest();
    // $("#slider-2").hide();
    // $("#sButton1").addClass("bg-gray-800");
    // loopSlider();
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