<div id="modalSubCategoriaNew" class="modal fade bd-example-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">
                    <i class="font-icon-close-2"></i>
                </button>
                <h4 class="modal-title" id="mdltitulo_Sub_new"></h4>
            </div>
            <form method="post" id="sub_cat_form">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="sub_cat_id" name="sub_cat_id">
                        <label class="form-label" for="sub_cat_nom" id="l_titulo">SubCategoria Nombre</label>
                        <input type="text" class="form-control" id="sub_cat_nom" name="sub_cat_nom" placeholder="Ingrese Nombre de la subcategoria" required>
                    </div>
                    <div>a                    </div>
                    <div>b                   </div>
                    <div>c                    </div>
                    <div>d                    </div>    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" name="action" id="#SubmitSubcat" value="add" class="btn btn-rounded btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>