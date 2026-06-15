<div class="modal fade" id="editProfesionModal" tabindex="-1" aria-labelledby="editProfesionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content custom-modal-content">

            <div class="modal-body p-5">

                <div class="modal-title-section mb-4">
                    <h5 class="modal-title fw-bold text-secondary-custom">
                        Profesión
                    </h5>

                    <span class="modal-subtitle text-muted fs-7">
                        Editar profesión
                    </span>
                </div>

                <form action="#" method="POST" id="formEditProfesion">
                    @csrf

                    <!-- NOMBRE -->
                    <div class="form-group-custom">
                        <label for="edit_nombre" class="form-label-custom">
                            Nombre de la Profesión
                        </label>

                        <input
                            type="text"
                            class="form-control-custom"
                            id="edit_nombre"
                            name="nombre"
                            value="Ingeniero de Software"
                            required>
                    </div>

                    <!-- DESCRIPCIÓN -->
                    <div class="form-group-custom mt-4">
                        <label for="edit_descripcion" class="form-label-custom">
                            Descripción
                        </label>

                        <textarea
                            class="form-control-custom"
                            id="edit_descripcion"
                            name="descripcion"
                            rows="4">Desarrollo, mantenimiento y optimización de sistemas informáticos.</textarea>
                    </div>

                    <!-- BOTONES -->
                    <div class="modal-actions-container d-flex justify-content-between align-items-center mt-5">

                        <button
                            type="button"
                            class="btn btn-cancel-custom"
                            data-bs-dismiss="modal">
                            CANCELAR
                        </button>

                        <button
                            type="submit"
                            class="btn btn-create-custom">
                            EDITAR
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>
</div>