@component('inhumations.components.createmodal')
    <div class="modal-header text-center">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Registrar Inhumación Nicho</h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class='bold'>Nicho</label>
                    <select 
                        id='newNiche' 
                        name='niche_id' 
                        class='form-control' 
                        required>
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="bold">Difunto</label>
                    <select 
                        id="newDeceased" 
                        name="deceased_id" 
                        class="form-control" 
                        required>
                    </select>  
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="bold">Familiar</label>
                    <select 
                        id="newRelative" 
                        name="relative_id" 
                        class="form-control" 
                        required>
                    </select>  
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class='bold'> Registro de Ingreso a Caja (RIC) </label>
                    <input type="text" name="ric" class='form-control' required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="bold">Convenio</label>
                    <select name="agreement" class="form-control" required>
                        <option value="" disabled selected>Seleccione un Convenio</option>
                        <option value="C">Compra</option>
                        <option value="R">Renovación</option>
                        <option value="I">Traslado Interno</option>
                        <option value="E">Traslado Externo</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="bold">Monto Parcial (S/)</label>
                    <input 
                        type="number" 
                        id="newNichePrice" 
                        class="form-control" 
                        step="0.01"
                        min="0"
                        max="999999.99"
                        readonly>
                </div> 
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="bold">Descuento (S/)</label>
                    <input 
                        type="number" 
                        name="discount" 
                        class="form-control" 
                        step="0.01"
                        min="0"
                        max="999999.99"
                        value="0"
                        >
                </div> 
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="bold">Pago Addicional (S/)</label>
                    <input 
                        type="number" 
                        name="additional" 
                        class="form-control" 
                        step="0.01"
                        min="0"
                        max="999999.99"
                        value="0"
                        >
                </div> 
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="bold">Observaciones</label>
                    <textarea name="notes" cols="3" class='form-control'></textarea>
                </div>
            </div>
        </div>
    </div>
@endcomponent