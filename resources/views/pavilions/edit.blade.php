<div id="updatePavilionModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="updatePavilionForm" accept-charset="UTF-8">
                @csrf
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Actualizar Pabellón</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="pavilion" id="update">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bold" for="weight">Nombre</label>
                                <input 
                                    type="text" 
                                    name="name"
                                    id="name"
                                    class="form-control" 
                                    maxlength="255" 
                                    required
                                    >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bold" for="type">Tipo</label>
                                <div class="mt-radio-inline">
                                    <label class="mt-radio">
                                        <input type="radio" name="type" id="niche" value="N"> Nicho
                                        <span></span>
                                    </label>
                                    <label class="mt-radio">
                                        <input type="radio" name="type" id="mausoleum" value="M"> Mausoleo
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button 
                        type="submit" 
                        class="btn btn-warning" 
                        id="actualizar"
                        data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Actualizando"
                    >
                        Actualizar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>