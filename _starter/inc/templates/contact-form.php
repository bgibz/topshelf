<div id="contact-form-parent-div">
	<form id="brewsiteContactForm" action="#" method="post" data-url="<?php echo admin_url('admin-ajax.php')?>">

		<div class="form-group">
			<label for="name">Your Name:</label>
			<input type="text" class="form-control" placeholder="Enter Name" id="contact_name" name="contact_name" required="required">
		</div>
		<div class="form-group">
			<label for="email">Your Email:</label>
			<input type="email" class="form-control" placeholder="Enter Email" id="email" name="email" required="required">
		</div>
		<div class="form-group">
			<label for="message">Leave Us A Message:</label>
			<textarea name="message" id="message" class="form-control" required="required" placeholder="Enter Your Message" rows="4" style="resize:none;"></textarea>
		</div>
		<div id="error-msg" class="alert alert-danger form-error-alert" style="display:none;"></div>
		<button type="submit" class="btn btn-primary">Submit</button>
	</form>
</div>