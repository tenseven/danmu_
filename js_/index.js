function setCookie(name, value) {
    var Days = 30;
    var exp = new Date();
    exp.setTime(exp.getTime() + Days * 24 * 60 * 60 * 1000);
    document.cookie = name + "=" + escape(value) + ";expires=" + exp.toGMTString();
}
$("#login").click(function () {
    var user1 = $("#user").val();
    var password = $("#password").val();
    $.ajax({
        type: "POST",
        url: "./login.php",
        data: { user1, password }, //"user1=" + user1 + "&password=" + password,
        dataType: 'JSON',
        success: function (res) {
            if (res.errcode != 0) {
                $("#result-msg").show().html(res.errmsg).fadeOut(2000);
            } else {
                var str = " 这是你的第 " + res.data.number_of_times + " 次登录" +
                    "最近一次登录在 " + res.data.last_login_time;
                $("#result-msg").innerHTML = str;
                setCookie("name", user1);
                window.location.assign("./barrage.html");
            }
        }
    });
});
$("#register").click(function () {
    var user2 = $("#user").val();
    var password1 = $("#password").val();
    var password2 = $("#password1").val();
    $.ajax({
        type: "POST",
        url: "./signup.php",
        data: { user2, password1, password2 },//"user2=" + user2 + "&password1=" + password1+"&password2="+password2,
        dataType: 'JSON',
        success: function (res) {
            if (res.errcode != 0) {
                $("#result-msg").show().html(res.errmsg).fadeOut(2000);
            } else {
                $("#result-msg").show().html("注册成功！").fadeOut(2000);

            }
        }
    });
});

