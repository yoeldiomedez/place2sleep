<div id="updateCemeteryModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="updateCemeteryForm" accept-charset="UTF-8">
                @csrf
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Actualizar Cementerio</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="period" id="update">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="bold" for="weight">Nombre</label>
                                <input 
                                    type="text" 
                                    name="appellation"
                                    id="appellation" 
                                    class="form-control" 
                                    >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-warning">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>