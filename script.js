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
    //$('#registerForm').fadeIn(1000);
}

/**
 * показываем форму входа
 */
function showLoginForm()
{
    $('#loginForm').show();
    $('#registerForm').hide();
    //$('#loginForm').fadeIn(1000);
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