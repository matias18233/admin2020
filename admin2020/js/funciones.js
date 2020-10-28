function mostrar_mensaje(tipo, titulo, mensaje) {
    if (mensaje != "") {
        switch (tipo) {
            case "0":
                tipo = "info";
                break;
            case "1":
                tipo = "warning";
                break;
            case "2":
                tipo = "error";
                break;
            case "3":
                tipo = "success";
                break;
        }
        swal({title: titulo, text: mensaje, type: tipo, confirmButtonText: "Aceptar"});
    }
}