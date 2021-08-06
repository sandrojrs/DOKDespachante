function formToJSON(formData) {
  var object = {};
  formData.forEach((value, key) => {
      // Reflect.has in favor of: object.hasOwnProperty(key)
      if (!Reflect.has(object, key)) {
          object[key] = value;
          return;
      }
      if (!Array.isArray(object[key])) {
          object[key] = [object[key]];
      }
      object[key].push(value);
  });
  return JSON.stringify(object);
}

(function ($) {
  var forms = $('form[data-ajax-submit="true"]');
  if (forms.length) {
      forms.each(function () {
          var form = $(this);
          form.on("submit", async function (e) {
              e.preventDefault();
              var el = $(this),
                  method = el.attr("method") || "POST",
                  url = el.attr("action") || el.attr("accept"),
                  inputs = el.find(
                      "input,select,textarea,button[type=submit]"
                  );
              var hasUploads = el.data("files") || false;
              var formData = new FormData(this);
              e.preventDefault();
              if (!hasUploads) {
                  var data = formToJSON(formData);
                  inputs.prop("disabled", true);
                  await axios
                      .request({
                          method,
                          url,
                          data,
                          headers: {
                              "Content-Type": "application/json",
                          },
                      })
                      .then((res) => {
                          if (res.data.status.toLowerCase() === "ok") {
                              toastr.success(res.data.message);
                              if (res.data.hasOwnProperty("redirect")) {
                                  setTimeout(
                                      () =>
                                          (window.location.href =
                                              res.data.redirect),
                                      res.data.hasOwnProperty("timeout")
                                          ? res.data.timeout
                                          : 3000
                                  );
                              } else {
                                  inputs.prop("disabled", false);
                              }
                          } else {
                              toastr.error(res.data.message);
                              inputs.prop("disabled", false);
                          }
                      })
                      .catch((err) => {
                          toastr.error(err.message);
                          inputs.prop("disabled", false);
                      });
              }
          });
      });
  }
})(jQuery);
