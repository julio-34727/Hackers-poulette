document.addEventListener('DOMContentLoaded', () => {

    document.querySelectorAll('.form__select').forEach($select => {
        $select.addEventListener('change', (event) => {
            $label = event.target.nextElementSibling;
            selectid = event.target.id;
            selectid = selectid.charAt(0).toUpperCase() + selectid.slice(1);
            $label.innerHTML = `${selectid}*: `;
            $span = document.createElement('span');
            $span.classList.add('correct');
            $span.innerHTML = 'valid choice &#10004';
            $label.append($span);
            $label.style.display = 'block';
        })
    })

    document.querySelectorAll('.form__radio-input').forEach($select => {
        $select.addEventListener('change', (event) => {
            $label = event.target.parentElement.nextElementSibling;
            $label.innerHTML = 'Gender*:';
            $span = document.createElement('span');
            $span.classList.add('correct');
            $span.innerHTML = ` ${event.target.value}&check;`;
            $label.append($span);
            $label.style.display = 'block';
        })
    })
    
})