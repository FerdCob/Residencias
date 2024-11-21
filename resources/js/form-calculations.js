// ------- PARTADO NUMERO 1 Generacion Total---------
//Restaurante
window.calculateTotalRest = function () {
    const rali = parseFloat(document.getElementById('rali_kg').value) || 0;
    const rcom = parseFloat(document.getElementById('rcom_kg').value) || 0;
    const rino = parseFloat(document.getElementById('rino_kg').value) || 0;
    const rnva = parseFloat(document.getElementById('rnva_kg').value) || 0;

    const totalRest = (rali + rcom + rino + rnva).toFixed(3);  // Limita a 3 decimales
    document.getElementById('totalRest').value = totalRest;

    // Llama a la función de suma general
    calculateTotalGeneral();
};
//Habitaciones
window.calculateTotalHabit = function () {
    const hino = parseFloat(document.getElementById('hino_kg').value) || 0;
    const hotr = parseFloat(document.getElementById('hotr_kg').value) || 0;

    const totalHabi = (hino + hotr ).toFixed(3);  // Limita a 3 decimales
    document.getElementById('totalHabi').value = totalHabi;

    // Llama a la función de suma general
    calculateTotalGeneral();
};
//Áreas comunes
window.calculateTotalAreas = function () {
    const asan = parseFloat(document.getElementById('asan_kg').value) || 0;
    const ajar = parseFloat(document.getElementById('ajar_kg').value) || 0;
    const aino = parseFloat(document.getElementById('aino_kg').value) || 0;

    const totalAreas = (asan + ajar + aino ).toFixed(3);  // Limita a 3 decimales
    document.getElementById('totalAreas').value = totalAreas;

    // Llama a la función de suma general
    calculateTotalGeneral();
};

// Suma general de todos los totales parciales
window.calculateTotalGeneral = function () {
    const totalRest = parseFloat(document.getElementById('totalRest').value) || 0;
    const totalHabi = parseFloat(document.getElementById('totalHabi').value) || 0;
    const totalAreas = parseFloat(document.getElementById('totalAreas').value) || 0;

    const totalGeneral = (totalRest + totalHabi + totalAreas).toFixed(3);
    document.getElementById('gentotal').value = totalGeneral;

     // Llama a `calculatePerCapita` para actualizar la generación per cápita
     calculatePerCapita();
};

// ------- PARTADO NUMERO 2 Generacion Percapita ---------

window.calculatePerCapita = function () {
    const totalGeneral = parseFloat(document.getElementById('gentotal').value) || 0;
    const totalHabi = parseFloat(document.getElementById('totalHabi').value) || 0;
    const Nhabitaciones = parseFloat(document.getElementById('nho').value) || 0;
    const NHuspedes = parseFloat(document.getElementById('nhn').value) || 0;
    const NPersonal = parseFloat(document.getElementById('np').value) || 0;


    const perCapita = (totalGeneral / (NPersonal+NHuspedes)).toFixed(3);
    document.getElementById('tp').value = perCapita;

    const perCapitaHabit = Nhabitaciones === 0 ? totalHabi : (totalHabi / Nhabitaciones).toFixed(3);
    document.getElementById('th').value = perCapitaHabit;
}

// ------- PARTADO NUMERO 3 Subproductos ---------

