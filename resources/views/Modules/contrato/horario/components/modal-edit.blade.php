<div class="modal fade" id="editHorarioModal" tabindex="-1" aria-labelledby="editHorarioModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content custom-modal-content">

            <div class="modal-body p-5">

                <div class="modal-title-section mb-4">
                    <h5 class="modal-title fw-bold text-secondary-custom">
                        Horario Laboral
                    </h5>

                    <span class="modal-subtitle text-muted fs-7">
                        Editar horario de trabajo
                    </span>
                </div>

                <form action="#" method="POST" id="formEditHorario">
                    @csrf
                    @method('PUT')

                    <!-- NOMBRE -->
                    <div class="form-group-custom">
                        <label for="edit_nombre" class="form-label-custom">
                            Nombre del Horario
                        </label>

                        <input
                            type="text"
                            class="form-control-custom"
                            id="edit_nombre"
                            name="nombre"
                            value="Administrativo Mañana"
                            required>
                    </div>

                    <!-- TIPO DE JORNADA -->
                    <div class="form-group-custom mt-4">
                        <label for="edit_tipo_jornada" class="form-label-custom">
                            Tipo de Jornada
                        </label>

                        <select
                            class="form-control-custom form-select-custom"
                            id="edit_tipo_jornada"
                            name="tipo_jornada"
                            required>

                            <option value="completa" selected>
                                Jornada Completa
                            </option>

                            <option value="media">
                                Media Jornada
                            </option>

                            <option value="jornalero">
                                Jornalero
                            </option>

                        </select>
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
                            rows="3">Horario utilizado para personal administrativo.</textarea>
                    </div>

                    <!-- HORAS -->
                    <div class="row mt-4">

                        <div class="col-md-6">
                            <label for="edit_hora_entrada" class="form-label-custom">
                                Hora de Entrada
                            </label>

                            <input
                                type="time"
                                class="form-control-custom"
                                id="edit_hora_entrada"
                                name="hora_entrada"
                                value="08:00"
                                required>
                        </div>

                        <div class="col-md-6">
                            <label for="edit_hora_salida" class="form-label-custom">
                                Hora de Salida
                            </label>

                            <input
                                type="time"
                                class="form-control-custom"
                                id="edit_hora_salida"
                                name="hora_salida"
                                value="17:00"
                                required>
                        </div>

                    </div>

                    <!-- TOLERANCIA -->
                    <div class="form-group-custom mt-4">
                        <label for="edit_tolerancia" class="form-label-custom">
                            Tolerancia de Entrada (Minutos)
                        </label>

                        <input
                            type="number"
                            min="0"
                            class="form-control-custom"
                            id="edit_tolerancia"
                            name="tolerancia"
                            value="10">
                    </div>

                    <!-- ESTADO VISUAL -->
                    <div class="alert alert-info mt-4 mb-0">

                        <i class="fa fa-info-circle me-2"></i>

                        Si existen empleados asociados a este horario,
                        el sistema validará si la modificación puede aplicarse.

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