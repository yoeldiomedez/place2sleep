<div id="newMausoleumModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="newMausoleumForm" accept-charset="UTF-8">
                @csrf
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Registrar Mausoleo</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bold">Pabellón</label>
                                <select 
                                    id="newPavilion" 
                                    name="pavilion_id" 
                                    class="form-control" 
                                    required></select>  
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bold">Nombre del Mausoleo</label>
                                <input 
                                    type="text" 
                                    name="name" 
                                    class="form-control" 
                                    maxlength="255"
                                    required>
                            </div> 
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bold">Ubicación</label>
                                <input 
                                    type="text" 
                                    name="location" 
                                    class="form-control" 
                                    maxlength="255"
                                    placeholder="Mz. ?? Lote ##"
                                    required>
                            </div> 
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bold">Documento de Referencia</label>
                                <input 
                                    type="text" 
                                    name="doc" 
                                    class="form-control" 
                                    maxlength="255"
                                    placeholder="RESOLUCIÓN N° ###-{{ date('Y') }}-SBPP-P"
                                    required>
                            </div> 
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bold">Capacidad</label>
                                <input 
                                    type="number" 
                                    name="size" 
                                    class="form-control" 
                                    step="1"
                                    min="1"
                                    max="9999"
                                    required>
                            </div> 
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bold">Precio</label>
                                <input 
                                    type="number" 
                                    name="price" 
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
                        class="btn btn-primary" 
                        id="registrar" 
                        data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Registrando"
                    >
                            Registrar
                    </button>
                </div> 
            </form>
        </div>
    </div>
</div>