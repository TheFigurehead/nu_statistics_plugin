<div>
    <h1>Kek for Serg</h1>

    <div id="app"></div>

    <div class="tabs_button">
        <div class="tabs_list">
            <?php $tabs = apply_filters('nu_stat_tabs_button', array()); ?>
            <ul>
                <?php foreach($tabs as $key => $tab): ?>
                    <li class="" data-id="<?=$key?>">
                        <a href="<?=admin_url(sprintf('admin.php?page=%s&tab=%s', 'nu-user-statistic', $key))?>">
                            <?=$tab?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <div class="tabs_content">
        <?php $contents = apply_filters('nu_stat_tabs_content', array()); ?>
        <?php $first = true; foreach($contents as $key => $content): ?>
            <div class="tabs_content_item <?php echo (($_GET['tab'] == $key) || (!$_GET['tab'] && $first)) ? ' active' : ''; ?>" id="<?=$key?>">
                <?=$content?>
            </div>
        <?php $first = false; endforeach; ?>
    </div>
</div>

<style>
.tabs_content_item{
    display: none;
}
.tabs_content_item.active{
    display: block;
}
</style>