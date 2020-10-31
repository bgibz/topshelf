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
          console.log("Something went wrong...");
        } else {
          // Success!
          console.log("Success!");
        }
      }
    });
  });
});
