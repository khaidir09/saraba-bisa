// Import Chart.js
import {
    Chart,
    BarController,
    BarElement,
    LinearScale,
    TimeScale,
    Tooltip,
    Legend,
} from "chart.js";

import { tailwindConfig, formatValue } from "../utils";

Chart.register(
    BarController,
    BarElement,
    LinearScale,
    TimeScale,
    Tooltip,
    Legend
);

// A chart built with Chart.js 3
// https://www.chartjs.org/
const laporanServis = () => {
    const ctx = document.getElementById("laporan-servis").getContext("2d");
    const chart = new Chart(ctx, {
        type: "line",
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul"],
            datasets: [
                {
                    label: "Omzet",
                    data: [65, 59, 80, 81, 56, 55, 40],
                    fill: false,
                    borderColor: "rgb(75, 192, 192)",
                    tension: 0.1,
                },
            ],
        },
        options: {
            chartArea: {
                backgroundColor: tailwindConfig().theme.colors.slate[50],
            },
            layout: {
                padding: 20,
            },
            scales: {
                y: {
                    display: false,
                    beginAtZero: true,
                },
                x: {
                    type: "time",
                    time: {
                        parser: "MM-DD-YYYY",
                        unit: "month",
                    },
                    display: false,
                },
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        title: () => false, // Disable tooltip title
                        label: (context) => formatValue(context.parsed.y),
                    },
                },
                legend: {
                    display: false,
                },
            },
            interaction: {
                intersect: false,
                mode: "nearest",
            },
            maintainAspectRatio: false,
        },
    });
};

export default laporanServis;
