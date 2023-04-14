<div id="deleteExhumationModal" class="modal fade bs-modal-sm" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form id="deleteExhumationForm" accept-charset="UTF-8">
                @csrf
                
                {{ $slot }}

                <div class="modal-body">
                    <input type="hidden" name="inhumation" id="delete">
                    <p class="text-center"></p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button 
                        type="submit" 
                        class="btn btn-danger"
                        id="eliminar"
                        data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Eliminando"
                    >
                        Eliminar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>