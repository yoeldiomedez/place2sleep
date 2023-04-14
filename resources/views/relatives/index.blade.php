@section('styles')
    @parent
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}"  rel="stylesheet">
    <link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet">
    <!-- END PAGE LEVEL SCRIPTS -->
@endsection

@extends('layouts.app')

@section('pagetitle', 'Familiares')
@section('pagesubtitle', '')

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="JavaScript:;" id="reloadRelativeDT">@yield('pagetitle')</a>
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
                        <button id="newRelativeBtn" class="btn btn-outline blue"> 
                            <i class="fa fa-plus"></i> Agregar
                        </button>
                    </div>    
                </div>              
            </div>
            <div class="portlet-body">
                <table id="relativeDataTable" class="table table-hover table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Tipo Documento</th>
                            <th>N° de Documento</th>
                            <th>N° Celular</th>
                            <th>Dirección</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@include('relatives.create')
@include('relatives.edit')
@include('relatives.delete')

@endsection

@push('scripts')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}"></script>
    <script src="{{ asset('assets/global/plugins/datatables/plugins/fnFindCellRowIndexes.js') }}"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <script>
    $(document).ready( function () {
        /**************************************************************************/
        /* Lista - Read
        /**************************************************************************/
        const relativeDataTable = setUpDataTable(
            '#relativeDataTable', 
            'Lista de Familiares', 
            [ 0, 1, 2, 3, 4, 5, 6],
            [],
            [
                {data: 'id', name: 'id'},
                {data: 'names', name: 'names'},
                {data: 'surnames', name: 'surnames'},
                {data: 'document_type', name: 'document_type'},
                {data: 'document_numb', name: 'document_numb'},
                {data: 'cellphone_numb', name: 'cellphone_numb'},
                {data: 'address', name: 'address'},
                {data: 'buttons', orderable: false, className: "text-center btn-actions"},
            ]
        )

        $.fn.dataTable.ext.errMode = 'throw'

        $('#reloadRelativeDT').click( function () {
            relativeDataTable.ajax.reload()
        })

        /*************************************************************************/
        /* Agregar - Create
        /*************************************************************************/
        $('#newRelativeBtn').click( function () {
            setUpFormModal('#newRelativeForm', '#newRelativeModal', 'show')
        })
        
        $('#newRelativeForm').submit( function(event) {
            event.preventDefault()
            addRelative('#newRelativeForm', '#newRelativeModal', relativeDataTable) 
        })

        /*************************************************************************/
        /* Editar - Update
        /*************************************************************************/
        $('#relativeDataTable tbody').on('click', '#editRelativeBtn', function(){
            let data = relativeDataTable.row($(this).parents('tr')).data()
            setUpFormModal('#updateRelativeForm', '#updateRelativeModal', 'show', data)
        })

        $('#updateRelativeForm').submit( function(event) {
            event.preventDefault()
            updateRelative(
                $('#update').val(), 
                '#updateRelativeForm', 
                '#updateRelativeModal', 
                relativeDataTable
            )
        })

        /**************************************************************************/
        /* Eliminar - Delete
        /**************************************************************************/
        $('#relativeDataTable tbody').on('click', '#deleteRelativeBtn', function(){
            let data = relativeDataTable.row($(this).parents('tr')).data()
            setUpFormModal('#deleteRelativeForm', '#deleteRelativeModal', 'show', data)
        })

        $('#deleteRelativeForm').submit( function(event) {
            event.preventDefault()
            deleteRelative(
                $('#delete').val(), 
                '#deleteRelativeForm', 
                '#deleteRelativeModal', 
                relativeDataTable
            )
        })
    })

    const url = "{{ url('relative') }}"

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

            $('#names').val(data.names)
            $('#surnames').val(data.surnames)
            $('#document_numb').val(data.document_numb)
            $('#cellphone_numb').val(data.cellphone_numb)
            $('#address').val(data.address)

            switch (data.document_type) {
                case 'DNI':
                    document.getElementById("document_type").selectedIndex = "1"
                    break;
                case 'RUC':
                    document.getElementById("document_type").selectedIndex = "2"
                    break;
                case 'P. NAC.':
                    document.getElementById("document_type").selectedIndex = "3"  
                    break;
                case 'CARNET EXT.':
                    document.getElementById("document_type").selectedIndex = "4"  
                    break;
                case 'PASAPORTE':
                    document.getElementById("document_type").selectedIndex = "5"  
                    break;
                case 'OTRO':
                    document.getElementById("document_type").selectedIndex = "6"
                    break;

                default:
                    document.getElementById("document_type").selectedIndex = "0"
                    break;
            }

            $('p').text(data.document_numb +' - '+ data.names +' '+ data.surnames)
        }

        $(modal).modal(behavior)
    }

    function addRelative(form, modal, dataTable) {

        loading('#registrar', 'start')

        $.ajax({
            type: 'POST',
            url: url,
            data: $(form).serialize(),
            success: function(data) {
                // console.log(data)
                setUpFormModal(form, modal, 'hide')

                dataTable.ajax.reload()

                toastrMessage('success', 'Familiar Registrado')
                loading('#registrar', 'stop')
            },
            error: function(xhr, status) {
                // console.log(xhr.responseJSON.message)
                toastrMessage(status, 'El Familiar no pudo ser Registrado')
                loading('#registrar', 'stop')
            }
        })
    }

    function updateRelative(id, form, modal, dataTable) {

        loading('#actualizar', 'start')

        $.ajax({
            type: 'PUT',
            url: url + "/" + id,
            data: $(form).serialize(),
            success: function(data) {
                // console.log(data)
                setUpFormModal(form, modal, 'hide')

                let row = $('#relativeDataTable').dataTable().fnFindCellRowIndexes(id, 0)

                dataTable.cell(row, 1).data(data.names).draw(false)
                dataTable.cell(row, 2).data(data.surnames).draw(false)
                dataTable.cell(row, 3).data(data.document_type).draw(false)
                dataTable.cell(row, 4).data(data.document_numb).draw(false)
                dataTable.cell(row, 5).data(data.cellphone_numb).draw(false)
                dataTable.cell(row, 6).data(data.address).draw(false)

                toastrMessage('info', 'Familiar Actualizado')
                loading('#actualizar', 'stop')
            },
            error: function(xhr, status) {
                // console.log(xhr.responseJSON.message)
                toastrMessage(status, 'El Familiar no pudo ser Actualizado')
                loading('#actualizar', 'stop')
            }
        })
    }

    function deleteRelative(id, form, modal, dataTable) {

        loading('#eliminar', 'start')

        $.ajax({
            type: 'DELETE',
            url: url + "/" + id,
            data: $(form).serialize(),
            success: function(data) {
                //console.log(data)
                setUpFormModal(form, modal, 'hide')

                let row = $('#relativeDataTable').dataTable().fnFindCellRowIndexes(id, 0)
                dataTable.row(row).remove().draw()
                    
                toastrMessage('warning', 'Familiar Eliminado')
                loading('#eliminar', 'stop')

            }, 
            error: function(xhr, status) {
                // console.log(xhr.responseJSON.message)
                toastrMessage(status, 'El Familiar no pudo ser Eliminado')
                loading('#eliminar', 'stop')
            }
        })
    }
    </script>
@endpush