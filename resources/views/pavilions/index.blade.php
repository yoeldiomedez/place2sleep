@extends('layouts.main')

@section('pagetitle', 'Pabellones')
@section('pagesubtitle', auth()->user()->cemetery_appellation)

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="JavaScript:;" id="reloadPavilionDT">@yield('pagetitle')</a>
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
                        <button id="newPavilionBtn" class="btn btn-outline blue"> 
                            <i class="fa fa-plus"></i> Agregar
                        </button>
                    </div>    
                </div>              
            </div>
            <div class="portlet-body">
                <table id="pavilionDataTable" class="table table-hover table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Tipo</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@include('pavilions.create')
@include('pavilions.edit')
@include('pavilions.delete')

@endsection

@push('scripts')
    <script>
    $(document).ready( function () {
        /**************************************************************************/
        /* Lista - Read
        /**************************************************************************/
        const pavilionDataTable = setUpDataTable(
            '#pavilionDataTable', 
            'Lista de Pabellones', 
            [ 0, 1, 2],
            [],
            [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'type', name: 'type'},
                {data: 'buttons', orderable: false, className: "text-center btn-actions"},
            ]
        )

        $('#pavilionDataTable').removeClass('no-footer')
        $.fn.dataTable.ext.errMode = 'throw'

        $('#reloadPavilionDT').click( function () {
            pavilionDataTable.ajax.reload()
        })

        /*************************************************************************/
        /* Agregar - Create
        /*************************************************************************/
        $('#newPavilionBtn').click( function () {
            setUpFormModal('#newPavilionForm', '#newPavilionModal', 'show')
        })
        
        $('#newPavilionForm').submit( function(event) {
            event.preventDefault()
            addPavilion('#newPavilionForm', '#newPavilionModal', pavilionDataTable) 
        })

        /*************************************************************************/
        /* Editar - Update
        /*************************************************************************/
        $('#pavilionDataTable tbody').on('click', '#editPavilionBtn', function(){
            let data = pavilionDataTable.row($(this).parents('tr')).data()
            setUpFormModal('#updatePavilionForm', '#updatePavilionModal', 'show', data)
        })

        $('#updatePavilionForm').submit( function(event) {
            event.preventDefault()
            updatePavilion(
                $('#update').val(), 
                '#updatePavilionForm', 
                '#updatePavilionModal', 
                pavilionDataTable
            )
        })

        /**************************************************************************/
        /* Eliminar - Delete
        /**************************************************************************/
        $('#pavilionDataTable tbody').on('click', '#deletePavilionBtn', function(){
            let data = pavilionDataTable.row($(this).parents('tr')).data()
            setUpFormModal('#deletePavilionForm', '#deletePavilionModal', 'show', data)
        })

        $('#deletePavilionForm').submit( function(event) {
            event.preventDefault()
            deletePavilion(
                $('#delete').val(), 
                '#deletePavilionForm', 
                '#deletePavilionModal', 
                pavilionDataTable
            )
        })
    })

    const url = "{{ url('pavilion') }}"

    function setUpDataTable(id, exportTitle, exportColumns, columnDefs, columns) {
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
            ajax: url,
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

            $('#name').val(data.name)

            if ( data.type == 'Nicho' ) {
                 $('#niche').prop('checked', true)
            } else { 
                $('#mausoleum').prop('checked', true) 
            }

            $('p').text(data.name +' - '+ data.type)
        }

        $(modal).modal(behavior)
    }

    function addPavilion(form, modal, dataTable) {

        loading('#registrar', 'start')

        $.ajax({
            type: 'POST',
            url: url,
            data: $(form).serialize(),
            success: function(data) {
                // console.log(data)
                setUpFormModal(form, modal, 'hide')

                dataTable.ajax.reload()

                toastrMessage('success', 'Pabellón Registrado')
                loading('#registrar', 'stop')
            },
            error: function(xhr, status) {
                // console.log(xhr.responseJSON.message)
                toastrMessage(status, 'El Pabellón no pudo ser Registrado')
                loading('#registrar', 'stop')
            }
        })
    }

    function updatePavilion(id, form, modal, dataTable) {

        loading('#actualizar', 'start')

        $.ajax({
            type: 'PUT',
            url: url + "/" + id,
            data: $(form).serialize(),
            success: function(data) {
                // console.log(data)
                setUpFormModal(form, modal, 'hide')

                let row = $('#pavilionDataTable').dataTable().fnFindCellRowIndexes(id, 0)

                dataTable.cell(row, 1).data(data.name).draw(false)
                dataTable.cell(row, 2).data(data.type).draw(false)

                toastrMessage('info', 'Pabellón Actualizado')
                loading('#actualizar', 'stop')
            },
            error: function(xhr, status) {
                // console.log(xhr.responseJSON.message)
                toastrMessage(status, 'El Pabellón no pudo ser Actualizado')
                loading('#actualizar', 'stop')
            }
        })
    }

    function deletePavilion(id, form, modal, dataTable) {

        loading('#eliminar', 'start')

        $.ajax({
            type: 'DELETE',
            url: url + "/" + id,
            data: $(form).serialize(),
            success: function(data) {
                //console.log(data)
                setUpFormModal(form, modal, 'hide')

                let row = $('#pavilionDataTable').dataTable().fnFindCellRowIndexes(id, 0)
                dataTable.row(row).remove().draw()
                    
                toastrMessage('warning', 'Pabellón Eliminado')
                loading('#eliminar', 'stop')

            }, 
            error: function(xhr, status) {
                // console.log(xhr.responseJSON.message)
                toastrMessage(status, 'El Pabellón no pudo ser Eliminado')
                loading('#eliminar', 'stop')
            }
        })
    }
    </script>
@endpush