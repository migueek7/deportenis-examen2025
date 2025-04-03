"use strict";

document.addEventListener("DOMContentLoaded", () => {
    // Obtenemos la URL base
    const baseUrl = window.location.href;
    // Add Modal
    const myModal = new bootstrap.Modal(document.getElementById('modalAddMenu'))

    const initDataTable = () => {
        $("#tableMenus").DataTable({
            "ajax": {
                url: baseUrl + "/menus",
                dataSrc: "",
                type: "GET",
            },
            order: [[0, "desc"]],
            columnDefs: [
                {
                    "targets": 4,
                    "class": "actions",
                    "sortable": false,
                    "render": function (data) {
                        return `
                            <div class="text-right">
                                <button type="button" class="btn btn-sm btn-primary btnEdit" number="${data.id_menu}">Editar</button>
                                <button type="button" class="btn btn-sm btn-danger btnDelete" number="${data.id_menu}">Eliminar</button>
                            </div>
                        `;
                    }
                },
            ],
            columns: [
                { "data": "id_menu" },
                { "data": "nombre_menu" },
                { "data": "nombre_menu_padre" },
                { "data": "descripcion" },
                { "data": null },
            ],
            dom: "<'row'<'col-md-6 'f><'col-md-6'B>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row d-flex align-items-center'<'col-md-8 d-flex'il><'col-md-4'p>>",
            buttons: [
                {
                    text: '<i class="fas fa-plus fa-md"></i> Agregar',
                    className: 'btn btn-sm btn-rounded btn-success btnAdd',
                    action: function (e, dt, node, config) {
                        // abrir modal con los datos del menu
                        myModal.show();
                        document.querySelector('.btnSave').removeAttribute('disabled');
                        // limpiar formulario
                        document.querySelector("#formAddMenu").reset();
                        document.querySelector("#id_menupadre").value = -1;
                        document.querySelector("#id_menu").value = 0;
                        document.querySelector(".btnSave").textContent = "Guardar";
                        // volver a cargar los menus en el select
                        const menus = JSON.parse(sessionStorage.getItem("menus"));
                        console.log("menus", menus);
                        const select = document.querySelector("#id_menupadre");
                        select.innerHTML = "<option value='-1'>Ninguno</option>";
                        menus.forEach((element) => {
                            select.innerHTML += `<option value="${element.id_menu}">${element.nombre_menu}</option>`;
                        });
                    }
                }
            ],
            responsive: true,
        });
    }

    // Delegación de eventos para los botones de editar
    $("#tableMenus").on("click", ".btnEdit", function (e) {
        console.log('target', e.target);
        const idMenu = $(this).attr("number");
        const menus = JSON.parse(sessionStorage.getItem("menus"));
        const menu = menus.find((element) => element.id_menu == idMenu);

        if (menu) {
            myModal.show();
            const form = document.querySelector("#formAddMenu");
            form.querySelector("#id_menupadre").value = menu.id_menupadre > 0 ? menu.id_menupadre : -1;
            form.querySelector("#id_menu").value = menu.id_menu;
            form.querySelector("#nombre_menu").value = menu.nombre_menu;
            form.querySelector("#descripcion").value = menu.descripcion;
            document.querySelector(".btnSave").textContent = "Actualizar";
        }
    });

    // Delegación de eventos para los botones de borrar
    $("#tableMenus").on("click", ".btnDelete", async function (e) {
        console.log('target', e.target);
        const idMenu = $(this).attr("number");
        // e.target.setAttribute('disabled');
        const url = `${baseUrl}deleteMenu`;
        const formData = new FormData();
        formData.append("id_menu", idMenu);

        try {
            const response = await fetch(url, {
                method: "POST",
                body: formData,
            });
            if (!response.ok) throw response;

            const data = await response.json();
            if (data === "success") {
                Swal.fire({
                    icon: 'success',
                    title: 'Menu eliminado correctamente',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    $("#tableMenus").DataTable().ajax.reload();
                });
            }
        } catch (error) {
            console.error(error);
            e.target.removeAttribute('disabled');
        }
    });

    const getMenus = async () => {
        try {
            const url = `${baseUrl}/menus`;
            console.log("url", url);
            const response = await fetch(url);
            if (!response.ok) throw respuesta;

            const data = await response.json();
            console.log("data", data);
            sessionStorage.setItem("menus", JSON.stringify(data));
            //Iniciar DataTable
            // si tabla no ha sido inicializada
            if (!$.fn.DataTable.isDataTable("#tableMenus")) {
                initDataTable();
            }
            // initDataTable();
        } catch (error) {
            console.log(error);
        } finally {
            console.log('Petición finalizada');
        }
    }

    getMenus();

    const guardarMenu = async () => {
        const form = document.querySelector("#formAddMenu");
        form.addEventListener("submit", async (event) => {
            event.preventDefault();

            // bloquear boton de guardado
            document.querySelector('.btnSave').setAttribute('disabled', true);

            const formData = new FormData(form);
            console.log("formData", formData);
            let url = "";
            if (form.querySelector("#id_menu").value > 0) {
                url = `${baseUrl}updateMenu`;
            } else {
                url = `${baseUrl}addMenu`;
            }
            const options = {
                method: "POST",
                body: formData,
            };
            try {
                const response = await fetch(url, options);
                if (!response.ok) throw response;
                const data = await response.json();
                console.log("data", data);
                if (data === "success") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Menu guardado correctamente',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(async (result) => {
                        myModal.hide();
                        document.querySelector('.btnSave').removeAttribute('disabled');
                        // Recargar DataTable
                        $("#tableMenus").DataTable().ajax.reload(null, false);
                        // Actualizar sessionStorage con los nuevos datos
                        const menusResponse = await fetch(`${baseUrl}/menus`);
                        const menusData = await menusResponse.json();
                        sessionStorage.setItem("menus", JSON.stringify(menusData));
                    });
                }

            } catch (error) {
                console.log(error);
                document.querySelector('.btnSave').setAttribute('disabled', false);
            } finally {
                console.log("Petición finalizada");
            }
        });
    }
    guardarMenu();
});