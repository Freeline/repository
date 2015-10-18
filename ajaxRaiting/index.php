<html>
<head>
    <?php
    header('Content-type: text/html; charset=utf-8');
    ?>
    <meta charset="utf-8">
    <script type="text/javascript" src="jQuery.js"></script>
    <script>
        var id=4268;
        var allInfo = new Array();
        var count = 1007;
        function ajaxStart(){
            $.ajax({
                type: "POST",
                data: {id: id, count: count},
                url: "script.php",
                success: function(data){
                    if (data != "0")
                        count++;
                    id--;
                    if (count == 1150){
                        clearInterval(ajaxTimer);
                        alert("ВСЕ");
                    }
                }
            });
        }
        ajaxStart();
        /*var ajaxTimer = setInterval("ajaxStart()", 5000);
        $(".mainButton").click(function(){
            clearInterval(ajaxTimer);
        });*/

    </script>
</head>
<body>
    <input type="button" class="mainButton" style="width:100px; height:30px;">
</body>
</html>