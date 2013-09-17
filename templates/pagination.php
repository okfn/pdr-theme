<?php if ($wp_query->max_num_pages > 1) :  ?>
<div class="row">
    <div class="pagination-container container">
        <?php wp_pagenavi(); ?>
    </div>
</div>
<?php endif; ?>