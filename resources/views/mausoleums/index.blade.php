@extends('layouts.app')

@section('pagetitle', 'Mausoleos')
@section('pagesubtitle', auth()->user()->cemetery_appellation)

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="JavaScript:;" id="reloadMausoleumDT">@yield('pagetitle')</a>
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
                            <button id="newMausoleumBtn" class="btn btn-outline blue">
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
                <table id="mausoleumDataTable" class="table table-hover table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Pabellón</th>
                            <th>Nombre</th>
                            <th>Ubicación</th>
                            <th>Doc. Ref.</th>
                            <th>Disponibilidad</th>
                            <th>Extensiones</th>
                            <th>Capacidad</th>
                            <th>Precio</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@include('mausoleums.create')
@include('mausoleums.edit')
@include('mausoleums.delete')

@endsection

@push('scripts')
    <script>
    $(document).ready( function () {
        /**************************************************************************/
        /* Lista - Read
        /**************************************************************************/
        var mausoleumDataTable = setUpDataTable(
            '#mausoleumDataTable',
            'Lista de Mausoleos',
            [ 0, 1, 2, 3, 4, 7, 8],
            [
                {
                    targets: [5, 6, 7],
                    searchable: false
                },
                {
                    targets: [4],
                    visible: false
                }
            ],
            [
                {data: 'id', name: 'id'},
                {data: 'pavilion.name', name: 'pavilion.name'},
                {data: 'name', name: 'name'},
                {data: 'location', name: 'location'},
                {data: 'doc', name: 'doc'},
                {data: 'availability', name: 'availability'},
                {data: 'extensions', name: 'extensions'},
                {data: 'size', name: 'size'},
                {data: 'price', name: 'price'},
                {data: 'buttons', orderable: false, className: "text-center btn-actions"},
            ]
        )

        $('#mausoleumDataTable').removeClass('no-footer')
        $.fn.dataTable.ext.errMode = 'throw'

        $('#reloadMausoleumDT').click( function () {

            $('#mausoleumDataTable').DataTable().destroy()

            mausoleumDataTable = setUpDataTable(
                '#mausoleumDataTable',
                'Lista de Mausoleos',
                [ 0, 1, 2, 3, 4, 7, 8],
                [
                    {
                        targets: [5, 6, 7],
                        searchable: false
                    },
                    {
                        targets: [4],
                        visible: false
                    }
                ],
                [
                    {data: 'id', name: 'id'},
                    {data: 'pavilion.name', name: 'pavilion.name'},
                    {data: 'name', name: 'name'},
                    {data: 'location', name: 'location'},
                    {data: 'doc', name: 'doc'},
                    {data: 'availability', name: 'availability'},
                    {data: 'extensions', name: 'extensions'},
                    {data: 'size', name: 'size'},
                    {data: 'price', name: 'price'},
                    {data: 'buttons', orderable: false, className: "text-center btn-actions"},
                ]
            )

            $('#mausoleumDataTable').removeClass('no-footer')
        })

        // Filtro de Mausoleos por Pabellon
        $('#pavilionFilter').empty()

        getPavilions('#pavilionFilter', 'M')

        $('#pavilionFilter').on('select2:select', function (event) {

            var data        = event.params.data
            let pavilion_id = data.id
            
            // console.log(pavilion_id)

            $('#mausoleumDataTable').DataTable().destroy()

            mausoleumDataTable = setUpDataTable(
                '#mausoleumDataTable',
                'Lista de Mausoleos',
                [ 0, 1, 2, 3, 4, 7, 8],
                [
                    {
                        targets: [5, 6, 7],
                        searchable: false
                    },
                    {
                        targets: [4],
                        visible: false
                    }
                ],
                [
                    {data: 'id', name: 'id'},
                    {data: 'pavilion.name', name: 'pavilion.name'},
                    {data: 'name', name: 'name'},
                    {data: 'location', name: 'location'},
                    {data: 'doc', name: 'doc'},
                    {data: 'availability', name: 'availability'},
                    {data: 'extensions', name: 'extensions'},
                    {data: 'size', name: 'size'},
                    {data: 'price', name: 'price'},
                    {data: 'buttons', orderable: false, className: "text-center btn-actions"},
                ],
                {
                    pavilion_id: pavilion_id
                }
            )

            $('#mausoleumDataTable').removeClass('no-footer')
        })
        /*************************************************************************/
        /* Agregar - Create
        /*************************************************************************/
        $('#newMausoleumBtn').click( function () {
            $('#newPavilion').empty()
            getPavilions('#newPavilion', 'M', true)
            setUpFormModal('#newMausoleumForm', '#newMausoleumModal', 'show')
        })

        $('#newMausoleumForm').submit( function(event) {
            event.preventDefault()
            addMausoleum('#newMausoleumForm', '#newMausoleumModal', mausoleumDataTable)
        })

        /*************************************************************************/
        /* Editar - Update
        /*************************************************************************/
        $('#mausoleumDataTable tbody').on('click', '#editMausoleumBtn', function(){
            let data = mausoleumDataTable.row($(this).parents('tr')).data()
            $('#editPavilion').empty()
            getPavilions('#editPavilion', 'M', true)
            selectPavilion('#editPavilion', data)
            setUpFormModal('#updateMausoleumForm', '#updateMausoleumModal', 'show', data)
        })

        $('#updateMausoleumForm').submit( function(event) {
            event.preventDefault()
            updateMausoleum(
                $('#update').val(),
                '#updateMausoleumForm',
                '#updateMausoleumModal',
                mausoleumDataTable
            )
        })

        /**************************************************************************/
        /* Eliminar - Delete
        /**************************************************************************/
        $('#mausoleumDataTable tbody').on('click', '#deleteMausoleumBtn', function(){
            let data = mausoleumDataTable.row($(this).parents('tr')).data()
            setUpFormModal('#deleteMausoleumForm', '#deleteMausoleumModal', 'show', data)
        })

        $('#deleteMausoleumForm').submit( function(event) {
            event.preventDefault()
            deleteMausoleum(
                $('#delete').val(),
                '#deleteMausoleumForm',
                '#deleteMausoleumModal',
                mausoleumDataTable
            )
        })
    })

    const url = "{{ url('mausoleum') }}"

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
            
            $('#name').val(data.name)
            $('#location').val(data.location)
            $('#doc').val(data.doc)
            $('#extensions').val(data.extensions)
            $('#size').val(data.size)
            $('#price').val(data.price)
            $('#created_at').val(data.created_at)

            if (data.availability > 0) {
                document.getElementById('extensions').disabled = true;
            } else {
                document.getElementById('extensions').disabled = false;
                $('#extensions').val(0)
            }

            $('p').text(data.name +' - '+ data.pavilion.name)
        }

        $(modal).modal(behavior)
    }

    function addMausoleum(form, modal, dataTable) {

        loading('#registrar', 'start')

        $.ajax({
            type: 'POST',
            url: url,
            data: $(form).serialize(),
            success: function(data) {
                // console.log(data)
                setUpFormModal(form, modal, 'hide')

                dataTable.ajax.reload()

                toastrMessage('success', 'Mausoleo Registrado')
                loading('#registrar', 'stop')
            },
            error: function(xhr, status) {
                // console.log(xhr.responseJSON.message)
                toastrMessage(status, 'El Mausoleo no pudo ser Registrado')
                loading('#registrar', 'stop')
            }
        })
    }

    function updateMausoleum(id, form, modal, dataTable) {

        loading('#actualizar', 'start')

        $.ajax({
            type: 'PUT',
            url: url + "/" + id,
            data: $(form).serialize(),
            success: function(data) {
                // console.log(data)
                setUpFormModal(form, modal, 'hide')

                let row = $('#mausoleumDataTable').dataTable().fnFindCellRowIndexes(id, 0)

                dataTable.cell(row, 1).data(data.pavilion.name).draw(false)
                dataTable.cell(row, 2).data(data.name).draw(false)
                dataTable.cell(row, 3).data(data.location).draw(false)
                dataTable.cell(row, 4).data(data.doc).draw(false)
                dataTable.cell(row, 5).data(data.availability).draw(false)
                dataTable.cell(row, 6).data(data.extensions).draw(false)
                dataTable.cell(row, 7).data(data.size).draw(false)
                dataTable.cell(row, 8).data(data.price).draw(false)

                toastrMessage('info', 'Mausoleo Actualizado')
                loading('#actualizar', 'stop')
            },
            error: function(xhr, status) {
                // console.log(xhr.responseJSON.message)
                toastrMessage(status, 'El Mausoleo no pudo ser Actualizado')
                loading('#actualizar', 'stop')
            }
        })
    }

    function deleteMausoleum(id, form, modal, dataTable) {

        loading('#eliminar', 'start')

        $.ajax({
            type: 'DELETE',
            url: url + "/" + id,
            data: $(form).serialize(),
            success: function(data) {
                //console.log(data)
                setUpFormModal(form, modal, 'hide')

                let row = $('#mausoleumDataTable').dataTable().fnFindCellRowIndexes(id, 0)
                dataTable.row(row).remove().draw()

                toastrMessage('warning', 'Mausoleo Eliminado')
                loading('#eliminar', 'stop')

            },
            error: function(xhr, status) {
                // console.log(xhr.responseJSON.message)
                toastrMessage(status, 'El Mausoleo no pudo ser Eliminado')
                loading('#eliminar', 'stop')
            }
        })
    }

    /*
     * API Functions
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