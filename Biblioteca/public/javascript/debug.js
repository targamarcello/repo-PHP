document.addEventListener('DOMContentLoaded',function (){
    const table = document.querySelector('table')

    if (table){
        const box = document.createElement('input')
        box.type = 'text'
        box.placeholder = 'Cerca utente...'
        box.style.width = '100%'
        box.style.padding = '10px'
        box.style.marginBottom = '10px'
        box.style.border = '2px solid #ddd'
        box.style.borderRadius = '6px'
        box.style.fontSize = '0.9em'

        table.parentNode.insertBefore(box,table)
        box.addEventListener('input',function (){
            const ricerca = this.value.toLowerCase()
            const righe = table.querySelectorAll('tbody tr')

            righe.forEach(function (riga){
                const text = riga.textContent.toLowerCase()
                if(text.includes(ricerca)){
                    riga.style.display = ''
                }else{
                    riga.style.display = 'none'
                }
            })
        })



    }
})