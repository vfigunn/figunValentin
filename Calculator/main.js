




const sumar = ()=>{
    let n1 = parseFloat(document.getElementById("n1").value);
    let n2 = parseFloat(document.getElementById("n2").value);

    let suma = n1+n2;

    document.getElementById("resultado").innerText = suma;
}
