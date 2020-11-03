function validateContactForm(name, email, message) {
  if (name === "" || email === "" || message === "") return false;
  return true;
}

jQuery(document).ready(function($) {
  /* contact form submit */
  $("#brewsiteContactForm").on("submit", function(e) {
    e.preventDefault();

    $(".form-error-alert").html("");
    $("#error-msg").hide();
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

    contactForm.find("input, button, textarea").attr("disabled", "disabled");

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
        error_msg = "We're sorry, but something seems to have gone wrong!";
        $("#error-msg").append(error_msg);
        $("#error-msg").show();
        contactForm.find("input, button, textarea").removeAttr("disabled");
      },
      success: function(response) {
        if (response == 0) {
          // Something went wrong
          error_msg = "We're sorry, but something seems to have gone wrong!";
          $("#error-msg").append(error_msg);
          $("#error-msg").show();
          contactForm.find("input, button, textarea").removeAttr("disabled");
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
