import './bootstrap';

import Alpine from 'alpinejs';
import branchIndex from './branch/branch-index';

window.Alpine = Alpine;

Alpine.data('branchIndex', branchIndex);
Alpine.start();
