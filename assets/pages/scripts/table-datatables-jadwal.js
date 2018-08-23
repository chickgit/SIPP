var TableDatatablesManaged = function () {

    var table = $('#sample_2');
    
    var filterGlobal = function() {
        table.DataTable().search(
            $('#global_filter').val(),
            false,
            true
            ).draw();
    }

    var filterColumn = function(i) {
        table.DataTable().column(i).search(
            $('#col'+i+'_filter').val(),
            false,
            true
            ).draw();
    }

    var initTable2 = function () {


        var fixedHeaderOffset = 0;
        if (App.getViewPort().width < App.getResponsiveBreakpoint('md')) {
            if ($('.page-header').hasClass('page-header-fixed-mobile')) {
                fixedHeaderOffset = $('.page-header').outerHeight(true);
            } 
        } else if ($('.page-header').hasClass('navbar-fixed-top')) {
            fixedHeaderOffset = $('.page-header').outerHeight(true);
        } else if ($('body').hasClass('page-header-fixed')) {
            fixedHeaderOffset = 64; // admin 5 fixed height
        }

        table.dataTable({

            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            "language": {
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                },
                "emptyTable": "No data available in table",
                "info": "Showing _START_ to _END_ of _TOTAL_ records",
                "infoEmpty": "No records found",
                "infoFiltered": "(filtered1 from _MAX_ total records)",
                "lengthMenu": "Show _MENU_",
                "search": "Cari:",
                "zeroRecords": "No matching records found",
                "paginate": {
                    "previous":"Prev",
                    "next": "Next",
                    "last": "Last",
                    "first": "First"
                }
            },

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js). 
            // So when dropdowns used the scrollable div should be removed. 
            //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
            "dom": 'lprti',
            // "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.
            "pagingType": "bootstrap_extended", //dari datatables.bootstrap.js di plugin global

            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 5,
            "columnDefs": [
                {  // set default column settings
                    // 'orderable': false,
                    // 'targets': [0]
                }, 
                {
                    // "searchable": false,
                    // "targets": [0]
                }
            ],
            "orderCellsTop": true,
            "order": [
                [0, "desc"]
            ], // set first column as a default sort by asc
            
            // setup rowreorder extension: http://datatables.net/extensions/fixedheader/
            fixedHeader: {
                header: true,
                headerOffset: fixedHeaderOffset
            },
        });

        var tableWrapper = jQuery('#sample_2_wrapper');

        table.find('.group-checkable').change(function () {
            var set = jQuery(this).attr("data-set");
            var checked = jQuery(this).is(":checked");
            jQuery(set).each(function () {
                if (checked) {
                    $(this).prop("checked", true);
                } else {
                    $(this).prop("checked", false);
                }
            });
        });
    }

    return {

        //main function to initiate the module
        init: function () {
            if (!jQuery().dataTable) {
                return;
            }
            initTable2();

            $('input.global_filter').on( 'keyup click', function () {
               filterGlobal();
            } );
            $('input.column_filter').on( 'keyup click', function () {
                filterColumn( $(this).parents('tr').attr('data-column') );
            } );

            $('.clear_search').on('click', function () {
                $(this).parents('div.input-group').find('input').val('');
                if ($(this).parents('tr').attr('data-column')) {
                    filterColumn( $(this).parents('tr').attr('data-column') );
                }else{
                    filterGlobal();
                }
            })

            $('.clear_search_all').on('click', function () {
                $(this).parents('table').find('input').val('');
                table.DataTable().columns().search('').draw();
            })
        }

    };

}();

if (App.isAngularJsApp() === false) { 
    jQuery(document).ready(function() {
        TableDatatablesManaged.init();
    });
}