<main class="container">
    <section class="row">
        <div class="col-xs-12">
            <h1>Hello {$activeUser} /{$role}/</h1>
            <a href="/user/logout/">Logout</a>

            {if isset($rsData)}
                {if count($rsData) > 0}
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col"># ID</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Role</th>
                    <th scope="col">Edit</th>
                </tr>
                </thead>
                <tbody>
                {foreach $rsData as $item}
                <tr>
                    <th scope="row">{$item['id']}</th>
                    <td><a href="/user/data/id/{$item['id']}/" title="Details">{$item['userName']}</a></td>
                    <td>{$item['role']}</td>
                    <td><a href="/user/edit/id/{$item['id']}/" title="Edit {$item['userName']}">Edit</a></td>
                </tr>
                {/foreach}
                </tbody>
            </table>
                {/if}
            {/if}

            {if isset($userId)}
                <pre>
                <code>
                &lsaquo;script&rsaquo;
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
                &lsaquo;/script&rsaquo;
                    &lsaquo;a href="" onclick="dataPrepare({$userId}); return false;"&rsaquo;Like&lsaquo;/a&rsaquo;&lsaquo;span&rsaquo; id="likeCnt"&lsaquo;/span&rsaquo;
                </code>
                    <pre>
            {/if}

            {if isset($rsVotes)}
                {if count($rsVotes) > 0}
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">E-mail</th>
                            <th scope="col">Page info</th>
                            <th scope="col">Quantity</th>
                        </tr>
                        </thead>
                        <tbody>
                        {foreach $rsVotes as $item}
                            <tr>
                                <td>{$item['email']}</td>
                                <td><a href="/like/detail/id/{$item['id']}/" title="Like details">{$item['page_info']}</a></td>
                                <td>{$item['quantity']}</td>
                            </tr>
                        {/foreach}
                        </tbody>
                    </table>
                {/if}
            {/if}
        </div>
    </section>
</main>