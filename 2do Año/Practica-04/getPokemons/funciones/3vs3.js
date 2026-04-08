const URL = 'https://pokeapi.co/api/v2/pokemon?limit=1306'
let pokemons = []

const btn_batalla = document.querySelector("#batalla")

const getNumRand = (min, max)=> {       
    return Math.round(Math.random()*(max-min)+parseInt(min));
}


const getAllPokemons = async()=>{
    try{
        const res = await fetch(`${URL}`)
        const data = await res.json()

        return data.results
    }
    catch(error){
        console.log(error)
    }

    }


const getPokemon = async(url)=>{
    try{
        const res = await fetch(url)
        const data = await res.json()

        return data
    }
    catch(error){
        console.log(error)
    }
}

const getPokemons = async()=>{
    const elegidos = [];
    const pokemones = await getAllPokemons()

    for(i=0;i<6;i++){
        const id = getNumRand(1,pokemones.length)
        const pokemonUrl = pokemones[id].url
        const pokemon = await getPokemon(pokemonUrl)
        elegidos.push(pokemon)
    }

    for(i=0;i<elegidos.length;i++){
        const imagen = document.querySelector(`#img${i+1}`)
        imagen.setAttribute("src",`${elegidos[i].sprites.front_default}`)


        const name = document.querySelector(`#p${i+1}`)
        name.textContent= `${elegidos[i].name}`

        const ataque = document.querySelector(`#a${i+1}`)
        const defensa = document.querySelector(`#d${i+1}`)
        
        elegidos[i].stats.forEach(stat => {
            if(stat.stat.name==='attack'){
                ataque.textContent = `Ataque: ${stat.base_stat}`
            }
            if(stat.stat.name==='defense'){
                defensa.textContent = `Defensa: ${stat.base_stat}`
            }
        });


    }

}


btn_batalla.addEventListener("click",()=>{
    getPokemons()
})

