/*Función que muestra el cajón de comentarios*/
function mostrarCajonComentario()
{
    /*Cambio la propiedad visibility a visible para que el formulario se muestre*/
    document.getElementsByClassName("CajonComen")[0].style.visibility = "visible"
    /*Pongo el margin a que se vea más bonito*/
    document.getElementsByClassName("CajonComen")[0].style.margin = 0;
}

/*Función que comprueba que todos los campos del formulario son correctos*/
function validarComentario()
{
    var opcion = true
    //Compruebo que el nombre no está vacío
    if(document.getElementById("name").value == null || document.getElementById("name").value == "")
        opcion = false
    
    //Compruebo que el email no está vacío
    if(document.getElementById("email").value == null || document.getElementById("email").value == "" )
        opcion = false
    else
        validarEmail(document.getElementById("email").value) //En caso de que no este vacío compruebo con una expresión regular si se trata de un correo válido

    //Compruebo que el comentario no está vacio
    if(document.getElementById("comen").value == null || document.getElementById("comen").value == "")
        opcion = false

    //Si algún campo está vacio muestro una alerta por pantalla    
    if(opcion == false)
    {
        alert("Tienes que rellenar todos los campos"); 
        return false;
    }
}
//Función que comprueba si se trata de un email válido mediante una expresión regular
function validarEmail(valor) {
    if (!(/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i. test(valor))){
     alert("La dirección de email es incorrecta.")
     return false
  }
} 