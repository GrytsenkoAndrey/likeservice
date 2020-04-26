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

            {if isset($button)}
                <code>
                    {$button}
                </code>
            {/if}

        </div>
    </section>
</main>