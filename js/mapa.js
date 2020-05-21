
window.onload = function () {
    setInterval(atualizaParadas, 2000);
};

function atualizaParadas() {
    fetch('./atualiza.php', { headers: { "Content-Type": "application/json; charset=utf-8" }})
        .then(res => res.json()) // parse response as JSON (can be res.text() for plain response)
        .then(response => {
            const estacionamento = response.estacionamentos[0];
            let htmlSensores = "";
            if (estacionamento.sensor1 < 12) {
                
                htmlSensores += `<section class="4u">
                <span><img src="images/Ocupado.jpg" alt="oucupado"></span>
                <h3>A1</h3>
                <a class="button button-style1" style="background-color: #e82e2e">Ocupado</a>
                </section>`;
            } else {
                htmlSensores += `<section class="4u">
                <span><img src="images/Livre.jpg" alt="livre"></span>
                <h3>A1</h3>
                <a class="button button-style1">Livre</a>
                </section>`
            }
            if (estacionamento.sensor2 < 12) {
                htmlSensores += `<section class="4u">
                <span><img src="images/Ocupado.jpg" alt="oucupado"></span>
                <h3>A2</h3>
                <a class="button button-style1" style="background-color: #e82e2e">Ocupado</a>
                </section>`;
            } else {
                htmlSensores += `<section class="4u">
                <span><img src="images/Livre.jpg" alt="livre"></span>
                <h3>A2</h3>
                <a class="button button-style1">Livre</a>
                </section>`;
            }
            if (estacionamento.sensor3 < 12) {
                htmlSensores += `<section class="4u">
                <span><img src="images/Ocupado.jpg" alt="oucupado"></span>
                <h3>A3</h3>
                <a class="button button-style1" style="background-color: #e82e2e">Ocupado</a>
                </section>`;
            } else {
                htmlSensores += `<section class="4u">
                <span><img src="images/Livre.jpg" alt="livre"></span>
                <h3>A3</h3>
                <a class="button button-style1">Livre</a>
                </section>`;
            }

            const sensores = document.querySelector('#sensores');
            sensores.innerHTML = htmlSensores;
        })
        .catch(err => {
            console.log(err);
            alert("sorry, there are no results for your search")
        });
}