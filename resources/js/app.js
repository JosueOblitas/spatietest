import './bootstrap';
import 'flowbite';
import Alpine from 'alpinejs';
import Toaster from '../../vendor/masmerise/livewire-toaster/resources/js'; // 👈
import Turbolinks from 'turbolinks';

Turbolinks.start();

window.Alpine = Alpine;
Alpine.plugin(Toaster); // 👈
Alpine.start();

