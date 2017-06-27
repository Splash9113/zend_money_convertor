$(function () {
    // $('#value').change(update);
    // $('#from').change(update);
    // $('#to').change(update);
    $('.start-convert').click(update);
});

var lastResults = [];

var update = function () {
    var value = $('#value').val();
    var from = $('#from').val();
    var to = $('#to').val();
    if (!validate(value, from, to)) {
        return;
    }
    $.post("/converter",
        {
            value: value,
            from: from,
            to: to
        },
        function (data) {
            if (data.error) {
                $('.panel.panel-default').parent().append('<div class="alert alert-danger"><strong>Danger!</strong> '+ data.error +'</div>');
                return;
            } else {
                $('.alert.alert-danger').remove();
            }
            lastResults.push($("#from option:selected").text().trim() + ' ' + value + ' -> ' + data + ' ' + $("#to option:selected").text().trim());
            if (lastResults.length > 5) {
                lastResults.shift();
            }
            $('#last-results').empty();
            $.each(lastResults, function (index, value) {
                $('#last-results').append(value + '\n');
            });
            $('#result').val(data);
        });
};

function validate(value, from, to) {
    if (value < 0) {
        $('#value').val(0);
        return false;
    }
    if (from < 1 || to < 1) {
        return false;
    }
    return true;
}