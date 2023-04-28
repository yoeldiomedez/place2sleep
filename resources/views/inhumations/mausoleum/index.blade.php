@extends('layouts.app')

@section('pagetitle', 'Inhumaciones Mausoleo')
@section('pagesubtitle', auth()->user()->cemetery_appellation)

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="JavaScript:;" id="reloadInhumationDT">@yield('pagetitle')</a>
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
                            <button id="newInhumationBtn" class="btn btn-outline blue">
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
                <table id="inhumationDataTable" class="table table-hover table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Convenio</th>
                            <th>Pabellón</th>
                            <th>Mausoleo</th>
                            <th>Difunto</th>
                            <th>Costo Total (S/)</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@include('inhumations.mausoleum.create')
@include('inhumations.mausoleum.edit')
@include('inhumations.mausoleum.delete')

@endsection

@push('scripts')
    <script>
    $(document).ready( function () {
        
        /**************************************************************************/
        /* Lista - Read
        /**************************************************************************/
        var inhumationDataTable = setUpDataTable(
            '#inhumationDataTable',
            'Lista de Inhumaciones en Mausoleo',
            [ 0, 1, 2, 3, 4, 5],
            [
                {
                    targets: [2, 3],
                    sortable: false
                }
            ],
            [
                {data: 'id', name: 'id'},
                {data: 'agreement', name: 'agreement', render: function ( data, type, row ) {
                    return formatStateLabel(row.agreement)
                }},
                {data: 'buriable.pavilion.name', name: 'buriable.pavilion.name'},
                {data: null, render: function ( data, type, row ) {
                        return row.buriable.name +' - '+ row.buriable.location
                }},
                {data: 'deceased.document_numb', name: 'deceased.document_numb', render: function ( data, type, row ) {
                    return row.deceased.document_numb +' - '+ row.deceased.names +' '+ row.deceased.surnames
                }},
                {data: 'amount', name: 'amount', render: function ( data, type, row ) {
                    return totalAmount(row.amount, row.discount, row.additional)
                }},
                {data: 'buttons', orderable: false, className: "text-center btn-actions"},
            ]
        )

        $('#inhumationDataTable').removeClass('no-footer')
        $.fn.dataTable.ext.errMode = 'throw'

        $('#reloadInhumationDT').click( function () { 

            $('#inhumationDataTable').DataTable().destroy()

            inhumationDataTable = setUpDataTable(
                '#inhumationDataTable',
                'Lista de Inhumaciones en Mausoleo',
                [ 0, 1, 2, 3, 4, 5],
                [
                    {
                        targets: [2, 3],
                        sortable: false
                    }
                ],
                [
                    {data: 'id', name: 'id'},
                    {data: 'agreement', name: 'agreement', render: function ( data, type, row ) {
                        return formatStateLabel(row.agreement)
                    }},
                    {data: 'buriable.pavilion.name', name: 'buriable.pavilion.name'},
                    {data: null, render: function ( data, type, row ) {
                        return row.buriable.name +' - '+ row.buriable.location
                    }},
                    {data: 'deceased.document_numb', name: 'deceased.document_numb', render: function ( data, type, row ) {
                        return row.deceased.document_numb +' - '+ row.deceased.names +' '+ row.deceased.surnames
                    }},
                    {data: 'amount', name: 'amount', render: function ( data, type, row ) {
                        return totalAmount(row.amount, row.discount, row.additional)
                    }},
                    {data: 'buttons', orderable: false, className: "text-center btn-actions"},
                ]
            )
            $('#inhumationDataTable').removeClass('no-footer')
        })

        // Filtro Mausoleo por Pabellon
        $('#pavilionFilter').empty()

        getPavilions('#pavilionFilter', 'M')

        $('#pavilionFilter').on('select2:select', function (event) {

            var data        = event.params.data
            let pavilion_id = data.id
            
            // console.log(pavilion_id)

            $('#inhumationDataTable').DataTable().destroy()

            inhumationDataTable = setUpDataTable(
                '#inhumationDataTable',
                'Lista de Inhumaciones en Mausoleo',
                [ 0, 1, 2, 3, 4, 5],
                [
                    {
                        targets: [2, 3],
                        sortable: false
                    }
                ],
                [
                    {data: 'id', name: 'id'},
                    {data: 'agreement', name: 'agreement', render: function ( data, type, row ) {
                        return formatStateLabel(row.agreement)
                    }},
                    {data: 'buriable.pavilion.name', name: 'buriable.pavilion.name'},
                    {data: null, render: function ( data, type, row ) {
                        return row.buriable.name +' - '+ row.buriable.location
                    }},
                    {data: 'deceased.document_numb', name: 'deceased.document_numb', render: function ( data, type, row ) {
                        return row.deceased.document_numb +' - '+ row.deceased.names +' '+ row.deceased.surnames
                    }},
                    {data: 'amount', name: 'amount', render: function ( data, type, row ) {
                        return totalAmount(row.amount, row.discount, row.additional)
                    }},
                    {data: 'buttons', orderable: false, className: "text-center btn-actions"},
                ],
                {
                    pavilion_id: pavilion_id
                }
            )
            
            $('#inhumationDataTable').removeClass('no-footer')
        })

        /*************************************************************************/
        /* Agregar - Create
        /*************************************************************************/
        $('#newInhumationBtn').click( function () {

            $('#newMausoleum').empty()
            $('#newDeceased').empty()
            $('#newRelative').empty()
            
            getMausoleums('#newMausoleum')
            getDeceaseds('#newDeceased')
            getRelatives('#newRelative')

            setUpFormModal('#newInhumationForm', '#newInhumationModal', 'show')
            
            $('#newMausoleum').on('select2:select', function (event) {
                // console.log(data)
                var data = event.params.data
                let id   = data.id

                $.ajax({
                    type: 'GET',
                    url: "{{ url('mausoleum') }}" + '/' + id,
                    success: function(data) {
                        // console.log(data)
                        let price = data.price / data.size
                        $('#newMausoleumPrice').val(price.toFixed(2))
                    },
                    error: function(xhr, status) {
                        console.log(xhr.responseJSON.message)
                    }
                })
            })
        })

        $('#newInhumationForm').submit( function (event) {
            event.preventDefault()
            addInhumation('#newInhumationForm', '#newInhumationModal', inhumationDataTable)
        })

        /*************************************************************************/
        /* Editar - Update
        /*************************************************************************/
        $('#inhumationDataTable tbody').on('click', '#editInhumationBtn', function () {
            let data = inhumationDataTable.row($(this).parents('tr')).data()
            
            $('#editMausoleum').empty()
            $('#editDeceased').empty()
            $('#editRelative').empty()
            
            getMausoleums('#editMausoleum')
            getDeceaseds('#editDeceased')
            getRelatives('#editRelative')

            selectMausoleum('#editMausoleum', data.buriable)
            selectDeceased('#editDeceased', data.deceased)
            selectRelative('#editRelative', data.relative)

            setUpFormModal('#updateInhumationForm', '#updateInhumationModal', 'show', data)

            $('#editMausoleum').on('select2:select', function (event) {
                // console.log(data)
                var data = event.params.data
                let id   = data.id

                $.ajax({
                    type: 'GET',
                    url: "{{ url('mausoleum') }}" + '/' + id,
                    success: function(data) {
                        // console.log(data)
                        let price = data.price / data.size
                        $('#editMausoleumPrice').val(price.toFixed(2))
                    },
                    error: function(xhr, status) {
                        console.log(xhr.responseJSON.message)
                    }
                })
            })
        })

        $('#updateInhumationForm').submit( function (event) {
            event.preventDefault()
            updateInhumation(
                $('#update').val(),
                '#updateInhumationForm',
                '#updateInhumationModal',
                inhumationDataTable
            )
        })

        /**************************************************************************/
        /* Eliminar - Delete
        /**************************************************************************/
        $('#inhumationDataTable tbody').on('click', '#deleteInhumationBtn', function (){
            let data = inhumationDataTable.row($(this).parents('tr')).data()
            setUpFormModal('#deleteInhumationForm', '#deleteInhumationModal', 'show', data)
        })

        $('#deleteInhumationForm').submit( function (event) {
            event.preventDefault()
            deleteInhumation(
                $('#delete').val(),
                '#deleteInhumationForm',
                '#deleteInhumationModal',
                inhumationDataTable
            )
        })
    })

    const url = "{{ url('mausoleums/inhumation') }}"

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
            $('#notes').val(data.notes)
            $('#discount').val(data.discount)
            $('#additional').val(data.additional)

            let price = data.buriable.price / (data.buriable.size + data.buriable.extensions)
            $('#editMausoleumPrice').val(price.toFixed(2))

            switch (data.agreement) {
                case 'Compra':
                    document.getElementById('agreement').selectedIndex = '1'
                    break;
                case 'Renovacion':
                    document.getElementById('agreement').selectedIndex = '2'
                    break;
                case 'Traslado Interno':
                    document.getElementById('agreement').selectedIndex = '3'
                    break;
                case 'Traslado Externo':
                    document.getElementById('agreement').selectedIndex = '4'
                    break;
                default:
                    document.getElementById('agreement').selectedIndex = '0'
                    break;
            }

            $('p').text(data.buriable.name +' - '+ data.deceased.document_numb +' - '+ data.deceased.names +' '+ data.deceased.surnames)
        }

        $(modal).modal(behavior)
    }

    function addInhumation(form, modal, dataTable) {

        loading('#registrar', 'start')

        $.ajax({
            type: 'POST',
            url: url,
            data: $(form).serialize(),
            success: function(data) {
                // console.log(data)
                setUpFormModal(form, modal, 'hide')

                dataTable.ajax.reload()

                toastrMessage('success', 'Inhumación Registrada')
                loading('#registrar', 'stop')
            },
            error: function(xhr, status) {
                // console.log(xhr.responseJSON.message)
                toastrMessage(status, 'La Inhumación no pudo ser Registrada')
                loading('#registrar', 'stop')
            }
        })
    }

    function updateInhumation(id, form, modal, dataTable) {

        loading('#actualizar', 'start')

        $.ajax({
            type: 'PUT',
            url: url + "/" + id,
            data: $(form).serialize(),
            success: function(data) {
                // console.log(data)
                setUpFormModal(form, modal, 'hide')

                let row = $('#inhumationDataTable').dataTable().fnFindCellRowIndexes(id, 0)

                dataTable.cell(row, 1).data(formatStateLabel(data.agreement)).draw(false)
                dataTable.cell(row, 2).data(data.buriable.pavilion.name).draw(false)
                dataTable.cell(row, 3).data(data.buriable.name +' - '+ data.buriable.location).draw(false)
                dataTable.cell(row, 4).data(data.deceased.document_numb +' - '+ data.deceased.names +' '+ data.deceased.surnames).draw(false)
                dataTable.cell(row, 5).data(data.amount).draw(false)

                toastrMessage('info', 'Inhumación Actualizada')
                loading('#actualizar', 'stop')
            },
            error: function(xhr, status) {
                // console.log(xhr.responseJSON.message)
                toastrMessage(status, 'La Inhumación no pudo ser Actualizada')
                loading('#actualizar', 'stop')
            }
        })
    }

    function deleteInhumation(id, form, modal, dataTable) {

        loading('#eliminar', 'start')

        $.ajax({
            type: 'DELETE',
            url: url + "/" + id,
            data: $(form).serialize(),
            success: function(data) {
                //console.log(data)
                setUpFormModal(form, modal, 'hide')

                let row = $('#inhumationDataTable').dataTable().fnFindCellRowIndexes(id, 0)
                dataTable.row(row).remove().draw()

                toastrMessage('warning', 'Inhumación Eliminada')
                loading('#eliminar', 'stop')
            },
            error: function(xhr, status) {
                // console.log(xhr.responseJSON.message)
                toastrMessage(status, 'La Inhumación no pudo ser Eliminada')
                loading('#eliminar', 'stop')
            }
        })
    }

    function formatStateLabel(state) {

        switch (state) {
            case 'Compra':
                return '<span class="label label-primary">'+state+'</span>'
                break;
            case 'Renovacion':
                return '<span class="label label-success">'+state+'</span>'
                break;
            case 'Traslado Interno':
                return '<span class="label label-warning">'+state+'</span>'
                break;
            case 'Traslado Externo':
                return '<span class="label label-danger">'+state+'</span>'
                break;
            default:
                return '<span class="label label-default">'+state+'</span>'
                break;
        }
    }

    function totalAmount(amount, discount, additional) {
        let total = (parseFloat(amount) + parseFloat(additional)) - parseFloat(discount)
        return total.toFixed(2)
    }

    /*
     * API Call Functions
     */
    function getDeceaseds(obj) {

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
                        url: "{{ url('api/deceased') }}",
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
                                        text: item.names +' '+
                                              item.surnames +' - '+
                                              item.document_numb
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

    function getRelatives(obj) {

        $('body').on('shown.bs.modal', '.modal', function() {
            // Select2 inside of a modal (Bootstrap 3.x) that has not yet been rendered or opened
            $(this).find('select').each(function() {
                let dropdownParent = $(document.body)
                if ($(this).parents('.modal.in:first').length !== 0)
                    dropdownParent = $(this).parents('.modal.in:first')

                $(obj).select2({
                    dropdownParent: dropdownParent,
                    language: 'es',
                    placeholder: 'Seleccione un Familiar',
                    allowClear: true,
                    ajax: {
                        url: "{{ url('api/relative') }}",
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
                                        text: item.names +' '+
                                                item.surnames +' - '+
                                                item.document_numb
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

    function getMausoleums(obj) {

        $('body').on('shown.bs.modal', '.modal', function() {
            // Select2 inside of a modal (Bootstrap 3.x) that has not yet been rendered or opened
            $(this).find('select').each(function() {
                let dropdownParent = $(document.body)
                if ($(this).parents('.modal.in:first').length !== 0)
                    dropdownParent = $(this).parents('.modal.in:first')

                $(obj).select2({
                    dropdownParent: dropdownParent,
                    language: 'es',
                    placeholder: 'Seleccione un Mausoleo',
                    allowClear: true,
                    ajax: {
                        url: "{{ url('api/mausoleum') }}",
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
                                        text: item.pavilion.name +' - '+
                                                item.name +' '+
                                                item.location +' ('+
                                                item.availability +')'
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
    
    function selectDeceased(obj, data){
        // Fetch the preselected item, and add to the control
        var dropdown = $(obj)

        // create the option and append to Select2
        let option = new Option(data.names+' '+ data.surnames +' - '+ data.document_numb, data.id, true, true)
        dropdown.append(option).trigger('change')

        // manually trigger the `select2:select` event
        dropdown.trigger({
            type: 'select2:select',
            params: {
                data: data
            }
        })
    }

    function selectRelative(obj, data){
        // Fetch the preselected item, and add to the control
        var dropdown = $(obj)

        // create the option and append to Select2
        let option = new Option(data.names+' '+ data.surnames +' - '+ data.document_numb, data.id, true, true)
        dropdown.append(option).trigger('change')

        // manually trigger the `select2:select` event
        dropdown.trigger({
            type: 'select2:select',
            params: {
                data: data
            }
        })
    }

    function selectMausoleum(obj, data){
        // Fetch the preselected item, and add to the control
        var dropdown = $(obj)

        // create the option and append to Select2
        let option = new Option(data.pavilion.name +' - '+ data.name +' '+ data.location +' ('+ data.availability +')', data.id, true, true)
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