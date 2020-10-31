function validateContactForm(name, email, message) {
  if (name === "" || email === "" || message === "") return false;
  return true;
}

jQuery(document).ready(function($) {
  /* contact form submit */
  $("#brewsiteContactForm").on("submit", function(e) {
    e.preventDefault();

    var contactForm = $(this);

    var name = contactForm.find("#contact_name").val();
    var email = contactForm.find("#email").val();
    var message = contactForm.find("#message").val();
    ajaxurl = contactForm.data("url");

    //var valid = validateContactForm(name, email, message);
    if (!validateContactForm(name, email, message)) {
      console.log("Inputs cannot be empty");
      return;
    }

    $.ajax({
      url: ajaxurl,
      type: "post",
      data: {
        name: name,
        email: email,
        message: message,
        action: "brewsite_submit_contact_form"
      },
      error: function(response) {
        console.log(response);
      },
      success: function(response) {
        if (response == 0) {
          // Something went wrong
          error_msg =
            "Something went wrong, please try to resubmit the form. If the error persists, drop us a line at: _contact_email_";
          $("#error-msg").append(error_msg);
          $("#error-msg").show();
        } else {
          // Success!
          $("#brewsiteContactForm").hide();
          success_msg = "<h3>Thank you for your message</h3>";
          $("#contact-form-parent-div").html(success_msg);
          $("#contact-form-parent-div").css("text-align", "center");
        }
      }
    });
  });
});
