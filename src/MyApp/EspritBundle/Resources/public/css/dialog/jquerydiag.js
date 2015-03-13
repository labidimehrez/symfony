$("#dialog").dialog({
    open: function(event, ui) {
        $(".ui-dialog-titlebar-close").hide();
    },
    modal: true,
    autoOpen: false,
    show: "fold",
    width: 400,
    buttons: [
        {
            text: "Luk",
            click: function() {
                $(this).dialog("close");

            }
        }
    ]
});
// Link to open the dialog
$("#dialog-link").click(function(event) {
    $("#dialog").dialog("open");
    event.preventDefault();
});