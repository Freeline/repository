<div class="purchase">
    <div class="purchaseContent">
        <table class="purchaseTable">
            <tr class="purchaseHeader">
                <td class="imgHeader" style="width:56%;" colspan="2">Описание</td>
                <td class="kolvoHeader" style="width:14%;">Количество</td>
                <td class="priceHeader" style="width:14%;">Цена</td>
                <td class="deleteHeader" style="width:10%;">Удалить</td>
            </tr>
            <?php
            $model = new model_catalog();
            $hoodiesInfo = $model->getHoodies();
            $cookieId = $_COOKIE['resultString'];
            $cookieIdExplode = explode("-", $cookieId);

            require('template/template.php');

            for ($q=0; $q<count($cookieIdExplode) - 1; $q++) {
                $splitArray = explode("%", $cookieIdExplode[$q]);
                $id = (int)explode("_", $splitArray[0])[0] - 1;
                $size = explode("_", $splitArray[0])[1];
                $kolvo = $splitArray[1];
                $parse->get_tpl('template/purchaseUnit.tpl');
                $parse->set_tpl('{UNITNUMBER}', $hoodiesInfo[$id]['id'] . "_" . $size);
                $parse->set_tpl('{UNITNUMBER2}', $hoodiesInfo[$id]['id'] . "_" . $size);
                $parse->set_tpl('{URL}', $hoodiesInfo[$id]['purchaseUrl']);
                $parse->set_tpl('{NAMEPURCHASE}', $hoodiesInfo[$id]['name']);
                $parse->set_tpl('{SIZEPURCHASE}', $size);
                $parse->set_tpl('{KOLVOPURCHASE}', $kolvo);
                $parse->set_tpl('{PRICEPURCHASE}', $hoodiesInfo[$id]['textPrice']);
                $parse->tpl_parse();
                echo $parse->template;
            }
            ?>
        </table>
        <div class="basketClear">Очистить корзину</div>
        <input type="button" class="purchaseButton" value="Заказать">
    </div>
</div>