/**
 * Created by APG on 25.04.2020.
 */


/**
 * показываем форму входа
 */
function showRegisterForm()
{
    $('#registerForm').show();
    $('#loginForm').hide();
}

/**
 * показываем форму входа
 */
function showLoginForm()
{
    $('#loginForm').show();
    $('#registerForm').hide();
}

/**
 * сравниваем пароль при добавлении нового пользователя
 */
function comparePass()
{
    var p1 = document.getElementById('regpassword1');
    var p2 = document.getElementById('regpassword2');

    if ( (p1.value.length > 0) && (p2.value.length > 0) ) {
        if (p1.value != p2.value) {
            $('#info').show();
        } else {
            $('#info').hide();
        };
    };

}


/**
 * сбор данных о пользователе и странице
 *
 */
function dataPrepare()
{
    // page address
    var pageUrl = String(window.location);
    // page title
    var pageTitle = document.getElementsByTagName('title');

    console.log(pageTitle[0].innerHTML);

    $.getJSON('https://ipinfo.io', function(data){
        console.log(data)
    });

}
/*
$.ajax({
    url:'http://freegeoip.net/json/'
    type:'get',
    dataType:'json'
}).done(function(data) {
    alert(data.ip);
});
*/