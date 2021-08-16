<?php require_once $_SERVER['DOCUMENT_ROOT'].'/core/page/header.php'; ?>

<script>
    document.title = '로그인 | 구해줘홈트'
</script>

<div class="min-w-screen-sm max-w-screen-sm min-h-screen mx-auto px-8 items-center justify-center flex">

    <div class="max-w-md w-full space-y-8">
        <div>
            <img class="mx-auto h-24 w-auto logo" src="../../../lib/img/logo/noun_Human_1689655.svg">
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                구해줘홈트 로그인
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                환영합니다. 2021년 제1회 두굿해커톤 7번팀
            </p>
        </div>
        <div class="mt-8 space-y-6">
            <input type="hidden" name="remember" value="true">
            <div class="rounded-md shadow-sm -space-y-px">
                <div>
                    <label for="email-address" class="sr-only">이메일</label>
                    <input id="email-address" name="email" type="email" autocomplete="email" required
                        class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm input-email"
                        placeholder="이메일">
                </div>
                <div>
                    <label for="password" class="sr-only">비밀번호</label>
                    <input id="password" name="password" type="password" autocomplete="current-password" required
                        class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm input-password"
                        placeholder="비밀번호">
                </div>
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember-me" name="remember-me" type="checkbox"
                        class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label for="remember-me" class="ml-2 block text-sm text-gray-900">
                        회원 정보 기억
                    </label>
                </div>

                <div class="text-sm">
                    <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">
                        비밀번호를 잊으셨습니까?
                    </a>
                </div>
            </div>

            <div>
                <button onclick="loginInfoSendRequest()"
                    class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                        <svg class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                            aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </span>
                    로그인
                </button>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                </div>

                <div class="text-sm">
                    <a href="./signup" class="font-medium text-indigo-600 hover:text-indigo-500">
                        회원가입
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once $_SERVER['DOCUMENT_ROOT'].'/core/page/footer.php'; ?>
<script src="../lib/js/page/login.js"></script>
</body>

</html>