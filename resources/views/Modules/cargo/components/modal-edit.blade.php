<div class="modal fade" id="editCargoModal" tabindex="-1" aria-labelledby="editCargoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content custom-modal-content">

            <div class="modal-body p-5">

                <div class="modal-title-section mb-4">
                    <h5 class="modal-title fw-bold text-secondary-custom">
                        Cargo
                    </h5>

                    <span class="modal-subtitle text-muted fs-7">
                        Editar cargo
                    </span>
                </div>

                <form action="#" method="POST" id="formCreateCargo">
                    @csrf

                    <!-- CARGO -->
                    <div class="form-group-custom">
                        <label for="nombre" class="form-label-custom">
                            Cargo
                        </label>

                        <input
                            type="text"
                            class="form-control-custom"
                            id="nombre"
                            name="nombre"
                            placeholder="Ej: Gerente General"
                            required>
                    </div>

                    <!-- DEPARTAMENTO -->
                    <div class="form-group-custom mt-4">
                        <label for="departamento_id" class="form-label-custom">
                            Departamento
                        </label>

                        <select
                            class="form-control-custom form-select-custom"
                            id="departamento_id"
                            name="departamento_id"
                            required>

                            <option value="" selected disabled>
                                Seleccione un departamento
                            </option>
                        </select>
                    </div>

                    <!-- CARGO SUPERIOR -->
                    <div class="form-group-custom mt-4">
                        <label for="superior_id" class="form-label-custom">
                            Cargo Superior (Opcional)
                        </label>

                        <select
                            class="form-control-custom form-select-custom"
                            id="superior_id"
                            name="superior_id">

                            <option value="" selected>
                                Seleccione un cargo superior
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
                            class="btn btn-edit-custom">
                            EDITAR
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>
</div>