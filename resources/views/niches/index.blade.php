@extends('layouts.main')

@section('pagetitle', 'Nichos')
@section('pagesubtitle', auth()->user()->cemetery_appellation)

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="JavaScript:;" id="reloadNicheDT">@yield('pagetitle')</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>Lista</span>
        </li>
    </ul>
</div>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="row">
                    <div class="col-xs-12 col-xs-offset-4 col-sm-2 col-sm-offset-0 col-md-2 col-md-offset-0 col-lg-2 col-lg-offset-0">
                        <div class="form-group">
                            <button id="newNicheBtn" class="btn btn-outline blue">
                                <i class="fa fa-plus"></i> Agregar
                            </button>
                        </div>
                    </div>
                    <div class="col-xs-12 col-xs-offset-0 col-sm-4 col-sm-offset-0 col-md-5 col-md-offset-0 col-lg-5 col-lg-offset-0">
                        <div class="form-group">
                            <select id="pavilionFilter" class="form-control">
                                <option value="">Seleccione un Pabellón</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="portlet-body">
                <table id="nicheDataTable" class="table table-hover table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Estado</th>
                            <th>Pabellón</th>
                            <th>Categoria</th>
                            <th>Fila</th>
                            <th>Columna</th>
                            <th>Precio (S/)</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@include('niches.create')
@include('niches.edit')
@include('niches.delete')

@endsection

