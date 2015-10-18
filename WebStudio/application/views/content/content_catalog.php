<?php
    $model = new model_catalog();
    $hoodiesInfo = $model->getHoodies();
    require('template/template.php');
?>

<div class="catalog">
    <div class="contentCatalog">
        <?php
        for ($q=0; $q<4; $q++) {
            $parse->get_tpl('template/catalogHoody.tpl');
            $parse->set_tpl('{UNITIDNUMBER}', $q+1);
            $parse->set_tpl('{UNITNUMBER}', $q+1);
            $parse->set_tpl('{URL}', $hoodiesInfo[$q]['url']);
            $parse->set_tpl('{NAME}', $hoodiesInfo[$q]['name']);
            $parse->set_tpl('{TEXT_PRICE}', $hoodiesInfo[$q]['textPrice']);
            $parse->tpl_parse();
            echo $parse->template;
        }
        ?>
    </div>
</div>