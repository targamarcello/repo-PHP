document.addEventListener('DOMContentLoaded',function (){
    const form = document.querySelector('form')

    if(form){
        form.addEventListener('submit',function (){
            const nome = document.getElementById('nome').value.trim()
            const cognome = document.getElementById('nome').value.trim()
            const password = document.getElementById('password').value.trim()
            if (nome.length<2){
                alert('Il nome deve contenere almeno 2 caratteri....')
                return
            }
            if (cognome.length<2){
                alert('Il cognome deve contenere almeno 2 caratteri....')
                return
            }
            if (password.length<6){
                alert('La password deve contenere almeno 6 caratteri....')
                return
            }
        })
    }
})