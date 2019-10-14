/* Fonctions */

const isValidEmail = (email) => {
    const regex1 = /(\.{2}|-{2}|_{2})/;
    const regex2 = /^[a-z0-9][a-z0-9-_\.]+@([a-z]|[a-z0-9]?[a-z0-9-]+[a-z0-9])\.[a-z0-9]{2,10}(?:\.[a-z]{2,10})?$/i;

    return !regex1.test(email) && regex2.test(email) && email.length <= 320;
};

const isValidInputsField = (field, input) => {
    let out = false;
    input = input.trim();
    if (field === 'firstname' || field === 'lastname') {
        const regex = /^[\p{L}]+([ '](?:\p{L}+))?([ '-](?:\p{L}+))*$/u;
        out = regex.test(input) && input.length > 1 && input.length <= 32;;
    }
    else if (field === 'email') {out = isValidEmail(input);}
    else if (field === 'comments') {
        out = input.length > 1;
    }

    return out;
};

/* Evénements */

// Affichage du label après modification des champs 'input' et 'textarea'
document.querySelector('form').addEventListener('input', event => {                                               
    if (event.target.matches('.form__input') || event.target.matches('.form__area')) {
        const field = event.target.getAttribute('name');
        $label = event.target.nextElementSibling;
        $label.innerHTML = field[0].toUpperCase() + field.slice(1) + '*: ';
        $span = document.createElement('span');
        $label.append($span);
        $label.style.display = 'block';

        if (isValidInputsField(field, event.target.value)) {
            $span.classList.add('correct');
            $span.innerHTML = 'valid field &#10004;'
            event.target.classList.add('border-correct');
            event.target.classList.remove('border-error');
        } 
        else {
            const msg1 = 'only unicode letters (2-32 chars) &amp; compound names';
            const msg2 = 'invalid email format (RFC 5321)';
            const msg3 = 'type your comments please (1-200 chars)';
            const msg = {'firstname': msg1, 'lastname': msg1, 'email': msg2, 'comments': msg3};
            $span.classList.add('error');
            $span.innerHTML = msg[field];
            event.target.classList.add('border-error');
            event.target.classList.remove('border-correct');
        }
    }
    
})

// Nettoyage des espaces au début et à la fin des inputs lorsque ces champs n'ont plus de focus
document.querySelector('form').addEventListener('focusout', (event) => {
    if (event.target.matches('.form__input') || event.target.matches('.form__area')) {
        event.target.value = event.target.value.trim();
    }
})

// Affichage du label après modification des champs 'radio' et 'select'
document.querySelector('form').addEventListener('change', event => {
    if (event.target.matches('.form__radio-input') || event.target.matches('.form__select')) {
        const name = event.target.getAttribute('name');
        $label = document.querySelector(`#${event.target.id} ~ .form__label`);
        $label.innerHTML = name[0].toUpperCase() + name.slice(1) + '*: ';
        $span = document.createElement('span');
        $span.classList.add('correct');
        $span.innerHTML = 'valid field &#10004;';
        $label.append($span);
        $label.style.display = 'block';
    }
})