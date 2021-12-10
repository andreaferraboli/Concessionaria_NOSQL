$(document).ready(function () {
    let concessionaria = {
        'Audi': ['qualsiasi', 'A1', 'A3', 'A8', 'Q8', 'etron'],
        'BMW': ['qualsiasi', 'Serie 7 Berlina', 'Serie 8 Coupe', 'X5', 'X6', 'M3 Berlina', 'M4 Coupe', 'M8 Coupe', 'i4', 'iX', 'iX3'],
        'Lamborghini': ['qualsiasi', 'Aventador', 'Urus', 'Huracan'],
        'Ferrari': ['qualsiasi', 'F8 SPIDER', '812 SUPERFAST', 'ROMA', 'F12 BERLINETTA', 'SF90 SPIDER', 'PORTOFINO M'],
        'Porsche': ['qualsiasi', '718', 'Panamera', '911', 'Taycan', 'Macan', 'Cayenne'],
        'Maserati': ['qualsiasi', 'Quattroporte', 'Levante', 'MC20']
    }
    const keys = Object.keys(concessionaria);
    for (i in keys) {
        option = document.createElement('option');
        option.value = keys[i];
        option.text = keys[i];
        document.getElementById('brand').appendChild(option);
    }
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