<div class="p-comment">
    <?php if (have_comments()): ?>
        <h2 id="comments" class="p-comment__ttl">Comment</h2>
        <ul class="p-comment__list">
            <?php wp_list_comments('avatar_size=60'); ?>
        </ul>

        <?php
        // コメントのページネーションを追加
        the_comments_pagination(array(
            'prev_text' => '&larr; ' . __('前へ', 'wpbeg'),
            'next_text' => __('次へ', 'wpbeg') . ' &rarr;',
            'mid_size'  => 1,
            'screen_reader_text' => __('コメントナビゲーション', 'wpbeg'),
            'class' => 'p-comment__pagination',
        ));
        ?>
    <?php endif; ?>
    <?php
    $args = array(
        'title_reply' => 'Leave a Reply',
        'label_submit' => ' POST COMMENT',
    );
    comment_form($args);
    ?>
</div>