@push('scripts')
    <script>
    $(document).ready( function () {
        /**************************************************************************/
        /* Lista - Read
        /**************************************************************************/
        var nicheDataTable = setUpDataTable(
            '#nicheDataTable',
            'Lista de Nichos',
            [ 0, 1, 2, 3, 4, 5, 6],
            [
                {
                    targets: [1, 3],
                    searchable: false
                }
            ],
            [
                {data: 'id', name: 'id'},
                {data: 'state', name: 'state', render: function ( data, type, row ) {
                        return formatStateLabel(row.state);
                }},
                {data: 'pavilion.name', name: 'pavilion.name'},
                {data: 'category', name: 'category'},
                {data: 'row_x', name: 'row_x'},
                {data: 'col_y', name: 'col_y'},
                {data: 'price', name: 'price'},
                {data: 'buttons', orderable: false, className: "text-center btn-actions"},
            ]
        )

        $('#nicheDataTable').removeClass('no-footer')
        $.fn.dataTable.ext.errMode = 'throw'

        $('#reloadNicheDT').click( function () {

            $('#nicheDataTable').DataTable().destroy()

            nicheDataTable = setUpDataTable(
                '#nicheDataTable',
                'Lista de Nichos',
                [ 0, 1, 2, 3, 4, 5, 6],
                [
                    {
                        targets: [1, 3],
                        searchable: false
                    }
                ],
                [
                    {data: 'id', name: 'id'},
                    {data: 'state', name: 'state', render: function ( data, type, row ) {
                            return formatStateLabel(row.state);
                    }},
                    {data: 'pavilion.name', name: 'pavilion.name'},
                    {data: 'category', name: 'category'},
                    {data: 'row_x', name: 'row_x'},
                    {data: 'col_y', name: 'col_y'},
                    {data: 'price', name: 'price'},
                    {data: 'buttons', orderable: false, className: "text-center btn-actions"},
                ]
            )

            $('#nicheDataTable').removeClass('no-footer')
        })

        // Filtro Nichos por Pabellon
        $('#pavilionFilter').empty()

        getPavilions('#pavilionFilter', 'N')

        $('#pavilionFilter').on('select2:select', function (event) {

            var data        = event.params.data
            let pavilion_id = data.id
            
            // console.log(pavilion_id)

            $('#nicheDataTable').DataTable().destroy()

            nicheDataTable = setUpDataTable(
                '#nicheDataTable',
                'Lista de Nichos',
                [ 0, 1, 2, 3, 4, 5, 6],
                [
                    {
                        targets: [1, 3],
                        searchable: false
                    }
                ],
                [
                    {data: 'id', name: 'id'},
                    {data: 'state', name: 'state', render: function ( data, type, row ) {
                            return formatStateLabel(row.state);
                    }},
                    {data: 'pavilion.name', name: 'pavilion.name'},
                    {data: 'category', name: 'category'},
                    {data: 'row_x', name: 'row_x'},
                    {data: 'col_y', name: 'col_y'},
                    {data: 'price', name: 'price'},
                    {data: 'buttons', orderable: false, className: "text-center btn-actions"},
                ],
                {
                    pavilion_id: pavilion_id
                }
            )
            
            $('#nicheDataTable').removeClass('no-footer')
        })
        /*************************************************************************/
        /* Agregar - Create
        /*************************************************************************/
        $('#newNicheBtn').click( function () {
            $('#newPavilion').empty()
            getPavilions('#newPavilion', 'N', true)
            setUpFormModal('#newNicheForm', '#newNicheModal', 'show')
        })

        $('#newNicheForm').submit( function(event) {
            event.preventDefault()
            addNiche('#newNicheForm', '#newNicheModal', nicheDataTable)
        })

        /*************************************************************************/
        /* Editar - Update
        /*************************************************************************/
        $('#nicheDataTable tbody').on('click', '#editNicheBtn', function(){
            let data = nicheDataTable.row($(this).parents('tr')).data()
            $('#editPavilion').empty()
            getPavilions('#editPavilion', 'N', true)
            selectPavilion('#editPavilion', data)
            setUpFormModal('#updateNicheForm', '#updateNicheModal', 'show', data)
        })

        $('#updateNicheForm').submit( function(event) {
            event.preventDefault()
            updateNiche(
                $('#update').val(),
                '#updateNicheForm',
                '#updateNicheModal',
                nicheDataTable
            )
        })

        /**************************************************************************/
        /* Eliminar - Delete
        /**************************************************************************/
        $('#nicheDataTable tbody').on('click', '#deleteNicheBtn', function(){
            let data = nicheDataTable.row($(this).parents('tr')).data()
            setUpFormModal('#deleteNicheForm', '#deleteNicheModal', 'show', data)
        })

        $('#deleteNicheForm').submit( function(event) {
            event.preventDefault()
            deleteNiche(
                $('#delete').val(),
                '#deleteNicheForm',
                '#deleteNicheModal',
                nicheDataTable
            )
        })
    })

    const url = "{{ url('niche') }}"

    function setUpDataTable(id, exportTitle, exportColumns, columnDefs, columns, params = {}) {
        let dataTable = $(id).DataTable({
            language: {
                zeroRecords: "No se encontraron resultados",
                info: "",
                infoEmpty: "",
                infoFiltered: "",
                search:"Buscar ",
                lengthMenu: "_MENU_",
                processing: '<i class="fa fa-circle-o-notch fa-spin"></i> Cargando '
            },
            order: [[ 0, "desc" ]],
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todo"]],
            serverSide: true,
            processing: true,
            ajax: {
                url: url,
                data: params
            },
            columns: columns,
            columnDefs: columnDefs,
            buttons: [
                {
                    extend: "print",
                    className: "btn btn-outline dark",
                    exportOptions: { columns: exportColumns},
                    text: '<i class="icon-printer"></i> Imprimir',
                    titleAttr: 'Imprimir',
                    title: exportTitle
                },
                {
                    extend: "pdf",
                    className: "btn btn-outline red",
                    exportOptions: { columns: exportColumns},
                    text: '<i class="fa fa-file-pdf-o"></i> PDF',
                    titleAttr: 'Exportar PDF',
                    title: exportTitle
                },
                {
                    extend: "excel",
                    className: "btn btn-outline green-meadow",
                    exportOptions: { columns: exportColumns},
                    text: '<i class="fa fa-file-excel-o"></i> Excel',
                    titleAttr: 'Exportar Excel',
                    title: exportTitle
                },
                {
                    extend: "colvis",
                    className: "btn btn-outline purple",
                    text: '<i class="fa fa-th-list"></i> Columnas'
                }
            ],
            dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
        })

        return dataTable
    }

    function setUpFormModal(form, modal, behavior, data = false) {

        $(form)[0].reset()

        if (data) {
            // console.log(data)
            $('#update').val(data.id)
            $('#delete').val(data.id)
            
            $('#col_y').val(data.col_y)
            $('#price').val(data.price)

            switch (data.category) {
                case 'Adulto':
                    document.getElementById('category').selectedIndex = '1'
                    break;
                case 'Parvulo':
                    document.getElementById('category').selectedIndex = '2'
                    break;
                case 'Osario':
                    document.getElementById('category').selectedIndex = '3'
                    break;
                case 'Dorado':
                    document.getElementById('category').selectedIndex = '4'
                    break;
                default:
                    document.getElementById('category').selectedIndex = '5'
                    break;
            }

            switch (data.state) {
                case 'Disponible':
                    $('#disponible').prop('checked', true)
                    break;

                case 'Ocupado':
                    $('#ocupado').prop('checked', true)
                    break;
            }

            switch (data.row_x) {
                case 'A':
                    document.getElementById('row_x').selectedIndex = '1'
                    break;
                case 'B':
                    document.getElementById('row_x').selectedIndex = '2'
                    break;
                case 'C':
                    document.getElementById('row_x').selectedIndex = '3'
                    break;
                case 'D':
                    document.getElementById('row_x').selectedIndex = '4'
                    break;
                case 'E':
                    document.getElementById('row_x').selectedIndex = '5'
                    break;
                case 'F':
                    document.getElementById('row_x').selectedIndex = '6'
                    break;
                case 'G':
                    document.getElementById('row_x').selectedIndex = '7'
                    break;
                case 'H':
                    document.getElementById('row_x').selectedIndex = '8'
                    break;
                case 'I':
                    document.getElementById('row_x').selectedIndex = '9'
                    break;
                case 'J':
                    document.getElementById('row_x').selectedIndex = '10'
                    break;
                case 'K':
                    document.getElementById('row_x').selectedIndex = '11'
                    break;
                case 'L':
                    document.getElementById('row_x').selectedIndex = '12'
                    break;
                case 'M':
                    document.getElementById('row_x').selectedIndex = '13'
                    break;
                case 'N':
                    document.getElementById('row_x').selectedIndex = '14'
                    break;
                case 'O':
                    document.getElementById('row_x').selectedIndex = '15'
                    break;
                case 'P':
                    document.getElementById('row_x').selectedIndex = '16'
                    break;
                case 'Q':
                    document.getElementById('row_x').selectedIndex = '17'
                    break;
                case 'R':
                    document.getElementById('row_x').selectedIndex = '18'
                    break;
                case 'S':
                    document.getElementById('row_x').selectedIndex = '19'
                    break;
                case 'T':
                    document.getElementById('row_x').selectedIndex = '20'
                    break;
                case 'U':
                    document.getElementById('row_x').selectedIndex = '21'
                    break;
                case 'V':
                    document.getElementById('row_x').selectedIndex = '22'
                    break;
                case 'W':
                    document.getElementById('row_x').selectedIndex = '23'
                    break;
                case 'X':
                    document.getElementById('row_x').selectedIndex = '24'
                    break;
                case 'Y':
                    document.getElementById('row_x').selectedIndex = '25'
                    break;
                case 'Z':
                    document.getElementById('row_x').selectedIndex = '26'
                    break;
                default:
                    document.getElementById('row_x').selectedIndex = '0'
                    break;
            }

            $('p').text(data.row_x +' '+ data.col_y +' - '+ data.pavilion.name)
        }

        $(modal).modal(behavior)
    }

    function addNiche(form, modal, dataTable) {

        loading('#registrar', 'start')

        $.ajax({
            type: 'POST',
            url: url,
            data: $(form).serialize(),
            success: function(data) {
                // console.log(data)
                setUpFormModal(form, modal, 'hide')

                dataTable.ajax.reload()

                toastrMessage('success', 'Nicho Registrado')
                loading('#registrar', 'stop')
            },
            error: function(xhr, status) {
                // console.log(xhr.responseJSON.message)
                toastrMessage(status, 'El Nicho no pudo ser Registrado')
                loading('#registrar', 'stop')
            }
        })
    }

    function updateNiche(id, form, modal, dataTable) {

        loading('#actualizar', 'start')

        $.ajax({
            type: 'PUT',
            url: url + "/" + id,
            data: $(form).serialize(),
            success: function(data) {
                // console.log(data)
                setUpFormModal(form, modal, 'hide')

                let row = $('#nicheDataTable').dataTable().fnFindCellRowIndexes(id, 0)

                dataTable.cell(row, 1).data(formatStateLabel(data.state)).draw(false)
                dataTable.cell(row, 2).data(data.pavilion.name).draw(false)
                dataTable.cell(row, 3).data(data.category).draw(false)
                dataTable.cell(row, 4).data(data.row_x).draw(false)
                dataTable.cell(row, 5).data(data.col_y).draw(false)
                dataTable.cell(row, 6).data(data.price).draw(false)

                toastrMessage('info', 'Nicho Actualizado')
                loading('#actualizar', 'stop')
            },
            error: function(xhr, status) {
                // console.log(xhr.responseJSON.message)
                toastrMessage(status, 'El Nicho no pudo ser Actualizado')
                loading('#actualizar', 'stop')
            }
        })
    }

    function deleteNiche(id, form, modal, dataTable) {

        loading('#eliminar', 'start')

        $.ajax({
            type: 'DELETE',
            url: url + "/" + id,
            data: $(form).serialize(),
            success: function(data) {
                //console.log(data)
                setUpFormModal(form, modal, 'hide')

                let row = $('#nicheDataTable').dataTable().fnFindCellRowIndexes(id, 0)
                dataTable.row(row).remove().draw()

                toastrMessage('warning', 'Nicho Eliminado')
                loading('#eliminar', 'stop')

            },
            error: function(xhr, status) {
                // console.log(xhr.responseJSON.message)
                toastrMessage(status, 'El Nicho no pudo ser Eliminado')
                loading('#eliminar', 'stop')
            }
        })
    }

    function formatStateLabel(state){

        switch (state) {
            case 'Disponible':
                return '<span class="label label-primary">'+state+'</span>'
                break;
            case 'Ocupado':
                return '<span class="label label-danger">'+state+'</span>'
                break;
            default:
                return '<span class="label label-default">'+state+'</span>'
                break;
        }
    }
    
    /*
     * Api Functions
     */
    function getPavilions(obj, type, modal = false) {

        if (modal) {
            $('body').on('shown.bs.modal', '.modal', function() {
                // Select2 inside of a modal (Bootstrap 3.x) that has not yet been rendered or opened
                $(this).find('select').each(function() {
                    let dropdownParent = $(document.body)
                    if ($(this).parents('.modal.in:first').length !== 0)
                        dropdownParent = $(this).parents('.modal.in:first')

                    $(obj).select2({
                        dropdownParent: dropdownParent,
                        language: 'es',
                        placeholder: 'Seleccione un Pabellón',
                        allowClear: true,
                        ajax: {
                            url: "{{ url('api/pavilion') }}",
                            dataType: 'json',
                            delay: 250,
                            data: function (params) {
                                return {
                                    term: params.term,
                                    page: params.page,
                                    type: type
                                }
                            },
                            processResults: function (data, params) {

                                params.page = params.page || 1

                                return {
                                    results:  $.map(data.data, function (item) {
                                        return {
                                            id:   item.id,
                                            text: item.name
                                        }
                                    }),
                                    pagination: {
                                        more: (params.page * data.per_page) < data.total
                                    }
                                }
                            },
                            cache: true
                        }
                    })
                })
            })
        } else {
            $(obj).select2({

                language: 'es',
                placeholder: 'Seleccione un Pabellón',
                allowClear: true,

                ajax: {
                    url: "{{ url('api/pavilion') }}",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            term: params.term,
                            page: params.page,
                            type: type
                        }
                    },
                    processResults: function (data, params) {

                        params.page = params.page || 1

                        return {
                            results:  $.map(data.data, function (item) {
                                return {
                                    id:   item.id,
                                    text: item.name
                                }
                            }),
                            pagination: {
                                more: (params.page * data.per_page) < data.total
                            }
                        }
                    },
                    cache: true
                }
            })
        }
    }

    function selectPavilion(obj, data){
        // Fetch the preselected item, and add to the control
        var dropdown = $(obj)

        // create the option and append to Select2
        let option = new Option(data.pavilion.name, data.pavilion.id, true, true)
        dropdown.append(option).trigger('change')

        // manually trigger the `select2:select` event
        dropdown.trigger({
            type: 'select2:select',
            params: {
                data: data
            }
        })
    }
    </script>
@endpush