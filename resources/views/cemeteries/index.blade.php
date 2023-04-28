@extends('layouts.app')

@section('pagetitle', 'Cementerios')
@section('pagesubtitle', '')

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="JavaScript:;" id="reloadCemeteryDT">@yield('pagetitle')</a>
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
                    <div class="col-xs-12 col-xs-offset-4 col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 col-lg-12 col-lg-offset-0">
                        <button id="newCemeteryBtn" class="btn btn-outline blue"> 
                            <i class="fa fa-plus"></i> Agregar
                        </button>
                    </div>    
                </div>              
            </div>
            <div class="portlet-body">
                <table id="cemeteryDataTable" class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@include('cemeteries.create')
@include('cemeteries.edit')
@include('cemeteries.delete')

@endsection

@push('scripts')
    <script>
    $(document).ready( function () {
        /**************************************************************************/
        /* Lista - Read
        /**************************************************************************/
        const cemeteryDataTable = setUpDataTable('#cemeteryDataTable', 'Lista de Cementerios', [0,1])

        $.fn.dataTable.ext.errMode = 'throw'
        $('#cemeteryDataTable').removeClass('no-footer')

        $('#reloadCemeteryDT').click( function () {
            cemeteryDataTable.ajax.reload()
        })

        /*************************************************************************/
        /* Agregar - Create
        /*************************************************************************/
        $('#newCemeteryBtn').click( function () {
            setUpFormModal('#newCemeteryForm', '#newCemeteryModal', 'show')
        })
        
        $('#newCemeteryForm').submit( function(event) {
            event.preventDefault()
            addCemetery('#newCemeteryForm', '#newCemeteryModal', cemeteryDataTable)
        })

        /*************************************************************************/
        /* Editar - Update
        /*************************************************************************/
        $('#cemeteryDataTable tbody').on('click', '#editCemeteryBtn', function(){
            let data = cemeteryDataTable.row($(this).parents('tr')).data()
            setUpFormModal('#updateCemeteryForm', '#updateCemeteryModal', 'show', data)
        })

        $('#updateCemeteryForm').submit( function(event) {
            event.preventDefault()
            let id = $('#update').val()
            updateCemetery(id, '#updateCemeteryForm', '#updateCemeteryModal', cemeteryDataTable)
        })

        /**************************************************************************/
        /* Eliminar - Delete
        /**************************************************************************/
        $('#cemeteryDataTable tbody').on('click', '#deleteCemeteryBtn', function(){
            let data = cemeteryDataTable.row($(this).parents('tr')).data()
            setUpFormModal('#deleteCemeteryForm', '#deleteCemeteryModal', 'show', data)
        })

        $('#deleteCemeteryForm').submit( function(event) {
            event.preventDefault();
            let id = $('#delete').val()
            deleteCemetery(id, '#deleteCemeteryForm', '#deleteCemeteryModal', cemeteryDataTable)
        })
    })

    const url = "{{ url('cemetery') }}"

    function setUpDataTable(id, exportTitle, exportColumns) {
        let dataTable = $(id).DataTable({
            language: {
                zeroRecords: "No se encontraron resultados",
                info: "",
                infoEmpty: "",
                infoFiltered: "",
                search:"Buscar ",
                lengthMenu: "_MENU_",
                processing: '<i class="fa fa-circle-o-notch fa-spin"></i> Cargando ',
            },
            order: [[ 0, "desc" ]],
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todo"]],
            serverSide: true,
            processing: true,
            ajax: url,
            columns: [
                {data: 'id', name: 'id'},
                {data: 'appellation', name: 'appellation'},
                {data: 'buttons', orderable: false, width: "30%", className: "text-center btn-actions"},
            ],
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

            $('#appellation').val(data.appellation)

            $('p').text(data.appellation)
        }

        $(modal).modal(behavior)
    }

    function addCemetery(form, modal, dataTable) {

        $.post(url, $(form).serialize()).done(function (data) {
            // console.log(data)
            setUpFormModal(form, modal, 'hide')
            dataTable.ajax.reload()
            toastrMessage('success', 'Cementerio Registrado')
        })
        .fail(function() {
            toastrMessage('error', 'El Cementerio no pudo ser Registrado')
        })
    }

    function updateCemetery(id, form, modal, dataTable) {

        $.ajax({
            type: 'PUT',
            url: url + "/" + id,
            data: $(form).serialize(),
            success: function(data) {
                // console.log(data)
                setUpFormModal(form, modal, 'hide')

                let row = $('#cemeteryDataTable').dataTable().fnFindCellRowIndexes(id, 0)

                dataTable.cell(row, 1).data(data.appellation).draw(false)

                toastrMessage('info', 'Cementerio Actualizado')
            },
            error: function(xhr, status) {
                toastrMessage('error', 'El Cementerio no pudo ser Actualizado')
            }
        })
    }

    function deleteCemetery(id, form, modal, dataTable) {

        $.ajax({
            type: 'DELETE',
            url: url + "/" + id,
            data: $(form).serialize(),
            success: function(data) {
                //console.log(data)
                setUpFormModal(form, modal, 'hide')

                let row = $('#cemeteryDataTable').dataTable().fnFindCellRowIndexes(id, 0)
                dataTable.row(row).remove().draw()
                    
                toastrMessage('warning', 'Cementerio Eliminado')
            }, 
            error: function(xhr, status) {
                toastrMessage('error', 'El Cementerio no pudo ser Eliminado')
            }
        })
    }
    </script>
@endpush