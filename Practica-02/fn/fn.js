
const Persona1 = {nombre:'Valentin',apellido:'Figun',edad:52,dni:'33222555',colores:['verde','azul','rojo']}

const Persona2 = {nombre:'Lucas',apellido:'Martinez',edad:42,dni:'44333777',colores:['narnaja','azul','amarillo']}


const esMayor = (p1,p2)=>{
    if(p1.edad==p2.edad){
        console.log(p1.nombre+' y '+p2.nombre+' tienen la misma edad')
    }else if(p1.edad>p2.edad && p1.colores.includes('azul')){
        console.log('El mayor es: '+p1.nombre+' y le gusta el color azul')
    }else if(p1.edad>p2.edad){
        console.log('El mayor es: '+p1.nombre+' y no le gusta el color azul')
    }else if(p2.colores.includes('azul')){
        console.log('El mayor es: '+p2.nombre+' y le gusta el color azul')
    }
    else{
        console.log('El mayor es: '+p2.nombre+' y no le gusta el color azul')
    }
}


esMayor(Persona1,Persona2)