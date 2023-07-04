export default () => ({
    isLoading: false,
    filter: {
        'search' : '',
        'inactive': false
    },
    data: [],
    selectedBranch: [],
    loadUsers() {
        this.$watch('filter.inactive', () => {
            this.reloadUsers();
        });
        this.isLoading = true;
        this.data = [];
        let url = '/admin/users/fetch';
        axios.get(url).then(
            response => {
                this.data = response.data.users;
                this.isLoading = false;
            }
        ).catch(error => {
               this.isLoading = false;
            }
        );
    },
    reloadUsers() {
        this.isLoading = true;
        this.data = [];
        let url = '/admin/users/fetch?search=' + this.filter.search + '&inactive=' + this.filter.inactive;
        axios.get(url).then(
            response => {
                this.data = response.data.users;
                this.isLoading = false;
            }
        ).catch(error => {
               this.isLoading = false;
            }
        );
    }
})
