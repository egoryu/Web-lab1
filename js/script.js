$(function() {
    function start() {
        /*if (typeof document.cookie["count"] == 'undefined')
            return;*/
        let count = getCookie("count");
        for (let i = 0; i < count; i++)
        {
            let data = getCookie("result" + i, true);
            if (data.validate) {
                let newRow = '<tr>';
                newRow += '<td>' + data.xval + '</td>';
                newRow += '<td>' + data.yval + '</td>';
                newRow += '<td>' + data.rval + '</td>';
                newRow += '<td>' + data.curtime + '</td>';
                newRow += '<td>' + data.exectime + '</td>';
                newRow += '<td>' + data.hitres + '</td></tr>';
                $('#result-table').append(newRow);
            }
        }
    }

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
        let yField = $('#y-textinput');
        let numY = yField.val().replace(',', '.');

        if (isNumeric(numY) && numY > -3 && numY < 5) {
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
            data: $(this).serialize() + '&time=' + new Date().getTimezoneOffset(),
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
    start();
});