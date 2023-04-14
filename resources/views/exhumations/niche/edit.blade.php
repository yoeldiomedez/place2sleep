@component('exhumations.components.editmodal')
    <div class="modal-header text-center">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Actualizar Exhumación de Nicho</h4>
    </div>
    <div class="modal-body">
        <input type="hidden" name="update" id="update">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class='bold'>Exhumado</label>
                    <select 
                        id='editDeceasedInNiche' 
                        name='inhumation_id' 
                        class='form-control' 
                        disabled
                        >
                    </select>
                </div>
            </div>
        </div>
        @include('exhumations.partials.editform')
    </div>
@endcomponent