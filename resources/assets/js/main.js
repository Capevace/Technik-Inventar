$(document).ready(function () {
    new Mavigator('.check-active-links', {warnIfLinkWasntFound: true, classToParent: true});

    FastClick.attach(document.body);
});

function deleteRequest (message, url, backUrl) {
    if(!confirm(message))
        return;

    $.ajax({
        url: url,
        method: 'DELETE'
    }).done(function (data) {
        console.log(data);
        window.location.href = backUrl;
    }).fail(function (error) {
        console.log(error);
        alert('Objekt konnte nicht gelöscht werden.');
    });
}
