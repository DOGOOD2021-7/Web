var chosen_type = 0;

function checkSendRequest() {
    var data = new Object();

    data.type = "check";
    if (chosenType == 1) {
        data.sign_type = "dieter";
        data.address = $('#sample6_address').val();
        data.address_detail = $('#sample6_detailAddress').val();
        data.profile = customer_s3_key;
    } else {
        data.sign_type = "gym";
        data.address = $('#sample7_address').val();
        data.address_detail = $('#sample7_detailAddress').val();
        data.gym_name = $('.input-gym-name').val();
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
            setCookie('dogoodhackaton7', data.token, 365)
            location.replace("./login")
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(jqXHR.responseText);
            alert("에러 발생\n" + jqXHR);
        }
    });
}
// 'type' => $data["sign_type"],
// 'address' => $data["address"],
// 'address_detail' => $data["address_detail"],

function chosenType(type) {
    chosenType = type;
    $(".check-content-main").hide();

    switch(chosenType) {
        case 1: // 일반 고객
            $(".check-content-customer").show();
            $(".check-title").text("일반고객 추가정보 입력")
            $(".check-description").text("아래 사항들을 작성하여 주세요.")
            break;
        case 2: // 헬스장 주인
            $(".check-content-owner").show();
            $(".check-title").text("헬스장 주인 추가정보 입력")
            $(".check-description").text("아래 사항들을 작성하여 주세요.")
            break;
    }
}

var customer_s3_key = ""
function readInputFile(e) {
    var sel_files = [];
    
    sel_files = [];
    $('.imagePreview').empty();
    $('.imagePreview').show();
    
    var files = e.target.files;
    var fileArr = Array.prototype.slice.call(files);
    var index = 0;
        
    var datas, xhr;
    datas = new FormData();
    datas.append('service_image', $('#customer-image-upload')[0].files[0]);
    console.log($('#customer-image-upload')[0].files[0])
 
    $.ajax({
        url: '../../core/req/upload_img',
        contentType: 'multipart/form-data', 
        type: 'POST',
        data: datas,   
        dataType: 'json',     
        mimeType: 'multipart/form-data',
        success: function (data) {               
            console.log(data);                
        },
        error : function (jqXHR, textStatus, errorThrown) {
            console.log(jqXHR.responseText);
            var split = jqXHR.responseText.split('.')
            if (split[1] == "jpg" || split[1] == "png" || split[1] == "jpeg" || split[1] == "gif") {
                customer_s3_key = jqXHR.responseText;
                $('#imagePreview').show()
            }else{
                alert('에러발생\n' + textStatus);
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });
    
    // fileArr.forEach(function(f){
    //     uploadImg(f);

    // 	if(!f.type.match("image/.*")){
    //     	alert("이미지 확장자만 업로드 가능합니다.");
    //         return;
    //     };
    //     if(files.length < 11){
    //     	sel_files.push(f);
    //         var reader = new FileReader();
    //         reader.onload = function(e){
    //         	var html = `<a id=img_id_${index}><img src=${e.target.result} data-file=${f.name} /></a>`;
    //             $('.imagePreview').append(html);
    //             index++;
    //         };
    //         reader.readAsDataURL(f);
    //     }
    // })
    // if(files.length > 11){
    // 	alert("최대 10장까지 업로드 할 수 있습니다.");
    // }
}

function uploadImg(img) {
    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: '../../core/req/upload_img',
        data: img,
        cache: false,
        processData: false,
        contentType: false,
        timeout: 5000,
        success: function (data) {
            try {
                console.log(data);
            } catch (e) {
                alert("이미지 업로드 실패")
                console.log(e)
                console.log(data)
            }
        },
        error: function (err) {
            alert("이미지 업로드 실패")
            console.log(err)
        }
    })
}

window.onload = function() {
    $('.customer-image-upload').on('change', readInputFile);
}