

(function ($) {

    $.fn.extend({
        relationsEditor: function(method) {
            
            function objectAdded(w, id) {
                return $('tr[object-id="' + id + '"]', w).length;
            }
            
            function updateHidden(w) {                
                w.find('input[type="hidden"]').val(w.relationsEditor('getAllAsString'));
            }
            
            var methods = {
                init : function( options ) {
                    var defaults = {
                        editorClass: 'relations-editor',
                        headerText: 'Related objects',
                        hintText: '(type to find and add ones)',
                        removeLinkText: 'Remove',
                        selectionLabel: 'Your selection: ',
                        addLinkText: 'Add',
                        hiddenFieldName: 'relations',
                        data: null,
                        autocompleteUrl: null
                    }                    
                    options = $.extend(defaults, options);

                    return this.each(function() {
                        var o = options;
                        var w = $(this);
                        w.data('options', o);
                        
                        w.empty().addClass(o.editorClass);
                        $('<span><span>').addClass(o.editorClass + '-header').text(o.headerText).appendTo(w);
                        w.append('  ');
                        $('<span><span>').addClass(o.editorClass + '-hint').text(o.hintText).appendTo(w);
                        w.append('<br/>');
                        $('<input type="hidden" />').attr('name', o.hiddenFieldName).appendTo(w);
                        $('<input type="text"/>').appendTo(w).autocomplete({
                            source: o.autocompleteUrl,
                            minLength: 2,
                            select: function( event, ui ) {
                                $(this).closest('.' + o.editorClass).find('.' + o.editorClass + '-selected').remove();
                                var wDiv = $('<div></div').addClass(o.editorClass + '-selected')
                                .data('selected-id', ui.item.value)
                                .data('selected-name', ui.item.label)
                                .insertAfter(this);
                                $('<span></span>').text(o.selectionLabel + ui.item.label + ' ').appendTo(wDiv);
                                if (objectAdded(w, ui.item.value)) {
                                    $('<span></span>').addClass(o.editorClass + '-hint').text(' (already added) ').appendTo(wDiv);
                                } else {
                                    $('<a href="#"></a>').text(o.addLinkText).click(function() {
                                        var wSelectedDiv = $(this).closest('.' + o.editorClass + '-selected');
                                        w.relationsEditor('add', {
                                            id: wSelectedDiv.data('selected-id'),
                                            name: wSelectedDiv.data('selected-name') 
                                        });
                                        wSelectedDiv.remove();
                                        updateHidden(w);
                                    }).appendTo(wDiv);
                                }
                                $(this).val('');
                                event.preventDefault();

                                
                            }
                        });
                        var wTable = $('<table></table>').appendTo(w);
                        for (var i in o.data) {
                            var item = o.data[i];
                            w.relationsEditor('add', {
                                id: item.id, 
                                name: item.name
                            });                     
                            
                        }
                        updateHidden(w);
                        
                       
                        
                        
                    });


                },
                
                add: function(item) {
                    return this.each(function() {
                        var w = $(this);
                        var o = w.data('options');
                        var wTable = $('table', w);
                        var wTr = $('<tr></tr>').attr('object-id', item.id).appendTo(wTable);
                        $('<td></td>').text(item.name).appendTo(wTr);
                        $('<td></td>').append($('<a href="#"></a>').text(o.removeLinkText).click(function() {
                            $(this).closest('tr').remove();
                            $('.' + o.editorClass + '-selected', w).remove();
                            updateHidden(w);
                            return false;
                        })).appendTo(wTr);
                    });
                },
                
                getAll: function() {
                    var w = this.first();
                    if (w.length === 1) {
                        var result = [];
                        w.find('tr').each(function() {
                            result.push($(this).attr('object-id'));
                        });
                        return result;
                    } else {
                        return [];
                    }
                    
                },
                
                getAllAsString: function() {
                    return this.relationsEditor('getAll').join();
                }
            }

            if ( methods[method] ) {
                return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
            } else if ( typeof method === 'object' || ! method ) {
                return methods.init.apply( this, arguments );
            } else {
                $.error( 'Method ' +  method + ' does not exist on jQuery.relationsEditor' );
            }
        }



    });





})(jQuery);


