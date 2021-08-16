<?php require_once $_SERVER['DOCUMENT_ROOT'].'/core/page/header.php'; ?>
<link rel="stylesheet" href="../lib/plugins/t-datepicker/css/t-datepicker.min.css">
<link rel="stylesheet" href="../lib/plugins/t-datepicker/css/themes/t-datepicker-main.css">

<script>
    document.title = '내 프로필 | 구해줘홈트'
</script>

<div class="min-w-screen-sm max-w-screen-sm mb-12 min-h-screen mx-auto px-8">

    <?php require_once $_SERVER['DOCUMENT_ROOT'].'/core/page/navbar.php'; ?>

        <!-- <p class="text-3xl font-bold text-shadow-xl">에</p>
        <p class="text-2xl mb-10 leading-none text-shadow-xl">설명</p> -->

        <h1 class="text-lg pb-1 border-b-2 border-gray-600 mb-4">예약 내역</h1>
        <div class="grid grid-cols-1 gap-4 gym-grid"></div>
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
                <p class="text-2xl font-bold modal-title">예약 취소 확인</p>
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
                <input class="w-full px-3 py-2 leading-normal text-black rounded cursor-text modal-input-cancelreason" id="name"
                    name="name" type="text" value="" placeholder=" ">
                <label class="absolute top-0 left-0 block w-full px-3 py-2 leading-normal text-black cursor-text"
                    for="name">
                    취소사유
                </label>
            </div>

            <!--Footer-->
            <div class="flex justify-end pt-2">
                <button
                    class="modal-submit px-4 bg-transparent p-3 rounded-lg text-indigo-500 hover:bg-gray-100 hover:text-indigo-400 mr-2">확인</button>
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
<script src="../lib/js/page/mypage.js"></script>
</body>

</html>