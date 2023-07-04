export default () => ({
    isLoading: false,
    filter: {
        'search' : '',
        'inactive': false,
        'branch' : ''
    },
    result: [],
    selectedBranch: [],
    loadUsers() {
        this.$watch('filter.inactive', () => {
            this.reloadUsers();
        });
        this.isLoading = true;
        this.result = [];
        let url = '/admin/users/fetch';
        axios.get(url).then(
            response => {
                this.result = response.data.result;
                this.isLoading = false;
            }
        ).catch(error => {
               this.isLoading = false;
            }
        );
    },
    reloadUsers() {
        this.isLoading = true;
        this.result = [];
        let url = '/admin/users/fetch?search=' + this.filter.search + '&inactive=' + this.filter.inactive + '&branch=' + this.filter.branch;
        axios.get(url).then(
            response => {
                this.result = response.data.result;
                this.isLoading = false;
            }
        ).catch(error => {
               this.isLoading = false;
            }
        );
    },
    setPaginationLabel(label, index){
        if (index == 0) {
            return '<';
        }
        else if (index == this.result.links.length - 1) {
            return '>';
        }

        return label;
    },
    loadPage(url){
        if (url) {
            this.loadFromUrl(url + '&search='  + this.filter.search + '&inactive=' + this.filter.inactive + '&branch=' + this.filter.branch);
        }
    },
    loadFromUrl(url) {
        this.isLoading = true;
        this.result = [];
        axios.get(url).then(
            response => {
                this.result = response.data.result;
                this.isLoading = false;
            }
        ).catch(error => {
               this.isLoading = false;
            }
        );
    }
})
