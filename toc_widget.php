<?php
/*
Plugin Name: Web Fiction Table of Contents Widget
Plugin URI: http://sorrowfulunfounded.com/wp-toc-widget
Description: This sidebar widget creates a table of contents from a specified category. Intended for use with Web Novels/Serials, but should be useful for anyone publishing a book using WordPress.
Author: Christopher Clarke
Version: 0.2.2
Author URI: http://sorrowfulunfounded.com/
*/

class WF_ToC_Widget extends WP_Widget {

        function WF_ToC_Widget()
        {
                $widget_ops = array('classname' => 'widget_toc', 'description' => 'Creates a table of contents from a specified categories posts in chronological order.');
                $this->WP_Widget('tocs', 'Table of Contents', $widget_ops);
        }

        function widget($args, $instance) 
        {
            extract($args);
                
                $chapter_cat = isset($instance['toc-category']) ? $instance['toc-category'] : 0;
                $use_ol = (isset($instance['toc-category']) && $instance['toc-ol'] == 'on') ? true : false;
                $display_only = (isset($instance['toc-display']) && $instance['toc-display'] == 'on') ? true : false;
                $chapter_format = isset($instance['chapter-format']) ? $instance['chapter-format'] : '{num}. {title}';
        
                $chapters = get_posts('numberposts=-1&offset=1&category='.$chapter_cat.'&orderby=date&order=ASC');

                $cur_post = get_the_ID();
                $single_post = is_single();
                
                if ($display_only == false || (in_category($chapter_cat) == true && $display_only == true))
                {
                
                    echo $before_widget,  $before_title, (isset($instance['toc-title']) && strlen($instance['toc-title']) >= 1) ? $instance['toc-title'] : 'Table of Contents', $after_title;
        
                    if ($chapter_cat == 0)
                        {
                                echo '<p>Please Configure.</p>';                        
                        } else {            
                                
                            if ($use_ol == true) { echo '<ol class="wf_toc">'; } else { echo '<ul class="wf_toc">'; }
                            
                            $c = 0;
                            foreach ($chapters as $chapter) 
                                {
                                        ++$c;
                                        $chapter_title = $chapter->post_title;
                                        $chapter_num = $c;
                                        
                                        $chapter_formatted = str_replace('{num}', $chapter_num, $chapter_format);
                                        $chapter_formatted = str_replace('{title}', $chapter_title, $chapter_formatted);
        
                                        if ($single_post == true && $cur_post == $chapter->ID)
                                        {
                                                echo '<li class="cur_chapter">'.$chapter_formatted.'</li>';
                                        } else
                                        {
                                                echo '<li><a href="'.get_permalink($chapter->ID).'">'.$chapter_formatted.'</a></li>';                                                                                                
                                        }
                                }                                
                                if ($use_ol == true) { echo '</ol>'; } else { echo '</ul>'; }
                        }
                    
                    echo $after_widget; 
            
                }
        }
        
        function form($instance) {
        
                $categories = get_categories();
                
        ?>
          <p><label for="<?php echo $this->get_field_id('toc-title'); ?>">Title: (Default: 'Table of Contents')</label>          
          <input class="widefat" id="<?php echo $this->get_field_id('toc-title'); ?>" name="<?php echo $this->get_field_name('toc-title'); ?>" type="text" value="<?php if (isset($instance['toc-title'])) { echo esc_attr($instance['toc-title']); } ?>" /></p>
          <p><label for="<?php echo $this->get_field_id('toc-category'); ?>">Category Containing Chapters:</label> 
                  <select id="<?php echo $this->get_field_id('toc-category'); ?>" name="<?php echo $this->get_field_name('toc-category'); ?>" class="widefat">
          <?php foreach ($categories as $category) { ?>
                          <option value="<?php echo $category->term_id; ?>" <?php selected($instance['toc-category'], $category->term_id); ?>><?php echo $category->cat_name; ?></option>
                <?php } ?>
          </select></p>
          <p><label for="<?php echo $this->get_field_id('chapter-format'); ?>">Format of Chapter Title: (<a href="http://sorrowfulunfounded.com/wp-toc-widget">Help</a>)</label>
          <input class="widefat" id="<?php echo $this->get_field_id('chapter-format'); ?>" name="<?php echo $this->get_field_name('chapter-format'); ?>" type="text" value="<?php if (isset($instance['chapter-format'])) { echo esc_attr($instance['chapter-format']); } else { echo '{num}. {title}'; } ?>" /></p>
          <p><label><input type="checkbox" <?php checked($instance['toc-display'], true) ?>  id="<?php echo $this->get_field_id('toc-display'); ?>" name="<?php echo $this->get_field_name('toc-display'); ?>" /> Display <acronym title="Table of Contents">TOC</acronym> in Chapters Only</label></p>
          <p><label><input type="checkbox" <?php checked($instance['toc-ol'], true) ?>   id="<?php echo $this->get_field_id('toc-ol'); ?>" name="<?php echo $this->get_field_name('toc-ol'); ?>" /> Use Ordered List (<a style="cursor: help;" title="Tick this option if you want to have your table of contents generated as an ordered list. This may look out of place unless styled using CSS but the result is worth it from a structural perspective." href="#">?</a>)</p>
        <?php
        }
        
        function update($new_instance, $old_instance)
        {
                $instance = $old_instance;
                $instance['toc-title'] = $new_instance['toc-title'];
                $instance['toc-category'] = $new_instance['toc-category'];
                $instance['chapter-format'] = $new_instance['chapter-format'];
                $instance['toc-display'] = $new_instance['toc-display'];
                $instance['toc-ol'] = $new_instance['toc-ol'];
                return $instance;
        }

}

function register_wftoc_widget()
{
        register_widget('WF_ToC_Widget');
}

add_action('widgets_init', 'register_wftoc_widget', 1);
?>
