import Alpine from 'alpinejs';
import Chart from 'chart.js/auto';
import flatpickr from 'flatpickr';
import { Thai } from 'flatpickr/dist/l10n/th.js';

// Configure flatpickr for Thai
flatpickr.localize(Thai);

window.Alpine = Alpine;
window.Chart = Chart;
window.flatpickr = flatpickr;

Alpine.start();
