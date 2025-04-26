

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

        let p2 = document.querySelector('#p2')
        p2.textContent = nombrePoke2.toUpperCase()

        let ganador = document.querySelector('#ganador')

        if (poderPoke1>poderPoke2){
            ganador.textContent = `${nombrePoke1.toUpperCase()} es el ganador!!`
        }else if(poderPoke1<poderPoke2){
            ganador.textContent = `${nombrePoke2.toUpperCase()} es el ganador!!`
        }else{
            ganador.textContent = `Tienen el mismo poder de ataque!!`
        }

    }
    catch(error){
        console.log(error)
    }
}


let id1 = parseInt(document.querySelector('#poke1').value)
let id2 = parseInt(document.querySelector('#poke1').value)

let btnBatalla = document.querySelector('#batalla')

btnBatalla.addEventListener('click',(e)=>{
    e.preventDefault()

    let id1 = parseInt(document.querySelector('#poke1').value)
    let id2 = parseInt(document.querySelector('#poke2').value)

    Batalla(id1,id2)
})
