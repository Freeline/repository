var oldIdPoint = "first";
if (getCookie("basketCount") != null)
    var basketCount = +getCookie("basketCount");
else
    basketCount = 0;
if (getCookie("resultString") != null)
    var resultString = getCookie('resultString');
else
    resultString = "";
var allId = new Map();
var size;

function getCookie ( cookie_name )
{
    var results = document.cookie.match ( '(^|;) ?' + cookie_name + '=([^;]*)(;|$)' );

    if ( results )
        return ( unescape ( results[2] ) );
    else
        return null;
}

function setCookie(name, value, expires, path, domain, secure) {
    document.cookie = name + "=" + escape(value) +
    ((expires) ? "; expires=" + expires : "") +
    ((path) ? "; path=" + path : "") +
    ((domain) ? "; domain=" + domain : "") +
    ((secure) ? "; secure" : "");
}

function delCookie(name) {
    document.cookie = name + "=" + "; expires=Thu, 01 Jan 1970 00:00:01 GMT";
}

function callbackFunction(item, index){
    var check = false;
    var oldRepeatCount;
    var arrayString = resultString.split("-");

    for (var q=0; q<arrayString.length-1; q++){
        if (arrayString[q].split("_")[0] == index.split("_")[0] && arrayString[q].split("_")[1].split("%")[0] == index.split("_")[1]){
            oldRepeatCount = +arrayString[q].split("%")[1];
            arrayString[q] = arrayString[q].replace("%" + oldRepeatCount, "%" + (+oldRepeatCount + +item));
            check = true;
            break;
        }
    }
    if (check == true) {
        resultString = "";
        for (var q = 0; q < arrayString.length-1; q++)
            resultString += arrayString[q] + "-";
    }
    else {
        resultString += index.split("_")[0] + "_" + index.split("_")[1] + "%" + item + "-";
    }
}

$(document).ready(function(){

    $(".purchaseButton").click(function() {
        if (basketCount == 0) {
            alert("Корзина пуста");
        }
        else{
            $(".orderMenu").fadeToggle();
            $(".backgroundOrder").fadeToggle();
        }
    });

    $(".deletePurchase .redCross").click(function(){
        var id = $(this).parent("td").parent("tr").attr("id");
        var kolvo = $(".purchaseTable .purchaseTr" + id + " .kolvoPurchase").html();
        resultString = resultString.replace(id + "%" + kolvo + "-", "");
        basketCount = basketCount - +kolvo;
        $(".basket > a > .textBasket > .basketNumber").html(basketCount);
        setCookie("basketCount", basketCount);
        setCookie("resultString", resultString);
        $(".purchaseTr" + id).remove();
    });

    $(".basket").click(function(){
        setCookie("basketCount", basketCount);
        allId.forEach(callbackFunction);
        setCookie("resultString", resultString);
    });

    $(".basketClear").click(function(){
        setCookie('basketCount', 0);
        setCookie('resultString', "");
        $(".basket > a > .textBasket > .basketNumber").html(0);
        $(".purchaseTr").remove();
    });

    $(".catalogButton").click(function(){
        var id = $(this).parent("div").parent("div").attr("id");
        size = undefined;
        $(".catalog .contentCatalog #" + id + " td").each(function(){
            if ($(this).css("background-color") == "rgb(218, 165, 32)"){
                size = $(this).html();
                return false;
            }
        });
        if (size != undefined) {
            if (allId.get(id + "_" + size) == null) {
                allId.set(id + "_" + size, 1);
            }
            else
                allId.set(id + "_" + size, +allId.get(id + "_" + size) + 1);

            basketCount = basketCount + 1;
            $(".basket > a > .textBasket > .basketNumber").html(basketCount);
        }
        else
            alert("Выберите размер");
    });

    $(".point").click(function(){
        var currentIdPoint = $(this).attr('id');
        if (currentIdPoint != oldIdPoint){
            $(".point").css("background-color", "#CCCCCC");
            $(".points div[id=" + currentIdPoint + "]").css("background-color", "#565656");
            $(".examplesContent .images").fadeOut();
            $(".examplesContent div[id=" + currentIdPoint + "]").fadeIn();
            oldIdPoint = currentIdPoint;
        }
    });

    $(".menu").next().css("z-index", "21");

    $(".backgroundOrder").click(function(){
        $(".backgroundOrder").fadeOut();
        $(".orderMenu").fadeOut();
        $(".hoodyStaticBlock").fadeOut();
    });

    $(".imgCatalog").click(function(){
        $('.hoodyStaticBlock').css("background-size", "100% 100%");
        $('.hoodyStaticBlock').css("background-position", "0% 0%");
        $(".backgroundOrder").fadeToggle();
        $(".hoodyStaticBlock").fadeToggle();
        var backgroundUrl = $(this).css("background-image");
        $(".hoodyStaticBlock").css("background-image", backgroundUrl);
        if ($(this).parent("div").attr('class') == 'unit unit1') {
            $('.hoodyStaticBlock').css("background-size", "115% 100%");
            $('.hoodyStaticBlock').css("background-position", "top center");
        }
        if ($(this).parent("div").attr('class') == 'unit unit4') {
            $('.hoodyStaticBlock').css("background-size", "105% 100%");
            $('.hoodyStaticBlock').css("background-position", "top center");
        }
    });

    $(".liLogo").click(function(){
        var top = 0;
        $('html, body').stop().animate({scrollTop: top}, 1000);
    });

    $(".sSize, .mSize, .lSize").click(function(){
        $(".sSize, .mSize, .lSize").css("background-color", "gray");
        $(".sSize, .mSize, .lSize").css("border", "1px solid black");
        $(this).css("background-color", "goldenrod");
        $(this).css("border", "1px solid goldenrod")
    });

    $(".buttonRight").click(function(){
        $(".bigExamplePhoto div[id=" + activeExampleId + "]").stop();
        var blockCount = $(".bigExamplePhoto div[id=" + activeExampleId +  "] div").length;
        var newNumberBlock = oldNumberBlock + 1;
        if (oldNumberBlock == blockCount){
            newNumberBlock = 1;
        }
        $(".bigExamplePhoto div[id=" + activeExampleId + "] div:nth-child(" + oldNumberBlock + ")").fadeOut(0);
        $(".bigExamplePhoto div[id=" + activeExampleId + "] div:nth-child(" + newNumberBlock + ")").fadeIn();
        oldNumberBlock = newNumberBlock;
    });

    $(".buttonLeft").click(function(){
        $(".bigExamplePhoto div[id=" + activeExampleId + "]").stop();
        var blockCount = $(".bigExamplePhoto div[id=" + activeExampleId +  "] div").length;
        var newNumberBlock = oldNumberBlock - 1;
        if (oldNumberBlock == 1){
            newNumberBlock = blockCount;
        }
        $(".bigExamplePhoto div[id=" + activeExampleId + "] div:nth-child(" + oldNumberBlock + ")").fadeOut(0);
        $(".bigExamplePhoto div[id=" + activeExampleId + "] div:nth-child(" + newNumberBlock + ")").fadeIn();
        oldNumberBlock = newNumberBlock;
    });
});

$(window).scroll(function(){
    var check = false;
    if (check == false && window.scrollY > 630){
        $(".basket").css("position", "fixed");
        $(".basket").css("top", "50px");
        check = true;
    }
    else{
        $(".basket").css("position", "absolute");
        $(".basket").css("top", "680px");
        check = false;
    }
});