function kup_bilet(id, nr_sali) {
    // ticket_form
    document.getElementById("formularz_bilety").style.display = "block";
    document.getElementById("sala_str").textContent = "Sala numer: " + nr_sali;
    document.getElementById("film_str").textContent = document.getElementById("nazwa_filmu"+id).textContent;
    document.getElementById("date_str").textContent = document.getElementById("date"+id).textContent;
    document.getElementById("id_seans").value = id;
    document.getElementById("film_img").src  = 'img/' + document.getElementById("film_str").textContent + '.jpg'; 
}

function anuluj() {
    document.getElementById("formularz_bilety").style.display = "none";
}
