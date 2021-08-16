<?php require_once $_SERVER['DOCUMENT_ROOT'].'/core/page/header.php'; ?>

<?php
if (isset($_COOKIE["dogoodhackaton7-user_type"])) {
    if ($_COOKIE["dogoodhackaton7-user_type"] == "gym") {
        die("<script>location.replace('./mypage');</script>");
    }
} else {
    die("<script>location.replace('./login');</script>");
}
?>

<script>
    document.title = '근처 헬스장 목록 | 구해줘홈트'
</script>

<div class="min-w-screen-sm max-w-screen-sm mb-12 min-h-screen mx-auto px-8">

    <?php require_once $_SERVER['DOCUMENT_ROOT'].'/core/page/navbar.php'; ?>

    <div class="mb-12">
        <!-- <div class="sliderAx h-auto">
            <div id="slider-1" class="container mx-auto">
                <div class="bg-cover bg-center h-auto text-white py-14 px-10 object-fill rounded-md"
                    style="background-image: url(https://i0.wp.com/t1.daumcdn.net/liveboard/sharehows_1boon/4df39b0cf7a64db29b0b4e22201ee288.gif?w=1080&ssl=1)">

                    <p class="text-sm font-bold uppercase text-shadow-xl">이벤트</p>
                    <p class="text-3xl font-bold text-shadow-xl">구해줘 홈트 론칭 기념 이벤트</p>
                    <p class="text-xl mb-10 leading-none text-shadow-xl">누구나 1회 이상 예약시 사은품 100% 지급!<br>♚♚히어로즈 오브 더 스☆톰♚♚가입시$$전원 카드팩☜☜뒷면100%증정※ ♜월드오브 워크래프트♜펫 무료증정￥ 특정조건 §§디아블로3§§★공허의유산★초상화획득기회@@@ 즉시이동http://kr.battle.net/heroes/ko/</p>
                </div>
            </div>

            <div id="slider-2" class="container mx-auto hidden">
                <div class="bg-cover bg-top h-auto text-white py-24 px-10 object-fill rounded-md"
                    style="background-image: url(http://cdn.gamemeca.com/gmdata/0001/384/563/%ED%8C%8C%EC%9B%8C%EC%BD%94%EB%94%A9.gif)">

                    <p class="font-bold text-sm uppercase text-shadow-xl">주제</p>
                    <p class="text-3xl font-bold text-shadow-xl">타이틀</p>
                    <p class="text-2xl mb-10 leading-none text-shadow-xl">설명</p>

                </div>
            </div>

            <div class="flex justify-between w-12 mx-auto pb-2" style="margin-top: -2rem">
                <button id="sButton1" onclick="sliderButton1()" class="bg-white rounded-full w-4 pb-2 "></button>
                <button id="sButton2" onclick="sliderButton2() " class="bg-white rounded-full w-4 p-2"></button>
            </div>
        </div> -->

        <h1 class="text-lg pb-1 border-b-2 border-gray-600 mb-4">주변 헬스장</h1>

        <div class="grid grid-cols-2 gap-4 gym-grid">

        </div>
    </div>
</div>

<?php require_once $_SERVER['DOCUMENT_ROOT'].'/core/page/footer.php'; ?>
<script type="text/javascript"
    src="//dapi.kakao.com/v2/maps/sdk.js?appkey=e79f5090845e0e47be98182c502ffe15&libraries=services"></script>
<script src="../lib/js/page/index.js"></script>
</body>

</html>