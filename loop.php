<?php // General loop including Asides goes here
if(!is_home() && !get_tarski_option('use_pages')) {
	$posts = query_posts($query_string . '&nopaging=1');
}
while (have_posts()) { the_post(); ?>
	
	<?php if(get_tarski_option('asidescategory') && in_category(get_tarski_option('asidescategory'))) { // Aside loop ?>
		
		<div class="aside" id="p-<?php the_ID(); ?>">
			<div class="content"><?php the_content(__('Read the rest of this entry &raquo;','tarski')); ?></div>
			<p class="meta"><span class="date"><?php echo tarski_date(); ?></span><?php tarski_author_posts_link(); ?> | <a class="comments-link" href="<?php the_permalink(); ?>"><?php if($post->comment_status == 'open' || $post->comment_count > 0) { comments_number(__('No comments','tarski'), __('1 comment','tarski'), '%' . __(' comments','tarski')); } else { _e('Permalink', 'tarski'); } ?></a><?php edit_post_link(__('edit','tarski'), ' (', ')'); ?></p>
		</div>
		
	<?php } else { // Non-Aside loop ?>
	
		<div class="entry">
			<div class="meta">
				<h2 class="title" id="post-<?php the_ID(); ?>"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php _e('Permanent Link to ','tarski'); the_title(); ?>"><?php the_title(); ?></a></h2>
				<p class="metadata"><?php echo '<span class="date">'. tarski_date(). '</span>';
				if(!get_tarski_option('hide_categories')) { echo __(' in ','tarski'). '<span class="categories">'; the_category(', '); echo '</span>'; }
				tarski_author_posts_link();
				if($post->comment_status == 'open' || $post->comment_count > 0) { echo ' | '; comments_popup_link(__('No comments', 'tarski'), __('1 comment', 'tarski'), '%' . __(' comments', 'tarski'), 'comments-link', __('Comments closed', 'tarski')); }
				edit_post_link(__('edit', 'tarski'),' <span class="edit">(',')</span>'); ?></p>
			</div>
			<div class="content">
				<?php the_content(__('Read the rest of this entry &raquo;','tarski')); ?>
			</div>
			<?php link_pages_without_spaces(); ?>
		</div>
		
	<?php } ?>
	
	<?php th_postend(); ?>
<?php } // End entry loop ?>