<div class="modal fade" id="editDepartamentoModal" tabindex="-1" aria-labelledby="editDepartamentoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content custom-modal-content">

            <div class="modal-body p-5">

                {{-- TITULO --}}
                <div class="modal-title-section mb-4">
                    <h5 class="modal-title fw-bold text-secondary-custom">
                        Departamento
                    </h5>

                    <span class="modal-subtitle text-muted fs-7">
                        Editar departamento
                    </span>
                </div>

                <form action="#" method="POST" id="formEditDepartamento">
                    @csrf
                    @method('PUT')

                    <!-- NOMBRE -->
                    <div class="form-group-custom">
                        <label for="edit_nombre" class="form-label-custom">
                            Nombre
                        </label>

                        <input
                            type="text"
                            class="form-control-custom"
                            id="edit_nombre"
                            name="nombre"
                            placeholder="Ej: Recursos Humanos"
                            required>
                    </div>

                    <!-- DEPARTAMENTO PADRE -->
                    <div class="form-group-custom mt-4">
                        <label for="edit_departamento_padre_id" class="form-label-custom">
                            Departamento padre
                        </label>

                        <select
                            class="form-control-custom form-select-custom"
                            id="edit_departamento_padre_id"
                            name="departamento_padre_id">

                            <option value="">
                                Sin departamento padre
                            </option>

                            {{-- opciones dinámicas luego --}}
                        </select>
                    </div>

                    <!-- EMPLEADOS -->
                    <div class="form-group-custom mt-4">
                        <label for="edit_empleados" class="form-label-custom">
                            Empleados
                        </label>

                        <input
                            type="number"
                            class="form-control-custom"
                            id="edit_empleados"
                            name="empleados"
                            min="0"
                            required>
                    </div>

                    <!-- ESTADO -->
                    <div class="form-group-custom mt-4">
                        <label for="edit_estado" class="form-label-custom">
                            Estado
                        </label>

                        <select
                            class="form-control-custom form-select-custom"
                            id="edit_estado"
                            name="estado"
                            required>

                            <option value="activo">Activo</option>
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
                            GUARDAR CAMBIOS
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>
</div>