window.calculateSubproductos = function () {
    const bs_car = isNaN(parseFloat(document.getElementById('bs_car').value)) ? 0 : parseFloat(document.getElementById('bs_car').value);
    const bs_pap = isNaN(parseFloat(document.getElementById('bs_pap').value)) ? 0 : parseFloat(document.getElementById('bs_pap').value);
    const bs_alu = isNaN(parseFloat(document.getElementById('bs_alu').value)) ? 0 : parseFloat(document.getElementById('bs_alu').value);
    const bs_met = isNaN(parseFloat(document.getElementById('bs_met').value)) ? 0 : parseFloat(document.getElementById('bs_met').value);
    const bs_pet = isNaN(parseFloat(document.getElementById('bs_pet').value)) ? 0 : parseFloat(document.getElementById('bs_pet').value);
    const bs_pla = isNaN(parseFloat(document.getElementById('bs_pla').value)) ? 0 : parseFloat(document.getElementById('bs_pla').value);
    const bs_jar = isNaN(parseFloat(document.getElementById('bs_jar').value)) ? 0 : parseFloat(document.getElementById('bs_jar').value);
    const bs_ali = isNaN(parseFloat(document.getElementById('bs_ali').value)) ? 0 : parseFloat(document.getElementById('bs_ali').value);
    const bs_com = isNaN(parseFloat(document.getElementById('bs_com').value)) ? 0 : parseFloat(document.getElementById('bs_com').value);
    const bs_san = isNaN(parseFloat(document.getElementById('bs_san').value)) ? 0 : parseFloat(document.getElementById('bs_san').value);
    const bs_nv = isNaN(parseFloat(document.getElementById('bs_nv').value)) ? 0 : parseFloat(document.getElementById('bs_nv').value);
    const bs_ms = isNaN(parseFloat(document.getElementById('bs_ms').value)) ? 0 : parseFloat(document.getElementById('bs_ms').value);
    const bs_pel = isNaN(parseFloat(document.getElementById('bs_pel').value)) ? 0 : parseFloat(document.getElementById('bs_pel').value);
    const bs_vid = isNaN(parseFloat(document.getElementById('bs_vid').value)) ? 0 : parseFloat(document.getElementById('bs_vid').value);


    const totalSubproductos = (bs_car + bs_pap + bs_alu + bs_met + bs_pet + bs_pla + bs_jar + bs_ali + bs_com + bs_san + bs_nv + bs_ms + bs_pel + bs_vid).toFixed(3);
    document.getElementById('totalSubp').value = totalSubproductos;
}

// ------- PARTADO NUMERO 4 Valorizables ---------
window.calculateValorizables = function () {
    const vol_r2 = parseFloat(document.getElementById('vol_r2').value) || 0;
    const peso_net2 = parseFloat(document.getElementById('peso_net2').value) || 0;

    // Verifica que ninguno de los valores sea 0 antes de dividir
    if (vol_r2 !== 0 && peso_net2 !== 0) {
        const peso_vol2 = (peso_net2 / vol_r2).toFixed(3);
        document.getElementById('peso_vol2').value = peso_vol2;
    } else {
        document.getElementById('peso_vol2').value = 0; // Opcional: asigna 0 o deja el campo vacío
    }
}
// ------- PARTADO NUMERO 5 No Valorizables ---------
window.calculateNoValorizables = function () {
    const vol_r1 = parseFloat(document.getElementById('vol_r1').value) || 0;
    const peso_net1 = parseFloat(document.getElementById('peso_net1').value) || 0;

    // Verifica que ninguno de los valores sea 0 antes de dividir
    if (vol_r1 !== 0 && peso_net1 !== 0) {
        const peso_vol1 = (peso_net1 / vol_r1).toFixed(3);
        document.getElementById('peso_vol1').value = peso_vol1;
    } else {
        document.getElementById('peso_vol1').value = 0; // Opcional: asigna 0 o deja el campo vacío
    }
}
// ------- PARTADO NUMERO 6 Fechas y Valorizables ---------
//  Preguntar si el vidrio entra como valorizable
window.calculateFechas = function () {
    const bs_car = isNaN(parseFloat(document.getElementById('bs_car').value)) ? 0 : parseFloat(document.getElementById('bs_car').value);
    const bs_pap = isNaN(parseFloat(document.getElementById('bs_pap').value)) ? 0 : parseFloat(document.getElementById('bs_pap').value);
    const bs_alu = isNaN(parseFloat(document.getElementById('bs_alu').value)) ? 0 : parseFloat(document.getElementById('bs_alu').value);
    const bs_met = isNaN(parseFloat(document.getElementById('bs_met').value)) ? 0 : parseFloat(document.getElementById('bs_met').value);
    const bs_pet = isNaN(parseFloat(document.getElementById('bs_pet').value)) ? 0 : parseFloat(document.getElementById('bs_pet').value);
    const bs_pla = isNaN(parseFloat(document.getElementById('bs_pla').value)) ? 0 : parseFloat(document.getElementById('bs_pla').value);
    const bs_jar = isNaN(parseFloat(document.getElementById('bs_jar').value)) ? 0 : parseFloat(document.getElementById('bs_jar').value);
    const bs_ali = isNaN(parseFloat(document.getElementById('bs_ali').value)) ? 0 : parseFloat(document.getElementById('bs_ali').value);
    const bs_com = isNaN(parseFloat(document.getElementById('bs_com').value)) ? 0 : parseFloat(document.getElementById('bs_com').value);


    const totalValorizable = (bs_car + bs_pap + bs_alu + bs_met + bs_pet + bs_pla + bs_jar + bs_ali + bs_com).toFixed(3);
    document.getElementById('total_valor').value = totalValorizable;

}


