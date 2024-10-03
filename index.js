$(function() {
    var $exportButtons = $('.exportToExcel').hide();

    $(".balls").on('click', function() {
        $exportButtons.show();
    });

    $(".lmao").on('click', function() {
        $exportButtons.hide();
    });
});
