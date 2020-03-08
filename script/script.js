/*Función que muestra el cajón de comentarios*/
function mostrarCajonComentario()
{
    /*Cambio la propiedad visibility a visible para que el formulario se muestre*/
    document.getElementsByClassName("CajonComen")[0].style.visibility = "visible"
    /*Pongo el margin a que se vea más bonito*/
    document.getElementsByClassName("CajonComen")[0].style.margin = 0;
    comentariosPredefinidos()
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
    
    aniadirComentario(document.getElementById("name"),document.getElementById("comen"))
    

}
//Función que comprueba si se trata de un email válido mediante una expresión regular
function validarEmail(valor)
{
    if (!(/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i. test(valor))){
     alert("La dirección de email es incorrecta.")
     return false
  }
}

function aniadirComentario(name,comentario)
{
    //Creo el div que contendrá todo el comentario
    newDiv = document.createElement("div")
    //Le asigno la clase para darle estilo con el css
    newDiv.className = "Comentario"
    //Creo un h3 para el autor, de modo que destaque más
    newAuthor = document.createElement("h3")
    //Creo el p para almacenar el contenido del comentario
    newPost = document.createElement("p")
    //Meto el nombre en el div del h3 y el comentario en el párrafo
    newUser = document.createTextNode(name.value)
    newAuthor.appendChild(newUser)
    newComen = document.createTextNode(comentario.value)
    newPost.appendChild(newComen)
    newDate = document.createElement("h7")
    //Creo un objeto Date para la fecha
    var d = new Date()
    //La variable mes la creo porque getMonth te devuelve un número de 0 a 11, por eso aqui la incremento en uno
    var mes = d.getMonth() + 1
    newDate = document.createTextNode(d.getDate()+"/"+mes+"/"+d.getFullYear())
    //Introduzco todo en el div creado inicialmente
    newDiv.appendChild(newAuthor)
    newDiv.appendChild(newPost)
    newDiv.appendChild(newDate)
    //Introduzco el div en el sitio correspondiente
    var seccion = document.getElementsByClassName("formulario")[0]
    document.getElementsByClassName("evento")[0].insertBefore(newDiv,seccion)
}

function comentariosPredefinidos()
{
    newDiv = document.createElement("div")
    newDiv.className = "Comentario"
    newAuthor = document.createElement("h3")
    newPost = document.createElement("p")
    newUser = document.createTextNode("Laura Benítez")
    newAuthor.appendChild(newUser)
    newComen = document.createTextNode("Simplemente espectacular,para mi una de las mejores películas de la historia con un guion, unos diálogos y unos personajes que se superan en todo.")
    newPost.appendChild(newComen)
    newDate = document.createElement("h7")
    //Creo un objeto Date para la fecha
    var d = new Date()
    //La variable mes la creo porque getMonth te devuelve un número de 0 a 11, por eso aqui la incremento en uno
    var mes = d.getMonth() + 1
    newDate = document.createTextNode(d.getDate()+"/"+mes+"/"+d.getFullYear())
    //Introduzco todo en el div creado inicialmente
    newDiv.appendChild(newAuthor)
    newDiv.appendChild(newPost)
    newDiv.appendChild(newDate)
    //Introduzco el div en el sitio correspondiente
    var seccion = document.getElementsByClassName("formulario")[0]
    document.getElementsByClassName("evento")[0].insertBefore(newDiv,seccion) 
    
    newDiv2 = document.createElement("div")
    newDiv2.className = "Comentario"
    newAuthor = document.createElement("h3")
    newPost = document.createElement("p")

    newUser = document.createTextNode("Miguel González")
    newAuthor.appendChild(newUser)
    newComen = document.createTextNode("Cuando el cine elimina los efectos especiales, que desvían nuestra atención, uno solo puede creer en el guión de una película, y cuando esto sucede, solamente Pulp Fiction puede hacerte pensar: QUE GRANDE ES EL CINE!!!")
    newPost.appendChild(newComen)
    newDate = document.createElement("h7")

    newDiv2.appendChild(newAuthor)
    newDiv2.appendChild(newPost)
    newDiv2.appendChild(newDate)
    //Introduzco el div en el sitio correspondiente
    var seccion = document.getElementsByClassName("formulario")[0]
    document.getElementsByClassName("evento")[0].insertBefore(newDiv2,seccion)    
}

function censura()
{
    if(document.getElementById("comen").value =="ho")
        document.getElementById("comen").value =="*"
}