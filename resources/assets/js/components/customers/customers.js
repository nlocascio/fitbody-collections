Vue.component('app-customers', {
    data () {
        return {
            customers: [],
            checkedCustomers: [],
            order: 'account_balance',
            desc: 1,
            fullScreenBusy: false
        }
    },

    computed: {
        totalBalances () {
            return Math.abs(
                _.reduce(
                    _.pluck(this.customers, 'account_balance'), (memo, num) => { return memo + num }, 0)
            )
        },

        checkedCustomerIds () {
            return _.pluck(this.checkedCustomers, 'id')
        }
    },

    events: {
        updateCustomers () {
            this.getCustomers()
        }
    },

    methods: {
        getCustomers () {
            this.fullScreenBusy = true;
            this.$http.get('/customers')
                .then((response) => {
                    this.customers = response.json()
                    this.fullScreenBusy = false;
                })
        },

        resyncCustomers () {
            this.fullScreenBusy = true;
            this.$http.post('/customer/refresh', {});
        },

        accountBalance(number) {
            return Math.abs(number).toLocaleString('en-US', { style: 'currency', currency: 'USD' })
        },

        checkAll (e) {
            var checkedCustomers = [];

            if (e.target.checked) {
                this.customers.forEach((customer) => {
                    checkedCustomers.push(customer)
                })
            }

            this.checkedCustomers = checkedCustomers;
        },

        createLetters () {
            window.location.href = '/customer/' + this.checkedCustomerIds.join('+') + '/letter/create'
        },

        createEmails () {
            window.location.href = '/customer/' + this.checkedCustomerIds.join('+') + '/email/create'
        }
    },

    ready () {
        this.getCustomers()

        var channel = Window.pusher.subscribe('user');

        channel.bind('App\\Events\\UpdatedCustomers', () => {
            this.getCustomers();
        });

        console.log('Customers loaded.')
    }
});