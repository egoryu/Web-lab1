$(function() {
    function isNumeric(n) {
        return !isNaN(parseFloat(n)) && isFinite(n);
    }

    function validateX() {
        if ($('.x-radio').is(':checked')) {
            return true;
        } else {
            $('#error').text('Неправильный формат x');
            return false;
        }
    }

    function validateY() {
        const Y_MIN = -3;
        const Y_MAX = 5;

        let yField = $('#y-textinput');
        let numY = yField.val().replace(',', '.');

        if (isNumeric(numY) && numY >= Y_MIN && numY <= Y_MAX) {
            return true;
        } else {
            $('#error').text('Неправильный формат y');
            return false;
        }
    }

    function validateR() {
        if ($('#r-value').selectedIndex !== -1) {
            return true;
        } else {
            $('#error').text('Неправильный формат r');
            return false;
        }
    }

    function validateForm() {
        return validateX() & validateY() & validateR();
    }
    
    $('#former').submit(function(event) {
        event.preventDefault();

        if (!validateForm()) {
            $('#error').removeClass('invisible');
            return;
        } else {
            $('#error').addClass('invisible');
        }

        $.ajax({
            url: 'php/work.php',
            method: 'GET',
            data: $(this).serialize(),
            dataType: "json",
            success: function(data) {
                if (data.validate) {
                    let newRow = '<tr>';
                    newRow += '<td>' + data.xval + '</td>';
                    newRow += '<td>' + data.yval + '</td>';
                    newRow += '<td>' + data.rval + '</td>';
                    newRow += '<td>' + data.curtime + '</td>';
                    newRow += '<td>' + data.exectime + '</td>';
                    newRow += '<td>' + data.hitres + '</td></tr>';
                    $('#result-table').append(newRow);
                } else {
                    $('#error').text(data.mistake);
                }
            }
        });
    });
});