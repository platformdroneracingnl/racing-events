// Are you sure? You want to delete a event?
$(document).on("submit", '.deleteEvent', function(e) {
    var translator = new Language(locale);
    var form = this;
    e.preventDefault();

    Swal.fire({
        title: translator.getStr("areYouSure"),
        text: translator.getStr("deleteEvent"),
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: translator.getStr("noCancel"),
        confirmButtonText: translator.getStr("yesConfirm")
    }).then((result) => {
        if (result.value) {
            form.submit();
        }
    })
});
