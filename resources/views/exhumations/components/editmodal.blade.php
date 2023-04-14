<div id="updateExhumationModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="updateExhumationForm" accept-charset="UTF-8">
                @csrf
                
                {{ $slot }}

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