
const URL = 'https://pokeapi.co/api/v2/pokemon/'
const $EquipoUno_Cards = document.getElementById('EquipoUnoCards'),
    $EquipoDos_Cards = document.getElementById('EquipoDosCards'),
    $btn_batalla = document.getElementById('batalla'),
    $btn_dadosE1 = document.getElementById('tirar_e1'),
    $btn_dadosE2 = document.getElementById('tirar_e2')

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
        document.querySelector('.totalDefenseE1').textContent= `Total Defense: ${statsEquipoUno.defense}`

        let statsEquipoDos = generarStats(equipo_dos)
        document.querySelector('.totalAttackE2').textContent= `Total Attack: ${statsEquipoDos.attack}`
        document.querySelector('.totalDefenseE2').textContent= `Total Defense: ${statsEquipoDos.defense}`



        //Batalla
        $btn_batalla.disabled = true

        $btn_batalla.addEventListener('click',()=>{
            generarBatalla(statsEquipoUno,statsEquipoDos)
            $btn_batalla.style.backgroundColor = '#222'
            $btn_batalla.disabled=true

        })

        
        //Dados Equipo 1
        document.getElementById('tiradas_E1').textContent =  `Tiradas: ` 
        document.getElementById('dado1_E1').textContent = `Dado 1: `
        document.getElementById('dado2_E1').textContent = `Dado 2: `
        document.getElementById('res_dados_E1').textContent = `Resultado: `
        document.getElementById('res_dados_final_E1').textContent = `Resultado más alto: `

        //Dados Equipo 2
        document.getElementById('tiradas_E2').textContent =  `Tiradas: ` 
        document.getElementById('dado1_E2').textContent = `Dado 1: `
        document.getElementById('dado2_E2').textContent = `Dado 2: `
        document.getElementById('res_dados_E2').textContent = `Resultado: `
        document.getElementById('res_dados_final_E2').textContent = `Resultado más alto: `

        let tiradas_totales = 0
        $btn_batalla.disabled=true

        //Tirar Dados E1
        let tirada_e1 = 0,
        mayor_res_e1 = 0

        $btn_dadosE1.addEventListener('click',()=>{
            tiradas_totales++
            let dado_1 = Math.floor(Math.random()*6+1),
            dado_2 = Math.floor(Math.random()*6+1),
            suma_de_dados = dado_1 + dado_2

            if(mayor_res_e1<suma_de_dados){mayor_res_e1=suma_de_dados}

            tirada_e1++ 
            document.getElementById('tiradas_E1').textContent =  `Tiradas: ${tirada_e1}` 
            document.getElementById('res_dados_E1').textContent = `Resultado: ${suma_de_dados}`
            document.getElementById('res_dados_final_E1').textContent = `Resultado más alto: ${mayor_res_e1}`
            document.getElementById('dado1_E1').textContent = `Dado 1: ${dado_1}`
            document.getElementById('dado2_E1').textContent = `Dado 2: ${dado_2}`

            if(tirada_e1===3){
                $btn_dadosE1.style.backgroundColor = '#222'
                $btn_dadosE1.disabled=true
            }

            if(tiradas_totales===6){
                $btn_batalla.style.backgroundColor = "red";
                $btn_batalla.disabled=false
            }

        })

        //Tirar Dados E2
        let tirada_e2 = 0,
        mayor_res_e2 = 0
        $btn_dadosE2.addEventListener('click',()=>{
            tiradas_totales++
            let dado_1 = Math.floor(Math.random()*6+1),
            dado_2 = Math.floor(Math.random()*6+1),
            suma_de_dados = dado_1 + dado_2

            if(mayor_res_e2<suma_de_dados){mayor_res_e2=suma_de_dados}

            tirada_e2++ 
            document.getElementById('tiradas_E2').textContent =  `Tiradas: ${tirada_e2}` 
            document.getElementById('res_dados_E2').textContent = `Resultado: ${suma_de_dados}`
            document.getElementById('res_dados_final_E2').textContent = `Resultado más alto: ${mayor_res_e2}`
            document.getElementById('dado1_E2').textContent = `Dado 1: ${dado_1}`
            document.getElementById('dado2_E2').textContent = `Dado 2: ${dado_2}`

            if(tirada_e2===3){
                $btn_dadosE2.style.backgroundColor = '#222'
                $btn_dadosE2.disabled=true
            }
            if(tiradas_totales===6){
                $btn_batalla.style.backgroundColor = "red";
                $btn_batalla.disabled=false
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
        console.log(restoEquipoUno,' ',restoEquipoDos)

        document.querySelector('.defensaSobranteE1').textContent = `Defensa sobrante: ${restoEquipoUno}`;

        document.querySelector('.defensaSobranteE2').textContent = `Defensa sobrante: ${restoEquipoDos}`;

        if(restoEquipoUno == restoEquipoDos){
            document.getElementById('EquipoUnoGana').textContent = 'Hay empate!!!!!!'
            document.getElementById('EquipoDosGana').textContent = 'Hay empate!!!!!!'
        }else if(restoEquipoUno>restoEquipoDos){
            document.getElementById('EquipoUnoGana').textContent = 'El equipo 1 es el ganador!!!!'
        }else{
            document.getElementById('EquipoDosGana').textContent = 'El equipo 2 es el ganador!!!!'
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
                $pokeDefense.textContent = `Defense: ${defense}`
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
                $pokeDefense.textContent = `Defense: ${defense}`
            }
            $card.append($pokeImg)
            $card.append($pokeName)
            $card.append($pokeAttack)
            $card.append($pokeDefense)

            $EquipoDos_Cards.appendChild($card)
        })
    });



}

const randomNumber = (total_pokemons)=>{
    const number = Math.floor(Math.random() * total_pokemons)
    return number
}

getPokemons()



