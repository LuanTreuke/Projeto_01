function typeWriter(elemento, delay = 0, callback) {
    const textoArray = elemento.textContent.split('');
    elemento.innerHTML = '';
    
    let i = 0;
    const intervalo = setInterval(() => {
        if (i < textoArray.length) {
            elemento.innerHTML += textoArray[i];
            i++;
        } else {
            clearInterval(intervalo);
            if (callback) callback();
        }
    }, 0.5);
}

document.addEventListener('DOMContentLoaded', function() {
    const txt1 = document.querySelector('.txt1');
    const txt2 = document.querySelector('.txt2');
    const txt3 = document.querySelector('.txt3');
    const txt4 = document.querySelector('.txt4');

    if (!txt1 || !txt2 || !txt3 || !txt4) return;

    // Esconde todos os textos inicialmente
    txt2.style.visibility = 'hidden';
    txt3.style.visibility = 'hidden';
    txt4.style.visibility = 'hidden';

    // Inicia a sequência de animações
    typeWriter(txt1, 0, () => {
        setTimeout(() => {
            txt2.style.visibility = 'visible';
            typeWriter(txt2, 0, () => {
                setTimeout(() => {
                    txt3.style.visibility = 'visible';
                    typeWriter(txt3, 0, () => {
                        setTimeout(() => {
                            txt4.style.visibility = 'visible';
                            typeWriter(txt4, 0);
                        }, 2);
                    });
                }, 2);
            });
        }, 2);
    });
});