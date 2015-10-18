<?php
class View{

    function generate($header, $content, $footer, $data = null){
        if ($data != null)
            include 'application/models/' . $data;
        include 'application/views/' . $header;
        include 'application/views/' . $content;
        include 'application/views/' . $footer;

    }
}