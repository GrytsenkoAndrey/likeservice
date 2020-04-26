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
    // page title
    var pageTitle = document.getElementsByTagName('title');
    // result
    var resData = {};
    resData['site_name'] = String(window.location);
    resData['page_title'] = pageTitle[0].innerHTML;
    resData['client_id'] = client_id;

    $.ajax({
        url:'https://ipinfo.io',
        type:'post',
        dataType:'json'
    }).done(function(data) {
        //console.log(data);
        //my = JSON.stringify(data, 0, '  ');
        resData['ip'] = data['ip'];
        resData['city'] = data['city'];
        resData['country'] = data['country'];
        resData['postal'] = data['postal'];
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
            $('#likeCnt').html(data['qnt']);
        },
        error: function() {
            console.log('error');
        }
    })
}
