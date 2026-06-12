<div class="modal fade" id="createContratoModal" tabindex="-1" aria-labelledby="createContratoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content custom-modal-content">

            <div class="modal-body p-5">

                <div class="modal-title-section mb-4">
                    <h5 class="modal-title fw-bold text-secondary-custom">
                        Tipo de Contrato
                    </h5>

                    <span class="modal-subtitle text-muted fs-7">
                        Registrar nuevo tipo de contrato
                    </span>
                </div>

                <form action="#" method="POST" id="formCreateContrato">
                    @csrf

                    <!-- NOMBRE -->
                    <div class="form-group-custom">
                        <label for="nombre" class="form-label-custom">
                            Nombre del Contrato
                        </label>

                        <input
                            type="text"
                            class="form-control-custom"
                            id="nombre"
                            name="nombre"
                            placeholder="Ej: Contrato Administrativo Mensual"
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
                            rows="3"
                            placeholder="Ingrese una descripción del contrato"></textarea>
                    </div>

                    <!-- PROFESIÓN -->
                    <div class="form-group-custom mt-4">
                        <label for="profesion_id" class="form-label-custom">
                            Profesión Asociada
                        </label>

                        <select
                            class="form-control-custom form-select-custom"
                            id="profesion_id"
                            name="profesion_id"
                            required>

                            <option value="" selected disabled>
                                Seleccione una profesión
                            </option>

                        </select>
                    </div>

                    <!-- HORARIO -->
                    <div class="form-group-custom mt-4">
                        <label for="horario_id" class="form-label-custom">
                            Horario Laboral
                        </label>

                        <select
                            class="form-control-custom form-select-custom"
                            id="horario_id"
                            name="horario_id"
                            required>

                            <option value="" selected disabled>
                                Seleccione un horario laboral
                            </option>

                        </select>
                    </div>

                    <!-- TIPO DE PAGO -->
                    <div class="form-group-custom mt-4">
                        <label for="tipo_pago_id" class="form-label-custom">
                            Tipo de Pago
                        </label>

                        <select
                            class="form-control-custom form-select-custom"
                            id="tipo_pago_id"
                            name="tipo_pago_id"
                            required>

                            <option value="" selected disabled>
                                Seleccione un tipo de pago
                            </option>

                        </select>
                    </div>

                    <!-- FRECUENCIA DE PAGO -->
                    <div class="form-group-custom mt-4">
                        <label for="frecuencia_pago_id" class="form-label-custom">
                            Frecuencia de Pago
                        </label>

                        <select
                            class="form-control-custom form-select-custom"
                            id="frecuencia_pago_id"
                            name="frecuencia_pago_id"
                            required>

                            <option value="" selected disabled>
                                Seleccione una frecuencia
                            </option>

                        </select>
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