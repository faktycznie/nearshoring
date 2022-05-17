<?php

$contact_box = get_field('contact_box', 'option');
if( !empty($contact_box) ) {

	foreach($contact_box as $contact) {
		$contact_box_id = $contact->ID;

		$contact_name = get_the_title( $contact_box_id );
		$contact_subtitle = get_field('team_position', $contact_box_id);
		$contact_email = get_field('team_email', $contact_box_id);
		$contact_phone = get_field('team_phone', $contact_box_id);
		$contact_link = get_field('team_external_link', $contact_box_id);
?>
	<div class="contact-box">
		<div class="contact-box__name">
			<?php if($contact_link) { ?>
			<a href="<?php echo $contact_link; ?>" target="_blank">
			<?php } ?>
				<?php echo $contact_name; ?>
			<?php if($contact_link) { ?>
			</a>
			<?php } ?>
		</div>
		<?php if($contact_subtitle) { ?>
		<div class="contact-box__subtitle"><?php echo $contact_subtitle; ?></div>
		<?php } ?>
		<?php if($contact_phone) { ?>
		<a href="tel:<?php echo str_replace(' ' , '', $contact_phone); ?>" class="contact-box__phone"><span class="contact-box__label">tel:</span> <?php echo str_replace('+48' , '<span class="smaller">+48</span>', $contact_phone); ?></a>
		<?php } ?>
		<?php if($contact_email) { ?>
		<a href="mailto:<?php echo $contact_email; ?>" class="contact-box__mail"><span class="contact-box__label">mail:</span> <?php echo $contact_email; ?></a>
		<?php } ?>
	</div>
<?php 
	}
} ?>