import './bootstrap';

import Alpine from 'alpinejs';
import branchIndex from './branch/branch-index';
import userIndex from './user/user-index';

window.Alpine = Alpine;

Alpine.data('branchIndex', branchIndex);
Alpine.data('userIndex', userIndex);
Alpine.start();
