<h1>Kek in plugin area</h1>
<div class="wrap">
    <p>Here is where the form would go if I actually had options.</p>

    <table class="wp-list-table widefat fixed striped posts">
        <thead>
            <tr>
                <th scope="col" id="date" class="manage-column column-date ">ID</th>
                <th scope="col" id="title" class="manage-column column-title ">Time Start</th>
                <th scope="col" id="title" class="manage-column column-title ">Time End</th>
                <th scope="col" id="author" class="manage-column column-author">User ID</th>
                <th scope="col" id="categories" class="manage-column column-categories">Post ID</th>
                <th scope="col" id="tags" class="manage-column column-tags">URL</th>
            </tr>
        </thead>

        <tbody id="the-list">
            <?php foreach ( $time_stats as $time_stat ) : ?>
                <tr id="post-1" class="iedit author-self level-0 post-1 type-post status-publish format-standard hentry category-uncategorized entry">
                    <td class="title column-title has-row-actions column-primary page-title" data-colname="ID">
                        <strong><?= $time_stat["id"] ?></strong>
                    </td>
                    <td class="title column-title has-row-actions column-primary page-title" data-colname="Date">
                        <span><?= $time_stat["time_start"] ?></span>
                    </td>
                    <td class="author column-author" data-colname="Author">
                        <span aria-hidden="true"><?= $time_stat["time_end"] ?></span>
                    </td>
                    <td class="categories column-categories" data-colname="Categories">
                        <strong><?= $time_stat["user_id"] ?></strong>
                    </td>
                    <td class="tags column-tags" data-colname="Tags">
                        <strong><?= $time_stat["post_id"] ?></strong>
                    </td>
                    <td class="date column-date" ><a href=""><?= $time_stat["url"] ?></a></td>
                </tr>
            <?php endforeach ?>
        </tbody>
        <tfoot>
            <tr>
                <th scope="col" class="manage-column column-date">ID</th>
                <th scope="col" class="manage-column column-title ">Time Start</th>
                <th scope="col" class="manage-column column-title ">Time End</th>
                <th scope="col" class="manage-column column-author">User ID</th>
                <th scope="col" class="manage-column column-categories">Post ID</th>
                <th scope="col" class="manage-column column-tags">URL</th>
            </tr>
        </tfoot>

    </table>

</div>