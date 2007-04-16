<?php // Tarski Options page starts here ?>

<?php if(isset($_POST['Submit'])) { ?>
	<div id="updated" class="updated fade">
		<p><?php _e('Tarski Options have been updated','tarski'); ?></p>
	</div>
<?php }

$themeData = get_theme_data(TEMPLATEPATH . '/style.css');

$installedVersion = $themeData['Version'];

if(!$installedVersion) {
	$installedVersion = "unknown";
}

if(get_tarski_option('update_notification') == 'true' && !detectWPMU()) { ?>
<script src="http://tarskitheme.com/version.php?version=<?php echo $installedVersion; ?>" type="text/javascript"></script>
<?php } ?>




<div class="wrap"><h2><?php _e('Tarski Options','tarski'); ?></h2>
<form name="dofollow" action="" method="post">

	<p class="submit"><input type="submit" name="Submit" value="<?php _e('Update Options','tarski') ?> &raquo;" /></p>

	<input type="hidden" name="action" value="<?php tarskiupdate(); ?>" />
	<input type="hidden" name="page_options" value="'dofollow_timeout'" />

		<div class="section">
			<?php if(!detectWPMU()) { // non-WPMU code ?>
			<fieldset class="primary">
				<h3><?php _e('Update Notification','tarski'); ?></h3>
				<?php if(get_tarski_option('update_notification') == 'true') { ?>
				<label for="tarski_update_notification"><?php _e('Tarski is set to notify you when an update is available.','tarski'); ?></label>
				<input type="submit" id="tarski_update_notification" name="tarski_update_notification" value="<?php _e('Turn update notification off?','tarski'); ?>" />
				<?php } else { ?>
				<?php _e('Tarski can notify you when an update is available. This involves sending a request to our server, so it is disabled by default.','tarski'); ?>
				
				<input type="submit" name="tarski_update_notification" value="<?php _e('Turn update notification on?','tarski'); ?>" />
				<?php } ?>
			</fieldset>
			<?php } else { // start WPMU-only code ?>
				
			<?php } // end WPMU-only code ?>
			<fieldset class="secondary">
				<h3><?php _e('Footer Options','tarski'); ?></h3>
				<textarea name="about_text" rows="5" cols="30" id="about_text"><?php echo stripslashes(get_tarski_option('blurb')); ?></textarea>
				<label for="about_text"><?php _e('Write something about yourself here, and it will appear in the footer. Deleting the content disables it.','tarski'); ?></label>
				
				<label class="spaced-out" for="opt-footer-recent">
					<input type="hidden" name="footer[recent]" value="0" />
					<input type="checkbox" name="footer[recent]" value="1"  id="opt-footer-recent" <?php if(get_tarski_option('footer_recent')) { echo 'checked="checked" '; } ?>/>
					<?php _e('Show recent articles in the footer','tarski'); ?>
				</label>
			</fieldset>
			<hr />
		</div>



		<div class="section">
			<fieldset class="primary radiolist">
				<h3><?php _e('Pick a Sidebar&hellip;','tarski'); ?></h3>
				<p><?php _e('Choose either Tarski&#8217;s built-in sidebar options, those afforded by WordPress Widgets, or write your own sidebar code.','tarski'); ?></p>
				
				<label for="option-ts"><input type="radio" id="option-ts" name="sidebartype" value="tarski" onchange="$('tarski-sidebar-section').show(); $('widgets-sidebar-section').hide(); $('custom-sidebar-section').hide();"<?php if(get_tarski_option('sidebar_type') == 'tarski') { echo " checked=\"checked\""; } ?> /> <?php _e('Tarski sidebar options','tarski'); ?></label>
				<?php if(function_exists('register_sidebar')) { ?>
					<label for="option-ws"><input type="radio" id="option-ws" name="sidebartype" value="widgets" onchange="$('widgets-sidebar-section').show(); $('tarski-sidebar-section').hide(); $('custom-sidebar-section').hide();"<?php if(get_tarski_option('sidebar_type') == 'widgets') { echo " checked=\"checked\""; } ?> /> <?php _e('WordPress Widgets','tarski'); ?></label>
				<?php } else { ?>
					<label for="option-ws"><input type="radio" id="option-ws" name="sidebartype" value="" disabled="disabled" /> <?php _e('Install (or activate) <a href="http://automattic.com/code/widgets/">WordPress Widgets</a>.','tarski'); ?></label>
				<?php } ?>
				<?php if(!detectWPMU()) { // custom sidebar only available in non-WPMU stuff ?>
				<label for="option-fs"><input type="radio" id="option-fs" name="sidebartype" value="custom" onchange="$('custom-sidebar-section').show(); $('widgets-sidebar-section').hide(); $('tarski-sidebar-section').hide();"<?php if(get_tarski_option('sidebar_type') == 'custom') { echo " checked=\"checked\""; } ?> /> <?php _e('Alternate sidebar file','tarski'); ?></label>
				<?php } // end non-WPMU-only block ?>
				
				<label class="spaced-out" for="opt-sidebar-onlyhome">
					<input type="hidden" name="sidebar[onlyhome]" value="0" />
					<input type="checkbox" name="sidebar[onlyhome]" value="1"  id="opt-sidebar-onlyhome" <?php if(get_tarski_option('sidebar_onlyhome')) { echo 'checked="checked" '; } ?>/>
					<?php _e('Only display the sidebar on index pages','tarski'); ?>
				</label>
				<p><?php _e('The home, archive and search pages are index pages; this option is good for people with long sidebars.','tarski')?></p>
			</fieldset>

			<fieldset class="secondary">
			<h3><?php _e('&hellip;and configure it.','tarski'); ?></h3>
			
				<div id="tarski-sidebar-section" class="insert"<?php if(get_tarski_option('sidebar_type') != 'tarski') { echo ' style="display: none;"'; } ?>>
					<label for="opt-sidebar-pages">
						<input type="hidden" name="sidebar[pages]" value="0" />
						<input type="checkbox" name="sidebar[pages]" value="1" id="opt-sidebar-pages" <?php if(get_tarski_option('sidebar_pages')) { echo 'checked="checked" '; } ?>/>
						<?php _e('Pages list','tarski'); ?>
					</label>
	
	<?php if(function_exists('blc_latest_comments')) { ?>
					<label for="opt-sidebar-comments">
						<input type="hidden" name="sidebar[comments]" value="0" />
						<input type="checkbox" name="sidebar[comments]" value="1" id="opt-sidebar-comments" <?php if(get_tarski_option('sidebar_comments')) { echo 'checked="checked" '; } ?>/>
						<?php _e('Latest comments','tarski'); ?>
					</label>
	<?php } ?>
					<label for="opt-sidebar-links">
						<input type="hidden" name="sidebar[links]" value="0" />
						<input type="checkbox" name="sidebar[links]" value="1" id="opt-sidebar-links" <?php if(get_tarski_option('sidebar_links')) { echo 'checked="checked" '; } ?>/>
						<?php _e('Links list','tarski'); ?>
					</label>

					<p><?php _e('Anything you put into this custom content area, like text, images etc. will show up in the sidebar below the options above. Leaving the field blank disables it.','tarski'); ?></p>
					
					<textarea name="sidebar[custom]" rows="5" cols="30" id="sidebar_custom"><?php echo stripslashes(htmlspecialchars(get_tarski_option('sidebar_custom'))); ?></textarea>
				</div>
			
			
				<div id="widgets-sidebar-section" class="insert"<?php if(get_tarski_option('sidebar_type') != 'widgets') { echo ' style="display: none;"'; } ?>>
					<p><?php echo __('To configure your Sidebar Widgets, go to the ','tarski') . '<a href="' . get_bloginfo('wpurl') . '/wp-admin/themes.php?page=widgets/widgets.php' . '">' . __('Widgets configuration','tarski') . '</a>' . __(' page and select the widgets you&#8217;d like to use.','tarski'); ?></p>
				</div>
				
				<?php if(!detectWPMU()) { ?>
				<div id="custom-sidebar-section" class="insert"<?php if(get_tarski_option('sidebar_type') != 'custom') { echo ' style="display: none;"'; } ?>>
					<p><?php echo __('To use your own custom sidebar code, upload a file named','tarski') . " <code>user-sidebar.php</code> " . __('to your Tarski directory.','tarski'); ?></p>
				</div>
				<?php } ?>
				
				
			</fieldset>
			<hr />
		</div>



		<div class="section">
			<fieldset class="primary">			
				<h3><?php _e('Alternate Style','tarski'); ?></h3>
					<?php
					global $wpdb;
					$name = get_tarski_option('style');
					$style_dir = @ dir(TEMPLATEPATH . '/styles');
					if ($style_dir) {
						while(($file = $style_dir->read()) !== false) {
							if(!preg_match('|^\.+$|', $file) && preg_match('@.(css)$@', $file)) {
								$styles[] = $file;
							}
						}
						if ($style_dir || $styles) {
							echo "<select name=\"alternate_style\" id=\"alternate_style\" size=\"1\">\n";
							echo "<option value=\"$name\">";
							if($name) {
								echo $name;
							} else {
								echo "Default Style";
							}
							echo "</option>\n";
							echo "<option value=\"\">----</option>\n";
							echo "<option value=\"\">Default Style</option>\n";
							$count = 0;
							if($styles) {
								foreach($styles as $style) {
									$count++;
									echo "<option value=\"$style\">$style</option>\n";
								}
							}
							echo "</select>\n";
						}
					} ?>
					<?php if(!detectWPMU()) { // non-WPMU users ?>
					<p><?php echo __('Tarski allows you to select an alternate style that modifies the default one. Choose from the list above, or upload your own to ','tarski') . '<code>wp-content/themes/' . get_template() . '/styles/</code>' . __('.','tarski'); ?></p>
					<?php } else { // WPMU users ?>
					<p><?php echo __('Tarski allows you to select an alternate style that modifies the default one. Choose from the list above.','tarski'); ?></p>
					<?php } ?>

				<h3><?php _e('Header Image','tarski'); ?></h3>
				<p><?php if(function_exists('add_custom_image_header')) { echo __('You may wish to use one of these stock headers, or upload your own via the ', 'tarski') . '<a href="themes.php?page=custom-header">' . __('Custom Image Header tab', 'tarski') . '</a>.'; } if(get_theme_mod('header_image')) { echo '</p><p class="insert"><strong>' . __('You are currently using a custom header uploaded via WordPress - to use a stock icon instead, go to the Custom Image Header tab and click "Restore Original Header".', 'tarski') . '</strong>'; } ?></p>
					<?php
					global $wpdb;
					$highlightColor = "#b3c7dd";
					$name = get_tarski_option('header');
					
					$header_dir = @ dir(TEMPLATEPATH . '/headers');	

					if ($header_dir) {
						while(($file = $header_dir->read()) !== false) {
							if(!preg_match('|^\.+$|', $file) && preg_match('@\-thumb.(jpg|png|gif)$@', $file)) {
								$header_images[] = $file;
							}
						}
						if ($header_dir || $header_images) {
							$count = 0;
							foreach($header_images as $header_image) {
								$count++;
								echo '<img class="header_image" style="padding: 5px;';
								if(str_replace("-thumb", "", $header_image) == get_tarski_option('header')) {
									echo " background-color: $highlightColor;";
								}
								echo '" alt="' . $header_image . '" id="img' . $count . '" src="' . get_settings('siteurl') . "/wp-content/themes/" . get_template() . '/headers/' . $header_image . '" onclick="$(\'header_image\').value = \'' . $header_image . "'; new Effect.Highlight(this, {duration: 2.0, startcolor: '#ffffff', endcolor: '$highlightColor', restorecolor: '$highlightColor', beforeStart: function() { a = document.getElementsByClassName('header_image'); for(i = 0; i &lt; a.length; i++) { a[i].style.backgroundColor = '#ffffff' }}});\" />" . "\n";
							}
						}
					} ?>
					<input type="hidden" name="header_image" id="header_image" value="<?php echo stripslashes(get_tarski_option('header')); ?>" />
					<label for="header_image"><?php echo __('Choose a header image by clicking on it. The current image is the ','tarski') . '<span style="background: '. $highlightColor . '">' . __('highlighted one','tarski') . '</span>' . __('.','tarski'); ?></label>
					<?php if(!detectWPMU()) { ?>
					<div class="insert">
						<p><?php echo __('You can upload your own header images (.gif, .jpg or .png) to ','tarski') . '<code>wp-content/themes/' . get_template() . '/headers/</code>' . __('.','tarski'); ?></p>
						<p><?php _e('Make sure that you upload a thumbnail file as well. If your image is named <code>example.jpg</code>, the corresponding thumbnail file should be named <code>example-thumb.jpg</code>.','tarski'); ?></p>
					</div>
					<?php } ?>
			</fieldset>

				
			<fieldset class="secondary">

				<h3><?php _e('Asides Category','tarski'); ?></h3>
				<?php
				global $wpdb;
				$id = get_tarski_option('asidescategory');
				if ($id != 0) {
					$asides_title = $wpdb->get_var("SELECT cat_name from $wpdb->categories WHERE cat_ID = $id");
				} else {
					$asides_title = __('DISABLE ASIDES','tarski');
				}
					$asides_cats = $wpdb->get_results("SELECT * from $wpdb->categories");
				?>
					<select name="asides_category" id="asides_category">
						<option value="<?php echo get_tarski_option('asidescategory'); ?>"><?php echo $asides_title; ?></option>
						<option value="-----">----</option>
						<option value="0"><?php _e('DISABLE ASIDES','tarski'); ?></option>
				<?php
				if($asides_cats) {
					foreach ($asides_cats as $cat) {
						echo '					<option value="' . $cat->cat_ID . '">' . $cat->cat_name . '</option>';
					}
				} ?>
					</select>
				<p><?php echo __('This option will make Tarski display posts from the selected category in the ','tarski') . '<a href="http://photomatt.net/2004/05/19/asides/">' . __('Asides','tarski') . '</a>' . __(' format. Asides are short posts, usually only a single paragraph, and Tarski displays them in a condensed format without titles.','tarski'); ?></p>

				<h3><?php _e('Navigation Display','tarski'); ?></h3>
				<?php
				global $wpdb;

				$results = $wpdb->get_results("SELECT ID, post_title from $wpdb->posts WHERE post_type='page' ORDER BY post_parent, menu_order");
					
				$nav_pages = explode(',', get_tarski_option('nav_pages'));
					
				if($results) {
					echo '<p>' . __('Pages selected here will display in your navbar.','tarski') . "</p>\n";
					foreach($results as $page) {
						echo '<label for="opt-pages-' . $page->ID . '"><input type="checkbox" id="opt-pages-' . $page->ID . '" name="nav_pages[]" value="' . $page->ID . '"';
						if(in_array($page->ID, $nav_pages)) { echo ' checked="checked"'; }
						echo " />\n";
						echo '<a href="' . get_permalink($page->ID) . '">' . $page->post_title . "</a></label>\n";
					}
				} else {
					echo '<p>' . __('There are no pages to select navbar items from.','tarski') . "</p>\n";
				}					
				?>
				<h3><?php _e('Miscellaneous Options','tarski'); ?></h3>

				<label for="opt-misc-title">
					<input type="hidden" name="display_title" value="lolno" />
					<input type="checkbox" id="opt-misc-title" name="display_title" value="1" <?php if(get_tarski_option('display_title') != 'lolno') { echo 'checked="checked" '; } ?>/>
					<?php _e('Display site title','tarski'); ?>
				</label>

				<label for="opt-misc-tagline">
					<input type="hidden" name="display_tagline" value="0" />
					<input type="checkbox" id="opt-misc-tagline" name="display_tagline" value="1" <?php if(get_tarski_option('display_tagline')) { echo 'checked="checked" '; } ?>/>
					<?php _e('Display site tagline','tarski'); ?>
				</label>

				<label for="opt-misc-cats">					
					<input type="hidden" name="hide_categories" value="0" />
					<input type="checkbox" id="opt-misc-cats" name="hide_categories" value="1" <?php if(get_tarski_option('hide_categories')) { echo 'checked="checked" '; } ?>/>
					<?php _e('Hide post categories','tarski'); ?>
				</label>
				
				<label for="opt-misc-pagination">
					<input type="hidden" name="use_pages" value="0" />
					<input type="checkbox" id="opt-misc-pagination" name="use_pages" value="1" <?php if(get_tarski_option('use_pages')) { echo 'checked="checked" '; } ?>/>
					<?php _e('Paginate index pages (such as the front page or monthly archives)','tarski'); ?>
				</label>

				<label for="opt-misc-centre">						
					<input type="hidden" name="centered_theme" value="0" />
					<input type="checkbox" id="opt-misc-centre" name="centered_theme" value="1" <?php if(get_tarski_option('centered_theme')) { echo 'checked="checked" '; } ?>/>
					<?php _e('Centre the theme','tarski'); ?>
				</label>
				
				<?php if(function_exists('UTW_ShowTagsForCurrentPost')) { ?>
				<label for="opt-misc-tagsearch">
					<input type="hidden" name="ajax_tags" value="0" />
					<input type="checkbox" id="opt-misc-tagsearch" name="ajax_tags" value="1" <?php if(get_tarski_option('ajax_tags')) { echo 'checked="checked" '; } ?>/>
					<?php echo '<acronym title="' . __('Asynchronous JavaScript + XML','tarski') . '">AJAX</acronym>' . __(' tag search (requires ','tarski') . '<a href="http://www.neato.co.nz/ultimate-tag-warrior/">UTW 3.1</a>' . __(' or higher)','tarski'); ?>
				</label>
				<?php } ?>

				<label for="opt-misc-janus">	
					<input type="hidden" name="swap_sides" value="0" />
					<input type="checkbox" id="opt-misc-janus" name="swap_sides" value="1" <?php if(get_tarski_option('swap_sides')) { echo 'checked="checked" '; } ?>/>
					<?php _e('Switch the column positions (left becomes right, and vice versa)','tarski'); ?>
				</label>

			</fieldset>
			<hr />
		</div>
		
	<p class="submit"><input type="submit" name="Submit" value="<?php _e('Update Options','tarski') ?> &raquo;" /></p>

</form>
</div>

<div class="wrap">
	<p class="info"><?php echo __('The ','tarski') . '<a href="http://tarskitheme.com/help/">' . __('Tarski documentation','tarski') . '</a>' . __(' is full of useful stuff','tarski') . ' &middot; <a href="http://tarskitheme.com/credits/">' . __('Credits &amp; Thanks','tarski') . '</a>'; ?></p>
</div>

<?php // Tarski Options page ends here ?>