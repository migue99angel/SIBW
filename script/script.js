/*Función que muestra el cajón de comentarios*/
function mostrarCajonComentario()
{
    /*Cambio la propiedad visibility a visible para que el formulario se muestre*/
    document.getElementsByClassName("CajonComen")[0].style.visibility = "visible"
    /*Pongo el margin a que se vea más bonito*/
    document.getElementsByClassName("CajonComen")[0].style.margin = 0;
    //comentariosPredefinidos() Esta función no es necesaria a partir de la práctica 3
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
    newDate = document.createTextNode(d.getDate()+"/"+mes+"/"+d.getFullYear()+" a las "+d.getHours()+":"+d.getMinutes())
    //Introduzco todo en el div creado inicialmente
    newDiv.appendChild(newAuthor)
    newDiv.appendChild(newPost)
    newDiv.appendChild(newDate)
    //Introduzco el div en el sitio correspondiente
    var seccion = document.getElementsByClassName("formulario")[0]
    document.getElementsByClassName("evento")[0].insertBefore(newDiv,seccion)
    /*//Reseteo los valores del formulario
    document.getElementById("name").value = ""
    document.getElementById("email").value = ""
    document.getElementById("comen").value = ""*/
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
    newDate = document.createTextNode(d.getDate()+"/"+mes+"/"+d.getFullYear()+" a las "+d.getHours()+":"+d.getMinutes())
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
    newDate2 = document.createElement("h7")

    newUser = document.createTextNode("Miguel González")
    newAuthor.appendChild(newUser)
    newComen = document.createTextNode("Cuando el cine elimina los efectos especiales, que desvían nuestra atención, uno solo puede creer en el guión de una película, y cuando esto sucede, solamente Pulp Fiction puede hacerte pensar: QUE GRANDE ES EL CINE!!!")
    newPost.appendChild(newComen)
    newDate2 = document.createElement("h7")
    newDate2 = document.createTextNode(d.getDate()+"/"+mes+"/"+d.getFullYear()+" a las "+d.getHours()+":"+d.getMinutes())
    newDiv2.appendChild(newAuthor)
    newDiv2.appendChild(newPost)
    newDiv2.appendChild(newDate2)

    //Introduzco el div en el sitio correspondiente
    var seccion = document.getElementsByClassName("formulario")[0]
    document.getElementsByClassName("evento")[0].insertBefore(newDiv2,seccion)    
}

function censura()
{   
        //Paso el texto que se escribe en la caja de comentarios a un array
        boxvalue = document.getElementById("comen").value
        string_to_array = StringToArray(boxvalue)
        //Compruebo si en el array hay alguna palabra prohibida, en el caso de que no la haya
        //Check2Ban devuelve -1 y en el caso de que si la haya devuelve la posición en la que se encuentra
        var pos = Check2Ban(document.getElementById("comen").value)
        
        if(pos != -1)
        {
            //En el caso de que se encuentre una palabra prohibida siempre será la última porque es en tiempo de escritura
            //Así que la eliminamos con pop e introducimos al final los asteriscos
            string_to_array.pop()
            //Genero una cadena de asteriscos con la misma longitud que la palabra censurada
            asteriscos = banning(pos)
            string_to_array.push(asteriscos)
            //Aquí volvemos a convertir el array en un String, utilizamos join(" ") para cambiar la separación por comas por espacios
            var sentence = new String(string_to_array.join(" "))
            //Volvemos a asignar el texto con el contenido restringido
            document.getElementById("comen").value = sentence
        }

}

//Función que convierte el string que se le pasa como parámetro en un array
function StringToArray(str) {
    return str.trim().split(" ");
};

//Función de palabras censuradas
function Check2Ban(arr)
{
    var x
    var pos = -1

    var p =[] 
    p = document.getElementById("ban").value 
    p = StringToArray(p)

    for(var i = 0; i < p.length; i++)
    {
        x = arr.indexOf(p[i])
        if(x != -1)
            return p[i].length
    }
    return pos
}
//Función que devuelve una cadena de asteriscos de una longitud determinada
function banning(n)
{
    var asteriscos = []
    for(var i = 0; i < n; i++)
        asteriscos.push("*")
    return String(asteriscos.join(""))    
}


/*Función que muestra el formulario para registro*/
function mostrarRegistro()
{
    /*Cambio la propiedad visibility a visible para que el formulario se muestre*/
    document.getElementById("login").style.visibility = "hidden"
    document.getElementById("login").style.display = "none"
    document.getElementById("regForm").style.visibility = "visible"
    document.getElementById("regForm").style.display = "inline"

}


function modificarDatos(div)
{
    div.style.visibility = "hidden"
    document.getElementById("cambiarMail").style.visibility = "visible"
}

function mostrarEditar(n)
{
    document.getElementsByClassName("formularioModerar")[n].style.display = "inline"
}

function mostrarEditarEvento()
{
    document.getElementsByClassName("EditarEvento")[0].style.display = "inline"
    document.getElementsByClassName("evento")[0].style.display = "none"
}

function mostrarModal(n)
{
    let cantidad = document.querySelectorAll('.modal').length;
    for(var i = 0; i < cantidad; i++)
        document.getElementsByClassName("modal")[i].style.display = "none";

    document.getElementsByClassName("modal")[n].style.display = "block";
}

function cerrarModal(n)
{
    document.getElementsByClassName("modal")[n].style.display = "none";
}

  
function busquedaAjax(consulta) {
    $.ajax({
        data: {consulta},
        url: 'busqueda.php',
        type: 'get',
        success: function(respuesta) {
            procesaRespuestaAjax(respuesta);
        }
    });
}

function procesaRespuestaAjax(respuesta) {
    
    var resultados = Array();
    for(var i = 0; i < respuesta.length; i++)
         resultados.push({'nombre' : respuesta[i][1], 'id':respuesta[i][0]});

    console.log(resultados)

   mostrarResultados(resultados);

}

function mostrarResultados(str) {
    if (str.length==0) {
      document.getElementById("livesearch").innerHTML="";
      document.getElementById("livesearch").style.border="0px";
      return;
    }

    var res = "";

    for(i = 0; i < str.length; ++i) {
        res += "<a href=\"/evento.php?pelicula=" + str[i]['id'] + "\">" + str[i]['nombre'] + "</a><br><br>";
    }

    document.getElementById("livesearch").style.border="1px solid #A5ACB2";
    $("#livesearch").html(res);

  }