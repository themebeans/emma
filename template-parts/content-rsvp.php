<?php
/**
 * The file is for displaying the blog post after content.
 * This has it's own content file because we call it among various post formats.
 * If you edit this file, its output will be edited on all post formats.
 *
 * @package     Emma
 * @link        https://themebeans.com/themes/emma
 */

if ( ! post_password_required() ) {

	// CONTACT FORM
	if ( isset( $_POST['submitted'] ) ) {
		if ( trim( $_POST['contactName'] ) === '' ) {
			$hasError = true;
		} else {
			$name = trim( $_POST['contactName'] );
		}

		if ( trim( $_POST['contactNameLast'] ) === '' ) {
			$hasError = true;
		} else {
			$lastname = trim( $_POST['contactNameLast'] );
		}

		if ( trim( $_POST['contactRSVP'] ) === '' ) {
			$hasError = true;
		} else {
			$rsvp = trim( $_POST['contactRSVP'] );
		}

		$plusone_first = trim( $_POST['contactNamePlusOne'] );
		$plusone_last  = trim( $_POST['contactNameLastPlusOne'] );

		if ( trim( $_POST['email'] ) === '' ) {
			$hasError = true;
		} elseif ( ! is_email( trim( $_POST['email'] ) ) ) {
			$hasError = true;
		} else {
			$email = trim( $_POST['email'] );
		}

		$comments = trim( $_POST['comments'] );

		do_action( 'bean_after_contactform_errors' );

		if ( ! isset( $hasError ) ) {

			 $site_name   = get_bloginfo( 'name' );
			$contactEmail = get_theme_mod( 'contact_email' );

			if ( ! isset( $contactEmail ) || ( $contactEmail == '' ) ) {
				$contactEmail = get_option( 'admin_email' );
			}

			$subject_content = '[' . $site_name . ' RSVP Form]';
			$subject         = apply_filters( 'bean_contactform_emailsubject', $subject_content );

			$body_content = "First Name: $name $lastname \n\nEmail: $email \n\nRSVP Status: $rsvp \n\nPlus One: $plusone_first $plusone_last \n\nMessage: $comments";
			$body         = apply_filters( 'bean_contactform_emailbody', $body_content );



			$headers = 'Reply-To: ' . $email;
			/*
			By default, this form will send from wordpress@yourdomain.com in order to work with
			a number of web hosts' anti-spam measures. If you want the from field to be the
			user sending the email, please uncomment the following line of code.
			*/
			// $headers = 'From: '.$name.' <'.$email.'>' . "\r\n" . 'Reply-To: ' . $email;
			wp_mail( $contactEmail, $subject, $body, $headers );
			$emailSent = true;
		}
	}
	?>

	<?php if ( isset( $emailSent ) && $emailSent == true ) { ?>

		<div class="contact-alert success">

			<h5><?php echo apply_filters( 'bean_contactform_success_msg', esc_html__( 'Your RSVP has been sent. Thanks.', 'emma' ) ); ?></h5>

		</div><!-- END .alert alert-success -->

	<?php } ?>

	<?php if ( isset( $hasError ) || isset( $captchaError ) ) { ?>

		<div class="contact-alert fail">

			<h5><?php echo apply_filters( 'bean_contactform_error_msg', esc_html__( 'An error occurred. Try again.', 'emma' ) ); ?></h5>

		</div><!-- END .alert alert-success -->

	<?php } ?>

	<form action="<?php esc_url( the_permalink() ); ?>" id="BeanForm" method="post">

		<ul class="bean-contactform">

			<li class="name">
				<label for="contactName"><?php echo apply_filters( 'bean_contactform_name_label', esc_html__( 'Name', 'emma' ) ); ?><span class="required">*</span></label>
				<div>
					<input type="text" name="contactName" id="contactName" value="
					<?php
					if ( isset( $_POST['contactName'] ) ) {
						echo esc_html( $_POST['contactName'] );}
?>
" class="required requiredField" />
					<span class="detail"><?php echo apply_filters( 'bean_contactform_firstname_label', esc_html__( 'First Name', 'emma' ) ); ?></span>
				</div>
				<div>
					<input type="text" name="contactNameLast" id="contactNameLast" value="
					<?php
					if ( isset( $_POST['contactNameLast'] ) ) {
						echo esc_html( $_POST['contactNameLast'] );}
?>
" class="required requiredField" />
					<span class="detail"><?php echo apply_filters( 'bean_contactform_lastname_label', esc_html__( 'Last Name', 'emma' ) ); ?></span>
				</div>
			</li>

			<?php do_action( 'bean_after_contactform_namefield' ); ?>

			<li class="email">
				<label for="email"><?php echo apply_filters( 'bean_contactform_email_label', esc_html__( 'Email', 'emma' ) ); ?><span class="required">*</span></label>
				<input type="text" name="email" id="email" value="
				<?php
				if ( isset( $_POST['email'] ) ) {
					echo esc_html( $_POST['email'] );}
?>
" class="required requiredField email" />
			</li>

			<?php do_action( 'bean_after_contactform_emailfield' ); ?>

			<li class="rsvp">
				<label for="contactRSVP"><?php echo apply_filters( 'bean_contactform_rsvp_label', esc_html__( 'Will you be coming?', 'emma' ) ); ?><span class="required">*</span></label>
				<input type="text" name="contactRSVP" id="contactRSVP" value="
				<?php
				if ( isset( $_POST['contactRSVP'] ) ) {
					echo esc_html( $_POST['contactRSVP'] );}
?>
" class="required requiredField" />
			</li>

			<?php do_action( 'bean_after_contactform_rsvpfield' ); ?>

			<li class="name">
				<label for="contactNamePlusOne"><?php echo apply_filters( 'bean_contactform_plusone_label', esc_html__( 'Plus One', 'emma' ) ); ?></label>
				<div>
					<input type="text" name="contactNamePlusOne" id="contactNamePlusOne" value="
					<?php
					if ( isset( $_POST['contactNamePlusOne'] ) ) {
						echo esc_html( $_POST['contactNamePlusOne'] );}
?>
"/>
					<span class="detail"><?php echo apply_filters( 'bean_contactform_firstname_label', esc_html__( 'First Name', 'emma' ) ); ?></span>
				</div>
				<div>
					<input type="text" name="contactNameLastPlusOne" id="contactNameLastPlusOne" value="
					<?php
					if ( isset( $_POST['contactNameLastPlusOne'] ) ) {
						echo esc_html( $_POST['contactNameLastPlusOne'] );}
?>
"/>
					<span class="detail"><?php echo apply_filters( 'bean_contactform_lastname_label', esc_html__( 'Last Name', 'emma' ) ); ?></span>
				</div>
			</li>

			<?php do_action( 'bean_after_contactform_plusonefield' ); ?>

			<li class="textarea"><label for="commentsText"><?php echo apply_filters( 'bean_contactform_message_label', esc_html__( 'Message', 'emma' ) ); ?></label>
				<textarea name="comments" id="commentsText" rows="20" cols="30">
				<?php
				if ( isset( $_POST['comments'] ) ) {
					if ( function_exists( 'stripslashes' ) ) {
						echo stripslashes( $_POST['comments'] );
					} else {
						echo esc_html( $_POST['comments'] ); }
				}
?>
</textarea>
			</li>

			<?php do_action( 'bean_after_contactform_allfields' ); ?>

			<li class="submit">
				<input type="hidden" name="submitted" id="submitted" value="true"/>
				<button type="submit" class="button"><?php echo apply_filters( 'bean_contactform_submit', esc_html__( 'Submit', 'emma' ) ); ?></button>
			</li>

			<?php do_action( 'bean_after_contactform_submit' ); ?>

		</ul>

	</form><!-- END #BeanForm -->

<?php } ?>
