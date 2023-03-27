<div id="modaldepartamento" class="modal fade bd-example-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">
                    <i class="font-icon-close-2"></i>
                </button>
                <h4 class="modal-title" id="mdltitulo"></h4>
            </div>
            <form method="post" id="depto_form">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="depto_id" name="depto_id">
                        <label class="form-label" for="depto_nom">Departamento Nombre</label>
                        <input type="text" class="form-control" id="depto_nom" name="depto_nom" placeholder="Ingrese Nombre del departamento" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" name="action" id="#" value="add" class="btn btn-rounded btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>