<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cards of Life with PHP</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!--<link rel="stylesheet" href="/resources/demos/style.css">-->
    <link rel="stylesheet" type="text/css" href="css/card.css">
    <style>
        body {
            font-family: "Open Sans", sans-serif;
            overflow: hidden;
            background: linear-gradient(rgba(60, 40, 80, 0.8), rgba(50, 200, 150, 0.4)), url(img/backgroundAurora.jpg);
            background-size: cover;
            background-repeat: no-repeat;
            height: 100%;
            background-attachment: fixed;
        }
        
        #sortable1,
        #sortable2,
        #sortable3 {
            /*list-style-type: none;
            margin: 0;
            float: left;
            margin-right: 10px;
            background: #eee;
            padding: 5px;
            width: 143px;*/
            list-style-type: none;
            overflow-x: auto;
            overflow-y: hidden;
            white-space: nowrap;
            /*background: rgba(240, 240, 230, 0.8);*/
            background: none;
            /*
            background-size: cover;
            background-attachment: fixed;
*/
            height: 340px;
            border-radius: 5px;
            /*box-shadow: 0 3px 5px 5px rgba(0, 0, 0, 0.1);*/
            margin: 10px 10px 0 10px;
            padding: 25px;
            /*cancel out the default padding of 40px*/
            transition: background 0.5s, box-shadow 2s;
            transition-timing-function: linear;
            /*translateZ speed hack; misplaced elements when dragged, however*/
            /*transform: translateZ(0);*/
        }
        
        #sortable3 {
            zoom: 110%;
            /*doesn't work in firefox though*/
            /*can create mouse placement problems; not a real solution*/
        }
        
        #sortable1 {
            zoom: 80%;
        }
        
        #sortable1:hover,
        #sortable2:hover,
        #sortable3:hover {
            background: rgba(200, 240, 230, 0.1);
            /*these background properties seem to perform horribly in transition*/
            /*
            background-image: url(img/backgroundBoard.svg);
            background-attachment: fixed;
            background-size: cover;
*/
            /*            box-shadow: 0 3px 5px 5px rgba(0, 0, 0, 0.1);*/
        }
        
        #sortable1:hover {
            box-shadow: 0 3px 5px 5px rgba(0, 0, 0, 0.1), 0 10px 100px 5px rgba(100, 220, 120, 0.2), inset 0 10px 100px 5px rgba(100, 220, 120, 0.2);
        }
        
        #sortable3:hover {
            box-shadow: 0 3px 5px 5px rgba(0, 0, 0, 0.1), 0 -10px 100px 5px rgba(100, 220, 120, 0.2), inset 0 -10px 100px 5px rgba(100, 220, 120, 0.2);
        }
        /*
        #sortable1::after,
        #sortable2::after,
        #sortable3::after {
            content: '';
            display: block;
            float: left;
            height: inherit;
            width: inherit;
            box-shadow: inset 0 3px 2px 5px rgba(0, 0, 0, 0.5);
        }
*/
        
        #sortable1 li,
        #sortable2 li,
        #sortable3 li {
            /*margin: 5px;
            padding: 5px;
            font-size: 1.2em;
            width: 120px;*/
            margin: 10px 10px 10px 0;
            /*float: left;*/
            height: 300px;
            width: 200px;
            font-size: 1em;
            text-align: center;
            background: white;
            border-radius: 10px;
            display: inline-block;
            white-space: normal;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.5s;
        }
        
        #sortable1 li:hover,
        #sortable2 li:hover,
        #sortable3 li:hover {
            box-shadow: 0px 3px 15px 5px rgba(100, 50, 120, 0.5), inset 0 0 30px rgba(100, 220, 120, 0.3);
            background: linear-gradient(rgba(45, 40, 60, 0.9), rgba(200, 100, 100, 0.4)), url(img/backgroundCard.jpg);
            background-size: cover;
            color: white;
            border-color: rgba(100, 220, 120, 0.4);
            cursor: grab;
            cursor: -webkit-grab;
        }
        
        #sortable1 li:hover div,
        #sortable2 li:hover div,
        #sortable3 li:hover div {
            color: white;
        }
        
        #sortable1 li:hover #cardArt,
        #sortable2 li:hover #cardArt,
        #sortable3 li:hover #cardArt {
            border-width: 1px;
            border-color: rgba(100, 220, 120, 0.9);
            box-shadow: 0 0 50px 10px rgba(50, 220, 0, 0.3), inset 0 0 0 10px rgba(100, 220, 120, 0.3), inset 0 0 20px 20px rgba(100, 220, 120, 0.3);
            transform: scale(1.03);
        }
        /*card content container*/
        
        #sortable1 li:active,
        #sortable2 li:active,
        #sortable3 li:active {
            transform: scale3d(1.2, 1.2, 1);
            /*transform: perspective(600px);
*/
            cursor: grabbing;
            cursor: -webkit-grabbing;
        }
        /*fix for firefox :active suppression by sortable*/
        /*
        .ui-sortable-active {
            transform: scale(1.2);
        }
*/
        
        .cardContent {
            height: 300px;
            /*horizontally centering the div*/
            margin: auto;
            padding: 5px;
            display: table;
            text-align: center;
        }
        
        .middleLine {
            height: 3px;
            border-style: none;
            border-radius: 50%;
            border-width: thin;
            margin: 10px 20px 0 20px;
            border-color: rgba(160, 240, 180, 0.5);
            box-shadow: 0 0 50px 10px rgba(50, 220, 0, 0.3), 0 0 15px rgba(160, 240, 180, 0.8);
            background: radial-gradient(rgba(200, 255, 220, 0.6), rgba(160, 240, 180, 0.9), rgba(50, 220, 0, 0.6));
        }
    </style>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src='js/jquery.mousewheel.min.js'></script>
    <script src="js/jquery.ui.touch-punch.min.js"></script>
    <!--drop between lists-->
    <script>
        $(function () {
            $("ul.droptrue").sortable({
                connectWith: "ul"
            });
            $("ul.dropfalse").sortable({
                connectWith: "ul",
                dropOnEmpty: false
            });
            $("#sortable1, #sortable3").disableSelection();
        });


        //following two blocks added to keep count; http://jsfiddle.net/3xnL7zko/2/
        function update_counts() {
            var n_ul1 = $("#sortable1 li").length;
            var n_ul3 = $("#sortable3 li").length;
            $("#count1").html(n_ul1);
            $("#count3").html(n_ul3);
        }

        $(function () {
            $("#sortable3,#sortable1").droppable({
                over: function (ev, ui) {
                    update_counts();
                },
                drop: function (ev, ui) {
                    update_counts();
                }
            }).disableSelection();
        });
    </script>

    <!--horizontal scrolling-->
    <script>
        $(function () {
            $("#sortable1, #sortable3").mousewheel(function (event, delta) {
                this.scrollLeft -= (delta * 30);
                event.preventDefault();
            });
        });
    </script>

    <!--saving; not working yet-->
    <script>
        $(function () {
            $("#sortable1, #sortable3").sortable({
                update: function (event, ui) {
                    var order = $(this).sortable('serialize');
                    $(document).on("click", "#saveList", function () { //that doesn't work
                        $.ajax({
                            data: order,
                            type: 'POST',
                            url: 'saverank.php'
                        });
                    });
                }
            }).disableSelection();
            $('#saveList').on('click', function () {
                var r = $("#sortable1, #sortable3").sortable("toArray");
                var a = $("#sortable1, #sortable3").sortable("serialize", {
                    attribute: "id"
                });
                console.log(r, a);
            });
        });
    </script>

    <!--path to make :active work in firefox; see: https://bugs.jqueryui.com/ticket/10671-->
    <!--
    <script>
        $.widget("ui.droptrue", $.ui.sortable, {
            _create: function () {
                this._super();
                this._on(this.element, {
                    "mousedown > *": function (event) {
                        $(event.target).addClass("ui-sortable-active");
                    },
                    "sortstop": function (event, ui) {
                        $(ui.item).removeClass("ui-sortable-active");
                    }
                });
            }
        });
        
        $( "#sortable1, #sortable3" ).sortable();
    </script>
