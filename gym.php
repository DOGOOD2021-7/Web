<?php require_once $_SERVER['DOCUMENT_ROOT'].'/core/page/header.php'; ?>
<link rel="stylesheet" href="../lib/plugins/t-datepicker/css/t-datepicker.min.css">
<link rel="stylesheet" href="../lib/plugins/t-datepicker/css/themes/t-datepicker-main.css">

<script>
    document.title = '헬스장 정보 및 예약 확인 | 구해줘홈트'
</script>

<div class="min-w-screen-sm max-w-screen-sm mb-12 min-h-screen mx-auto px-8">

    <?php require_once $_SERVER['DOCUMENT_ROOT'].'/core/page/navbar.php'; ?>

    <div class="mb-12">
        <style>
            .carousel-open:checked+.carousel-item {
                position: static;
                opacity: 100;
            }

            .carousel-item {
                -webkit-transition: opacity 0.6s ease-out;
                transition: opacity 0.6s ease-out;
            }

            .carousel-item-img {
                --tw-shadow: inset 0 15px 25px 0 rgba(0, 0, 0, 0.25);
                box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
            }

            #carousel-1:checked~.control-1,
            #carousel-2:checked~.control-2,
            #carousel-3:checked~.control-3 {
                display: block;
            }

            .carousel-indicators {
                list-style: none;
                margin: 0;
                padding: 0;
                position: absolute;
                bottom: 2%;
                left: 0;
                right: 0;
                text-align: center;
                z-index: 10;
            }

            #carousel-1:checked~.control-1~.carousel-indicators li:nth-child(1) .carousel-bullet,
            #carousel-2:checked~.control-2~.carousel-indicators li:nth-child(2) .carousel-bullet,
            #carousel-3:checked~.control-3~.carousel-indicators li:nth-child(3) .carousel-bullet {
                color: #2b6cb0;
                /*Set to match the Tailwind colour you want the active one to be */
            }
        </style>
        <div class="carousel relative bg-white">
            <div class="carousel-inner relative overflow-hidden w-full">
                <!--Slide 1-->
                <input class="carousel-open" type="radio" id="carousel-1" name="carousel" aria-hidden="true" hidden=""
                    checked="checked">
                <div class="carousel-item absolute opacity-0" style="height:15rem;">
                    <div class="carousel-item-img block h-full w-full bg-pink-400 text-white text-5xl text-center slider-image-one">
                    </div>
                </div>
                <label for="carousel-3"
                    class="prev control-1 w-6 h-6 ml-2 ml-10 absolute cursor-pointer hidden text-md font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center z-10 inset-y-0 left-0 my-auto slider-one-left">
                    <div style="margin-top:2px;margin-right:1px">‹</div>
                </label>
                <label for="carousel-2"
                    class="next control-1 w-6 h-6 mr-2 mr-10 absolute cursor-pointer hidden text-md font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center z-10 inset-y-0 right-0 my-auto slider-one-right">
                    <div style="margin-top:2px;margin-left:1px">›</div>
                </label>

                <div class="slider-two">
                    <input class="carousel-open" type="radio" id="carousel-2" name="carousel" aria-hidden="true" hidden="">
                    <div class="carousel-item absolute opacity-0" style="height:15rem;">
                        <div class="block h-full w-full bg-yellow-500 text-white text-5xl text-center slider-image-two"></div>
                    </div>
                    <label for="carousel-1"
                        class="prev control-2 w-6 h-6 ml-2 md:ml-10 absolute cursor-pointer hidden text-md font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center z-10 inset-y-0 left-0 my-auto slider-two-left">
                        <div style="margin-top:2px;margin-right:1px">‹</div>
                    </label>
                    <label for="carousel-3"
                        class="next control-2 w-6 h-6 mr-2 md:mr-10 absolute cursor-pointer hidden text-md font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center z-10 inset-y-0 right-0 my-auto slider-two-right">
                        <div style="margin-top:2px;margin-left:1px">›</div>
                    </label>
                </div>
                
                <div class="slider-three">
                    <input class="carousel-open" type="radio" id="carousel-3" name="carousel" aria-hidden="true" hidden="">
                    <div class="carousel-item absolute opacity-0" style="height:15rem;">
                        <div class="block h-full w-full bg-green-500 text-white text-5xl text-center slider-image-three"></div>
                    </div>
                    <label for="carousel-2"
                        class="prev control-3 w-6 h-6 ml-2 md:ml-10 absolute cursor-pointer hidden text-md font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center z-10 inset-y-0 left-0 my-auto slider-three-left">
                        <div style="margin-top:2px;margin-right:1px">‹</div>
                    </label>
                    <label for="carousel-1"
                        class="next control-3 w-6 h-6 mr-2 md:mr-10 absolute cursor-pointer hidden text-md font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center z-10 inset-y-0 right-0 my-auto slider-three-right">
                        <div style="margin-top:2px;margin-left:1px">›</div>
                    </label>
                </div>

                <!-- Add additional indicators for each slide-->
                <ol class="carousel-indicators">
                    <li class="inline-block mr-2">
                        <label for="carousel-1"
                            class="carousel-bullet cursor-pointer block text-4xl text-white hover:text-blue-700">•</label>
                    </li>
                    <li class="inline-block mr-2">
                        <label for="carousel-2"
                            class="carousel-bullet cursor-pointer block text-4xl text-white hover:text-blue-700">•</label>
                    </li>
                    <li class="inline-block mr-3">
                        <label for="carousel-3"
                            class="carousel-bullet cursor-pointer block text-4xl text-white hover:text-blue-700">•</label>
                    </li>
                </ol>

            </div>
        </div>

        <p class="p-2 ml-1 mt-1 text-xl font-bold text-gray-900 gym-title">
            ABC휘트니스
        </p>
        <p class="p-1 mb-1 text-sm text-gray-600 gym-address">
            서울특별시 강남특별구 인천특별동
        </p>

        <div class="flex items-center justify-between px-4 mt-6 border-b select-none md:mt-4">
            <div class="flex">
                <div class="flex items-center px-4 pb-2 text-sm font-semibold border-b-2 cursor-pointer hover:border-gray-300"
                    id="tabs-tab-detail" onclick="tabsClick(1)">
                    상세정보
                </div>
                <div class="flex items-center px-4 pb-2 text-sm font-semibold border-b-2 border-transparent cursor-pointer hover:border-gray-300"
                    id="tabs-tab-reservation" onclick="tabsClick(2)">
                    예약하기
                </div>
            </div>
        </div>

        <div class="tabs-content-detail mb-3">
            <label class="block text-gray-700 text-md font-bold my-1" for="username">
                요금표
            </label>
            <div class="tabs-content-detail-price_desc mb-3">
                None
            </div>

            <label class="block text-gray-700 text-md font-bold my-1" for="username">
                헬스장 위치
            </label>
            <div id="map" class="w-full mt-3 rounded-md" style="height:320px;"></div>
        </div>

        <div class="tabs-content-reservation" hidden>
            <div>
                <div class="t-datepicker my-3">
                    <div class="t-check-in t-picker-only"></div>
                </div>
            </div>
            <div class="tabs-content-reservation-one">
                날짜를 선택하여 주세요.
            </div>
        </div>

    </div>