// ------- DOOM ---------
// Agrega el evento `input` a los campos automáticamente
document.addEventListener('DOMContentLoaded', () => {
    // Campos para calcular `Total Rest`
    const fieldsRest = ['rali_kg', 'rcom_kg', 'rino_kg', 'rnva_kg'];
    fieldsRest.forEach(id => {
        const element = document.getElementById(id);
        if (element) {
            element.addEventListener('input', calculateTotalRest); // Llama a calculateTotalRest cuando se cambie
        }
    });

    // Campos para calcular `Total Habit`
    const fieldsHabit = ['hino_kg', 'hotr_kg'];
    fieldsHabit.forEach(id => {
        const element = document.getElementById(id);
        if (element) {
            element.addEventListener('input', calculateTotalHabit); // Llama a calculateTotalHabit cuando se cambie
        }
    });
    // Campos para calcular `Total Areas`
    const fieldsAreas = ['asan_kg', 'ajar_kg', 'aino_kg'];
    fieldsAreas.forEach(id => {
        const element = document.getElementById(id);
        if (element) {
            element.addEventListener('input', calculateTotalAreas); // Llama a calculateTotalHabit cuando se cambie
        }
    });
    // Campos para calcular `Per Capita`
    const fieldsPerCapita = ['gentotal', 'nho', 'nhn', 'np'];
    fieldsPerCapita.forEach(id => {
        const element = document.getElementById(id);
        if (element) {
            element.addEventListener('input', calculatePerCapita);
        }
    });
     // Campos para calcular `Subproductos`
     const fieldsSubProductos = ['bs_car', 'bs_pap', 'bs_alu', 'bs_met', 'bs_pet', 'bs_pla', 'bs_jar', 'bs_ali', 'bs_com', 'bs_san', 'bs_nv', 'bs_ms', 'bs_pel', 'bs_vid'];
     fieldsSubProductos.forEach(id => {
         const element = document.getElementById(id);
         if (element) {
             element.addEventListener('input', calculateSubproductos);
         }
     });
     // Campos para calcular `Valorizables`
     const fieldsValorizables = ['vol_r2', 'peso_net2'];
     fieldsValorizables.forEach(id => {
         const element = document.getElementById(id);
         if (element) {
             element.addEventListener('input', calculateValorizables);
         }
     });
          // Campos para calcular `No Valorizables`
          const fieldsNoValorizables = ['vol_r1', 'peso_net1'];
          fieldsNoValorizables.forEach(id => {
              const element = document.getElementById(id);
              if (element) {
                  element.addEventListener('input', calculateNoValorizables);
              }
          });
               // Campos para calcular `Subproductos`
     const fieldsSValorizables = ['bs_car', 'bs_pap', 'bs_alu', 'bs_met', 'bs_pet', 'bs_pla', 'bs_jar', 'bs_ali', 'bs_com'];
     fieldsSValorizables.forEach(id => {
         const element = document.getElementById(id);
         if (element) {
             element.addEventListener('input', calculateFechas);
         }
     });
});
