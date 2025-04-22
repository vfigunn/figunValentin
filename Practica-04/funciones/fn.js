let poke1 = 2
let poke2 = 27

const getCharacters = async (poke1,poke2)=>{
    try {
        const res = await fetch('https://pokeapi.co/api/v2/pokemon?offset=0&limit=2000')
        const data = await res.json()
        let urlPoke1 = data.results[poke1-1].url
        let urlPoke2 = data.results[poke2-1].url
        
        //traer 1er Pokemon
        const getPoke1 = async(urlPoke1)=>{
            const resPoke1 = await fetch(`${urlPoke1}`)
            const dataPoke1 = await resPoke1.json()
            const statsPoke1 = dataPoke1.stats
            let poderPoke1 = ""
            let nombrePoke1 = dataPoke1.name
            let pokemon1 = {"name":`${nombrePoke1}`}
            for(i of statsPoke1){
                if(i.stat.name=='attack'){
                    poderPoke1 = i.base_stat
                    pokemon1.poder = `${poderPoke1}`
                }
            }
            return pokemon1
        }
        pokemon1 = await getPoke1(urlPoke1)

        //traer 2do Pokemon
        const getPoke2 = async(urlPoke2)=>{
            const resPoke2 = await fetch(`${urlPoke2}`)
            const dataPoke2 = await resPoke2.json()
            const statsPoke2 = dataPoke2.stats
            let poderPoke2 = ""
            let nombrePoke2 = dataPoke2.name
            let pokemon2 = {"name":`${nombrePoke2}`}
            for(i of statsPoke2){
                if(i.stat.name=='attack'){
                    poderPoke2 = i.base_stat
                    pokemon2.poder = `${poderPoke2}`
                }
            }
            return pokemon2
        }
        pokemon2 = await getPoke2(urlPoke2)
        
        if(pokemon1.poder>pokemon2.poder){
            console.log(`${pokemon1.name} es mas fuerte`)
        }else{
            console.log(`${pokemon2.name} es mas fuerte`)
        }
    }
    catch(error){
        console.log(error)
    }
}

getCharacters(poke1,poke2)