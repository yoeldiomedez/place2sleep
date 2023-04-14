<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class='bold'> Registro de Ingreso a Caja (RIC) </label>
            <input type="text" name="ric" class='form-control' required>
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
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label class="bold">Observaciones</label>
            <textarea name="notes" cols="4" class='form-control'></textarea>
        </div>
    </div>
</div>