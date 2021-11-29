var app = new Vue({
    el: '#app',
    data: {
        fish_category_id: "",
        fish_name: "",
        region_id: "",
        markets: [],
        loading: false,
    },
    mounted() {
        this.getMarkets();
    },
    methods: {
        getMarkets() {
            this.loading = true,
                axios
                    .get('https://avesma.dev.can.co.id/api/v1/markets', {
                        params: {
                            fish_name: this.fish_name,
                            fish_category_id: this.fish_category_id,
                        }
                    })
                    .then(response => {
                        this.markets = response.data.ponds;
                        this.loading = false;
                    })
        }
    },
})