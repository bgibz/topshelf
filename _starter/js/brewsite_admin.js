jQuery(document).ready(function($) {
  var mediaUploader;

  $("#upload-image-button").on("click", function(e) {
    e.preventDefault();
    if (mediaUploader) {
      mediaUploader.open();
      return;
    }

    mediaUploader = wp.media({
      title: "Choose a Display Image",
      button: {
        text: "Upload an Image"
      },
      multiples: false
    });

    mediaUploader.on("select", function() {
      attachment = mediaUploader
        .state()
        .get("selection")
        .first()
        .toJSON();
      $("#display_image").val(attachment.url);
      $("#display-img-preview").css(
        "background-image",
        "url(" + attachment.url + ")"
      );
      $("#display-img-file").text("Uploaded Image: " + attachment.name);
    });

    mediaUploader.open();
  });
});
