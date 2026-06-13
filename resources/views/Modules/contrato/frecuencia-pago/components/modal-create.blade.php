<div class="modal fade" id="createFrecuenciaPagoModal" tabindex="-1" aria-labelledby="createFrecuenciaPagoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content custom-modal-content">

            <div class="modal-body p-5">

                <div class="modal-title-section mb-4">
                    <h5 class="modal-title fw-bold text-secondary-custom">
                        Frecuencia de Pago
                    </h5>

                    <span class="modal-subtitle text-muted fs-7">
                        Registrar nueva frecuencia de pago
                    </span>
                </div>

                <form action="#" method="POST" id="formCreateFrecuenciaPago">
                    @csrf

                    <div class="form-group-custom">
                        <label for="nombre" class="form-label-custom">
                            Nombre de la Frecuencia
                        </label>

                        <input
                            type="text"
                            class="form-control-custom"
                            id="nombre"
                            name="nombre"
                            placeholder="Ej: Mensual"
                            required>
                    </div>

                    <div class="form-group-custom mt-4">
                        <label for="descripcion" class="form-label-custom">
                            Descripción
                        </label>

                        <textarea
                            class="form-control-custom"
                            id="descripcion"
                            name="descripcion"
                            rows="4"
                            placeholder="Ingrese una descripción de la frecuencia de pago"></textarea>
                    </div>

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