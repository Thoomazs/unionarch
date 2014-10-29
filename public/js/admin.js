$( function() {


    // LOG

    var $body = $( "body.admin-log-index" );

    $body.find( ".table tr" ).on( "click", function() {
        var $tr = $( this ).closest( "tr" );
        if ( $tr.hasClass( "open" ) )
            $tr.removeClass( "open" );
        else
            $tr.addClass( "open" );
    } );

    // SELECT (many-to-many relations)
    var many_to_many_update = function() {
        $( ".form-group ul.list-group .close" ).off( "click" ).on( "click", function() {
            var $li = $( this ).closest( ".list-group-item" );
            var $ul = $li.closest('.list-group');
            var $input = $li.find( 'input[type="hidden"]' );
            var $select = $li.closest('.form-group' ).find("select");
            $select.find('option[value="' + $input.val() + '"]' ).removeAttr('disabled' ).show();

            $li.remove();

            if( $ul.find(".list-group-item" ).length == 0 ) $ul.addClass('hidden');
        } )
    }

    $( "select.many-to-many" ).off( "change" ).on( "change", function() {

        var $this = $( this );
        var $group = $this.closest( '.form-group' );
        var $ul = $group.find( "ul.list-group" );
        var o = '';
        var $option = $this.find( "option:selected" );

        if ( $option.length > 1 ) $option = $( $option[0] );

        o += '<li class="list-group-item">';
        o += '   <input type="hidden" name="' + $this.data( 'name' ) + '[]" value="' + $option.val() + '"/>';
        o += '    ' + $option.text();
        o += '   <a class="close"><i class="fa fa-times"></i></a>';
        o += '</li>';

        $ul.removeClass('hidden');
        $ul.append( o );

        $option.attr('disabled','').hide();

        $this.find( "option:first" ).prop( "selected", true );

        many_to_many_update();

    } );

    many_to_many_update();
    $( ".form-group ul.list-group input[type='hidden']" ).each( function() {
        var $this = $( this );
        var $select = $this.closest('.form-group' ).find("select");

        $select.find('option[value="'+$this.val()+'"]' ).prop('selected',true ).change();

        $this.remove();
    });




} );
