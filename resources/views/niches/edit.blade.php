<div id="updateNicheModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="updateNicheForm" accept-charset="UTF-8">
                @csrf
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Actualizar Nicho</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="niche" id="update">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bold">Pabellón</label>
                                <select 
                                    id="editPavilion" 
                                    name="pavilion_id" 
                                    class="form-control" 
                                    required></select>  
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bold">Estado</label>
                                <div class="mt-radio-inline">
                                    <label class="mt-radio">
                                        <input type="radio" name="state" id="disponible" value="D" required> Disponible
                                        <span></span>
                                    </label>
                                    <label class="mt-radio">
                                        <input type="radio" name="state" id="ocupado" value="O"> Ocupado
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bold">Fila</label>
                                <select name="row_x" id="row_x" class="form-control" required>
                                    <option value="" disabled selected>Seleccione una Fila</option>
                                    <option>A</option><option>B</option><option>C</option>
                                    <option>D</option><option>E</option><option>F</option>
                                    <option>G</option><option>H</option><option>I</option>
                                    <option>J</option><option>K</option><option>L</option>
                                    <option>M</option><option>N</option>
                                    <option>O</option><option>P</option><option>Q</option>
                                    <option>R</option><option>S</option><option>T</option>
                                    <option>U</option><option>V</option><option>W</option>
                                    <option>X</option><option>Y</option><option>Z</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bold">Categoria</label>
                                <select name="category" id="category" class="form-control" required>
                                    <option value="" disabled selected>Seleccione una Categoria</option>
                                    <option value="A">Adulto</option>
                                    <option value="P">Parvulo</option>
                                    <option value="O">Osario</option>
                                    <option value="D">Dorado</option>
                                    <option value="Z">Otro</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bold">Columna</label>
                                <input 
                                    type="number" 
                                    name="col_y" 
                                    id="col_y" 
                                    class="form-control" 
                                    step="1"
                                    min="1"
                                    max="99"
                                    required>
                            </div> 
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bold">Precio</label>
                                <input 
                                    type="number" 
                                    name="price" 
                                    id="price" 
                                    class="form-control" 
                                    step="0.01"
                                    min="0"
                                    max="999999.99"
                                    required>
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