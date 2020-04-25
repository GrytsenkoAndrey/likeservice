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
function dataPrepare(client_id)
{
    // page address
    var pageUrl = String(window.location);
    // page title
    var pageTitle = document.getElementsByTagName('title');
    // client id
    var clientId = client_id;
    // result
    var resData = {};
    resData['site_name'] = pageUrl;
    resData['page_title'] = pageTitle[0].innerHTML;
    resData['client_id'] = clientId;

    $.getJSON('https://ipinfo.io', function(data){
        //console.log(data)
        resData['ip'] = data['ip'];
        resData['city'] = data['city'];
        resData['country'] = data['country'];
        resData['post'] = data['postal'];
    });

    console.log(resData);

    $.ajax({
        type:'POST',
        async:true,
        url:'/like/process/',
        data:resData,
        dataType:'json',
        success: function(data) {
            console.log(data);
        },
        error: function() {
            console.log('error');
        }
    })
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