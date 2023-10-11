function build(mode) {
    $('#log').load('log.php?mode=' + mode);
    tally();
}

function tally() {
    $('#tally').load('log.php?mode=tally');
}


$(document).ready(function() {
    build('build');

    setInterval(function() {
        var mode = $("#btn-mode").data('mode');
        if(mode == 'restore') {
            build('build');
        }else {
            build('restore');
        }
    }, 30000);

    $('#btn-mode').on('click', function(evt) {
        evt.preventDefault();
        var mode = $(this).data('mode');

        if(mode == 'restore') {
            build("restore");
            $('#label-mode').html("Live");
            $(this).data('mode', 'live');
        } else {
            build("build");
            $('#label-mode').html("Restore");
            $(this).data('mode', 'restore');
        }
    });

    $('#form-new').submit(function(evt) {
        evt.preventDefault();
        var form  = $(this); // this particular form
        // var activity = $('#activity').val();
        var data = form.serialize();

        $.ajax({
            url: 'log.php?mode=new',
            data: data,
            success: function() { // if file was loaded successfully
                build('build');
            }
        });
    });

    $('#log').on('click', '.btn-stop', function() {
        var id = $(this).data('id');
        $.ajax({
            url: 'log.php?mode=stop&id=' + id,
            success: function() {
                build('build');
            }
        })
    });

    $('#log').on('click', '.btn-remove', function() {
        var id = $(this).data('id');
        $.ajax({
            url: 'log.php?mode=remove&id=' + id,
            success: function() {
                build('build');
            }
        })
    });

    $('#log').on('click', '.btn-restore', function() {
        var id = $(this).data('id');
        $.ajax({
            url: 'log.php?mode=status&id=' + id,
            success: function() {
                build('restore');
            }
        })
    });

    // $('#tally').load('log.php?mode=tally');

    // $('#log').load('log.php?mode=build');
});