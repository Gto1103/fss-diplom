import sortSeances from "./sortSeances.js";
import viewSeances from "./viewSeances.js";

export default function deleteSeance(hallsData, moviesData, seancesData) {
    const seanceEl = [...document.querySelectorAll('.conf-step__seances-movie')];
    for (let i = 0; i < seanceEl.length; i++) {
        seanceEl[i].onclick = () => {
            const movie = moviesData.find(movie => movie.id == getSeanceId(i, hallsData, seancesData).movie_id);
            const formSeance = document.getElementById('delete_seance');
            formSeance.querySelector('span').textContent = movie.title;
            formSeance.action = '/admin/delete_seance/' +  getSeanceId(i, hallsData, seancesData).id;
            document.getElementById('deleteShowPopup').classList.add('active');
            formSeance.onsubmit = (e) => {
                e.preventDefault();
                let delEl = seancesData.findIndex(item => item.id == getSeanceId(i, hallsData, seancesData).id);
                seancesData.splice(delEl, 1);

                let seancesTable = document.querySelector('.data-tables-seances');
                seancesTable.value = JSON.stringify(seancesData);

                viewSeances(hallsData, moviesData, seancesData);
                document.getElementById('deleteShowPopup').classList.remove('active');
            }
        }
    }
}

//вспомогательная функция возвращает сеанс от его номера в seances-timeline
function getSeanceId(k, hallsData, seancesData) {
    let hallSession = sortSeances(hallsData, seancesData);
    let i = 0;
    let j = 0;
    for (let s = 0; s < hallSession.length; s++) {
        if (hallSession[s].length - k <= 0) {
            k -= hallSession[s].length;
            i++;
        } else {
            j = k;
            break;
        }
    }
    return hallSession[i][j];
}
