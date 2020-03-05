$(document).ready(function() {
        $('#myTable').DataTable();
        $(document).ready(function() {
            var table = $('#example').DataTable({
                "columnDefs": [{
                    "visible": false,
                    "targets": 2
                }],
                "order": [
                    [2, 'asc']
                ],
                "displayLength": 25,
                "drawCallback": function(settings) {
                    var api = this.api();
                    var rows = api.rows({
                        page: 'current'
                    }).nodes();
                    var last = null;
                    api.column(2, {
                        page: 'current'
                    }).data().each(function(group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                            last = group;
                        }
                    });
                }
            });
            // Order by the grouping
            $('#example tbody').on('click', 'tr.group', function() {
                var currentOrder = table.order()[0];
                if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                    table.order([2, 'desc']).draw();
                } else {
                    table.order([2, 'asc']).draw();
                }
            });
        });
    });
    $('#example23').DataTable({
        dom: 'lBfrtip',
        buttons: [
            {
                extend:    'copyHtml5',
                text:      '<i class="fa fa-files-o"> Copiar</i>',
                className: 'copiar',
                titleAttr: 'Copy'
            },
            {
                extend:    'excelHtml5',
                text:      '<i class="fa fa-file-excel-o"> Excel</i>',
                titleAttr: 'Excel'
            },
            {
                extend:    'csvHtml5',
                text:      '<i class="fa fa-file-text-o"> CSV</i>',
                titleAttr: 'CSV'
            },
            {
                extend: 'pdf',
                text: '<i class="fa fa-file-pdf-o"> PDF</i>',
                titleAttr: 'pdf'
            },
            {
                extend: 'print',
                text: '<i class="fa fa-print"> Imprimir</i>',
                titleAttr: 'print'
            },
            {
                text: '<i class="fa fa-plus"> Nuevo</i>',
                action: function ( e, dt, node, config ) {
                    $('#myModal').modal('show');
                    $("#tittle-form").html("Nuevo registro");
                    $("#btn-action").html("Guardar");
                }
            }

        ]
    });

    function showDataEdit(name, apellido){
      $('#myModal').modal('show');
      $("#tittle-form").html("Actualizar registro");
      $("#btn-action").html("Actualizar");
      $('#firstName').val(name);
      $('#lastName').val(apellido);
    }
