@extends('layouts.default')

@section('pagetitle', 'Consulta por Mausoleo')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center">
                    Búsqueda de Inhumados
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="alert alert-info text-justify">
                                <i class="fa fa-info-circle"></i> 
                                Ingrese el <b>Número DNI</b> del <b>inhumado</b> para una búsqueda especifíca.
                            </div>
                        </div>
                        <div class="col-md-12">
                            <table id="dataTableInhumationM" class="table table-bordered table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Difunto</th>
                                        <th>Mausoleo</th>
                                        <th>Pabellón</th>
                                        <th>Cementerio</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            $("#dataTableInhumationM").DataTable({
                language: {
                    zeroRecords: "No se encontraron resultados",
                    info:         "",
                    infoEmpty:    "",
                    infoFiltered: "",
                    search: "DNI: _INPUT_",
                    searchPlaceholder: "",
                    processing: '<i class="fa fa-circle-o-notch fa-spin"></i> Cargando ',
                    paginate: {
                        next:     "&raquo;",
                        previous: "&laquo;"
                    }                    
                },
                dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12 toolbar'l><'col-md-6 col-sm-12'f>r><'table-responsive't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",                order: [[ 0, "desc" ]],
                serverSide: true,
                processing: true,
                ajax: "{{ url('search/mausoleum') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'deceased.document_numb', name: 'deceased.document_numb', render: function ( data, type, row ) {
                        return row.deceased.document_numb +' | '+ row.deceased.names + ' ' + row.deceased.surnames
                    }},
                    {data: null, render: function ( data, type, row ) {
                        return row.buriable.name +' | '+ row.buriable.location
                    }},
                    {data: 'buriable.pavilion.name'},
                    {data: 'buriable.pavilion.cemetery.appellation'},
                ],
                columnDefs: [
                    {
                        targets: [ 0, 2, 3, 4 ],
                        searchable: false
                    },
                    {
                        targets: [2, 3, 4],
                        sortable: false
                    }
                ]
            });

            $('div.toolbar').html(
                '<ul class="nav d-flex justify-content-center justify-content-md-start">'+
                    '<li class="nav-item">'+
                        '<a class="nav-link" href="{{ url("search/niche") }}"><i class="fa fa-th"></i> Nicho</a>'+
                    '</li>'+
                    '<li class="nav-item">'+
                        '<a class="nav-link active" href="{{ url("search/mausoleum") }}"><i class="fa fa-bank"></i> Mausoleo</a>'+
                   '</li>'+
                '</ul>'
            );

            $.fn.dataTable.ext.errMode = 'throw';
        });
    </script> 
@endpush()