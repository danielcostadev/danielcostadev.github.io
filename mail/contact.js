$(function () {
    function showSuccessMessage() {
        $('#success').html("<div class='alert alert-success'>");
        $('#success > .alert-success')
            .html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>")
            .append("<strong>Your message has been sent. </strong>")
            .append('</div>');
        $('#contactForm').trigger("reset");
    }

    function showErrorMessage(name) {
        $('#success').html("<div class='alert alert-danger'>");
        $('#success > .alert-danger')
            .html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>")
            .append($("<strong>").text("Sorry " + name + ", it seems that our mail server is not responding. Please try again later!"))
            .append('</div>');
        $('#contactForm').trigger("reset");
    }

    $("#contactForm input, #contactForm textarea").jqBootstrapValidation({
        preventSubmit: true,
        submitError: function ($form, event, errors) {
            // Adicionar tratamento de erros aqui, se necessário
        },
        submitSuccess: function ($form, event) {
            event.preventDefault();
            var name = $("input#name").val();
            var email = $("input#email").val();
            var subject = $("input#subject").val();
            var message = $("textarea#message").val();

            var $this = $("#sendMessageButton");
            $this.prop("disabled", true);

            $.ajax({
                url: "https://formspree.io/f/xjvnnvbq",
                type: "POST",
                data: {
                    name: name,
                    email: email,
                    subject: subject,
                    message: message
                },
                cache: false,
                success: function () {
                    showSuccessMessage();
                },
                error: function () {
                    showErrorMessage(name);
                },
                complete: function () {
                    setTimeout(function () {
                        $this.prop("disabled", false);
                    }, 1000);
                }
            });
        },
        filter: function () {
            return $(this).is(":visible");
        },
    });

    $("a[data-toggle=\"tab\"]").click(function (e) {
        e.preventDefault();
        $(this).tab("show");
    });
});

$('#name').focus(function () {
    $('#success').html('');
});
