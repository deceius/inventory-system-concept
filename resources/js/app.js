import './bootstrap';

import Alpine from 'alpinejs';
import branchIndex from './branch/branch-index';
import userIndex from './user/user-index';
import brandsIndex from './item-settings/brands-index';
import typesIndex from './item-settings/types-index';
import itemsIndex from './items/items-index';
import expensesIndex from './expense/expenses-index';

window.Alpine = Alpine;

Alpine.data('branchIndex', branchIndex);
Alpine.data('userIndex', userIndex);
Alpine.data('brandsIndex', brandsIndex);
Alpine.data('typesIndex', typesIndex);
Alpine.data('itemsIndex', itemsIndex);
Alpine.data('expensesIndex', expensesIndex);
Alpine.start();
