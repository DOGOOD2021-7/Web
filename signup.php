<?php require_once $_SERVER['DOCUMENT_ROOT'].'/core/page/header.php'; ?>

<script>
    document.title = '회원가입 | 구해줘홈트'
</script>

<div class="min-w-screen-sm max-w-screen-sm min-h-screen mx-auto px-8 items-center justify-center flex">

    <div class="max-w-md w-full space-y-8">
        <div>
            <img class="mx-auto h-24 w-auto logo" src="../../../lib/img/logo/noun_Human_1689655.svg">
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                구해줘홈트 회원가입
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                환영합니다. 2021년 제1회 두굿해커톤 7번팀
            </p>
        </div>
        <div class="mt-8 space-y-6">

            <div class="relative mb-4 border rounded shadow appearance-none label-floating font-nanum">
                <input class="w-full px-3 py-2 leading-normal text-black rounded cursor-text input-email" id="email" name="email"
                    type="email" value="" placeholder=" " focus>
                <label class="absolute top-0 left-0 block w-full px-3 py-2 leading-normal text-black cursor-text"
                    for="email">
                    이메일 주소
                </label>
            </div>
            <!-- <div class="relative mb-4 border rounded shadow appearance-none label-floating font-nanum">
                <input class="w-full px-3 py-2 leading-normal text-black rounded cursor-text" id="name" name="name"
                    type="text" value="" placeholder=" ">
                <label class="absolute top-0 left-0 block w-full px-3 py-2 leading-normal text-black cursor-text"
                    for="name">
                    이름
                </label>
            </div> -->
            <div class="relative mb-4 border rounded shadow appearance-none label-floating font-nanum">
                <input class="w-full px-3 py-2 leading-normal text-black rounded cursor-text input-password" id="password"
                    name="password" type="password" value="" placeholder=" ">
                <label class="absolute top-0 left-0 block w-full px-3 py-2 leading-normal text-black cursor-text"
                    for="password">
                    비밀번호
                </label>
            </div>
            <div class="relative mb-4 border rounded shadow appearance-none label-floating font-nanum">
                <input class="w-full px-3 py-2 leading-normal text-black rounded cursor-text input-password2" id="password-verify"
                    name="password-verify" type="password" value="" placeholder=" ">
                <label class="absolute top-0 left-0 block w-full px-3 py-2 leading-normal text-gray cursor-text"
                    for="password-verify">
                    비밀번호 확인
                </label>
            </div>

            <button onclick="signUpInfoSendRequest()"
                class="w-full py-3 my-1 text-center text-white transition duration-300 ease-in-out bg-indigo-600 rounded hover:bg-indigo-700 hover:bg-indigo-dark focus:outline-none">
                회원 가입
            </button>
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                </div>

                <div class="text-sm">
                    <a href="./login" class="font-medium text-indigo-600 hover:text-indigo-500">
                        로그인
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once $_SERVER['DOCUMENT_ROOT'].'/core/page/footer.php'; ?>
<script src="../lib/js/page/signup.js"></script>
</body>

</html>