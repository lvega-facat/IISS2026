document.addEventListener("DOMContentLoaded", function () {

    /* =========================================
       ELEMENTOS DEL SIDEBAR
    ========================================= */

    const links = document.querySelectorAll(".nav-link-custom");
    const collapses = document.querySelectorAll(".submenu");
    const submenuLinks = document.querySelectorAll(".submenu li a");

    const sidebar = document.getElementById("sidebar");
    const toggleBtn = document.getElementById("sidebarToggle");
    const toggleIcon = toggleBtn.querySelector("i");

    /* =========================================
       COLAPSAR / EXPANDIR SIDEBAR
    ========================================= */

    toggleBtn.addEventListener("click", function () {

        sidebar.classList.toggle("collapsed");

        if (sidebar.classList.contains("collapsed")) {
            toggleIcon.classList.remove("fa-minus");
            toggleIcon.classList.add("fa-plus");
        } else {
            toggleIcon.classList.remove("fa-plus");
            toggleIcon.classList.add("fa-minus");
        }

    });

    /* =========================================
       BOTONES PRINCIPALES DEL SIDEBAR
    ========================================= */

    links.forEach(link => {

        link.addEventListener("click", function () {

            if (this.classList.contains("no-submenu")) {

                links.forEach(item =>
                    item.classList.remove("selected-active")
                );

                submenuLinks.forEach(item =>
                    item.classList.remove("submenu-active")
                );

                this.classList.add("selected-active");

                // Cerrar submenús abiertos
                collapses.forEach(collapse => {

                    const bsCollapse =
                        bootstrap.Collapse.getInstance(collapse);

                    if (bsCollapse) {
                        bsCollapse.hide();
                    }

                });
            }

        });

    });

    /* =========================================
       SUBMENÚS
    ========================================= */

    submenuLinks.forEach(subLink => {

        subLink.addEventListener("click", function () {

            submenuLinks.forEach(item =>
                item.classList.remove("submenu-active")
            );

            this.classList.add("submenu-active");

        });

    });

    /* =========================================
       EVENTOS DE BOOTSTRAP COLLAPSE
    ========================================= */

    collapses.forEach(collapse => {

        collapse.addEventListener("show.bs.collapse", function () {

            links.forEach(link =>
                link.classList.remove("selected-active")
            );

            const toggler =
                document.querySelector(`[href="#${this.id}"]`);

            if (toggler) {
                toggler.classList.add("selected-active");
            }

        });

        collapse.addEventListener("hide.bs.collapse", function () {

            const toggler =
                document.querySelector(`[href="#${this.id}"]`);

            if (toggler) {
                toggler.classList.remove("selected-active");
            }

            const internalLinks =
                this.querySelectorAll("li a");

            internalLinks.forEach(link =>
                link.classList.remove("submenu-active")
            );

        });

    });

    /* =========================================
       MENÚ DE USUARIO
    ========================================= */

    const avatar = document.getElementById("userAvatar");
    const dropdown = document.getElementById("userDropdown");

    if (avatar && dropdown) {

        avatar.addEventListener("click", function (e) {

            e.stopPropagation();
            dropdown.classList.toggle("show");

        });

        document.addEventListener("click", function () {

            dropdown.classList.remove("show");

        });

        dropdown.addEventListener("click", function (e) {

            e.stopPropagation();

        });

    }

});