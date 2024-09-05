$("document").ready(() => {
  function notify(content, type = "success") {
    let wrapper = $(".wrapper_notifications"),
      id = Math.floor(Math.random() * 500 + 1),
      notificacion =
        '<div class="alert alert-' +
        type +
        '" id="noty_' +
        id +
        '">' +
        content +
        "</div>",
      time = 5000;

    //insertar en el contenedor la notificación
    wrapper.append(notificacion);

    //Timer para ocultar la notificación
    setTimeout(function () {
      $("#noty_" + id).remove();
    }, time);

    return true;
  }

  //Cargar contenido de la cotización
  function get_quote() {
    let wrapper = $(".wrapper_quote"),
      action = "get_quote_res",
      nombre = $("#nombre"),
      empresa = $("#empresa"),
      email = $("#email");

    $.ajax({
      url: "ajax.php",
      type: "get",
      cache: false,
      dataType: "json",
      data: { action },
      beforeSend: function () {
        wrapper.waitMe({});
      },
    })
      .done((res) => {
        if (res.status === 200) {
          nombre.val(res.data.quote.nombre);
          empresa.val(res.data.quote.empresa);
          email.val(res.data.quote.email);
          wrapper.html(res.data.html);
        } else {
          wrapper.html(res.msg);
        }
      })
      .fail((err) => {
        wrapper.html("Ocurrió un error, por favor recarga la página");
      })
      .always(() => {
        wrapper.waitMe("hide");
      });
  }
  get_quote();

  //Función para agregar un concepto a la cotización
  $("#add_to_quote").on("submit", add_to_quote);
  function add_to_quote(e) {
    e.preventDefault();

    let form = $("#add_to_quote"),
      action = "add_to_quote",
      data = new FormData(form.get(0)),
      errors = 0;

    //Agregar la accion al objeto data
    data.append("action", action);

    //Validar concepto
    let concepto = $("#concepto").val(),
      precio = parseFloat($("#precio_unitario").val());

    if (concepto.length < 5) {
      notify("Ingresa un concepto válido por favor.", "danger");
      errors++;
    }

    //Validar precios
    if (precio < 10) {
      notify("Por favor ingrese un precio mayor a $10.", "danger");
      errors++;
    }

    if (errors > 0) {
      notify("Completa el formulario.", "danger");
      return false;
    }

    $.ajax({
      url        : "ajax.php",
      type       : "POST",
      dataType   : "json",
      cache      : false,
      processData: false,
      contentType: false,
      data       : data,
      beforeSend : () => {
        form.waitMe();
      },
    })
      .done((res) => {
        if (res.status === 201) {
          notify(res.msg);
          form.trigger("reset");
          get_quote();
        } else {
          notify(res.msg, "danger");
        }
      })
      .fail((err) => {
        notify("Hubo un problema con la petición, intenta de nuevo.", "danger");
        form.trigger("reset");
      })
      .always(() => {
        form.waitMe("hide");
      });
  }

  //Función para reiniciar la cotización
  $(".restart_quote").on("click", restart_quote);
  function restart_quote(e) {
    e.preventDefault;

    let button = $(this),
      action = "restart_quote";

    if (!confirm("¿Estás seguro?")) return false;

    //Petición
    $.ajax({
      url: "ajax.php",
      type: "POST",
      dataType: "json",
      data: { action },
    })
      .done((res) => {
        if (res.status === 200) {
          notify(res.msg);
          get_quote();
        } else {
          notify(res.msg, "danger");
        }
      })
      .fail((err) => {
        notify("Hubo un problema con la petición.", "danger");
      })
      .always(() => {});
  }

  //Función para eliminar elementos individuales
  $("body").on("click", ".delete_concept", delete_concept);
  function delete_concept(e) {
    e.preventDefault();

    let button = $(this),
      id = button.data("id"),
      action = "delete_concept";

    if (!confirm("¿Estás seguro?")) return false;

    //Petición
    $.ajax({
      url: "ajax.php",
      type: "POST",
      dataType: "json",
      data: { action, id },
      beforeSend: () => {
        $("body").waitMe();
      },
    })
      .done((res) => {
        if (res.status === 200) {
          notify(res.msg);
          get_quote();
        } else {
          notify(res.msg, "danger");
        }
      })
      .fail((err) => {
        notify("Hubo un problema con la petición", "danger");
      })
      .always(() => {
        $("body").waitMe("hide");
      });
  }

  //Función para cargar un sólo concepto
  $("body").on("click", ".edit_concept", edit_concept);
  function edit_concept(e) {
    e.preventDefault();

    let button = $(this),
      id = button.data("id"),
      action = "edit_concept",
      wrapper_update_concept = $(".wrapper_update_concept"),
      form_update_concept = $("#save_concept");

    //Petición
    $.ajax({
      url: "ajax.php",
      type: "POST",
      dataType: "json",
      data: { action, id },
      beforeSend: () => {
        $("body").waitMe();
      },
    })
      .done((res) => {
        if (res.status === 200) {
          $("#id_concepto", form_update_concept).val(res.data.id);
          $("#concepto", form_update_concept).val(res.data.concept);
          $(
            '#tipo option[value="' + res.data.type + '"]',
            form_update_concept
          ).attr("selected", true);
          $("#cantidad", form_update_concept).val(res.data.quantity);
          $("#precio_unitario", form_update_concept).val(res.data.price);
          wrapper_update_concept.fadeIn();
          notify(res.msg);
        } else {
          notify(res.msg, "danger");
        }
      })
      .fail((err) => {
        notify("Hubo un problema con la petición", "danger");
      })
      .always(() => {
        //$("body").waitMe("hide");
      });
  }

  //Función para guardar cambios en elemento
  $("#save_concept").on("submit", save_concept);
  function save_concept(e) {
    e.preventDefault();

    let form                 = $("#save_concept"),
    action                   = "save_concept",
    data                     = new FormData(form.get(0)),
    wrapper_update_concept    = $(".wrapper_update_concept"),
    errors                   = 0;

    //Agregar la acción al objeto data
    data.append("action", action);

    //Validar el concepto
    let concepto = $("#concepto", form).val(),
      precio = parseFloat($("#precio_unitario", form).val());

    if (concepto.length < 5) {
      notify("Ingresa un concepto válido.", "danger");
      errors++;
    }

    //Validar el precio
    if (precio < 10) {
      notify("Por favor ingresa un precio mayor a $10", "danger");
    }

    if (errors > 0) {
      notify("Completa el formulario", "danger");
      return false;
    }

    $.ajax({
      url         : 'ajax.php',
      type        : 'POST',
      dataType    : 'json',
      cache       : false,
      processData : false,
      contentType : false,
      data        : data,
      beforeSend  : () => {
        form.waitMe();
      }
    }).done(res => {
      if(res.status === 200){
        form.trigger('reset');
        wrapper_update_concept.fadeOut();
        notify(res.msg);
        get_quote();
      } else {
        notify(res.msg, 'danger');
      }
    }).fail(err => {
      notify('Hubo un problema con la petición, intenta de nuevo.', 'danger');
      wrapper_update_concept.fadeOut();
      form.trigger('reset');
    }).always(() => {
      form.waitMe('hide');
    })

  }

  //Cancel edit
  $('#cancel_edit').on('click', (e) => {
    e.preventDefault();

    let button = $(this),
    wrapper    = $('.wrapper_update_concept'),
    form       = $('#save_concept');

    wrapper.fadeOut();
    form.trigger('reset');
  });
});
