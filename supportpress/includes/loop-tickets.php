<?php
/**
 * IcarusThemes
 */
 
//global variables
global $itdata, $prth_counter, $tickets_grid_class;
$prth_counter++;

   wp_get_current_user();
    /**
     * @example Safe usage: $current_user = wp_get_current_user();
     * if ( !($current_user instance of WP_User) )
     *     return;
     */
    global $current_user_username;
    global $current_user_id;
        
//get ticket meta
$status = '';
$status = get_post_meta($post->ID, 'prth_ticket_status', true);
if ($status == 'open'){ $status = 'Open'; } if ($status == 'closed'){ $status = 'Closed'; }

$priority = '';
$priority = get_post_meta($post->ID, 'prth_ticket_priority', true);
if ($priority == '1'){ $priority = 'low'; } if ($priority == '2'){ $priority = 'medium'; } if ($priority == '3'){ $priority = 'high'; }


//get the date
$today = date(get_option('date_format'));
$postdate = get_the_date();
$modified = get_the_modified_date();
	
//get the ticket owner
$ownerid = get_post_meta($post->ID, 'prth_ticket_assigned', true);
if ( $ownerid != '') { $assignedname = get_the_author_meta( 'display_name', $ownerid ); } else { $assignedname = '-'; }

//get the ticket requestor
$requestedid = get_post_meta($post->ID, 'prth_ticket_requested', true);
if ( $requestedid != '') { $requestedname = get_the_author_meta( 'display_name', $requestedid ); } else { $requestedname = '-'; }

//get terms
$terms = get_the_terms( get_the_ID(), 'tickets_cats' );
$terms_list = get_the_term_list( get_the_ID(), 'tickets_cats' );

?>

<!-- TABLE ROW -->
<tr data-id="id-<?php echo $prth_counter; ?>" data-type="<?php if($terms) { foreach ($terms as $term) { echo $term->slug .' '; } } else { echo 'none'; } ?>" class="<?php if ($ownerid == $current_user_id){ echo 'warning'; } ?>">
    
		<!-- Ticket PRIORITY -->
		<td class="textaligncenter;"><p class="marginbottom10" class="text-<?php echo $priority;  ?>">
		<?php
			if ($priority == 'low'){ $priority = 'Low'; } if ($priority == 'medium'){ $priority = 'Medium'; } if ($priority == 'high'){ $priority = 'High'; }
		
			echo $priority;
		?>
		</p></td>

		<!-- Ticket TITLE -->
		<td>
        	<span><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></span>
		</td>

		<!-- Ticket Requestor -->
		<td>
			<?php echo $requestedname; ?>
		</td>

		<!-- Ticket Assignee -->
		<td>
			<?php echo $assignedname; ?>
		</td>

		<!-- Ticket Date -->
		<td>
			<p class="muted marginbottom10"><?php echo $modified; ?></p>
		</td>
								
		<td>
		<?php
			echo $terms_list;
		?>
		</td>


</tr><!-- /portfolio-post -->
