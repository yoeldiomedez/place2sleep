@component('exhumations.components.createmodal')
    <div class="modal-header text-center">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Registrar Exhumación de Nicho</h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class='bold'>Exhumado</label>
                    <select 
                        id='newDeceasedInNiche' 
                        name='inhumation_id' 
                        class='form-control' 
                        required>
                    </select>
                </div>
            </div>
        </div>
        @include('exhumations.partials.createform')
    </div>
@endcomponent