-->
</head>

<body>
    <div id="scaler">
        <div id="menu">
            <button id="saveList">Save</button>
            <span>Top deck count: </span><span id="count3">0</span><span>Bottom deck count: </span><span id="count1">15</span>
        </div>
        <ul id="sortable3" class="droptrue">
            <!--<li class="ui-state-default">
                <div class="cordContent">Placeholder</div>
            </li>-->
        </ul>
        <div class="middleLine" style="clear:both;"></div>
        <ul id="sortable1" class="droptrue">
            <?php 
            $file = fopen("data/cardsColumns.csv","r");
            while(! feof($file))  {
            $content = fgetcsv($file);
            if (NULL != $content) {                  
            echo ('<li class="ui-state-default">
                <div class="cardContent">
                    <div id="alignmentBar">---</div>
                    <div id="cardName">
                        <td>' . $content[0] . '</td>
                    </div>
                    <div id="cardArtContainer">
                        <div id="cardArt"');
                        // if image is present; otherwise use default defined in card.css
                        if ($content[2] != NULL) {
                        echo ('style="background-image:url(' . $content[2] . ')"
                        ');
                        }
                        echo ('></div>
                    </div>
                    <div id="cardText">'
                        . $content[1] . 
                    '</div>
                </div>
            </li>');}
            }
            fclose($file);
            ?>
                <!--<li class="ui-state-default">
                <div class="cardContent">default string</div>
            </li>-->
        </ul>
        <br style="clear:both"> </div>
</body>

</html>