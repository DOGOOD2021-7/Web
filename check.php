<?php require_once $_SERVER['DOCUMENT_ROOT'].'/core/page/header.php'; ?>

<script>
    document.title = '확인 | 구해줘홈트'
</script>

<div class="min-w-screen-sm max-w-screen-sm min-h-screen mx-auto px-8 items-center justify-center flex">

    <div class="max-w-md w-full space-y-8">
        <div>
            <img class="mx-auto h-24 w-auto logo" src="../../../lib/img/logo/noun_Human_1689655.svg">
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900 check-title">
                구해줘홈트! 가입 유형 확인
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600 check-description">
                아래 선택지 중에서 선택하여 주세요.
            </p>
        </div>

        <div class="check-content-main">
            <div class="flex flex-wrap -mx-3 mb-4">
                <div class="w-full md:w-1/2 px-3 md:mb-0">
                    <button
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold text-xl py-5 px-10 rounded inline-flex items-center w-full"
                        onclick="chosenType(2)">
                        <i class="fas fa-file-medical-alt mr-3"></i>
                        <span>헬스장 주인</span>
                    </button>
                </div>
                <div class="w-full md:w-1/2 px-3 md:mb-0">
                    <button
                        class="bg-green-500 hover:bg-green-600 text-green-900 font-bold text-xl py-5 px-12 rounded inline-flex items-center w-full"
                        onclick="chosenType(1)">
                        <i class="fas fa-users text-white mr-3"></i>
                        <span class="text-white">일반고객</span>
                    </button>
                </div>
            </div>
        </div>

        <div class="check-content-customer" hidden>
            <div class="w-full mt-8">
                <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 w-full">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                        프로필 사진 업로드
                    </label>
                    <form id="customer-form" method="post" enctype="multipart/form">
                        <div class="flex w-full items-center justify-center bg-grey-lighter">
                            <label
                                class="w-64 flex flex-col items-center px-4 py-3 bg-white text-blue rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer">
                                <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                                </svg>
                                <span class="mt-2 text-base leading-normal">업로드</span>
                                <input type='file' accept="img/*" id="customer-image-upload" class="customer-image-upload" hidden />
                            </label>
                        </div>
                    </form>
                    <div id="imagePreview" hidden>
                        <span>업로드 성공</span>
                    </div>
                    <label class="block text-gray-700 text-sm font-bold mt-6 mb-2" for="username">
                        주소 입력
                    </label>
                    <div class="flex flex-wrap -mx-3 mb-4">
                        <div class="w-full md:w-2/3 px-3 md:mb-0">
                            <input type="text"
                                class="relative px-3 py-2 border rounded shadow appearance-none label-floating font-nanum cursor-default w-full"
                                id="sample6_postcode" placeholder="우편번호" readonly>
                        </div>
                        <div class="w-full md:w-1/3 px-3 md:mb-0">
                            <input type="button"
                                class="w-full py-2 text-center text-white transition duration-300 ease-in-out bg-indigo-600 rounded hover:bg-indigo-700 hover:bg-indigo-dark focus:outline-none cursor-pointer"
                                onclick="sample6_execDaumPostcode()" value="우편번호 찾기"><br>
                        </div>
                    </div>
                    <input type="text"
                        class="relative px-3 py-2 mb-4 border rounded shadow appearance-none label-floating font-nanum w-full cursor-default"
                        id="sample6_address" placeholder="주소" readonly><br>
                    <input type="text"
                        class="relative px-3 py-2 mb-4 border rounded shadow appearance-none label-floating font-nanum w-full cursor-default"
                        id="sample6_extraAddress" placeholder="참고항목" readonly>
                    <input type="text"
                        class="relative px-3 py-2 mb-4 border rounded shadow appearance-none label-floating font-nanum w-full text-black placeholder-black"
                        id="sample6_detailAddress" placeholder="상세주소">

                    <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
                    <script>
                        function sample6_execDaumPostcode() {
                            new daum.Postcode({
                                oncomplete: function (data) {
                                    // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                                    // 각 주소의 노출 규칙에 따라 주소를 조합한다.
                                    // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                                    var addr = ''; // 주소 변수
                                    var extraAddr = ''; // 참고항목 변수

                                    //사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
                                    if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                                        addr = data.roadAddress;
                                    } else { // 사용자가 지번 주소를 선택했을 경우(J)
                                        addr = data.jibunAddress;
                                    }

                                    // 사용자가 선택한 주소가 도로명 타입일때 참고항목을 조합한다.
                                    if (data.userSelectedType === 'R') {
                                        // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                                        // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                                        if (data.bname !== '' && /[동|로|가]$/g.test(data.bname)) {
                                            extraAddr += data.bname;
                                        }
                                        // 건물명이 있고, 공동주택일 경우 추가한다.
                                        if (data.buildingName !== '' && data.apartment === 'Y') {
                                            extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data
                                                .buildingName);
                                        }
                                        // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                                        if (extraAddr !== '') {
                                            extraAddr = ' (' + extraAddr + ')';
                                        }
                                        // 조합된 참고항목을 해당 필드에 넣는다.
                                        document.getElementById("sample6_extraAddress").value = extraAddr;

                                    } else {
                                        document.getElementById("sample6_extraAddress").value = '';
                                    }

                                    // 우편번호와 주소 정보를 해당 필드에 넣는다.
                                    document.getElementById('sample6_postcode').value = data.zonecode;
                                    document.getElementById("sample6_address").value = addr;
                                    // 커서를 상세주소 필드로 이동한다.
                                    document.getElementById("sample6_detailAddress").focus();
                                }
                            }).open();
                        }
                    </script>
                    <button
                        class="bg-green-500 hover:bg-green-600 text-green-900 font-bold text-xl py-5 pl-32 rounded inline-flex items-center w-full"
                        onclick="checkSendRequest()">
                        <i class="fas fa-check text-white mr-3"></i>
                        <span class="text-white">입력완료</span>
                    </button>
                </div>
            </div>
        </div>

        <div class="check-content-owner" hidden>
            <div class="w-full mt-8">
                <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 w-full">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                        헬스장 정보를 입력해주세요.
                    </label>
                    <div class="relative mb-4 border rounded shadow appearance-none label-floating font-nanum">
                        <input class="w-full px-3 py-2 leading-normal text-black rounded cursor-text input-gym-name" id="name"
                            name="name" type="text" value="" placeholder=" ">
                        <label
                            class="absolute top-0 left-0 block w-full px-3 py-2 leading-normal text-black cursor-text"
                            for="name">
                            헬스장 명
                        </label>
                    </div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                        SNS 계정
                    </label>
                    <input type="text"
                        class="relative px-3 py-2 mb-4 border rounded shadow appearance-none label-floating font-nanum w-full text-black placeholder-black placeholder-small"
                        placeholder="Facebook (ex: https://www.facebook.com/dogoodhackers/)">
                    <input type="text"
                        class="relative px-3 py-2 mb-4 border rounded shadow appearance-none label-floating font-nanum w-full text-black placeholder-black"
                        placeholder="Instagram (ex: @dogoodhackers)">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                        프로필 사진 업로드
                    </label>
                    <div class="flex w-full items-center justify-center bg-grey-lighter">
                        <label
                            class="w-64 flex flex-col items-center px-4 py-3 bg-white text-blue rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer">
                            <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20">
                                <path
                                    d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                            </svg>
                            <span class="mt-2 text-base leading-normal">업로드</span>
                            <input type='file' accept="img/*" class="customer-image-upload" hidden />
                        </label>
                    </div>
                    <div id="imagePreview" hidden>
                        <img id="imagePreview-img" />
                    </div>
                    <label class="block text-gray-700 text-sm font-bold mt-6 mb-2" for="username">
                        주소 입력
                    </label>
                    <div class="flex flex-wrap -mx-3 mb-4">
                        <div class="w-full md:w-2/3 px-3 md:mb-0">
                            <input type="text"
                                class="relative px-3 py-2 border rounded shadow appearance-none label-floating font-nanum cursor-default w-full"
                                id="sample7_postcode" placeholder="우편번호" readonly>
                        </div>
                        <div class="w-full md:w-1/3 px-3 md:mb-0">
                            <input type="button"
                                class="w-full py-2 text-center text-white transition duration-300 ease-in-out bg-indigo-600 rounded hover:bg-indigo-700 hover:bg-indigo-dark focus:outline-none cursor-pointer"
                                onclick="sample7_execDaumPostcode()" value="우편번호 찾기"><br>
                        </div>
                    </div>
                    <input type="text"
                        class="relative px-3 py-2 mb-4 border rounded shadow appearance-none label-floating font-nanum w-full cursor-default"
                        id="sample7_address" placeholder="주소" readonly><br>
                    <input type="text"
                        class="relative px-3 py-2 mb-4 border rounded shadow appearance-none label-floating font-nanum w-full cursor-default"
                        id="sample7_extraAddress" placeholder="참고항목" readonly>
                    <input type="text"
                        class="relative px-3 py-2 mb-4 border rounded shadow appearance-none label-floating font-nanum w-full text-black placeholder-black"
                        id="sample7_detailAddress" placeholder="상세주소">

                    <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
                    <script>
                        function sample7_execDaumPostcode() {
                            new daum.Postcode({
                                oncomplete: function (data) {
                                    // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                                    // 각 주소의 노출 규칙에 따라 주소를 조합한다.
                                    // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                                    var addr = ''; // 주소 변수
                                    var extraAddr = ''; // 참고항목 변수

                                    //사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
                                    if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                                        addr = data.roadAddress;
                                    } else { // 사용자가 지번 주소를 선택했을 경우(J)
                                        addr = data.jibunAddress;
                                    }

                                    // 사용자가 선택한 주소가 도로명 타입일때 참고항목을 조합한다.
                                    if (data.userSelectedType === 'R') {
                                        // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                                        // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                                        if (data.bname !== '' && /[동|로|가]$/g.test(data.bname)) {
                                            extraAddr += data.bname;
                                        }
                                        // 건물명이 있고, 공동주택일 경우 추가한다.
                                        if (data.buildingName !== '' && data.apartment === 'Y') {
                                            extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data
                                                .buildingName);
                                        }
                                        // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                                        if (extraAddr !== '') {
                                            extraAddr = ' (' + extraAddr + ')';
                                        }
                                        // 조합된 참고항목을 해당 필드에 넣는다.
                                        document.getElementById("sample7_extraAddress").value = extraAddr;

                                    } else {
                                        document.getElementById("sample7_extraAddress").value = '';
                                    }

                                    // 우편번호와 주소 정보를 해당 필드에 넣는다.
                                    document.getElementById('sample7_postcode').value = data.zonecode;
                                    document.getElementById("sample7_address").value = addr;
                                    // 커서를 상세주소 필드로 이동한다.
                                    document.getElementById("sample7_detailAddress").focus();
                                }
                            }).open();
                        }
                    </script>
                    <button
                        class="bg-green-500 hover:bg-green-600 text-green-900 font-bold text-xl py-5 pl-32 rounded inline-flex items-center w-full"
                        onclick="checkSendRequest()">
                        <i class="fas fa-check text-white mr-3"></i>
                        <span class="text-white">입력완료</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once $_SERVER['DOCUMENT_ROOT'].'/core/page/footer.php'; ?>
<script src="../lib/js/page/check.js"></script>
</body>

</html>