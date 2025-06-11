const URL = 'https://randomuser.me/api/?results='
const $button_buscar = document.getElementById('btn-user'),
    $input = document.getElementById('usuario'),
    $section_cards = document.getElementById('section_cards'),
    $button_borrar = document.getElementById('btn-borrar')

class Person {
    constructor(fName,lName,age,img){
        this.fName = fName
        this.lName = lName
        this.age = age
        this.img = img
    }

}

const getUsers = async(countUsers)=>{
    const res = await fetch(`${URL}${countUsers}`)
    const data = await res.json()

    const usuarios = data.results

    return usuarios
}


$button_buscar.addEventListener('click',async (e)=>{
    $section_cards.textContent = ''
    const countUsers = parseInt(document.getElementById('usuario').value)
    if(countUsers >= 1){
        const usuarios = await getUsers(countUsers)

        let edades = 0

        usuarios.forEach((user)=>{
            const person = new Person(user.name.first,user.name.last,user.dob.age,user.picture.large)
            const $card = document.createElement('div'),
            $img = document.createElement('img'),
            $fName = document.createElement('p'),
            $lName = document.createElement('p'),
            $age = document.createElement('p')

            $img.src = person.img
            $fName.textContent = person.fName
            $lName.textContent = person.lName
            $age.textContent = person.age

            edades += user.dob.age

            $card.appendChild($img)
            $card.appendChild($fName)
            $card.appendChild($lName)
            $card.appendChild($age)

            $section_cards.appendChild($card)
        })

        let promedio = edades / countUsers

    }
})



$button_borrar.addEventListener('click',()=>{
    $section_cards.textContent = ''
    $input.value = ''
})


