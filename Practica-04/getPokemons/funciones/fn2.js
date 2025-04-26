

const Batalla = async (id1,id2)=>{
    try {
        //Pokemon num 1
        const res1 = await fetch(`https://pokeapi.co/api/v2/pokemon/${id1}`)
        const pokemon1 = await res1.json()
        const nombrePoke1 = pokemon1.name
        let poderPoke1;
        let stats = pokemon1.stats;

        stats.forEach(e => {
            if (e.stat.name === 'attack'){
                poderPoke1 = e.base_stat
            }
        });
        
        //Pokmemon num 2
        const res2 = await fetch(`https://pokeapi.co/api/v2/pokemon/${id2}`)
        const pokemon2 = await res2.json()
        const nombrePoke2 = pokemon2.name
        let poderPoke2;
        let stats2 = pokemon2.stats;

        stats2.forEach(e => {
            if (e.stat.name === 'attack'){
                poderPoke2 = e.base_stat
            }
        });

        let p1 = document.querySelector('#p1')
        p1.textContent = nombrePoke1.toUpperCase()
        let img1 = document.querySelector('#img1')
        img1.src = pokemon1.sprites.front_default
        let poder1 = document.querySelector('#poder1')
        poder1.textContent = `Ataque: ${poderPoke1.toString()}`


        let p2 = document.querySelector('#p2')
        p2.textContent = nombrePoke2.toUpperCase()
        let img2 = document.querySelector('#img2')
        img2.src = pokemon2.sprites.front_default
        let poder2 = document.querySelector('#poder2')
        poder2.textContent = `Ataque: ${poderPoke2.toString()}`

        let ganador = document.querySelector('#ganador')
        let imgganador = document.querySelector("#imgganador")


        if (poderPoke1>poderPoke2){
            ganador.innerHTML = `<b>${nombrePoke1.toUpperCase()}</b> es el ganador!!`
            imgganador.src = img1.src            
        }else if(poderPoke1<poderPoke2){
            ganador.innerHTML = `<b>${nombrePoke2.toUpperCase()}</b> es el ganador!!`
            imgganador.src = img2.src
        }else{
            ganador.textContent = `Tienen el mismo poder de ataque!!`
        }

    }
    catch(error){
        console.log(error)
    }
}

let btnBatalla = document.querySelector('#batalla')

btnBatalla.addEventListener('click',(e)=>{
    e.preventDefault()

    let id1 = parseInt(document.querySelector('#poke1').value)
    let id2 = parseInt(document.querySelector('#poke2').value)

    let vs = document.querySelector("#vs")
    vs.textContent = "VS"

    Batalla(id1,id2)
})

let btnBorrar = document.querySelector('#borrar')

btnBorrar.addEventListener('click',(e)=>{
    e.preventDefault()

    let id1 = document.querySelector("#poke1").value = ""
    let id2 = document.querySelector("#poke2").value = ""

    let p1 = document.querySelector('#p1').textContent = ""
    let img1 = document.querySelector('#img1').src = ""

    let p2 = document.querySelector('#p2').textContent = ""
    let img2= document.querySelector('#img2').src = ""

    let ganador = document.querySelector('#ganador').textContent = ""
    let imgganador = document.querySelector("#imgganador").src = ""

    let poder1 = document.querySelector('#poder1').textContent = ""
    let poder2 = document.querySelector("#poder2").textContent = ""

    let vs = document.querySelector("#vs").textContent = ""

})