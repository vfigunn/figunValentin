const enviar = ()=>{
    let nombre = document.querySelector("#nombre").value;
    let apellido = document.querySelector("#apellido").value;
    let documento = document.querySelector("#dni").value;

    const tabla = document.querySelector("tbody");
    
    let alumno = `<tr>
                    <td>${nombre}</td>
                    <td>${apellido}</td>
                    <td>${documento}</td>
                </tr>`

    tabla.insertAdjacentHTML("afterend",alumno);
}