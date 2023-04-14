<div id="deletePavilionModal" class="modal fade bs-modal-sm" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form id="deletePavilionForm" accept-charset="UTF-8">
                @csrf
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">¿Eliminar Pabellón?</h4>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="pavilion" id="delete">
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