
const contenedor = document.querySelector('#contenedor')


const getPokemon = async (id)=>{
    try{
        const res = await fetch(`https://pokeapi.co/api/v2/pokemon/${id}`)
        const data = await res.json()
        createPokemon(data)
    }
    catch(error){
        console.log(error)
    }
}

const getPokemons =  (number)=>{
    for(i=1;i <= number;i++){
        getPokemon(i)
    }
}


const createPokemon = (pokemon)=>{
    const card = document.createElement('div')
    card.classList.add('card')

    const imagen = document.createElement('div')
    imagen.classList.add('imagen')

    const img = document.createElement('img')
    img.src = pokemon.sprites.front_default

    imagen.appendChild(img)

    const number = document.createElement('p')
    number.classList.add('data')
    number.textContent = `#${pokemon.id.toString().padStart(3,0)}`;

    const name = document.createElement('p')
    name.classList.add('data')
    name.textContent = `${pokemon.name.toUpperCase()}`

    card.appendChild(imagen)
    card.appendChild(name)
    card.appendChild(number)

    contenedor.appendChild(card)

}

// getPokemons(3)

const traer = document.querySelector('#traer')
const limpiar = document.querySelector('#limpiar')

traer.addEventListener('click',()=>{
    const pokemones = document.querySelector('#id').value
    getPokemons(pokemones)
    contenedor.innerHTML = ""
})

limpiar.addEventListener('click',()=>{
    const input = document.querySelector('#id').value = ""
    contenedor.innerHTML = ""
})