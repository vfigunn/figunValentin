
const URL = 'https://pokeapi.co/api/v2/pokemon/'
const $EquipoUno_Cards = document.getElementById('EquipoUnoCards'),
    $EquipoDos_Cards = document.getElementById('EquipoDosCards'),
    $btn_batalla = document.getElementById('batalla'),
    $btn_dadosE1 = document.getElementById('tirar_e1')

const getPokemons = async()=>{
    try{
        //Cantidad total de pokemones
        const res_length = await fetch(URL)
        const length = await res_length.json()
        const total_pokemons = length.count

        //Completa los equipos
        const equipo_uno = [];
        const equipo_dos = [];
        for(i=1;i<=6;i++){
            const id = randomNumber(total_pokemons)
            let Pokemon = await getPokemon(id)
            
            if(equipo_uno.length<3){
                equipo_uno.push(Pokemon)
            }else{
                equipo_dos.push(Pokemon)
            }
        }
        console.log(equipo_uno)
        console.log(equipo_dos)

        createCards(equipo_uno,equipo_dos)

        
        let statsEquipoUno = generarStats(equipo_uno)  

        document.querySelector('.totalAttackE1').textContent= `Total Attack: ${statsEquipoUno.attack}`
        document.querySelector('.totalDefenseE1').textContent= `Total Attack: ${statsEquipoUno.defense}`

        let statsEquipoDos = generarStats(equipo_dos)
        document.querySelector('.totalAttackE2').textContent= `Total Attack: ${statsEquipoDos.attack}`
        document.querySelector('.totalDefenseE2').textContent= `Total Attack: ${statsEquipoDos.defense}`



        //Batalla
        $btn_batalla.disabled = true
        $btn_batalla.addEventListener('click',()=>{
            generarBatalla(statsEquipoUno,statsEquipoDos)
        })

        //Tirar Dados
        let tirada_e1 = 0,
        mayor_res_e1 = 0
        $btn_dadosE1.addEventListener('click',()=>{
            let dado_1 = Math.floor(Math.random()*6+1),
            dado_2 = Math.floor(Math.random()*6+1),
            suma_de_dados = dado_1 + dado_2

            if(mayor_res_e1<suma_de_dados){mayor_res_e1=suma_de_dados}

            tirada_e1++ 
            document.getElementById('tiradas_E1').textContent =  `Tiradas: ${tirada_e1}` 
            document.getElementById('res_dados_E1').textContent = `Resultado: ${suma_de_dados}`
            document.getElementById('res_dados_final_E1').textContent = `Resultado más alto: ${mayor_res_e1}`
            document.getElementById('dado1').textContent = `Dado 1: ${dado_1}`
            document.getElementById('dado2').textContent = `Dado 2: ${dado_2}`

            if(tirada_e1===3){
                $btn_batalla.disabled=false
                $btn_dadosE1.disabled=true
            }
        })

        

    }
    catch(err){
        
    }
    
    
}

const getPokemon = async(id)=>{
    try {
        const res = await fetch(`${URL}/${id}`)
    
        while(res.ok != true){
            id = randomNumber(1031)
            const res = await fetch(`${URL}/${id}`)
            const data = await res.json()
    
            return data
        }

        const data = await res.json()
        return data 

    }catch(err){
        
    }
}

const generarStats = (equipo)=>{
    let attack_equipo = 0;
    let defense_equipo= 0;

    const Equipo = {
        "attack" : attack_equipo,
        "defense" : defense_equipo
    }

    equipo.forEach((pokemon) => {
        pokemon.stats.forEach(stat =>{
            if(stat.stat.name === 'attack'){
                attack_equipo += stat.base_stat
                Equipo.attack = attack_equipo
            }
            if(stat.stat.name === 'defense'){
                defense_equipo+= stat.base_stat
                Equipo.defense = defense_equipo
            }
        })
    });

    return Equipo;
}

const generarBatalla = (equipo_uno,equipo_dos)=>{
        const restoEquipoUno = equipo_uno.defense - equipo_dos.attack
        const restoEquipoDos = equipo_dos.defense - equipo_uno.attack

        if(restoEquipoUno == restoEquipoDos){
            document.getElementById('EquipoUnoGana').textContent = 'Hay empate!!!!!!'
            document.getElementById('EquipoDosGana').textContent = 'Hay empate!!!!!!'
        }else if(restoEquipoUno>restoEquipoDos){
            document.getElementById('EquipoUnoGana').textContent = 'El quipo 1 es el ganador!!!!'
        }else{
            document.getElementById('EquipoDosGana').textContent = 'El quipo 2 es el ganador!!!!'
        }


}

const createCards = (equipoUno,equipoDos)=>{

    equipoUno.forEach(pokemon => {
        let $card = document.createElement('div'),
        $pokeImg = document.createElement('img'),
        $pokeName = document.createElement('p'),
        $pokeAttack = document.createElement('p'),
        $pokeDefense = document.createElement('p')

        $card.setAttribute('class','card')
        let name = pokemon.name
        $pokeName.textContent = name
        let img = pokemon.sprites.front_default
        $pokeImg.src = img


        pokemon.stats.forEach(stat =>{
            if(stat.stat.name === 'attack'){
                let attack = stat.base_stat
                $pokeAttack.textContent = `Attack: ${attack}`
            }
            if(stat.stat.name === 'defense'){
                let defense = stat.base_stat
                $pokeDefense.textContent = `Denfense: ${defense}`
            }
            $card.append($pokeImg)
            $card.append($pokeName)
            $card.append($pokeAttack)
            $card.append($pokeDefense)

            $EquipoUno_Cards.appendChild($card)
        })
    });

    
    equipoDos.forEach(pokemon => {
        let $card = document.createElement('div'),
        $pokeImg = document.createElement('img'),
        $pokeName = document.createElement('p'),
        $pokeAttack = document.createElement('p'),
        $pokeDefense = document.createElement('p')

        $card.setAttribute('class','card')
        let name = pokemon.name
        $pokeName.textContent = name
        let img = pokemon.sprites.front_default
        $pokeImg.src = img


        pokemon.stats.forEach(stat =>{
            if(stat.stat.name === 'attack'){
                let attack = stat.base_stat
                $pokeAttack.textContent = `Attack: ${attack}`
            }
            if(stat.stat.name === 'defense'){
                let defense = stat.base_stat
                $pokeDefense.textContent = `Denfense: ${defense}`
            }
            $card.append($pokeImg)
            $card.append($pokeName)
            $card.append($pokeAttack)
            $card.append($pokeDefense)

            $EquipoDos_Cards.appendChild($card)
        })
    });



}

// const tirarDados = ()=>{
//     let tirada_e1 = 0
//     tirada_e1++
//     document.getElementById('tiradas_E1').textContent =  `Tiradas: ${tirada_e1}`  
//     tirada_e1++  
// }



const randomNumber = (total_pokemons)=>{
    const number = Math.floor(Math.random() * total_pokemons)
    return number
}

getPokemons()



