function registrarEvento() {
    var titulo = document.getElementById("titulo").value;
    var fecha = document.getElementById("fecha").value;
    var descripcion = document.getElementById("descripcion").value;
    var imagenURL = document.getElementById("imagenURL").value;

    var evento = {
        titulo: titulo,
        fecha: fecha,
        descripcion: descripcion,
        imagenURL: imagenURL
    };

    var eventoRegistradoDiv = document.getElementById("eventoRegistrado");
    var nuevoEventoDiv = document.createElement("div");
    nuevoEventoDiv.innerHTML = "<h2>" + evento.titulo + "</h2>" +
                                 "<p><strong>Fecha:</strong> " + evento.fecha + "</p>" +
                                 "<p><strong>Descripción:</strong> " + evento.descripcion + "</p>" +
                                 "<img src='" + evento.imagenURL + "' alt='Imagen del evento'>";
    eventoRegistradoDiv.appendChild(nuevaNoticiaDiv);
}
