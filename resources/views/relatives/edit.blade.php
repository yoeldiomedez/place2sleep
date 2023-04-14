<div id="updateRelativeModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="updateRelativeForm" accept-charset="UTF-8">
                @csrf
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Actualizar Familiar</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="relative" id="update">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bold" for="weight">Nombres</label>
                                <input 
                                    type="text" 
                                    name="names"
                                    id="names" 
                                    class="form-control" 
                                    maxlength="255" 
                                    required
                                    >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bold" for="weight">Apellidos</label>
                                <input 
                                    type="text" 
                                    name="surnames"
                                    id="surnames" 
                                    class="form-control" 
                                    maxlength="255" 
                                    required
                                    >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bold" for="document_type">Tipo de Documento</label>
                                <select name="document_type" id="document_type" class="form-control" required>
                                    <option value="" disabled selected>Seleccione un Tipo de Documento</option>
                                    <option value="DNI">Documento Nacional de Identidad</option>
                                    <option value="RUC">Reg. Único de Contribuyentes</option>
                                    <option value="P. NAC.">Partida de Nacimiento</option>
                                    <option value="CARNET EXT.">Carnet de Extranjería </option>
                                    <option value="PASAPORTE">Pasaporte</option>
                                    <option value="OTRO">Otro</option>
                                </select>
                            </div> 
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bold" for="document_numb">№ de Documento</label>
                                <input 
                                    type="number" 
                                    name="document_numb" 
                                    id="document_numb" 
                                    class="form-control" 
                                    required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bold" for="cellphone_numb">N° Celular</label>
                                <input 
                                    type="number" 
                                    name="cellphone_numb" 
                                    id="cellphone_numb" 
                                    class="form-control"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bold" for="address">Dirección</label>
                                <input 
                                    type="text" 
                                    name="address" 
                                    id="address" 
                                    class="form-control"
                                    required
                                    >
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