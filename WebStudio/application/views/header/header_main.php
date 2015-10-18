<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="text/javascript" src="http://localhost/webStudio/js/jQuery.js"></script>
    <script type="text/javascript" src="http://localhost/webStudio/js/java.js"></script>
    <link rel="stylesheet" type="text/css" href="http://localhost/webStudio/css/header.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/webStudio/css/content.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/webStudio/css/footer.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/webStudio/css/mainContent.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/webStudio/css/media-queries.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/webStudio/css/payContent.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/webStudio/css/deliveryContent.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/webStudio/css/catalogContent.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/webStudio/css/contactsContent.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/webStudio/css/purchaseContent.css">

    <script>
        $(document).ready(function(){
            if (getCookie('basketCount') != null)
                $(".basket > a > .textBasket > .basketNumber").html(getCookie('basketCount'));
            $(".orderMenu").fadeToggle(0);
            $(".backgroundOrder").fadeToggle(0);
            $(".hoodyStaticBlock").fadeToggle(0);
            $(".mainSlider > div:not(:first):not(.points)").fadeOut(0);
        });
    </script>


</head>
<body>
    <div class="backgroundOrder">

    </div>

    <div class="orderMenu">
        <div class="orderHeader">Оформление заказа</div>
        <form method="POST" name="orderForm" class="orderForm">
            <label for="orderInputFIO" class="orderLabelFIO">Имя и фамилия</label>
            <input type="text" id="orderInputFIO" class="orderInputFIO">
            <label for="orderInputPhone" class="orderLabelPhone">Телефон</label>
            <input type="text" id="orderInputPhone" class="orderInputPhone">
            <input type="button" class="orderButton">
        </form>
    </div>

    <div class="backgroundBlock"></div>

    <div class="misisShop">Misis Shop</div>

    <div class="hoodyStaticBlock"></div>

    <div class="basket">
        <a href="/webstudio/main/purchase">
        <div class="imgBasket"></div>
        <div class="textBasket">Корзина (<span class="basketNumber">0</span>)</div>
        </a>
    </div>

    <div class="menu">
        <ul>
            <li class="liMain""><a href="http://localhost/webstudio/main/index">Главная</a></li>
            <li class="liAbout""><a href="http://localhost/webstudio/main/pay">Оплата</a></li>
            <li class="liExamples""><a href="http://localhost/webstudio/main/delivery">Доставка</a></li>
            <li class="liPriceList""><a href="http://localhost/webstudio/main/catalog">Каталог</a></li>
            <li class="liSells"">Акции</li>
            <li class="liContacts""><a href="http://localhost/webstudio/main/contacts">Контакты</a></li>
        </ul>
    </div>