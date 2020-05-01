// Filter table

$(document).ready(function() {
    $("#tableSearch").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#fineTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});