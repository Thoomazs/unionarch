function Helpers() {

    this.init = function() {
        var _this = this;

        // tooltip
        if ( $.fn.tooltip )
            $( "[data-toggle='tooltip']" ).tooltip( "destroy" ).tooltip();

        // popover
        if ( $.fn.popover )
            $( "[data-toggle='popover']" ).popover( "destroy" ).popover();

        // auto resize
        if ( $.fn.yaar )
            $( "textarea[data-resize='true']" ).attr( "rows", 3 ).yaar();

        // magnific popup
        if ( $.fn.magnificPopup ) {
            $( "[data-popup='true']" ).magnificPopup( {
                type                : 'image',
                closeOnContentClick : true,
                closeBtnInside      : false,
                fixedContentPos     : true,
                mainClass           : 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
                image               : {
                    verticalFit : true,
                    titleSrc    : function( item ) {
                        return item.el.attr( 'title' );
                    }
                },
                zoom                : {
                    enabled  : true,
                    duration : 300 // don't foget to change the duration also in CSS
                }
            } );

            $( "[data-popup='gallery']" ).each( function() {
                $( this ).magnificPopup( {
                    delegate            : 'a[data-popup]',
                    type                : 'image',
                    gallery             : {
                        enabled  : true,
                        tCounter : '%curr% / %total%'
                    },
                    closeOnContentClick : true,
                    closeBtnInside      : false,
                    fixedContentPos     : true,
                    mainClass           : 'mfp-no-margins mfp-with-zoom',
                    image               : {
                        verticalFit : true,
                        titleSrc    : function( item ) {
                            return item.el.attr( 'title' );
                        }
                    }
                } );
            } );
        }

        // warning modal on href
        $( "[data-warning='true']" ).on( "click", function( e ) {
            e.preventDefault();

            var $this = $( this );
            var href = $this.attr( "href" );

            _this.modal( {
                title   : "Jste si jistý?",
                body    : '<div class="alert alert-danger text-center" style="margin: -16px -15px;border-radius: 0;padding: 20px 15px;"><strong>Opravdu</strong> chcete tuto akci provést?</div>',
                buttons : [
                    {
                        classes : "btn-default",
                        title   : "Zrušit",
                        dismiss : true
                    },
                    {
                        href    : href,
                        classes : "btn-danger",
                        title   : "Provést",
                        dismiss : false
                    }
                ]
            } );

            if ( $this.is( "button, input" ) ) {
                $( "#modal-javascript .btn-danger" ).off().on( "click", function() {
                    $this.closest( "form" ).submit();
                } )
            }

        } );

        // wysiwyg editor
        if ( $.fn.tinymce ) {
            $( "textarea[data-editor='true'][id]" ).tinymce( {
                script_url            : '/public/js/tinymce/tinymce.min.js',
                theme                 : "modern",
                statusbar             : false,
                plugins               : "link image autoresize preview code table autoresize jbimages",
                toolbar               : "undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link unlink image jbimages | code removeformat",
                autoresize_min_height : "100%",
                entity_encoding       : "raw",
                relative_urls         : false
            } );
        }

        // datepicker
        if ( $.fn.pickadate ) {
            $( "input[data-toggle='datepicker']" ).pickadate( {} );
        }
        if ( $.fn.pickatime ) {
            $( "input[data-toggle='timepicker']" ).pickatime( {
                clear    : 'Smazat',
                format   : 'HH:i',
                interval : 30,
                min      : [6, 0],
                max      : [22, 0]
            } );
        }
        $( ".form-file input[type='file']" ).on("click", function() {
            console.log("ads");
        });

        // form fix
        $("form" ).on("submit", function() {
            var $form = $(this);
            var $files = $form.find("input[type='file']" );
            if( $files.length > 0 ) {
                $files.each( function() {
                    var $this = $(this);

                    if( $this.val() == "") $this.attr("disabled", "disabled");
                })
            }
        });

        $( ".form-file input[type='file']" ).off( "change" ).on( "change", function() {
            var $this = $( this );
            var file = $this.val().split( "\\" ).pop();
            var $file = $this.closest( '.form-file' );
            var $span = $file.find( 'span' );

            if ( file !== "" ) {
                $span.text( file );
                $file.addClass('active');
            }
            else {
                $span.text( $span.data( 'title' ) );
                $file.removeClass('active');
            }
        } );

        $( ".form-select select" ).off( "change" ).on( "change", function() {
            var $this = $(this);
            var $select = $this.closest(".form-select");
            $select.addClass('active');
        });

        //height
        if ( $( "[data-height]" ).length > 0 ) {
            var fce = function() {
                var $data_height = $( "[data-height]" );
                $data_height.each( function() {
                    var t = $( this );
                    t.css( "height", "" );
                } );
                $data_height.each( function() {
                    var t = $( this );
                    t.css( "height", "" );
                    if ( $( window ).width() > 767 ) {

                        if ( t.css( "float" ) != "none" || t.parent().css( "float" ) != "none" ) {
                            var height = Number( t.data( "height" ) );
                            var bonus = (t.data( "height-bonus" )) ? Number( t.data( "height-bonus" ) ) : 0;
                            var newHeight = (t.parent().height()) * (height / 100) + bonus;
                            if ( newHeight > height ) t.css( "height", newHeight + "px" );
                        } else {
                            t.css( "height", "" );
                        }
                    }
                } )
            };
            $( window ).resize( fce ).resize();

        }

    };

    // Modal
    this.modal = function( options ) {

        if ( options == "close" ) {
            $( ".modal" ).remove();
            $( ".modal-backdrop" ).remove();
            return;
        }

        options = $.extend( {
            id      : "modal-javascript",
            header  : true,
            title   : "Modal",
            body    : "",
            footer  : true,
            buttons : {},
            modal   : {
                keyboard : false,
                backdrop : "static",
                show     : true
            },
            remove  : false
        }, options );

        var o = '';
        o += '<div class="modal fade" id="' + options.id + '">';
        o += '    <div class="modal-dialog">';
        o += '        <div class="modal-content">';

        if ( options.header != false ) {
            o += '        <div class="modal-header">';
            o += '            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
            o += '            <h4 class="modal-title">' + options.title + '</h4>';
            o += '        </div>';
        }

        o += '            <div class="modal-body">';
        o += options.body;
        o += '            </div>';

        if ( options.footer != false ) {
            o += '        <div class="modal-footer">';

            var length = options.buttons.length, element = null;
            for ( var i = 0; i < length; i++ ) {
                element = options.buttons[i];
                var dismis, href;
                if ( element.dismiss ) dismis = 'data-dismiss="modal"'; else dismis = "";
                if ( element.href ) href = 'href="' + element.href + '" '; else href = "";
                o += '        <a ' + href + ' class="btn btn-sm ' + element.classes + '" ' + dismis + '>' + element.title + '</a>';
            }
        }

        o += '        </div>';
        o += '    </div>';
        o += '</div>';

        $( ".modal-backdrop" ).remove();
        if ( $( "#" + options.id ).length != 0 ) {
            $( "#" + options.id ).remove();
        }
        $( "body" ).append( o );
        $( "#" + options.id ).modal( options.modal );

        if ( options.remove ) {
            $( "#" + options.id ).on( 'hidden.bs.modal', function() {
                $( this ).remove();
            } )
        }

    };

    this.loading = function( options ) {

        $( '#modal-loading' ).modal( 'hide' );
        $( "#modal-loading" ).on( 'hidden.bs.modal', function() {
            $( this ).remove();
        } );

        if ( options != "close" ) {
            options = $.extend( {
                text  : "Načítám…",
                icon  : true,
                width : 100
            }, options );

            var o = '';
            o += '<div class="text-center">';
            o += '  <p style="font-size: 35px; font-weight: 100; margin: 15px;">';
            if ( options.icon ) {
                o += '      <i class="fa fa-spinner fa-spin" style="font-size: 40px; vertical-align: middle; position: relative; top: -3px; margin-right: 15px;"></i>';
            }
            o += '      ' + options.text;
            o += '  </p>';
            o += '</div>';

            this.modal( {
                id     : "modal-loading",
                body   : o,
                header : false,
                footer : false,
                remove : true
            } )
        }
    };

    this.dialog = function( options ) {

        if ( options == "close" ) {
            this.modal( "close" );
            return;
        }

        options = $.extend( {
            buttons : [
                {
                    href    : "",
                    classes : "btn-default",
                    title   : "Ok",
                    dismiss : true
                }
            ],
            header  : true,
            remove  : true
        }, options );

        this.modal( options )
    };

    // Scroll to

    this.scroll = function( options, callback ) {

        options = $.extend( {
            element   : "body",
            container : "body",
            animated  : true,
            bonus     : 0
        }, options );

        $element = $( options.element );
        $container = $( options.container );

        if ( options.animated ) {
            $container.animate( {
                scrollTop : $element.offset().top - $container.offset().top + $( "html" ).scrollTop() + options.bonus
            }, function() {
                if ( typeof callback == "function" ) callback();
            } );
        } else {
            $container.scrollTop(
                $element.offset().top - $container.offset().top + $( "html" ).scrollTop() + options.bonus
            );
        }
    };

    // constructor after DOM load
    var _this = this;
    $( function() {
        _this.init();
    } )
}

// vytvoreni globalni promenne
var Helper = new Helpers();