</div>

<div class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
    <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

    <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">

        <div class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
            <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                <path
                    d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                </path>
            </svg>
            <span class="text-sm">(Esc)</span>
        </div>

        <!-- Add margin if you want to see some of the overlay behind the modal-->
        <div class="modal-content py-4 text-left px-6">
            <!--Title-->
            <div class="flex justify-between items-center pb-3">
                <p class="text-2xl font-bold modal-title">TEMP</p>
                <div class="modal-close cursor-pointer z-50">
                    <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                        viewBox="0 0 18 18">
                        <path
                            d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                        </path>
                    </svg>
                </div>
            </div>

            <!--Body-->
            <div class="relative mb-4 border rounded shadow appearance-none label-floating font-nanum">
                <input class="w-full px-3 py-2 leading-normal text-black rounded cursor-text modal-input-name" id="name"
                    name="name" type="text" value="" placeholder=" ">
                <label class="absolute top-0 left-0 block w-full px-3 py-2 leading-normal text-black cursor-text"
                    for="name">
                    이름
                </label>
            </div>
            <div class="relative mb-4 border rounded shadow appearance-none label-floating font-nanum">
                <input class="w-full px-3 py-2 leading-normal text-black rounded cursor-text modal-input-phoneNumber" id="phoneNumber"
                    name="phoneNumber" type="text" value="" placeholder=" ">
                <label class="absolute top-0 left-0 block w-full px-3 py-2 leading-normal text-black cursor-text"
                    for="phoneNumber">
                    휴대전화 번호
                </label>
            </div>

            <!--Footer-->
            <div class="flex justify-end pt-2">
                <button
                    class="modal-submit px-4 bg-transparent p-3 rounded-lg text-indigo-500 hover:bg-gray-100 hover:text-indigo-400 mr-2">예약신청</button>
                <button
                    class="modal-close px-4 bg-indigo-500 p-3 rounded-lg text-white hover:bg-indigo-400">취소</button>
            </div>

        </div>
    </div>
</div>

<?php require_once $_SERVER['DOCUMENT_ROOT'].'/core/page/footer.php'; ?>
<script src="../lib/plugins/t-datepicker/js/t-datepicker.min.js"></script>
<script type="text/javascript"
    src="//dapi.kakao.com/v2/maps/sdk.js?appkey=e79f5090845e0e47be98182c502ffe15&libraries=services"></script>
<script src="../lib/js/page/gym.js"></script>
</body>

</html>