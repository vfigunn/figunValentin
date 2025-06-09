
const URL = 'https://pokeapi.co/api/v2/pokemon/'
const $body = document.querySelector('body'),
    $header = document.createElement('header'),
    $h1 = document.createElement('h1'),
    $section = document.createElement('section'),
    $equipo1 = document.createElement('div'),
    $equipo2 = document.createElement('div'),
    $equipo1_title = document.createElement('h2'),
    $equipo2_title = document.createElement('h2'),
    $equipo1_cards = document.createElement('div'),
    $equipo2_cards = document.createElement('div'),
    $stats_total_E1 = document.createElement('div'),
    $stats_total_E2 = document.createElement('div')


$equipo1.id = 'EquipoUno'
$equipo2.id = 'EquipoDos'
$equipo1_cards.id = 'EquipoUnoCards'
$equipo2_cards.id = 'EquipoDosCards'
$equipo1_title.textContent = 'Equipo 1'
$equipo2_title.textContent = 'Equipo 2'
$stats_total_E1.setAttribute('class','equipoStats')
$stats_total_E2.setAttribute('class','equipoStats')


$body.append($header)
$body.append($section)
$header.append($h1)
$section.append($equipo1)
$section.append($equipo2)
$equipo1.append($equipo1_title)
$equipo2.append($equipo2_title)
$equipo1.append($equipo1_cards)
$equipo2.append($equipo2_cards)

$equipo1.append($stats_total_E1)
$equipo2.append($stats_total_E2)

$h1.textContent = "Batalla de Equipos Pókemon"





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










        //Batalla
        const $total_attack_E1 = document.createElement('p'),
        $total_defense_E1 = document.createElement('p'),
        $total_attack_E2 = document.createElement('p'),
        $total_defense_E2 = document.createElement('p')

        let statsEquipoUno = generarStats(equipo_uno)        
        $total_attack_E1.textContent = `Total Attack: ${statsEquipoUno.attack}`
        $total_defense_E1.textContent = `Total Defense: ${statsEquipoUno.defense}`

        $stats_total_E1.append($total_attack_E1)
        $stats_total_E1.append($total_defense_E1)

        let statsEquipoDos = generarStats(equipo_dos)
        $total_attack_E2.textContent = `Total Attack: ${statsEquipoDos.attack}`
        $total_defense_E2.textContent = `Total Defense: ${statsEquipoDos.defense}`

        $stats_total_E2.append($total_attack_E2)
        $stats_total_E2.append($total_defense_E2)


        const batalla = generarBatalla(statsEquipoUno,statsEquipoDos)




        
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
            console.log('Hay empate!!!!!!')
        }else if(restoEquipoUno>restoEquipoDos){
            console.log('El quipo 1 es el ganador!!!!')
        }else{
            console.log('El equipo 2 es el gandor!!!!')
        }
}

const createCards = (equipoUno,equipoDos)=>{

    equipoUno.forEach(pokemon => {
        let $equipo1_cards = document.querySelector('#EquipoUnoCards')
        let $card = document.createElement('div'),
            $nombre = document.createElement('p'),
            $ataque = document.createElement('p'),
            $defensa = document.createElement('p'),
            $imagen = document.createElement('img')
        
        $card.setAttribute("class","card")
        let name = pokemon.name;
        $nombre.textContent = name
        let img = pokemon.sprites.front_default
        $imagen.src = img


        pokemon.stats.forEach(stat =>{
            if(stat.stat.name === 'attack'){
                let attack = stat.base_stat
                $ataque.textContent = `Attack: ${attack}`
            }
            if(stat.stat.name === 'defense'){
                let defense = stat.base_stat
                $defensa.textContent = `Denfense: ${defense}`
            }
            $card.append($imagen)
            $card.append($nombre)
            $card.append($ataque)
            $card.append($defensa)

            $equipo1_cards.appendChild($card)
        })
    });

    equipoDos.forEach(pokemon => {
        let $equipo2_cards = document.querySelector('#EquipoDosCards')
        let $card = document.createElement('div'),
            $nombre = document.createElement('p'),
            $ataque = document.createElement('p'),
            $defensa = document.createElement('p'),
            $imagen = document.createElement('img')
        
        $card.setAttribute("class","card")
        let name = pokemon.name;
        $nombre.textContent = name
        let img = pokemon.sprites.front_default
        $imagen.src = img


        pokemon.stats.forEach(stat =>{
            if(stat.stat.name === 'attack'){
                let attack = stat.base_stat
                $ataque.textContent = `Attack: ${attack}`
            }
            if(stat.stat.name === 'defense'){
                let defense = stat.base_stat
                $defensa.textContent = `Denfense: ${defense}`
            }
            $card.append($imagen)
            $card.append($nombre)
            $card.append($ataque)
            $card.append($defensa)

            $equipo2_cards.appendChild($card)
        })
    });


}



const randomNumber = (total_pokemons)=>{
    const number = Math.floor(Math.random() * total_pokemons)
    return number
}

getPokemons()



