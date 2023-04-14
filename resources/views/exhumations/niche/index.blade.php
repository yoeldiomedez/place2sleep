@section('styles')
    @parent
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}"  rel="stylesheet">
    <link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet"/>
    <!-- END PAGE LEVEL SCRIPTS -->
@endsection

@extends('layouts.app')

@section('pagetitle', 'Exhumaciones Nicho')
@section('pagesubtitle', auth()->user()->cemetery_appellation)

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="JavaScript:;" id="reloadExhumationDT">@yield('pagetitle')</a>
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
                            <button id="newExhumationBtn" class="btn btn-outline blue">
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
                <table id="exhumationDataTable" class="table table-hover table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Fecha</th>
                            <th>Pabellón</th>
                            <th>Nicho</th>
                            <th>Difunto</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@include('exhumations.niche.create')
@include('exhumations.niche.edit')
@include('exhumations.niche.delete')

@endsection

@push('scripts')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}"></script>
    <script src="{{ asset('assets/global/plugins/datatables/plugins/fnFindCellRowIndexes.js') }}"></script>

    <script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/global/plugins/select2/js/i18n/es.js') }}"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <script>
    $(document).ready( function () {
        
        /**************************************************************************/
        /* Lista - Read
        /**************************************************************************/
        var exhumationDataTable = setUpDataTable(
            '#exhumationDataTable',
            'Lista de Exhumaciones en Nicho',
            [ 0, 1, 2, 3, 4],
            [
                {
                    targets: [2, 3, 4],
                    sortable: false
                }
            ],
            [
                {data: 'id', name: 'id'},
                {data: 'created_at', name: 'created_at'},
                {data: 'inhumation.buriable.pavilion.name', name: 'inhumation.buriable.pavilion.name'},
                {data: null, render: function ( data, type, row ) {
                    return row.inhumation.buriable.row_x +' - '+ row.inhumation.buriable.col_y
                }},
                {data: 'inhumation.deceased.document_numb', name: 'inhumation.deceased.document_numb', render: function ( data, type, row ) {
                    return row.inhumation.deceased.document_numb +' - '+ row.inhumation.deceased.names +' '+ row.inhumation.deceased.surnames
                }},
                {data: 'buttons', orderable: false, className: "text-center btn-actions"},
            ]
        )

        $('#exhumationDataTable').removeClass('no-footer')
        $.fn.dataTable.ext.errMode = 'throw'

        $('#reloadExhumationDT').click( function () { 

            $('#exhumationDataTable').DataTable().destroy()

            exhumationDataTable = setUpDataTable(
                '#exhumationDataTable',
                'Lista de Exhumaciones en Nicho',
                [ 0, 1, 2, 3, 4],
                [
                    {
                        targets: [2, 3, 4],
                        sortable: false
                    }
                ],
                [
                    {data: 'id', name: 'id'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'inhumation.buriable.pavilion.name', name: 'inhumation.buriable.pavilion.name'},
                    {data: null, render: function ( data, type, row ) {
                        return row.inhumation.buriable.row_x +' - '+ row.inhumation.buriable.col_y
                    }},
                    {data: 'inhumation.deceased.document_numb', name: 'inhumation.deceased.document_numb', render: function ( data, type, row ) {
                        return row.inhumation.deceased.document_numb +' - '+ row.inhumation.deceased.names +' '+ row.inhumation.deceased.surnames
                    }},
                    {data: 'buttons', orderable: false, className: "text-center btn-actions"},
                ]
            )
            $('#exhumationDataTable').removeClass('no-footer')
        })

        // Filtro Nicho por Pabellon
        $('#pavilionFilter').empty()

        getPavilions('#pavilionFilter', 'N')

        $('#pavilionFilter').on('select2:select', function (event) {

            var data        = event.params.data
            let pavilion_id = data.id
            
            // console.log(pavilion_id)

            $('#exhumationDataTable').DataTable().destroy()

            exhumationDataTable = setUpDataTable(
                '#exhumationDataTable',
                'Lista de Exhumaciones en Nicho',
                [ 0, 1, 2, 3, 4],
                [
                    {
                        targets: [2, 3, 4],
                        sortable: false
                    }
                ],
                [
                    {data: 'id', name: 'id'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'inhumation.buriable.pavilion.name', name: 'inhumation.buriable.pavilion.name'},
                    {data: null, render: function ( data, type, row ) {
                        return row.inhumation.buriable.row_x +' - '+ row.inhumation.buriable.col_y
                    }},
                    {data: 'inhumation.deceased.document_numb', name: 'inhumation.deceased.document_numb', render: function ( data, type, row ) {
                        return row.inhumation.deceased.document_numb +' - '+ row.inhumation.deceased.names +' '+ row.inhumation.deceased.surnames
                    }},
                    {data: 'buttons', orderable: false, className: "text-center btn-actions"},
                ],
                {
                    pavilion_id: pavilion_id
                }
            )
            
            $('#exhumationDataTable').removeClass('no-footer')
        })

        /*************************************************************************/
        /* Agregar - Create
        /*************************************************************************/
        $('#newExhumationBtn').click( function () {

            $('#newDeceasedInNiche').empty()
            getDeceasedsInNiche('#newDeceasedInNiche')
            setUpFormModal('#newExhumationForm', '#newExhumationModal', 'show')
        })

        $('#newExhumationForm').submit( function (event) {
            event.preventDefault()
            addExhumation('#newExhumationForm', '#newExhumationModal', exhumationDataTable)
        })

        /*************************************************************************/
        /* Editar - Update
        /*************************************************************************/
        $('#exhumationDataTable tbody').on('click', '#editExhumationBtn', function () {
            let data = exhumationDataTable.row($(this).parents('tr')).data()
            
            $('#editDeceasedInNiche').empty()
            getDeceasedsInNiche('#editDeceasedInNiche')
            selectDeceasedsInNiche('#editDeceasedInNiche', data)
            setUpFormModal('#updateExhumationForm', '#updateExhumationModal', 'show', data)
        })

        $('#updateExhumationForm').submit( function (event) {
            event.preventDefault()
            updateExhumation(
                $('#update').val(),
                '#updateExhumationForm',
                '#updateExhumationModal',
                exhumationDataTable
            )
        })

        /**************************************************************************/
        /* Eliminar - Delete
        /**************************************************************************/
        $('#exhumationDataTable tbody').on('click', '#deleteExhumationBtn', function (){
            let data = exhumationDataTable.row($(this).parents('tr')).data()
            setUpFormModal('#deleteExhumationForm', '#deleteExhumationModal', 'show', data)
        })

        $('#deleteExhumationForm').submit( function (event) {
            event.preventDefault()
            deleteExhumation(
                $('#delete').val(),
                '#deleteExhumationForm',
                '#deleteExhumationModal',
                exhumationDataTable
            )
        })
    })

    const url = "{{ url('niches/exhumation') }}"

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
            dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'><'col-md-6 col-sm-12'>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
        })

        return dataTable
    }

    function setUpFormModal(form, modal, behavior, data = false) {

        $(form)[0].reset()

        if (data) {
            // console.log(data)
            $('#update').val(data.id)
            $('#delete').val(data.id)
            
            $('#ric').val(data.ric)
            $('#doc').val(data.doc)
            $('#notes').val(data.notes)

            let pavilion = data.inhumation.buriable.pavilion.name
            let niche = data.inhumation.buriable.row_x +' '+ data.inhumation.buriable.col_y

            $('p').text(pavilion +' | '+ niche)
        }

        $(modal).modal(behavior)
    }

    function addExhumation(form, modal, dataTable) {

        loading('#registrar', 'start')

        $.ajax({
            type: 'POST',
            url: url,
            data: $(form).serialize(),
            success: function(data) {
                // console.log(data)
                setUpFormModal(form, modal, 'hide')

                dataTable.ajax.reload()

                toastrMessage('success', 'Exhumación Registrada')
                loading('#registrar', 'stop')
            },
            error: function(xhr, status) {
                // console.log(xhr.responseJSON.message)
                toastrMessage(status, 'La Exhumación no pudo ser Registrada')
                loading('#registrar', 'stop')
            }
        })
    }

    function updateExhumation(id, form, modal, dataTable) {

        loading('#actualizar', 'start')

        $.ajax({
            type: 'PUT',
            url: url + "/" + id,
            data: $(form).serialize(),
            success: function(data) {
                // console.log(data)
                setUpFormModal(form, modal, 'hide')

                dataTable.ajax.reload()

                toastrMessage('info', 'Exhumación Actualizada')
                loading('#actualizar', 'stop')
            },
            error: function(xhr, status) {
                // console.log(xhr.responseJSON.message)
                toastrMessage(status, 'La Exhumación no pudo ser Actualizada')
                loading('#actualizar', 'stop')
            }
        })
    }

    function deleteExhumation(id, form, modal, dataTable) {

        loading('#eliminar', 'start')

        $.ajax({
            type: 'DELETE',
            url: url + "/" + id,
            data: $(form).serialize(),
            success: function(data) {
                //console.log(data)
                setUpFormModal(form, modal, 'hide')

                let row = $('#exhumationDataTable').dataTable().fnFindCellRowIndexes(id, 0)
                dataTable.row(row).remove().draw()

                toastrMessage('warning', 'Exhumación Eliminada')
                loading('#eliminar', 'stop')
            },
            error: function(xhr, status) {
                // console.log(xhr.responseJSON.message)
                toastrMessage(status, 'La Exhumación no pudo ser Eliminada')
                loading('#eliminar', 'stop')
            }
        })
    }

    /*
     * API Call Functions
     */
    function getDeceasedsInNiche(obj) {

        $('body').on('shown.bs.modal', '.modal', function() {
            // Select2 inside of a modal (Bootstrap 3.x) that has not yet been rendered or opened
            $(this).find('select').each(function() {
                let dropdownParent = $(document.body)
                if ($(this).parents('.modal.in:first').length !== 0)
                    dropdownParent = $(this).parents('.modal.in:first')

                $(obj).select2({
                    dropdownParent: dropdownParent,
                    language: 'es',
                    placeholder: 'Seleccione un Difunto',
                    allowClear: true,
                    ajax: {
                        url: "{{ url('api/niches/inhumation') }}",
                        dataType: 'json',
                        delay: 250,
                        data: function (params) {
                            return {
                                term: params.term,
                                page: params.page
                            }
                        },
                        processResults: function (data, params) {

                            params.page = params.page || 1

                            return {
                                results:  $.map(data.data, function (item) {
                                    return {
                                        id:   item.id,
                                        text: item.deceased.document_numb +' - '+
                                            item.deceased.names +' '+
                                            item.deceased.surnames +' | '+
                                            item.buriable.pavilion.name +' | '+
                                            item.buriable.row_x +' '+
                                            item.buriable.col_y
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
    }

    function selectDeceasedsInNiche(obj, data){
        // Fetch the preselected item, and add to the control
        var dropdown = $(obj)

        let deceased = data.inhumation.deceased.document_numb +' - '+ data.inhumation.deceased.names +' '+ data.inhumation.deceased.surnames
        let pavilion = data.inhumation.buriable.pavilion.name
        let niche    = data.inhumation.buriable.row_x +' '+ data.inhumation.buriable.col_y

        // create the option and append to Select2
        let option = new Option(deceased +' | '+ pavilion +' | '+ niche, data.id, true, true)
        dropdown.append(option).trigger('change')

        // manually trigger the `select2:select` event
        dropdown.trigger({
            type: 'select2:select',
            params: {
                data: data
            }
        })
    }

    function getPavilions(obj, type) {

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
    </script>
@endpush