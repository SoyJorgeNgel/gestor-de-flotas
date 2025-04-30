function informacion_cp() {
  $.ajax({
    url: "https://api.copomex.com/query/info_cp/" + $("#createZipCode").val(),
    data: {
      token: "pruebas",
      type: "simplified",
    },
    type: "GET",
    dataType: "json",
    success: function (copomex) {
      if (!copomex.error) {
        $("#createState").val(copomex.response.estado.toUpperCase());
        $("#createLocality").val(copomex.response.municipio.toUpperCase());
        $("#createNeighborhood").html("");
        for (var i = 0; i < copomex.response.asentamiento.length; i++) {
          $("#createNeighborhood").append(
            "<option>" + copomex.response.asentamiento[i].toUpperCase() + "</option>"
          );
        }
        // Simulación de relleno de campos para activar eventos de cambio
        $("#createState").trigger("focus");
        $("#createLocality").trigger("focus");
        $("#createNeighborhood").trigger("focus");
      } else {
        console.log("error: " + copomex.error_message);
      }
    },
    error: function (jqXHR, status, error) {
      if (jqXHR.status == 400) {
        copomex = jqXHR.responseJSON;
        alert(copomex.error_message);
      }
    },
    complete: function (jqXHR, status) {
      console.log("Petición a COPOMEX terminada");
    },
  });
}


function informacion_cp2() {
  $.ajax({
    url: "https://api.copomex.com/query/info_cp/" + $("#postal2").val(), //aqui va el endpoint de la api de copomex, con el método de info_cp, se deberá concatenar el CP ya que se recibe como parametro en la url, no como variable GET
    data: {
      token: "8ab0a5ed-98c3-4978-82af-19e64932935f", //aqui va tu token. Crea una cuenta gratuita para obtener tu token en https://api.copomex.com/panel
      type: "simplified",
    },
    type: "GET", //el método http que se usará, COPOMEX solo ocupa método get
    dataType: "json", // el tipo de información que se espera de respuesta
    success: function (copomex) {
      // código a ejecutar si la petición es satisfactoria, dentro irá el código personalizado

      if (!copomex.error) {
        //si NO hubo un error
        $("#estado2").val(copomex.response.estado.toUpperCase()); //ingresamos la respuesta del tipo de asentamiento, en el input destino
        $("#municipio2").val(copomex.response.municipio.toUpperCase()); //ingresamos la respuesta del municipio, en el input destino
        $("#ciudad2").val(copomex.response.ciudad.toUpperCase()); //ingresamos la respuesta de la ciudad, en el input destino
        $("#asentamiento2").html(""); //reseteamos el input select para que no se concatene a los nuevos resultados
        for (var i = 0; i < copomex.response.asentamiento.length; i++) {
          //iteramos el resultado en un for
          $("#asentamiento2").append(
            "<option>" + copomex.response.asentamiento[i].toUpperCase() + "</option>"
          ); //agregamos el item al listado de colonias
        }
      } else {
        //si hubo error
        console.log("error: " + copomex.error_message);
      }
    },
    error: function (jqXHR, status, error) {
      //si ocurrió un error en el request al endpoint de COPOMEX

      if (jqXHR.status == 400) {
        //el código http 400 significa que algo se mandó mal (Bad Request)
        copomex = jqXHR.responseJSON;
        alert(copomex.error_message); //mostramos en un alerta, el error recibido
      }
    },
    complete: function (jqXHR, status) {
      // código a ejecutar sin importar si la petición falló o no
      console.log("Petición a COPOMEX terminada");
    },
  });
}