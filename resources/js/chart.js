import Chart from "chart.js/auto";

const labels = Object.keys(dailyData); // Le date
const earningsData = Object.values(dailyData).map((item) => item.earnings); // Guadagni

// Inizializza la data corrente
let currentDate = new Date();
console.log(earningsData);

// Funzione per ottenere tutti i giorni del mese
const getDailyLabels = (date) => {
    const year = date.getFullYear();
    const month = date.getMonth();
    const daysInMonth = new Date(year, month + 1, 0).getDate(); // Ottiene il numero di giorni nel mese

    return Array.from(
        { length: daysInMonth },
        (_, i) =>
            `${i + 1} ${date.toLocaleDateString("it-IT", { month: "short" })}`
    );
};

// Funzione per aggiornare il grafico e il mese mostrato
const updateChart = () => {
    const labels = getDailyLabels(currentDate);
    chart.data.labels = labels;
    chart.data.datasets[0].data = earningsData;
    chart.update();

    // Aggiorna il mese e l'anno visualizzato
    document.getElementById("currentMonth").textContent =
        currentDate.toLocaleDateString("it-IT", {
            month: "long",
            year: "numeric",
        });
};

// Configurazione iniziale del grafico
const ctx = document.getElementById("lineChart").getContext("2d");
const chart = new Chart(ctx, {
    type: "line",
    data: {
        labels: labels, // Le date
        datasets: [
            {
                label: "Guadagni (€)",
                data: earningsData, // Guadagni per ogni giorno
                fill: false,
                borderColor: "rgb(75, 192, 192)",
                tension: 0.1,
            },
        ],
    },
});

// Imposta il mese iniziale nella UI
document.getElementById("currentMonth").textContent =
    currentDate.toLocaleDateString("it-IT", { month: "long", year: "numeric" });

// Event listener per il pulsante "Precedente"
document.getElementById("prevMonth").addEventListener("click", () => {
    currentDate.setMonth(currentDate.getMonth() - 1);
    updateChart();
});

// Event listener per il pulsante "Successivo"
document.getElementById("nextMonth").addEventListener("click", () => {
    currentDate.setMonth(currentDate.getMonth() + 1);
    updateChart();
});
