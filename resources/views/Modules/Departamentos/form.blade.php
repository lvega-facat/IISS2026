<form>

    {{-- NOMBRE --}}
    <div class="mb-3">
        <label class="form-label-custom">
            Nombre *
        </label>

        <input
            type="text"
            class="form-control-custom"
            placeholder="Ingrese el nombre del departamento"
            required>
    </div>

    {{-- CÓDIGO --}}
    <div class="mb-3">
        <label class="form-label-custom">
            Código *
        </label>

        <input
            type="text"
            class="form-control-custom"
            placeholder="Ingrese el código"
            required>
    </div>

    {{-- DESCRIPCIÓN --}}
    <div class="mb-3">
        <label class="form-label-custom">
            Descripción
        </label>

        <textarea
            class="form-control-custom"
            rows="4"
            placeholder="Ingrese una descripción"></textarea>
    </div>

    {{-- FUNCIÓN PRINCIPAL --}}
    <div class="mb-3">
        <label class="form-label-custom">
            Función Principal *
        </label>

        <input
            type="text"
            class="form-control-custom"
            placeholder="Ingrese la función principal"
            required>
    </div>

    {{-- DEPARTAMENTO PADRE --}}
    <div class="mb-3">
        <label class="form-label-custom">
            Departamento Padre
        </label>

        <select class="form-select-custom">

            <option selected>
                Ninguno
            </option>

            <option>
                Administración
            </option>

            <option>
                Tecnología
            </option>

            <option>
                Recursos Humanos
            </option>

            <option>
                Finanzas
            </option>

        </select>
    </div>

    {{-- BOTONES --}}
    <div class="modal-actions-container d-flex justify-content-end gap-2">

        <button
            type="button"
            class="btn-cancel-custom">
            Cancelar
        </button>

        <button
            type="submit"
            class="btn-create-custom">
            Guardar
        </button>

    </div>

</form>