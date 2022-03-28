$(document).ready(function () {
    //modelli della concessionaria
    let concessionaria = {
        'Audi': ['qualsiasi', 'A1', 'A3', 'A8', 'Q8', 'etron'],
        'BMW': ['qualsiasi', 'Serie 7 Berlina', 'Serie 8 Coupe', 'X5', 'X6', 'M3 Berlina', 'M4 Coupe', 'M8 Coupe', 'i4', 'iX', 'iX3'],
        'Lamborghini': ['qualsiasi', 'Aventador', 'Urus', 'Huracan'],
        'Ferrari': ['qualsiasi', 'F8 SPIDER', '812 SUPERFAST', 'ROMA', 'F12 BERLINETTA', 'SF90 SPIDER', 'PORTOFINO M'],
        'Porsche': ['qualsiasi', '718', 'Panamera', '911', 'Taycan', 'Macan', 'Cayenne'],
        'Maserati': ['qualsiasi', 'Quattroporte', 'Levante', 'MC20']
    }
    let kilometraggio = [0, 100, 1000, 5000, 10000]
    let cavalli = [200, 250, 300, 350, 400, 450, 500, 550, 600, 650, 700, 750, 800, 850, 900, 950, 1000]
    //estrapolo i brand dalla concessionaria
    const keys = Object.keys(concessionaria);
    //riempio il menù a cascata dei brand presenti
    for (i in keys) {
        option = document.createElement('option');
        option.value = keys[i];
        option.text = keys[i];
        document.getElementById('brand').appendChild(option);
    }
    //riempio il menù a cascata del kilometraggio
    for (i in kilometraggio) {
        option = document.createElement('option');
        option.value = kilometraggio[i];
        option.text = kilometraggio[i];
        document.getElementById('kilometraggio').appendChild(option);
    }
    //riempio il menù a cascata dei cavalli
    for (i in cavalli) {
        option = document.createElement('option');
        option.value = cavalli[i];
        option.text = cavalli[i];
        document.getElementById('cavalli').appendChild(option);
    }
    ////riempio il menù a cascata del modello quando si seleziona un brand
    $("#brand").change(function () {
        var selectedBrand = document.getElementById("brand").value;
        var e = document.getElementById("modello");
        var first = e.firstElementChild;
        while (first) {
            first.remove();
            first = e.firstElementChild;
        }
        for (let i = 0; i < concessionaria[selectedBrand].length; i++) {
            option2 = document.createElement('option');
            option2.value = concessionaria[selectedBrand][i];
            option2.text = concessionaria[selectedBrand][i];
            document.getElementById("modello").appendChild(option2);
        }

    });
});
