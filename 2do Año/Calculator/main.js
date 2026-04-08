
const sumar = ()=>{
    let n1 = parseFloat(document.getElementById("n1").value);
    let n2 = parseFloat(document.getElementById("n2").value);

    let suma = (isNaN(n1) || isNaN(n2)) ? 0 : n1+n2;

    document.getElementById("resultado").innerText = suma;
}

const restar = ()=>{
    let n1 = parseFloat(document.getElementById("n1").value);
    let n2 = parseFloat(document.getElementById("n2").value);

    let resta = (isNaN(n1) || isNaN(n2)) ? 0 : n1-n2;

    document.getElementById("resultado").innerText = resta;
}

const multiplicar = ()=>{
    let n1 = parseFloat(document.getElementById("n1").value);
    let n2 = parseFloat(document.getElementById("n2").value);

    let producto = (isNaN(n1) || isNaN(n2)) ? 0 : n1*n2;

    document.getElementById("resultado").innerText = producto;
}

const dividir = ()=>{
    let n1 = parseFloat(document.getElementById("n1").value);
    let n2 = parseFloat(document.getElementById("n2").value);

    let division = (isNaN(n1) || isNaN(n2)) ? 0 : n1/n2;

    if (n2===0){
        alert("No se puede dividir por 0.")
        return 0;
    }

    document.getElementById("resultado").innerText = division;
}

const borrar = ()=>{
    document.getElementById("resultado").innerText = 0;
    document.querySelector("#n1").value = null;
    document.querySelector("#n2").value = null;
}

