var isShow = true;
var fontcolor = "white";
var fontSize = Math.floor(Math.random() * 24) + "px";
$("#white").click(function () {
    fontcolor = "white";
});
$("#red").click(function () {
    fontcolor = "red";
});
$("#blue").click(function () {
    fontcolor = "blue";
});
$("#green").click(function () {
    fontcolor = "green";
});
$("#purple").click(function () {
    fontcolor = "purple";
});
$("#yellow").click(function () {
    fontcolor = "yellow";
});
$("#sm").click(function () {
    fontSize = "10px";
});
$("#s").click(function () {
    fontSize = "15px";
});
$("#m").click(function () {
    fontSize = "20px";
});
$("#l").click(function () {
    fontSize = "25px";
});

$(".clear").on("click", function () {
    if (isShow) {
        $(".bullet").css("opacity", 0);
        isShow = false;
    } else {
        $(".bullet").css("opacity", 1);
        isShow = true;
    }
});
function createBarrage(text) {
    var jqueryDom = $("<div class='bullet'>" + text + "</div>");
    var left = $(".screen_container").width() + "px";
    var up = Math.random() * 180 + "px";
    jqueryDom.css({
        "position": 'absolute',
        "color": fontcolor,
        "font-size": fontSize,
        "left": left,
        "top": up,
        "white-space": 'nowrap',
    });
    $(".screen_container").append(jqueryDom);
    return jqueryDom;
}
function addInterval(jqueryDom) {
    var left = jqueryDom.offset().left - $(".screen_container").offset().left;
    var timer = setInterval(function () {
        left--;
        jqueryDom.css("left", left + "px");
        if (jqueryDom.offset().left + jqueryDom.width() < $(".screen_container").offset().left) {
            jqueryDom.remove();
            clearInterval(timer);
        }
    }, 10);

}