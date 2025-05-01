const URL = 'https://rickandmortyapi.com/api/character'
const section = document.querySelector('#characters')

const getCharacters = async ()=>{
    try{
        const res = await fetch(URL)
        const data = await res.json()

        const count = data.info.pages
        
        for (let i = 1;i<=count;i++){
            createCharacter(i)
        }
    
    }
    catch(error){
        console.log(error)
    }

}

const createCharacter = async (page)=>{    
    const res = await fetch(`${URL}?page=${page}`)
    const data = await res.json()
    const countCharacters = data.results.length


    for(let i = 0;i<= countCharacters;i++){
            
        const card = document.createElement('div')
        card.classList.add('card')
    
        const name = document.createElement('h1')
        name.classList.add('name')
        name.innerText = data.results[i].name

        const status = document.createElement('p')
        status.classList.add('name')
        status.innerText = data.results[i].status

        const image = document.createElement('img')
        image.classList.add('image')
        image.src = data.results[i].image
        

        card.appendChild(name)
        card.appendChild(status)
        card.appendChild(image)
    
        section.appendChild(card)
    
    }
    
}


getCharacters()

