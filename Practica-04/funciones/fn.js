let poke1 = 2
let poke2 = 5

const getCharacters = async (poke1,poke2)=>{
    try {
        const res = await fetch('https://pokeapi.co/api/v2/pokemon?offset=0&limit=2000')
        const data = await res.json()
        let urls = [data.results[poke1-1].url,data.results[poke2-1].url]

        urls.forEach((url)=>{fetch(url)
            .then(res=>res.json())
            .then(data=>console.log(data))})
    }
    catch(error){
        console.log(error)
    }
}

getCharacters(poke1,poke2)