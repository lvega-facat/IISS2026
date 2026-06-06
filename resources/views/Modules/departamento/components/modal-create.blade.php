<div class="modal fade" id="createDepartamentoModal" tabindex="-1" aria-labelledby="createDepartamentoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content custom-modal-content">

            <div class="modal-body p-5">

                {{-- TITULO --}}
                <div class="modal-title-section mb-4">
                    <h5 class="modal-title fw-bold text-secondary-custom">
                        Departamento
                    </h5>

                    <span class="modal-subtitle text-muted fs-7">
                        Registrar nuevo departamento
                    </span>
                </div>

                <form action="{{ route('departamentos.store') }}" method="POST" id="formCreateDepartamento">
                    @csrf

                    <!-- NOMBRE -->
                    <div class="form-group-custom">
                        <label for="nombre" class="form-label-custom">
                            Nombre
                        </label>

                        <input
                            type="text"
                            class="form-control-custom"
                            id="nombre"
                            name="nombre"
                            placeholder="Ej: Recursos Humanos"
                            required>
                    </div>

                    <!-- DEPARTAMENTO PADRE -->
                    <div class="form-group-custom mt-4">
                        <label for="departamento_padre_id" class="form-label-custom">
                            Departamento padre
                        </label>

                        <select
                            class="form-control-custom form-select-custom"
                            id="departamento_padre_id"
                            name="departamento_padre_id">

                            <option value="" selected>
                                Sin departamento padre
                            </option>

                            {{-- aquí luego cargas dinámico --}}
                        </select>
                    </div>

                    <!-- EMPLEADOS -->
                    <div class="form-group-custom mt-4">
                        <label for="empleados" class="form-label-custom">
                            Empleados
                        </label>

                        <input
                            type="number"
                            class="form-control-custom"
                            id="empleados"
                            name="empleados"
                            placeholder="Ej: 10"
                            min="0"
                            value="0"
                            required>
                    </div>

                    <!-- ESTADO -->
                    <div class="form-group-custom mt-4">
                        <label for="estado" class="form-label-custom">
                            Estado
                        </label>

                        <select
                            class="form-control-custom form-select-custom"
                            id="estado"
                            name="estado"
                            required>

                            <option value="activo" selected>Activo</option>
                            <option value="inactivo">Inactivo</option>

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