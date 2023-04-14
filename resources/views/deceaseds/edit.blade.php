<div id="updateDeceasedModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="updateDeceasedForm" accept-charset="UTF-8">
                @csrf
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Actualizar Difunto</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="deceased" id="update">
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
                                <label class="bold" for="gender">Sexo</label>
                                <div class="mt-radio-inline text-center" style="margin-bottom: -12px;margin-top: -8px;">
                                    <label class="mt-radio">
                                        <input id="male" type="radio" name="gender" value="M" required> Masculino
                                        <span></span>
                                    </label>
                                    <label class="mt-radio">
                                        <input id="female" type="radio" name="gender" value="F"> Femenino
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bold" for="marital_status">Estado Civil</label>
                                <select name="marital_status" id="marital_status" class="form-control" required>
                                    <option value="" disabled selected>Seleccione un Estado Civil</option>
                                    <option value="S">Soltero(a)</option>
                                    <option value="C">Casado(a)</option>
                                    <option value="V">Viudo(a)</option>
                                    <option value="D">Divorciado(a)</option>
                                </select>
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
                                <label class="bold" for="birth_date">Fecha de Nacimiento</label>
                                <input 
                                    type="date" 
                                    name="birth_date" 
                                    id="birth_date" 
                                    class="form-control"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bold" for="death_date">Fecha de Fallecimiento</label>
                                <input 
                                    type="date" 
                                    name="death_date" 
                                    id="death_date" 
                                    class="form-control"
                                    >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="bold" for="country_origin">País de Origen</label>
                                <input 
                                    type="text" 
                                    name="country_origin" 
                                    id="country_origin" 
                                    class="form-control" 
                                    maxlength="255" 
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