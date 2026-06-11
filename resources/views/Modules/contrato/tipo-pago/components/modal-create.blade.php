<div class="modal fade" id="createTipoPagoModal" tabindex="-1" aria-labelledby="createTipoPagoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content custom-modal-content">

            <div class="modal-body p-5">

                <div class="modal-title-section mb-4">
                    <h5 class="modal-title fw-bold text-secondary-custom">
                        Tipo de Pago
                    </h5>

                    <span class="modal-subtitle text-muted fs-7">
                        Registrar nuevo tipo de pago
                    </span>
                </div>

                <form action="#" method="POST" id="formCreateTipoPago">
                    @csrf

                    <div class="form-group-custom">
                        <label for="nombre" class="form-label-custom">
                            Nombre del Tipo de Pago
                        </label>

                        <input
                            type="text"
                            class="form-control-custom"
                            id="nombre"
                            name="nombre"
                            placeholder="Ej: Transferencia Bancaria"
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
                            placeholder="Ingrese una descripción del tipo de pago"></textarea>
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