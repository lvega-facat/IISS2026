<div class="modal fade" id="createProfesionModal" tabindex="-1" aria-labelledby="createProfesionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content custom-modal-content">

            <div class="modal-body p-5">

                <div class="modal-title-section mb-4">
                    <h5 class="modal-title fw-bold text-secondary-custom">
                        Profesión
                    </h5>

                    <span class="modal-subtitle text-muted fs-7">
                        Registrar nueva profesión
                    </span>
                </div>

                <form action="#" method="POST" id="formCreateProfesion">
                    @csrf

                    <!-- NOMBRE -->
                    <div class="form-group-custom">
                        <label for="nombre" class="form-label-custom">
                            Nombre de la Profesión
                        </label>

                        <input
                            type="text"
                            class="form-control-custom"
                            id="nombre"
                            name="nombre"
                            placeholder="Ej: Ingeniero de Software"
                            required>
                    </div>

                    <!-- DESCRIPCIÓN -->
                    <div class="form-group-custom mt-4">
                        <label for="descripcion" class="form-label-custom">
                            Descripción
                        </label>

                        <textarea
                            class="form-control-custom"
                            id="descripcion"
                            name="descripcion"
                            rows="4"
                            placeholder="Ingrese una descripción de la profesión"></textarea>
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
                            CREAR
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>
</div>